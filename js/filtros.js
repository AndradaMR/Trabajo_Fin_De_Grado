document.addEventListener("DOMContentLoaded", function () {

    let categoriaFiltro = document.getElementById("categoria_filtro");
    let subcategoriaFiltro = document.getElementById("subcategoria_filtro");
    let filtrosBuscar = document.getElementById("filtrosbuscar");
    let buscador = document.getElementById("buscador");
    let precio = document.getElementById("precio");

    categoriaFiltro.addEventListener("change", function () {
        let nombrecat = this.value;

        subcategoriaFiltro.innerHTML = '<option value="">Subcategorías</option>';

        if (nombrecat !== "" && subcategoriasPorPadre[nombrecat]) {
            subcategoriasPorPadre[nombrecat].forEach(function(subcat) {
                const option = document.createElement("option");
                option.value = subcat.id_categoria;
                option.textContent = subcat.nombre;
                subcategoriaFiltro.appendChild(option);
            });
        }
    });

    filtrosBuscar.addEventListener("click", function () {
        let params = [];

    if (buscador.value.trim() !== "") {
        params.push("buscador=" + encodeURIComponent(buscador.value.trim()));
    }

    if (categoriaFiltro.value !== "") {
        params.push("categoria=" + encodeURIComponent(categoriaFiltro.value));
    }

    if (subcategoriaFiltro.value !== "") {
        params.push("subcategoria=" + encodeURIComponent(subcategoriaFiltro.value));
    }

    if (precio.value !== "") {
        params.push("precio=" + encodeURIComponent(precio.value));
    }

    window.location.href = "categoria.php?" + params.join("&");
});

});
