<h1>Filtres - Catégories</h1>

<label for="category">Choose a category:</label><br><br>
<select id="category" name="category" multiple onchange="categoryChosen(this)">
    echo "test";
    <?php
    echo "test";
    var_dump($rep);
    foreach ($rep as $key => $value) {
      echo "<option value=$value->cat_id>$value->cat_title</option>";
    }
    ?>
</select>