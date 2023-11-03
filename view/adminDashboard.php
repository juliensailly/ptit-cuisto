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
            <?php
            if (sizeof($awaitingComments) == 0) {
                ?>
                <div class="alert alert-secondary" role="alert">Aucun commentaire en attente pour le moment</div>
                <?php
            } else {
                ?>
                <div class="list-group">
                    <?php
                    $rec_id = -1;
                    foreach ($awaitingComments as $key => $comment) {
                        if ($rec_id != $comment->rec_id && $rec_id != -1) {
                            ?>
                        </div>
                    </div>
                    <?php
                        }
                        if ($rec_id != $comment->rec_id) {
                            $rec_id = $comment->rec_id;
                            ?>
                    <div class="recipe list-group-item list-group-item-action">
                        <h4>
                            <a href="index.php?controller=recipes&action=read&id=<?= $comment->rec_id ?>">
                                <?= $comment->rec_title ?>
                            </a>
                        </h4>
                        <h6 class="recipe_category">
                            <a href="index.php?controller=filtre&action=categories&id=<?= $comment->cat_id ?>"><i>
                                    <?= $comment->cat_title ?>
                                </i></a>
                        </h6>
                        <p>
                            <?= $comment->rec_summary ?>
                        </p>
                        <hr>
                        <div class="commentsContainer">
                            <?php
                        }
                        ?>
                        <div class="comment">
                            <div class="author">
                                <div class="user_pp" <?php
                                srand($comment->users_id);
                                $randColor = "#" . str_pad(dechex(rand(0xb9b9b9, 0xFFFFFF)), 6, 0, STR_PAD_LEFT);
                                echo "style=\"background-color: $randColor;\"";
                                ?>>
                                    <span>
                                        <?= substr($comment->users_pseudo, 0, 1) ?>
                                    </span>
                                </div>
                                <div>
                                    <p>
                                        <?= $comment->users_pseudo ?>
                                    </p>
                                    <p>Publié
                                        <?php
                                        if ($comment->com_date < date("Y-m-d H:i:s", strtotime("-1 day"))) {
                                            echo " le " . date("d/m/Y", strtotime($comment->com_date));
                                        } else {
                                            echo " à " . date("H:i", strtotime($comment->com_date));
                                        }
                                        ?>
                                    </p>
                                </div>
                            </div>
                            <p class="comment">
                                <?= $comment->com_content ?>
                            </p>
                            <div class="commentChoice btn-group">
                                <a href="index.php?controller=admin&action=deleteComment&rec_id=<?= $comment->rec_id ?>&users_id=<?= $comment->users_id ?>"
                                    class="btn btn-outline-danger"><svg xmlns="http://www.w3.org/2000/svg" width="16"
                                        height="16" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                                        <path
                                            d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8 2.146 2.854Z" />
                                    </svg></a>
                                <a href="index.php?controller=admin&action=validComment&rec_id=<?= $comment->rec_id ?>&users_id=<?= $comment->users_id ?>"
                                    class="btn btn-outline-success"><svg xmlns="http://www.w3.org/2000/svg" width="16"
                                        height="16" fill="currentColor" class="bi bi-check-lg" viewBox="0 0 16 16">
                                        <path
                                            d="M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425a.247.247 0 0 1 .02-.022Z" />
                                    </svg></a>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
            <?php
            }
            ?>
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