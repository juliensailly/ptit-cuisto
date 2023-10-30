<h1>Filtre - Recherche par ingrédients</h1>

<form action="javascript:void(0);" id="formIngredients">
    <label>Ingrédients présents :</label>
    <br>
    <?php
    foreach ($ingredients as $ingredient) {
        echo '<input type="checkbox" class="ingredient" id="ingredientsID' . $ingredient->ing_id . '" name="ingredients" value="' . $ingredient->ing_id . '">';
        echo '<label for="ingredientsID' . $ingredient->ing_id . '">' . $ingredient->ing_title . '</label>';
        echo '<br>';
    }
    ?>
</form>
<div id="results"></div>
<script src="resources/script/filtreIngredients.js"></script>