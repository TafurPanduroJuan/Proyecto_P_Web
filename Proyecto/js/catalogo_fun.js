document.addEventListener("DOMContentLoaded", () => {
  const links = document.querySelectorAll(".categorias a");
  const contenedor = document.getElementById("contenedor-productos");
  const contenedorFiltros = document.querySelector(".filtros");

  // Función para cargar los filtros según la categoría
  async function cargarFiltros(categoria) {
    contenedorFiltros.innerHTML = "<h3>Filtros</h3>"; // Limpiar filtros

    try {
      const res = await fetch("../data/filtros.json");
      const data = await res.json();
      const filtros = data[categoria]; // Ej: filtros["monitores"]

      for (const titulo in filtros) {
        const valores = filtros[titulo];

        // Título del grupo de filtro
        const strong = document.createElement("strong");
        strong.textContent = titulo;
        contenedorFiltros.appendChild(strong);

        // Opciones del filtro
        valores.forEach(valor => {
          const label = document.createElement("label");
          label.innerHTML = `<input type="checkbox"> ${valor}`;
          contenedorFiltros.appendChild(label);
        });
      }
    } catch (error) {
      contenedorFiltros.innerHTML += "<p>Error al cargar filtros.</p>";
      console.error(error);
    }
  }

  // Función para cargar productos según la categoría
  async function cargarCategoria(categoria) {
    try {
      const res = await fetch(`../data/${categoria}.json`);
      const productos = await res.json();

      contenedor.innerHTML = ""; // Limpiar productos anteriores

      productos.forEach(prod => {
        const div = document.createElement("div");
        div.classList.add("id-producto");
        div.innerHTML = `
          <img src="${prod.imagen}" alt="${prod.nombre}">
          <h4>${prod.nombre}</h4>
          <p>S/ ${prod.precio.toFixed(2)}</p>
          <button id="carrito">Agregar al carrito</button>
        `;
        contenedor.appendChild(div);
      });

      // También cargamos filtros para esta categoría
      cargarFiltros(categoria);
    } catch (error) {
      contenedor.innerHTML = "<p>Error al cargar productos.</p>";
      console.error(error);
    }
  }

  // Evento para cada subcategoría del menú
  links.forEach(link => {
    link.addEventListener("click", (e) => {
      e.preventDefault();
      const categoria = link.textContent.trim().toLowerCase();
      cargarCategoria(categoria);
    });
  });

  // Mostrar monitores al iniciar
  cargarCategoria("monitores");
});
