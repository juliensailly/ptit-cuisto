<?php global $recipe_img_path; ?>

<h2>Tableau de bord - Administrateur</h2>

<ul class="nav nav-tabs" id="adminTabs" role="tablist">
    <li class="nav-item" role="presentation">
        <button class="nav-link active" id="awaiting-recipe-tab" data-bs-toggle="tab" data-bs-target="#awaiting-recipe"
            type="button" role="tab" aria-controls="awaiting-recipe" aria-selected="true">Recettes en attente</button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="awaiting-comment-tab" data-bs-toggle="tab" data-bs-target="#awaiting-comment"
            type="button" role="tab" aria-controls="awaiting-comment" aria-selected="false">Commentaires en
            attente</button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="edito-tab" data-bs-toggle="tab" data-bs-target="#edito" type="button" role="tab"
            aria-controls="edito" aria-selected="false">Edito</button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="users-tab" data-bs-toggle="tab" data-bs-target="#users" type="button" role="tab"
            aria-controls="users" aria-selected="false">Utilisateurs</button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="recipes-tab" data-bs-toggle="tab" data-bs-target="#recipes" type="button"
            role="tab" aria-controls="recipes" aria-selected="false">Recettes</button>
    </li>
</ul>
<div class="tab-content" id="adminTabsContent">
    <div class="tab-pane fade show active" id="awaiting-recipe" role="tabpanel" aria-labelledby="awaiting-recipe-tab">
        <h3>Recettes en attente de validation</h3>
        <div class="tabContentContainer">
            <?php
            foreach ($awaitingRecipes as $index => $recipe) { ?>
                <div class="card">
                    <img class="card-img-top" src="<?= $recipe_img_path . $recipe->rec_image_src ?>"
                        alt="Illustration de <?= $recipe->rec_title ?>">
                    <div class="card-body">
                        <h4 class="card-title">
                            <?= $recipe->rec_title ?>
                        </h4>
                        <h6 class="recipe_category card-subtitle">
                            <a href="index.php?controller=filtre&action=categories&id=<?= $recipe->cat_id ?>"><i>
                                    <?= $recipe->cat_title ?>
                                </i></a>
                        </h6>
                        <p class="card-text">
                            <?= $recipe->rec_summary ?>
                        </p>
                    </div>
                    <div class="btn-group">
                        <a href="index.php?controller=recipes&action=deleteForm&id=<?= $recipe->rec_id ?>"
                            class="btn btn-outline-danger">Supprimer la recette</a>
                        <a href="index.php?controller=recipes&action=read&id=<?= $recipe->rec_id ?>"
                            class="btn btn-primary">Plus de détails</a>
                        <a href="index.php?controller=admin&action=validRecipe&id=<?= $recipe->rec_id ?>"
                            class="btn btn-outline-success">Accepter la recette</a>
                    </div>
                </div>
                <?php
            }
            if (sizeof($awaitingRecipes) % 2 != 0) { ?>
                <div class="card" style="visibility:hidden;"></div>
                <?php
            }
            if (empty($awaitingRecipes)) { ?>
                <div class="alert alert-secondary" role="alert">Aucune recette en attente</div>
                <?php
            }
            ?>
        </div>

    </div>
    <div class="tab-pane fade" id="awaiting-comment" role="tabpanel" aria-labelledby="awaiting-comment-tab">
        <h3>Commentaires en attente de validation</h3>
        <div class="tabContentContainer">

        </div>
    </div>
    <div class="tab-pane fade" id="edito" role="tabpanel" aria-labelledby="edito-tab">
        <h3>Modification de l'éditorial de la page d'accueil</h3>
        <div class="tabContentContainer">

        </div>
    </div>
    <div class="tab-pane fade" id="users" role="tabpanel" aria-labelledby="users-tab">
        <h3>Utilisateurs de Pti-Cuisto</h3>
        <div class="tabContentContainer">

        </div>
    </div>
    <div class="tab-pane fade" id="recipes" role="tabpanel" aria-labelledby="recipes-tab">
        <h3>Recettes de Pti-Cuisto</h3>
        <div class="tabContentContainer">

        </div>
    </div>
</div>