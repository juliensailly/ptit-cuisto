let ingredientSelected = [],
    ingredientSearch = document.querySelector("#ingredientSearch"),
    ingredientQuantity = document.querySelector("#ingredientQuantity"),
    ingredientsResults = document.querySelector("#ingredientsResults ul"),
    addIngredientBtn = document.querySelector("#addIngredientBtn"),
    selectedIngredientsHiddenInput = document.querySelector("#selectedIngredients");

function init() {
    ingredientSearch.addEventListener("input", function (e) {
        ingredientsResults.innerHTML = "";
        if (ingredientSearch.value == "") return;
        let xhr = new XMLHttpRequest();
        xhr.open(
            "GET",
            "index.php?controller=API&action=getIngredients&searchText=" +
                ingredientSearch.value,
            true
        );
        xhr.send();
        xhr.onload = function () {
            if (xhr.status === 200) {
                let ingredients = JSON.parse(xhr.responseText);
                for (let i = 0; i < ingredients.length; i++) {
                    let li = document.createElement("li");
                    li.classList.add("list-group-item");
                    li.textContent = ingredients[i].ing_title;
                    li.addEventListener("click", function (e) {
                        ingredientSearch.value = ingredients[i].ing_title;
                        ingredientsResults.innerHTML = "";
                    });
                    ingredientsResults.appendChild(li);
                }
            }
        };
    });

    addIngredientBtn.addEventListener("click", function (e) {
        ingredientsResults.innerHTML = "";
        if (ingredientSearch.value == "" || ingredientQuantity.value == "") return;
        if (ingredientSelected.find((ingredient) => ingredient.title === ingredientSearch.value)) return;
        ingredientSelected.push({
            title: ingredientSearch.value,
            quantity: ingredientQuantity.value,
        });
        ingredientSearch.value = "";
        ingredientQuantity.value = "";
        updateSelectedIngredients();
    });
    updateSelectedIngredients();
}

function updateSelectedIngredients() {
    let ingredientsList = document.querySelector("ul.ingredientsList");
    ingredientsList.innerHTML = "";
    selectedIngredientsHiddenInput.value = JSON.stringify(ingredientSelected);
    for (let i = 0; i < ingredientSelected.length; i++) {
        let li = document.createElement("li");
        li.classList.add("list-group-item");
        li.textContent = ingredientSelected[i].title + " - " + ingredientSelected[i].quantity;
        li.addEventListener("click", function (e) {
            ingredientSelected.splice(i, 1);
            updateSelectedIngredients();
        });
        ingredientsList.appendChild(li);
    }
    if (ingredientSelected.length === 0) {
        ingredientsList.innerHTML =
            '<div class="alert alert-secondary" role="alert">Aucun ingrédient sélectionné</div>';
    }
}

init();