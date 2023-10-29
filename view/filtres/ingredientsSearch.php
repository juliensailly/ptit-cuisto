<h1>Filtre - Recherche par ingrédients</h1>

<form action="javascript:void()">
    <label>Ingrédients présents :</label>
    <br>
    <?php
    foreach ($ingredients as $ingredient) {
        echo '<input type="checkbox" name="ingredients" value="' . $ingredient['id'] . '">' . $ingredient['name'] . '<br>';
    }
    ?>
    <label for=""></label>
    <input type="text" name="title" id="title" placeholder="Rechercher le titre d'une recette">
</form>
<div id="results"></div>
<script src="resources/script/filtreIngredients.js"></script>