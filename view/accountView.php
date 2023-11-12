<?php global $recipe_img_path; ?>

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
        <?php
        if ($_SESSION['login'] != false) {
            if ($_SESSION['login']->users_id == $user->users_id) {
                ?>
                <a href="index.php?controller=account&action=changeProfilInformation&id=<?= $user->users_id ?>"
                    class="btn btn-primary">Modifier
                    mes informations</a>
                <?php
            }
        }
        ?>
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
                <?php
                if ($_SESSION['login'] != false && $_SESSION['login']->users_id == $user->users_id) {
                    ?>
                    <div class="editBtnProfilPage">
                        <a href="index.php?controller=recipes&action=editForm&id=<?= $recipe->rec_id ?>"
                            class="btn btn-primary" title="Modifier la recette">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-pen-fill" viewBox="0 0 16 16">
                                <path
                                    d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001z" />
                            </svg>
                        </a>
                        <a href="index.php?controller=recipes&action=deleteForm&id=<?= $recipe->rec_id ?>"
                            class="btn btn-danger" title="Supprimer la recette">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                <path
                                    d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z" />
                            </svg>
                        </a>
                    </div>
                    <?php
                }
                ?>
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