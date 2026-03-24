document.addEventListener("DOMContentLoaded", function () {
    
    document.getElementById("categoria").addEventListener("change", function() {
    let categoria = this.value.toLowerCase();
        console.log(categoria);

    if (categoria !== "") {
        window.location.href = "categoria-" + categoria + ".php";
    }
});

});