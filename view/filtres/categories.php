<h1>Filtres - Catégories</h1>

<label for="category">Choose a category:</label><br><br>
<select id="category" name="category" multiple onchange="location = 'http:\/\/'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'&category='. this.value'">
    <?php
    foreach ($rep as $key => $value) {
      echo "<option value=$value->cat_id>$value->cat_title</option>";
    }
    ?>
</select>