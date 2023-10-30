<h1>Filtres - Catégories</h1>

<label for="category">Choose a category:</label><br><br>
<select id="category" name="category" multiple>
    <?php
    foreach ($rep as $key => $value) {
      echo "<option value=$value->cat_id>$value->cat_title</option>";
    }
    ?>
</select>
<div id="results"></div>
<script src="resources/script/filtreCategory.js"></script>