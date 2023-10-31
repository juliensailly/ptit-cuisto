<h2>Nos recettes</h2>
<div class="recipes_display">

    <?php
    foreach ($recipes as $key => $recipe) {
        if ($key % 2 == 0) {
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
        if ($key % 2 != 0) {
            echo "</div>";
        }
        if ($key == sizeof($recipes) - 1) {
            echo "<div class=\"card\" style=\"visibility:hidden;\"></div></div>";
        }
    }
    if (sizeof($recipes) == 0) {
        echo "<div class='alert alert-warning' role='alert'>Aucune recette</div>";
    }
    ?>
</div>

<div class="page_number btn-group">
    <?php
    if ($page > 1) {
        ?>
        <a href="index.php?controller=recipes&action=readAll&page=<?= $page - 1 ?>" class="btn btn-outline-primary"><i
                class="fa-solid fa-arrow-left"></i></a>
        <?php
    } else {
        ?>
        <button type="button" class="btn btn-outline-primary" disabled><i class="fa-solid fa-arrow-left"></i></button>
        <?php
    }
    ?>
    <span class="btn btn-outline-primary">
        <?php
        if (isset($_GET['page'])) {
            if ($_GET['page'] != "")
                echo "Page " . $_GET['page'];
            else
                echo "Page 1";
        } else {
            echo "Page 1";
        }
        ?>
    </span>
    <a href="index.php?controller=recipes&action=readAll&page=<?= $page + 1 ?>" class="btn btn-outline-primary"><i
            class="fa-solid fa-arrow-right"></i></a>
</div>