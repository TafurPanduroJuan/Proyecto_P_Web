document.addEventListener("DOMContentLoaded", () => {
    const links = document.querySelectorAll(".categorias .categoria-link");
    const contenedor = document.getElementById("contenedor-productos");
    const contenedorFiltros = document.querySelector(".filtros");

    let todosLosProductos = []; // Almacenará todos los productos de la DB
    let productosActualesFiltradosPorCategoria = []; // Productos de la categoría seleccionada
    let categoriaActualId = null; // Almacenará el ID de la categoría actual

    // Mapeo de IDs de categoría a nombres de tablas y campos de especificaciones
    // Esto es crucial para saber qué campos de especificación buscar en los datos del producto
    const categorySpecsMap = {
        1: { // Audífonos
            name: 'auriculares',
            fields: [
                { name: 'tipo', label: 'Tipo' },
                { name: 'conexion', label: 'Conexión' },
                { name: 'luces', label: 'Luces' }
            ]
        },
        2: { // Monitores
            name: 'monitores',
            fields: [
                { name: 'pantalla', label: 'Tamaño de Pantalla' },
                { name: 'resolucion', label: 'Resolución' },
                { name: 'frecuencia', label: 'Frecuencia' },
                { name: 'panel', label: 'Tipo de Panel' }
            ]
        },
        3: { // Mouse
            name: 'mouse',
            fields: [
                { name: 'tipo', label: 'Tipo' },
                { name: 'dpi', label: 'DPI' },
                { name: 'conexion', label: 'Conexión' }
            ]
        },
        4: { // Teclados
            name: 'teclados',
            fields: [
                { name: 'tipo', label: 'Tipo' },
                { name: 'idioma', label: 'Idioma' },
                { name: 'conectividad', label: 'Conectividad' },
                { name: 'iluminacion', label: 'Iluminación' }
            ]
        }
    };

    // Función para obtener el ID de categoría a partir del nombre (usado en data-categoria)
    function getCategoryIdByName(categoryName) {
        for (const id in categorySpecsMap) {
            if (categorySpecsMap[id].name === categoryName) {
                return parseInt(id);
            }
        }
        return null;
    }

    async function cargarFiltros(productosDeCategoria) {
        contenedorFiltros.innerHTML = "";

        const tituloFiltros = document.createElement("h3");
        tituloFiltros.textContent = "Filtros";
        contenedorFiltros.appendChild(tituloFiltros);

        try {
            const filtrosDisponibles = {};
            const currentCategorySpecs = categorySpecsMap[categoriaActualId];

            if (currentCategorySpecs) {
                currentCategorySpecs.fields.forEach(field => {
                    filtrosDisponibles[field.label] = new Set();
                });

                productosDeCategoria.forEach(producto => {
                    currentCategorySpecs.fields.forEach(field => {
                        if (producto[field.name]) {
                            filtrosDisponibles[field.label].add(producto[field.name]);
                        }
                    });
                });

                for (const titulo in filtrosDisponibles) {
                    const valores = Array.from(filtrosDisponibles[titulo]);

                    if (valores.length > 0) { // Solo mostrar filtros si hay valores disponibles
                        const strong = document.createElement("strong");
                        strong.textContent = titulo;
                        contenedorFiltros.appendChild(strong);

                        valores.forEach(valor => {
                            const label = document.createElement("label");
                            const input = document.createElement("input");
                            input.type = "checkbox";
                            input.setAttribute("data-filtro-grupo", titulo);
                            input.value = valor;

                            label.appendChild(input);
                            label.append(` ${valor}`);
                            contenedorFiltros.appendChild(label);
                        });
                    }
                }
            }

            contenedorFiltros.querySelectorAll("input[type='checkbox']").forEach(chk => {
                chk.addEventListener("change", aplicarFiltros);
            });

        } catch (error) {
            contenedorFiltros.innerHTML += "<p>Error al cargar filtros.</p>";
            console.error("Error al cargar filtros:", error);
        }
    }

    function mostrarProductos(productosAMostrar) {
        contenedor.innerHTML = "";

        if (productosAMostrar.length === 0) {
            contenedor.innerHTML = "<p>No hay productos que coincidan con los filtros seleccionados.</p>";
            return;
        }

        const currentCategorySpecs = categorySpecsMap[categoriaActualId];

        productosAMostrar.forEach((prod, index) => {
            const div = document.createElement("div");
            div.className = "id-producto";
            div.dataset.id = `prod-${prod.id}`; // Usar el ID real del producto de la DB

            let detallesHTML = "";
            if (currentCategorySpecs) {
                currentCategorySpecs.fields.forEach(field => {
                    if (prod[field.name] !== undefined && prod[field.name] !== null) {
                        detallesHTML += `<p><strong>${field.label}:</strong> ${prod[field.name]}</p>`;
                    }
                });
            }

            div.innerHTML = `
                <img src="${prod.imagen}" alt="${prod.nombre}">
                <h4>${prod.nombre}</h4>
                <p><strong>Precio:</strong> S/ ${parseFloat(prod.precio).toFixed(2)}</p>
                ${detallesHTML}
                <button class="add-to-cart-btn">Agregar al carrito</button>
            `;

            contenedor.appendChild(div);
        });

        if (typeof window.inicializarBotonesCarrito === 'function') {
            window.inicializarBotonesCarrito();
        }
    }

    async function cargarTodosLosProductosDesdeDB() {
        try {
            const res = await fetch('../controlador/productos.php?action=list');
            if (!res.ok) {
                throw new Error(`HTTP error! status: ${res.status}`);
            }
            todosLosProductos = await res.json();
            console.log("Productos cargados desde DB:", todosLosProductos);
        } catch (error) {
            console.error("Error al cargar todos los productos desde la base de datos:", error);
            contenedor.innerHTML = "<p>Error al cargar productos. Inténtalo de nuevo más tarde.</p>";
        }
    }

    async function cargarCategoria(categoriaNombre) {
        // Obtener el ID de la categoría
        categoriaActualId = getCategoryIdByName(categoriaNombre);
        if (categoriaActualId === null) {
            console.error("Categoría no encontrada:", categoriaNombre);
            contenedor.innerHTML = "<p>Categoría no válida.</p>";
            return;
        }

        // Filtrar los productos por la categoría seleccionada
        productosActualesFiltradosPorCategoria = todosLosProductos.filter(prod => 
            prod.categoria_id === categoriaActualId
        );

        await cargarFiltros(productosActualesFiltradosPorCategoria);
        mostrarProductos(productosActualesFiltradosPorCategoria);
    }

    function aplicarFiltros() {
        const filtrosSeleccionados = {};
        const currentCategorySpecs = categorySpecsMap[categoriaActualId];

        contenedorFiltros.querySelectorAll("input[type='checkbox']:checked").forEach(chk => {
            const filtroGrupoLabel = chk.getAttribute("data-filtro-grupo"); // e.g., "Tamaño de Pantalla"
            const valor = chk.value;

            // Encontrar el nombre de la clave de la DB a partir del label del filtro
            const fieldName = currentCategorySpecs.fields.find(f => f.label === filtroGrupoLabel)?.name;

            if (fieldName) {
                if (!filtrosSeleccionados[fieldName]) {
                    filtrosSeleccionados[fieldName] = [];
                }
                filtrosSeleccionados[fieldName].push(valor);
            }
        });

        if (Object.keys(filtrosSeleccionados).length === 0) {
            mostrarProductos(productosActualesFiltradosPorCategoria);
            return;
        }

        const productosFiltrados = productosActualesFiltradosPorCategoria.filter(prod => {
            for (const fieldName in filtrosSeleccionados) {
                const valoresSeleccionados = filtrosSeleccionados[fieldName];

                if (prod[fieldName] === undefined || prod[fieldName] === null) {
                    return false;
                }

                const coincideGrupo = valoresSeleccionados.some(valor => {
                    const prodValor = String(prod[fieldName]).trim().replace(/['"]/g, '');
                    const filtroValor = String(valor).trim().replace(/['"]/g, '');
                    return prodValor === filtroValor;
                });

                if (!coincideGrupo) {
                    return false;
                }
            }
            return true;
        });

        mostrarProductos(productosFiltrados);
    }

    // Event listeners para los enlaces de categoría
    links.forEach(link => {
        link.addEventListener("click", (e) => {
            e.preventDefault();
            const categoria = link.dataset.categoria; // 'monitores', 'mouse', etc.
            cargarCategoria(categoria);
        });
    });

    // Cargar todos los productos al inicio y luego la categoría por defecto
    cargarTodosLosProductosDesdeDB().then(() => {
        // Cargar la categoría por defecto (por ejemplo, monitores)
        cargarCategoria("monitores");
    });
});
