let nbPerson = 1,
    defaultNbPerson = 1,
    removeButton = document.querySelector("#removePerson"),
    addButton = document.querySelector("#addPerson"),
    ingredientsQuantityElements = document.querySelectorAll(
        "table td:nth-child(even)"
    ),
    ingredientsQuantity = [],
    col_left = document.querySelector(".column.col_left"),
    col_right = document.querySelector(".column.col_right"),
    ingredients = document.querySelector(".component.ingredients"),
    recipe_content = document.querySelector(".component.recipe_content"),
    tags = document.querySelector(".component.tags"),
    comments = document.querySelector(".component.comments");

function init() {
    addEventListener("resize", relocateWhenResizing);
    relocateWhenResizing();

    nbPerson = parseInt(
        document.querySelector("div.person_number span.btn").textContent
    );
    defaultNbPerson = nbPerson;
    removeButton.addEventListener("click", removePerson);
    addButton.addEventListener("click", addPerson);
    if (nbPerson == NaN) {
        nbPerson = 1;
        defaultNbPerson = nbPerson;
    }

    ingredientsQuantityElements.forEach((element) => {
        ingredientsQuantity.push({
            quantity: parseFloat(element.textContent),
            unit: element.textContent
                .trim()
                .substring(
                    parseFloat(element.textContent).toString().length + 1
                ),
        });
    });
}

function removePerson() {
    if (nbPerson > 1) {
        nbPerson--;
        document.querySelector("div.person_number span").textContent =
            nbPerson + (nbPerson > 1 ? " personnes" : " personne");
    }
    updateQuantity();
}

function addPerson() {
    nbPerson++;
    document.querySelector("div.person_number span").textContent =
        nbPerson + (nbPerson > 1 ? " personnes" : " personne");
    updateQuantity();
}

function updateQuantity() {
    ingredientsQuantityElements.forEach((element, index) => {
        element.textContent =
            (
                (ingredientsQuantity[index].quantity * nbPerson) /
                defaultNbPerson
            ).toString() +
            " " +
            ingredientsQuantity[index].unit;
    });
}

function relocateWhenResizing() {
    if (window.innerWidth < 768 && !col_left.contains(ingredients)) {
        col_left.appendChild(ingredients);
        col_left.appendChild(recipe_content);
        col_right.appendChild(tags);
        col_right.appendChild(comments);
    } else if (window.innerWidth >= 768 && !col_right.contains(ingredients)) {
        col_right.appendChild(ingredients);
        col_right.appendChild(recipe_content);
        col_left.appendChild(tags);
        col_left.appendChild(comments);
    }
}

init();
