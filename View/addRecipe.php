<h2>Ajouter une recette</h2>

<form action="index.php?controller=recipes&action=create" method="post">
    <div>
        <label for="title">Titre :</label>
        <input type="text" id="title" name="title" class="form-control" required>
    </div>
    <div>
        <label for="summary">Description :</label>
        <textarea id="summary" name="summary" class="form-control" required></textarea>
    </div>
    <div>
        <label for="content">Instructions :</label>
        <textarea id="content" name="content" class="form-control" required></textarea>
    </div>
    <div>
        <label for="category">Catégorie :</label>
        <select name="category" id="category" class="form-control" required>
            <?php
            foreach ($categories as $category) {
                echo "<option value='" . $category->cat_id . "'>" . $category->cat_title . "</option>";
            }
            ?>
        </select>
    </div>
    <div class="ingredientsChoiceList">
        <label>Ajouter des ingredients :</label>
        <div class="ingredientChoice">
            <input type="text" name="ingredientSearch" id="ingredientSearch" class="form-control"
                placeholder="Veuillez entrer le nom d'un ingrédient">
            <div id="ingredientsResults">
                <ul class="list-group">
                </ul>
            </div>
            <input type="text" name="ingredientQuantity" id="ingredientQuantity" class="form-control"
                placeholder="Veuillez entrer la quantité correspondante">
            <button class="btn">Ajouter l'ingrédient</button>
        </div>
        <ul class="ingredientsList">

        </ul>
    </div>
    <div class="tagsChoice">
        <label>Ajouter des tags :</label>
        <div class="tagsChoice">
            <input type="text" name="tagSearch" id="tagSearch" class="form-control"
                placeholder="Veuillez entrer le nom d'un tag">
            <div id="tagsResults">
                <ul class="list-group">
                </ul>
            </div>
            <button class="btn">Ajouter le tag</button>
        </div>
        <ul class="tagsList">

        </ul>
    </div>
    <div>
        <label for="image">Image :</label>
        <input type="file" id="image" name="image" class="form-control" required>
    </div>
    <input type="submit" class="btn btn-primary" value="Ajouter">
</form>

<script src="resources/script/recipeIngredientsChoice.js"></script>