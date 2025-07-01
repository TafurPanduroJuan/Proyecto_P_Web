document.addEventListener("DOMContentLoaded", () => {
    const links = document.querySelectorAll(".categorias .categoria-link");
    const contenedor = document.getElementById("contenedor-productos");
    const contenedorFiltros = document.querySelector(".filtros");

    let productosActuales = [];
    let categoriaActual = "monitores";

    const clavesFiltro = {
        "Tamaño de Pantalla": "pantalla",
        "Resolución": "resolucion",
        "Frecuencia": "frecuencia",
        "Tipo de Panel": "panel",
        "Tipo": "tipo",
        "DPI": "dpi",
        "Conexión": "conexion",
        "Luces": "luces",
        "Idioma": "idioma",
        "Conectividad": "conectividad",
        "Iluminación": "iluminacion"
    };

    async function cargarFiltros(categoria) {
        contenedorFiltros.innerHTML = "<h3>Filtros</h3>";

        try {
            const res = await fetch(`/Proyecto_P_Web/Proyecto/public/data/${categoria}.json`);
            const data = await res.json();

            const filtrosDisponibles = {};

            data.forEach(producto => {
                for (const [titulo, clave] of Object.entries(clavesFiltro)) {
                    if (producto[clave]) {
                        if (!filtrosDisponibles[titulo]) {
                            filtrosDisponibles[titulo] = new Set();
                        }
                        filtrosDisponibles[titulo].add(producto[clave]);
                    }
                }
            });

            for (const titulo in filtrosDisponibles) {
                const valores = Array.from(filtrosDisponibles[titulo]);

                const strong = document.createElement("strong");
                strong.textContent = titulo;
                contenedorFiltros.appendChild(strong);

                valores.forEach(valor => {
                    const label = document.createElement("label");
                    label.innerHTML = `
                        <input type="checkbox" data-filtro-grupo="${titulo}" value="${valor}"> ${valor}
                    `;
                    contenedorFiltros.appendChild(label);
                });
            }

            contenedorFiltros.querySelectorAll("input[type='checkbox']").forEach(chk => {
                chk.addEventListener("change", aplicarFiltros);
            });

        } catch (error) {
            contenedorFiltros.innerHTML += "<p>Error al cargar filtros.</p>";
            console.error("Error al cargar filtros:", error);
        }
    }

    function mostrarProductos(productos) {
        contenedor.innerHTML = "";

        if (productos.length === 0) {
            contenedor.innerHTML = "<p>No hay productos que coincidan con los filtros seleccionados.</p>";
            return;
        }

        productos.forEach((prod, index) => {
            const div = document.createElement("div");
            div.className = "id-producto";
            div.dataset.id = `prod-${categoriaActual}-${index}`;

            let detallesHTML = "";
            for (const filtroTitulo in clavesFiltro) {
                const claveProd = clavesFiltro[filtroTitulo];
                if (prod[claveProd] !== undefined) {
                    detallesHTML += `<p><strong>${filtroTitulo}:</strong> ${prod[claveProd]}</p>`;
                }
            }

            div.innerHTML = `
                <img src="${prod.imagen}" alt="${prod.nombre}">
                <h4>${prod.nombre}</h4>
                <p><strong>Precio:</strong> S/ ${prod.precio.toFixed(2)}</p>
                ${detallesHTML}
                <button class="add-to-cart-btn">Agregar al carrito</button>
            `;

            contenedor.appendChild(div);
        });

        if (typeof window.inicializarBotonesCarrito === 'function') {
            window.inicializarBotonesCarrito();
        }
    }

    async function cargarCategoria(categoria) {
        try {
            const res = await fetch(`/Proyecto_P_Web/Proyecto/public/data/${categoria}.json`);
            const productos = await res.json();

            productosActuales = productos;
            categoriaActual = categoria;

            await cargarFiltros(categoria);
            mostrarProductos(productos);
        } catch (error) {
            contenedor.innerHTML = "<p>Error al cargar productos de esta categoría.</p>";
            console.error(`Error al cargar productos de ${categoria}:`, error);
        }
    }

    function aplicarFiltros() {
        const filtrosSeleccionados = {};

        contenedorFiltros.querySelectorAll("input[type='checkbox']:checked").forEach(chk => {
            const filtroGrupo = chk.getAttribute("data-filtro-grupo");
            const valor = chk.value;

            if (!filtrosSeleccionados[filtroGrupo]) {
                filtrosSeleccionados[filtroGrupo] = [];
            }
            filtrosSeleccionados[filtroGrupo].push(valor);
        });

        if (Object.keys(filtrosSeleccionados).length === 0) {
            mostrarProductos(productosActuales);
            return;
        }

        const productosFiltrados = productosActuales.filter(prod => {
            for (const filtroGrupo in filtrosSeleccionados) {
                const claveProd = clavesFiltro[filtroGrupo];
                const valoresSeleccionados = filtrosSeleccionados[filtroGrupo];

                if (prod[claveProd] === undefined || prod[claveProd] === null) {
                    return false;
                }

                const coincideGrupo = valoresSeleccionados.some(valor => {
                    const prodValor = String(prod[claveProd]).trim().replace(/['"]/g, '');
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

    links.forEach(link => {
        link.addEventListener("click", (e) => {
            e.preventDefault();
            const categoria = link.dataset.categoria;
            cargarCategoria(categoria);
        });
    });

    cargarCategoria(categoriaActual);
});
