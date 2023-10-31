let nbPerson = 1,
    defaultNbPerson = 1,
    removeButton = document.querySelector("#removePerson"),
    addButton = document.querySelector("#addPerson"),
    ingredientsQuantityElements = document.querySelectorAll(
        "table td:nth-child(even)"
    ),
    ingredientsQuantity = [];

function init() {
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
            (ingredientsQuantity[index].quantity * nbPerson / defaultNbPerson).toString() +
            " " +
            ingredientsQuantity[index].unit;
    });
}

init();
