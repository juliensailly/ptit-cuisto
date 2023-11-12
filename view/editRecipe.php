<?php global $recipe_img_path; ?>
<h2>Modifier une recette :</h2>

<form enctype="multipart/form-data" action="index.php?controller=recipes&action=edit&id=<?= $recipe['rec_id'] ?>"
    method="post" id="addRecipeForm">
    <div class="recipeFormContainer">
        <div class="column">
            <div>
                <label for="title">Titre :</label>
                <input type="text" id="title" name="title" class="form-control" maxlength="200" required
                    value="<?= $recipe['rec_title'] ?>">
            </div>

            <div>
                <label for="summary">Description :</label>
                <textarea id="summary" name="summary" class="form-control" maxlength="300"
                    required><?= $recipe['rec_summary'] ?></textarea>
            </div>

            <div>
                <label for="image">Image :</label>
                <img src="<?= $recipe_img_path . $recipe['rec_image_src'] ?>" alt="Image actuelle de la recette">
                <input type="file" id="image" name="image" class="form-control" accept="image/png, image/jpeg">
            </div>

            <div>
                <label for="content">Instructions :</label>
                <textarea id="content" name="content" class="form-control" maxlength="2000"
                    required><?= $recipe['rec_content'] ?></textarea>
            </div>

            <div>
                <label for="category">Catégorie :</label>
                <select name="category" id="category" class="form-control" required>
                    <?php
                    foreach ($categories as $category) {
                        if ($category->cat_id == $recipe['cat_id']) {
                            echo "<option value='" . $category->cat_id . "' selected>" . $category->cat_title . "</option>";
                        } else {
                            echo "<option value='" . $category->cat_id . "'>" . $category->cat_title . "</option>";
                        }
                    }
                    ?>
                </select>
            </div>

            <div>
                <label for="nbPerson">Nombre de personne(s) :</label>
                <br>
                <div class="person_number btn-group">
                    <button type="button" class="btn btn-outline-primary" id="removePerson"
                        onclick="javascript:(parseInt(document.getElementById('nbPerson').value) > 1 ? (document.getElementById('nbPerson').value = parseInt(document.getElementById('nbPerson').value) - 1) : void(0))">-</button>
                    <input type="number" min="1" name="nbPerson" id="nbPerson" class="btn btn-outline-primary"
                        value="<?= $recipe['rec_nb_person'] ?>"></input>
                    <button type="button" class="btn btn-outline-primary" id="addPerson"
                        onclick="javascript:(document.getElementById('nbPerson').value = parseInt(document.getElementById('nbPerson').value) + 1)">+</button>
                </div>
            </div>
        </div>
        <div class="column">
            <div>
                <p>Ajouter des ingredients :</p>
                <div class="ingredientsChoiceList">
                    <div class="d-flex">
                        <div id="ingredientsResults">
                            <label for="ingredientSearch">Nom d'un ingrédient</label>
                            <input type="text" name="ingredientSearch" id="ingredientSearch" class="form-control"  placeholder="Il sera ajouté si inexistant">
                            <ul class="list-group">
                            </ul>
                        </div>
                        <div>
                            <label for="ingredientQuantity">Quantité et unité</label>
                            <input type="text" name="ingredientQuantity" id="ingredientQuantity" class="form-control" placeholder="ex: 10 cl">
                        </div>
                    </div>
                    <button type="button" class="btn btn-success" id="addIngredientBtn">Ajouter l'ingrédient</button>
                    <?php
                    $json_ingredients = array();
                    foreach ($ingredients as $ingredient) {
                        array_push($json_ingredients, [
                            "title" => $ingredient['ing_title'],
                            "quantity" => $ingredient['ing_quantity']
                        ]);
                    }
                    $json_ingredients = json_encode($json_ingredients);
                    ?>
                    <label for="selectedIngredients" style="visibility: hidden">hidden input</label>
                    <textarea type="text" name="selectedIngredients" id="selectedIngredients"
                        hidden><?= $json_ingredients ?></textarea>
                    <hr>
                    <ul class="ingredientsList">

                    </ul>
                </div>
            </div>

            <div>
                <p>Ajouter des tags :</p>
                <div class="tagsChoice">
                    <div id="tagsResults">
                        <label for="tagSearch">Nom d'un tag</label>
                        <input type="text" name="tagSearch" id="tagSearch" class="form-control"  placeholder="Il sera ajouté si inexistant">
                        <ul class="list-group">
                        </ul>
                    </div>
                    <button type="button" class="btn btn-success" id="addTagBtn">Ajouter le tag</button>
                    <?php
                    $json_tags = array();
                    foreach ($tags as $tag) {
                        array_push($json_tags, [
                            "title" => $tag['tag_title']
                        ]);
                    }
                    $json_tags = json_encode($json_tags);
                    $json_tags = str_replace("'", "&quot;", $json_tags);
                    ?>
                    <label for="selectedTags" style="visibility: hidden">hidden input</label>
                    <textarea type="text" name="selectedTags" id="selectedTags" hidden><?= $json_tags ?></textarea>
                    <hr>
                    <ul class="tagsList">

                    </ul>
                </div>
            </div>
        </div>
    </div>

    <input type="submit" class="btn btn-primary" value="Modifier la recette">
</form>

<script src="resources/script/recipeIngredientsChoice.js"></script>
<script src="resources/script/recipeTagsChoice.js"></script>