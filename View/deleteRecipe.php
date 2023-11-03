<?php global $recipe_img_path; ?>
<div class="deletionConfirmation">
    <h3>Supprimer la recette ?</h3>
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
        </div>
        <div class="btn-group">
            <a href="index.php?controller=recipes&action=delete&id=<?= $recipe['rec_id'] ?>"
                class="btn btn-outline-primary">Oui</a>
            <a href="index.php?controller=recipes&action=read&id=<?= $recipe['rec_id'] ?>"
                class="btn btn-primary">Non</a>
        </div>
    </div>
</div>