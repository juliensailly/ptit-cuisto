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
            <img src="<?= $recipe->rec_image_src ?>" class="d-block w-100"
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
    <article>
        <h2>Recettes les plus récentes</h2>
        
    </article>
    <article>

    </article>
</div>