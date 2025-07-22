document.addEventListener("DOMContentLoaded", function () {
    const tablaProductos = document.getElementById("tabla-productos");
    const modalForm = new bootstrap.Modal(document.getElementById("modalForm"));
    const formProducto = document.getElementById("form-producto");
    const inputId = document.getElementById("inputId");
    const modalTitle = document.getElementById("modalTitle");
    const selectCategory = document.getElementById("product-category");
    const dynamicSpecsContainer = document.getElementById("dynamic-specs-container");
    const btnAddProduct = document.getElementById("btn-add-product");
    const productImageInput = document.getElementById("product-image");
    const imagePreview = document.getElementById("image-preview");
    const currentImagePath = document.getElementById("current-image-path");

    let categorias = []; // Para almacenar las categorías cargadas

    // Mapeo de IDs de categoría a nombres de tablas y campos de especificaciones
    const categorySpecsMap = {
        1: { // Audífonos
            table: 'audifonos',
            fields: [
                { name: 'tipo', label: 'Tipo', type: 'text' },
                { name: 'conexion_esp', label: 'Conexión', type: 'text' }, // Renombrado para evitar conflicto
                { name: 'luces', label: 'Luces', type: 'text' }
            ]
        },
        2: { // Monitores
            table: 'monitores',
            fields: [
                { name: 'pantalla', label: 'Tamaño de Pantalla', type: 'text' },
                { name: 'resolucion', label: 'Resolución', type: 'text' },
                { name: 'frecuencia', label: 'Frecuencia', type: 'text' },
                { name: 'panel', label: 'Tipo de Panel', type: 'text' }
            ]
        },
        3: { // Mouse
            table: 'mouses',
            fields: [
                { name: 'tipo', label: 'Tipo', type: 'text' },
                { name: 'dpi', label: 'DPI', type: 'text' },
                { name: 'conexion_esp', label: 'Conexión', type: 'text' } // Renombrado
            ]
        },
        4: { // Teclados
            table: 'teclados',
            fields: [
                { name: 'tipo', label: 'Tipo', type: 'text' },
                { name: 'idioma', label: 'Idioma', type: 'text' },
                { name: 'conectividad', label: 'Conectividad', type: 'text' },
                { name: 'iluminacion', label: 'Iluminación', type: 'text' }
            ]
        }
    };

    // Función para cargar categorías en el select
    async function loadCategories() {
        try {
            const response = await fetch('../controlador/productos.php?action=get_categories');
            categorias = await response.json();
            selectCategory.innerHTML = '<option value="">Seleccione la categoria del producto</option>';
            categorias.forEach(cat => {
                const option = document.createElement('option');
                option.value = cat.id;
                option.textContent = cat.nombre;
                selectCategory.appendChild(option);
            });
        } catch (error) {
            console.error('Error al cargar categorías:', error);
        }
    }

    // Función para generar campos de especificaciones dinámicamente
    function generateDynamicSpecs(categoryId, productData = {}) {
        dynamicSpecsContainer.innerHTML = ''; // Limpiar campos anteriores
        const specs = categorySpecsMap[categoryId];

        if (specs) {
            specs.fields.forEach(field => {
                const div = document.createElement('div');
                div.className = 'form-group mb-2';
                const label = document.createElement('label');
                label.textContent = field.label;
                const input = document.createElement('input');
                input.type = field.type;
                input.className = 'form-control';
                input.name = field.name;
                input.placeholder = field.label;
                input.required = true;
                // Rellenar con datos si se está editando
                if (productData[field.name]) {
                    input.value = productData[field.name];
                }
                div.appendChild(label);
                div.appendChild(input);
                dynamicSpecsContainer.appendChild(div);
            });
        }
    }

    // Evento al cambiar la categoría seleccionada
    selectCategory.addEventListener('change', function () {
        const selectedCategoryId = this.value;
        generateDynamicSpecs(selectedCategoryId);
    });

    // Función para cargar y mostrar productos en la tabla
    async function loadProducts() {
        try {
            const response = await fetch('../controlador/productos.php?action=list');
            const products = await response.json();
            tablaProductos.innerHTML = '';
            products.forEach(product => {
                const row = tablaProductos.insertRow();
                row.innerHTML = `
                    <td class="text-center">${product.id}</td>
                    <td>${product.nombre}</td>
                    <td class="text-center">S/ ${parseFloat(product.precio).toFixed(2)}</td>
                    <td class="text-center">${product.categoria_nombre}</td>
                    <td class="text-center">
                        ${product.imagen ? `<img src="${product.imagen}" alt="${product.nombre}" style="width: 50px; height: 50px; object-fit: cover;">` : 'N/A'}
                    </td>
                    <td class="text-center">
                        <button class="btn btn-small btn-warning btn-edit" data-id="${product.id}" data-category-id="${product.categoria_id}">
                            <span class="material-symbols-outlined">edit</span>
                        </button>
                    </td>
                    <td class="text-center">
                        <button class="btn btn-small btn-danger btn-delete" data-id="${product.id}">
                            <span class="material-symbols-outlined">delete</span>
                        </button>
                    </td>
                `;
            });
            attachEventListeners();
        } catch (error) {
            console.error('Error al cargar productos:', error);
        }
    }

    // Adjuntar event listeners a los botones de editar y eliminar
    function attachEventListeners() {
        document.querySelectorAll('.btn-edit').forEach(button => {
            button.onclick = async () => {
                const productId = button.dataset.id;
                const categoryId = button.dataset.categoryId;
                modalTitle.textContent = 'Editar Producto';
                formProducto.action = '../controlador/productos.php?action=update';
                inputId.value = productId;

                try {
                    const response = await fetch(`../controlador/productos.php?action=get_product&id=${productId}`);
                    const productData = await response.json();
                    if (productData) {
                        document.getElementById('product-name').value = productData.nombre;
                        document.getElementById('product-price').value = productData.precio;
                        selectCategory.value = productData.categoria_id;
                        currentImagePath.value = productData.imagen || ''; // Guardar la ruta actual de la imagen
                        if (productData.imagen) {
                            imagePreview.src = productData.imagen;
                            imagePreview.style.display = 'block';
                        } else {
                            imagePreview.style.display = 'none';
                        }
                        generateDynamicSpecs(productData.categoria_id, productData); // Generar y rellenar especificaciones
                        modalForm.show();
                    }
                } catch (error) {
                    console.error('Error al obtener datos del producto para edición:', error);
                }
            };
        });

        document.querySelectorAll('.btn-delete').forEach(button => {
            button.onclick = async () => {
                if (confirm('¿Estás seguro de que quieres eliminar este producto?')) {
                    const productId = button.dataset.id;
                    try {
                        const formData = new FormData();
                        formData.append('id', productId);
                        const response = await fetch('../controlador/productos.php?action=delete', {
                            method: 'POST',
                            body: formData
                        });
                        const result = await response.text();
                        alert(result);
                        loadProducts(); // Recargar productos después de eliminar
                    } catch (error) {
                        console.error('Error al eliminar producto:', error);
                    }
                }
            };
        });
    }

    // Manejar el envío del formulario (Agregar/Editar)
    formProducto.addEventListener('submit', async function (event) {
        event.preventDefault();
        const formData = new FormData(formProducto);

        // Si no se selecciona una nueva imagen en edición, mantener la existente
        if (inputId.value && !productImageInput.files.length) {
            formData.append('imagen', currentImagePath.value);
        }

        try {
            const response = await fetch(formProducto.action, {
                method: 'POST',
                body: formData
            });
            const result = await response.text();
            alert(result);
            modalForm.hide();
            loadProducts(); // Recargar productos después de guardar
        } catch (error) {
            console.error('Error al guardar producto:', error);
        }
    });

    // Limpiar el modal al cerrarlo
    document.getElementById('modalForm').addEventListener('hidden.bs.modal', function () {
        formProducto.reset();
        inputId.value = '';
        modalTitle.textContent = 'Nuevo Producto';
        formProducto.action = '../controlador/productos.php?action=insert';
        dynamicSpecsContainer.innerHTML = ''; // Limpiar especificaciones dinámicas
        imagePreview.style.display = 'none';
        imagePreview.src = '';
        currentImagePath.value = '';
        selectCategory.value = ''; // Resetear la selección de categoría
    });

    // Evento para el botón "Agregar Producto"
    btnAddProduct.addEventListener('click', function() {
        modalTitle.textContent = 'Nuevo Producto';
        formProducto.action = '../controlador/productos.php?action=insert';
        formProducto.reset();
        inputId.value = '';
        dynamicSpecsContainer.innerHTML = '';
        imagePreview.style.display = 'none';
        imagePreview.src = '';
        currentImagePath.value = '';
        selectCategory.value = '';
    });

    // Previsualización de la imagen
    productImageInput.addEventListener('change', function() {
        if (this.files && this.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                imagePreview.src = e.target.result;
                imagePreview.style.display = 'block';
            };
            reader.readAsDataURL(this.files[0]);
        } else {
            imagePreview.style.display = 'none';
            imagePreview.src = '';
        }
    });

    // Cargar categorías y productos al iniciar
    loadCategories();
    loadProducts();
});
