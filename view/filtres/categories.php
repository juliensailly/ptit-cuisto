<h1>Filtres - Catégories</h1>

<form action="javascript:void(0)" name="categoriesForm">
  <?php
  foreach ($rep as $key => $value) {
    if ($value->cat_id == $id) {
      echo "<input type=\"radio\" class=\"btn-check\" name=\"catRadio\" value=\"$value->cat_id\" id=\"$value->cat_id\" autocomplete=\"off\" checked>";
    } else {
      echo "<input type=\"radio\" class=\"btn-check\" name=\"catRadio\" value=\"$value->cat_id\" id=\"$value->cat_id\" autocomplete=\"off\">";
    } ?>
    <label class="btn btn-primary" for="<?= $value->cat_id ?>"><?= $value->cat_title ?></label>
    <?php
  }
  ?>
</form>
<div id="results"></div>
<script src="resources/script/filtreCategory.js"></script>