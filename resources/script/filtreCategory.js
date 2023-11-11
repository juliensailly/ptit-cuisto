function init() {
    var radios = document.forms["categoriesForm"].elements["catRadio"];
    for (var i = 0, max = radios.length; i < max; i++) {
        radios[i].onclick = function () {
            displayRecipe();
        };
    }
    displayRecipe();
}

function displayRecipe() {
    if (document.forms["categoriesForm"].elements["catRadio"].value == "") return;
    window.history.pushState(
        {},
        "",
        "index.php?controller=filtre&action=categories&id=" +
        document.forms["categoriesForm"].elements["catRadio"].value
    );
    let xhr = new XMLHttpRequest();
    xhr.open(
        "GET",
        "index.php?controller=API&action=categoryFilter&id=" +
        document.forms["categoriesForm"].elements["catRadio"].value,
        true
    );
    xhr.send();
    xhr.onload = function () {
        if (xhr.status === 200) {
            // Parse JSON
            let recipes = JSON.parse(xhr.responseText);
            // Display recipes
            let html = "";
            for (let i = 0; i < recipes.length; i++) {
                html += '<div class="col_display">';
                html += '<div class="card">';
                html +=
                    '<img class="card-img-top" src="resources/img/recipes_images/' +
                    recipes[i].rec_image_src +
                    '" alt="Card image cap">';
                html += '<div class="card-body">';
                html +=
                    '<h5 class="card-title">' + recipes[i].rec_title + "</h5>";
                html +=
                    '<p class="card-text">' + recipes[i].rec_summary + "</p>";
                html +=
                    '<a href="index.php?controller=recipes&action=read&id=' +
                    recipes[i].rec_id +
                    '" class="btn btn-primary">Consulter la recette</a>';
                html += "</div>";
                html += "</div>";
                html += "</div>";
            }
            document.querySelector("#results").innerHTML = html;
        }
    };
}

init();
