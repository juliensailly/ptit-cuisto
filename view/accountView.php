<?php global $recipe_img_path; ?>

<h2>Tableau de bord - Utilisateurs</h2>

<div class="profil_header">
    <div>
        <div class="user_pp" <?php
        srand($user->users_id);
        $randColor = "#" . str_pad(dechex(rand(0xb9b9b9, 0xFFFFFF)), 6, 0, STR_PAD_LEFT);
        echo "style=\"background-color: $randColor;\"";
        ?>>
            <span>
                <?= strtoupper(substr($user->users_pseudo, 0, 1)) ?>
            </span>
        </div>
    </div>
    <div>
        <h3>
            <?= $user->users_pseudo ?>
        </h3>
        <p>
            <em>
                <?= $user->users_name ?>
                <?= $user->users_lastname ?>
            </em>
        </p>
        <p>Inscrit depuis le
            <?= date("d/m/Y", strtotime($user->users_inscription_date)) ?>
        </p>
        <p>Responsable de
            <?= $nbReceivedLiked->NBRECEIVEDLIKES ?> <i class="fa-regular fa-heart"></i> plaisirs
        </p>
    </div>
</div>

<ul class="nav nav-pills mb-3 d-flex justify-content-center gap-3" id="pills-tab" role="tablist">
    <li class="nav-item" role="presentation">
        <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home"
            type="button" role="tab" aria-controls="pills-home" aria-selected="true">Recettes créées</button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile"
            type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Carnet de recettes
            enregistrées</button>
    </li>
</ul>
<div class="tab-content" id="pills-tabContent">
    <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab"
        tabindex="0">
        <?php
        foreach ($usersRecipes as $key => $recipe) {
            if ($key % 2 == 0) {
                echo "<div class='recipes_row'>";
            }
            ?>
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
                    <a href="index.php?controller=recipes&action=read&id=<?= $recipe->rec_id ?>" class="btn btn-primary">
                        Consulter la recette
                    </a>
                </div>
            </div>

            <?php
            if ($key % 2 != 0) {
                echo "</div>";
            }
            if ($key == sizeof($usersRecipes) - 1) {
                echo "<div class=\"card\" style=\"visibility:hidden;\"></div>";
            }
        }
        if (sizeof($usersRecipes) == 0) {
            echo "<div class='alert alert-secondary' role='alert'>Aucune recette créée</div>";
        }
        ?>
        </div>
    </div>
    <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab" tabindex="0">
    <?php
        foreach ($usersLikedRecipes as $key => $recipe) {
            if ($key % 2 == 0) {
                echo "<div class='recipes_row'>";
            }
            ?>
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
                    <a href="index.php?controller=recipes&action=read&id=<?= $recipe->rec_id ?>" class="btn btn-primary">
                        Consulter la recette
                    </a>
                </div>
            </div>

            <?php
            if ($key % 2 != 0) {
                echo "</div>";
            }
            if ($key == sizeof($usersLikedRecipes) - 1) {
                echo "<div class=\"card\" style=\"visibility:hidden;\"></div>";
            }
        }
        if (sizeof($usersLikedRecipes) == 0) {
            echo "<div class='alert alert-secondary' role='alert'>Aucune recette enregistrée</div>";
        }
        ?>
    </div>
</div>
