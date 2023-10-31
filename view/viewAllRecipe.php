<h2>Nos recettes</h2>
<div class="recipes_display">

    <?php
    foreach ($recipes as $key => $recipe) {
        if ($key%2 == 0) {
            echo "<div class='recipes_row'>";
        }
        ?>
        <div class="card">
            <img class="card-img-top" src="<?= $recipe['rec_image_src'] ?>">
            <div class="card-body">
                <h4 class="card-title">
                    <?= $recipe['rec_title'] ?>
                </h4>
                <p class="card-text">
                    <?= $recipe['rec_summary'] ?>
                </p>
                <a href="index.php?controller=recipes&action=read&id=<?= $recipe['rec_id'] ?>">
                    <button class="btn btn-primary" type="button">Consulter la recette</button>
                </a>
            </div>
        </div>

        <?php
        if ($key%2 != 0) {
            echo "</div>";
        }
    }
    ?>

</div>