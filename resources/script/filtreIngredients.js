let selectedIngredients = {};

function init() {
    document.querySelector("#ingredientSearch").addEventListener("input", function (e) {
        document.querySelector('#ingredientsResults ul').innerHTML = "";
        if (document.querySelector("#ingredientSearch").value == "") return;
        let xhr = new XMLHttpRequest();
        xhr.open('GET', "index.php?controller=API&action=getIngredients&searchText=" + document.querySelector("#ingredientSearch").value, true);
        xhr.send();
        xhr.onload = function () {
            if (xhr.status === 200) {
                let ingredients = JSON.parse(xhr.responseText);
                for (let i = 0; i < ingredients.length; i++) {
                    let li = document.createElement("li");
                    li.classList.add("list-group-item");
                    li.textContent = ingredients[i].ing_title;
                    li.addEventListener("click", function (e) {
                        selectedIngredients[ingredients[i].ing_id] = ingredients[i].ing_title;
                        document.querySelector("#ingredientSearch").value = "";
                        document.querySelector('#ingredientsResults ul').innerHTML = "";
                        updateSelectedIngredients();
                        searchForRecipes();
                    });
                    document.querySelector('#ingredientsResults ul').appendChild(li);
                }
            }
        };
    });
    updateSelectedIngredients();
    searchForRecipes();
}

function updateSelectedIngredients() {
    document.querySelector('#ingredientsSelected ul').innerHTML = "";
    for (var ing_id in selectedIngredients) {
        let li = document.createElement("li");
        li.classList.add("list-group-item");
        li.textContent = selectedIngredients[ing_id];
        li.addEventListener("click", function (e) {
            delete selectedIngredients[ing_id];
            updateSelectedIngredients();
            searchForRecipes();
        });
        let crossIcon = document.createElement("div");
        crossIcon.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16"> <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/> </svg>';
        li.appendChild(crossIcon);
        document.querySelector('#ingredientsSelected ul').appendChild(li);
    }
    if (Object.keys(selectedIngredients).length === 0) {
        document.querySelector('#ingredientsSelected ul').innerHTML = '<div class="alert alert-secondary" role="alert">Aucun ingrédient sélectionné</div>';
    }
}

function searchForRecipes() {
    let url = "index.php?controller=API&action=ingredientsFilter&tab_ing_id=";
    for (var ing_id in selectedIngredients) {
        url += ing_id + ",";
    }
    if (url[url.length - 1] === ",") {
        url = url.substring(0, url.length - 1);
    }
    // Request AJAX
    let xhr = new XMLHttpRequest();
    xhr.open('GET', url, true);
    xhr.send();
    xhr.onload = function () {
        if (xhr.status === 200) {
            // Parse JSON
            let recipes = JSON.parse(xhr.responseText);
            // Display recipes
            let html = '';
            for (let i = 0; i < recipes.length; i++) {
                html += '<div class="col_display">';
                html += '<div class="card">';
                html += '<img class="card-img-top" src="resources/img/recipes_images/' + recipes[i].rec_image_src + '" alt="Card image cap">';
                html += '<div class="card-body">';
                html += '<h5 class="card-title">' + recipes[i].rec_title + '</h5>';
                html += '<p class="card-text">' + recipes[i].rec_summary + '</p>';
                html += '<a href="index.php?controller=recipes&action=read&id='+ recipes[i].rec_id +'" class="btn btn-primary">Consulter la recette</a>';
                html += '</div>';
                html += '</div>';
                html += '</div>';
            }
            if (recipes.length === 0) {
                html = '<div class="alert alert-secondary" role="alert">Aucune recette ne correspond à votre recherche</div>';
            }
            document.querySelector('#results').innerHTML = html;
        }
    };
}

init();