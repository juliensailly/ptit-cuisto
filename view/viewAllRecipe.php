<?php global $recipe_img_path ?>
<h2>Nos recettes</h2>
<div class="recipes_display">

    <?php
    foreach ($recipes as $key => $recipe) {
        if ($key % 2 == 0) {
            echo "<div class='recipes_row'>";
        }
        ?>
        <div class="card">
            <img class="card-img-top" src="<?= $recipe_img_path . $recipe['rec_image_src'] ?>"
                alt="Illustration de <?= $recipe['rec_title'] ?>">
            <div class="card-body">
                <h4 class="card-title">
                    <?= $recipe['rec_title'] ?>
                </h4>
                <h6 class="recipe_category card-subtitle">
                    <a href="index.php?controller=filtre&action=categories&id=<?= $recipe['cat_id'] ?>"><i>
                            <?= $recipe['cat_title'] ?>
                        </i></a>
                </h6>
                <p class="card-text">
                    <?= $recipe['rec_summary'] ?>
                </p>
                <div class="tags all_recipes">
                    <div>
                        <?php
                        foreach ($tags as $key1 => $tag) {
                            if ($tag['rec_id'] != $recipe['rec_id']) {
                                continue;
                            }
                            ?>
                            <a href="index.php?controller=filtre&action=tagsSearch&tag_id=<?= $tag['tag_id'] ?>&tag_title=<?= str_replace(" ", "%20", $tag['tag_title']) ?>"
                                class="tag" <?php
                                srand($tag['tag_id']);
                                $colorcanal = rand(0, 2);
                                $color = rand(0, 255);
                                $colorB = rand($color, 255);
                                if ($colorcanal == 0)
                                    $color = "rgb($color, $colorB, 255)";
                                else if ($colorcanal == 1)
                                    $color = "rgb(255, $color, $colorB)";
                                else
                                    $color = "rgb($colorB, 255, $color)";
                                echo "style=\"background-color: $color;\""; ?>>
                                <?= $tag['tag_title'] ?>
                            </a>
                            <?php
                        }
                        ?>
                    </div>
                </div>
                <a href="index.php?controller=recipes&action=read&id=<?= $recipe['rec_id'] ?>" class="btn btn-primary">
                    Consulter la recette
                </a>
            </div>
        </div>

        <?php
        if ($key % 2 != 0) {
            echo "</div>";
        }
        if ($key == sizeof($recipes) - 1) {
            echo "<div class=\"card\" style=\"visibility:hidden;\"></div>";
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
        <a href="index.php?controller=recipes&action=readAll&page=<?= $page - 1 ?>" class="btn btn-outline-primary"><svg
                xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-left-fill"
                viewBox="0 0 16 16">
                <path
                    d="m3.86 8.753 5.482 4.796c.646.566 1.658.106 1.658-.753V3.204a1 1 0 0 0-1.659-.753l-5.48 4.796a1 1 0 0 0 0 1.506z" />
            </svg></a>
        <?php
    } else {
        ?>
        <button type="button" class="btn btn-outline-primary" disabled><svg xmlns="http://www.w3.org/2000/svg" width="16"
                height="16" fill="currentColor" class="bi bi-caret-left-fill" viewBox="0 0 16 16">
                <path
                    d="m3.86 8.753 5.482 4.796c.646.566 1.658.106 1.658-.753V3.204a1 1 0 0 0-1.659-.753l-5.48 4.796a1 1 0 0 0 0 1.506z" />
            </svg></button>
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
    <a href="index.php?controller=recipes&action=readAll&page=<?= $page + 1 ?>" class="btn btn-outline-primary"><svg
            xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-right-fill"
            viewBox="0 0 16 16">
            <path
                d="m12.14 8.753-5.482 4.796c-.646.566-1.658.106-1.658-.753V3.204a1 1 0 0 1 1.659-.753l5.48 4.796a1 1 0 0 1 0 1.506z" />
        </svg></a>
</div>