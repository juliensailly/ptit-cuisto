function init() {
    document.querySelector("#formIngredients").addEventListener("input", function (e) {
        let selectedIngredients = [];
        document.querySelectorAll(".ingredient").forEach(function (element) {
            if (element.checked) {
                selectedIngredients.push(element.value);
            }
        });
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "/filtreIngredients");
        xhr.setRequestHeader("Content-Type", "application/json");
        xhr.addEventListener("load", function () {
            document.querySelector("#recettes").innerHTML = xhr.responseText;
        });
        xhr.send(JSON.stringify(selectedIngredients));
        
    });
}

init();