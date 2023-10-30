function init() {
    document.querySelector("#formIngredients").addEventListener("input", function (e) {
        let selectedIngredients = [], url = "http://localhost/index.php?controller=API&action=ingredientsFilter&tab_ing_id=";
        document.querySelectorAll(".ingredient").forEach(function (element) {
            if (element.checked) {
                selectedIngredients.push(element.value);
                url += element.value + ",";
            }
        });
        if (selectedIngredients.length !== 0) {
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
                let html = '<div class="row" style="width: 100%;">';
                for (let i = 0; i < recipes.length; i++) {
                    html += '<div class="col-sm-6">';
                    html += '<div class="card">';
                    html += '<img class="card-img-top" src="' + recipes[i].rec_image_src + '" alt="Card image cap">';
                    html += '<div class="card-body">';
                    html += '<h5 class="card-title">' + recipes[i].rec_title + '</h5>';
                    html += '<p class="card-text">' + recipes[i].rec_summary + '</p>';
                    html += '<a href="index.php?controller=recipe&action=show&rec_id='+ recipes[i].rec_id +'" class="btn btn-primary">Consulter la recette</a>';
                    html += '</div>';
                    html += '</div>';
                    html += '</div>';
                }
                html += '</div>';
                if (recipes.length === 0) {
                    html = '<div class="alert alert-warning" role="alert">Aucune recette ne correspond à votre recherche</div>';
                }
                document.querySelector('#results').innerHTML = html;
            }
        };

    });
}

init();