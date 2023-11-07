<?php global $recipe_img_path; ?>

<h2>Tableau de bord - Utilisateurs</h2>

<section class="userDashboard">
    <h3>Utilisateurs</h3>
    <table>
        <thead>
            <tr>
                <th>Identifiant</th>
                <th>Adresse mail</th>
                <th>Prénom</th>
                <th>Nom</th>
                <th>Pseudo</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $users = $_SESSION['login'];
            echo '<tr>';
            echo '<td>' . $users->users_id . '</td>';
            echo '<td>' . $users->users_email . '</td>';
            echo '<td>' . $users->users_name . '</td>';
            echo '<td>' . $users->users_lastname . '</td>';
            echo '<td>' . $users->users_pseudo . '</td>';
            echo '</tr>';
            echo '<td>';
            echo '</td>';
            echo '</tr>';
            ?>
        </tbody>
    </table>
</section>

<div class="tab-content" id="adminTabsContent">
    <div class="tab-pane fade show active" id="awaiting-recipe" role="tabpanel" aria-labelledby="awaiting-recipe-tab">
        <h3>Recettes écrite </h3>
        <div class="tabContentContainer">
            <?php
            foreach ($usersRecipes as $index => $recipe) { ?>
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

                </div>
                <?php
            }
            ?>

        </div>
    </div>

    <div class="tab-content" id="adminTabsContent">
        <div class="tab-pane fade show active" id="awaiting-recipe2" role="tabpanel"
            aria-labelledby="awaiting-recipe-tab">
            <h3>Recettes favorites</h3>
            <div class="tabContentContainer">
                <?php
                foreach ($usersLikedRecipes as $index => $recipe) { ?>
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

                    </div>
                    <?php
                }
                ?>

    <a href="index.php?controller=account&action=changeProfilInformation&id=<?= $_SESSION['login']->users_id?>">Change info</a>

