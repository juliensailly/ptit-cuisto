<?php global $recipe_img_path ?>
<h2>Recettes les plus aimées</h2>
<div id="mostLikedRecipesCarousel" class="carousel slide">
    <div class="carousel-indicators">
        <?php
        $i = 0;
        foreach ($mostLikedRecipes as $recipe) {
            if ($i == 0) {
                echo '<button type="button" data-bs-target="#mostLikedRecipesCarousel" data-bs-slide-to="' . $i . '" class="active" aria-current="true" aria-label="Slide ' . $i . '"></button>';
            } else {
                echo '<button type="button" data-bs-target="#mostLikedRecipesCarousel" data-bs-slide-to="' . $i . '" aria-label="Slide ' . $i . '"></button>';
            }
            $i++;
        }
        ?>
    </div>
    <div class="carousel-inner">
        <?php
        $i = 0;
        foreach ($mostLikedRecipes as $recipe) {
            if ($i == 0) {
                echo '<div class="carousel-item active">';
            } else {
                echo '<div class="carousel-item">';
            }
            ?>
            <img src="<?= $recipe_img_path . $recipe->rec_image_src ?>" class="d-block w-100"
                alt="Illustration de la recette <?= $recipe->rec_title ?>">
            <div class="carousel-caption d-md-block">
                <h5>
                    <a href="index.php?controller=recipes&action=read&id=<?= $recipe->rec_id ?>">
                        <?= $recipe->rec_title ?>
                    </a>
                </h5>
            </div>
        </div>
        <?php
        $i++;
        }
        ?>
</div>
<button class="carousel-control-prev" type="button" data-bs-target="#mostLikedRecipesCarousel" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
</button>
<button class="carousel-control-next" type="button" data-bs-target="#mostLikedRecipesCarousel" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
</button>
</div>

<div class="home_content">
    <article class="recent_recipes">
        <h2>Recettes les plus récentes</h2>
        <div>
            <?php foreach ($mostRecentRecipes as $recipe) { ?>
                <div class="card">
                    <img class="card-img-top" src="<?= $recipe_img_path . $recipe->rec_image_src ?>"
                        alt="Illustration de <?= $recipe->rec_title ?>">
                    <div class="card-body">
                        <h4 class="card-title">
                            <?= $recipe->rec_title ?>
                        </h4>
                        <p class="card-text">
                            <?= $recipe->rec_summary ?>
                        </p>
                        <a href="index.php?controller=recipes&action=read&id=<?= $recipe->rec_id ?>"
                            class="btn btn-primary">
                            Consulter la recette
                        </a>
                    </div>
                </div>
            <?php } ?>
        </div>
    </article>
    <article>
        <h2>Edito</h2>
        <div class="edito">
            <img src="resources/img/pticuisto.png" alt="Illustration de Pti Cuisto">
            <h2>
                <?= $edito->edi_title ?>
            </h2>
            <p>
                <?= nl2br($edito->edi_content) ?>
            </p>
        </div>
    </article>
</div>