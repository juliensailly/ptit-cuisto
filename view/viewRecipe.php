<?php
global $recipe_img_path;


if ($recipe['isAuthorised'] == 0 && $_SESSION['login'] != false && ($_SESSION['login']->users_id == $recipe['users_id'] || $_SESSION['login']->users_type == 1)) {
    echo "<div class='alert alert-warning' role='alert'>Cette recette n'a pas encore été autorisée</div>";
}
?>

<h2 class="recipe_title">
    <?php
    echo $recipe['rec_title'];
    if ($_SESSION['login'] != false && ($_SESSION['login']->users_id == $recipe['users_id'] || $_SESSION['login']->users_type == 1)) {
        ?>
        <div>
            <a href="index.php?controller=recipes&action=editForm&id=<?= $recipe['rec_id'] ?>" class="btn btn-primary">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen-fill"
                    viewBox="0 0 16 16">
                    <path
                        d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001z" />
                </svg>
                <span hidden>Modifier</span>
            </a>
            <a href="index.php?controller=recipes&action=deleteForm&id=<?= $recipe['rec_id'] ?>" class="btn btn-danger">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill"
                    viewBox="0 0 16 16">
                    <path
                        d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z" />
                </svg>
                <span hidden>Supprimer</span>
            </a>
        </div>

        <?php
    }
    ?>

</h2>
<a href="index.php?controller=filtre&action=categories&id=<?= $recipe['cat_id'] ?>">
    <h4 class="recipe_category"><i>
            <?= $recipe['cat_title'] ?>
        </i></h4>
</a>

<article id="recipe_view">
    <div class="column col_left">
        <div class="component">
            <div class="img_container">
                <img src="<?= $recipe_img_path . $recipe['rec_image_src'] ?>" alt="<?= $recipe['rec_title'] ?>">
            </div>
            <div class="author_save">
                <a href="index.php?controller=account&action=showProfil&id=<?= $recipe['users_id'] ?>"
                    class="authorProfilLink">
                    <div class="author">
                        <div class="user_pp" <?php
                        srand($recipe['users_id']);
                        $randColor = "#" . str_pad(dechex(rand(0xb9b9b9, 0xFFFFFF)), 6, 0, STR_PAD_LEFT);
                        echo "style=\"background-color: $randColor;\"";
                        ?>>
                            <span>
                                <?= strtoupper(substr($recipe['users_pseudo'], 0, 1)) ?>
                            </span>
                        </div>
                        <div>
                            <p>
                                <?= $recipe['users_pseudo'] ?>
                            </p>
                            <?php
                            $date = $recipe['rec_creation_date'];
                            if (isset($recipe['rec_modification_date'])) {
                                if ($recipe['rec_modification_date'] > $recipe['rec_creation_date']) {
                                    $date = $recipe['rec_modification_date'];
                                }
                            }
                            ?>
                            <p>Publié
                                <?php
                                if ($date < date("Y-m-d H:i:s", strtotime("-1 day"))) {
                                    echo " le " . date("d/m/Y", strtotime($date));
                                } else {
                                    echo " à " . date("H:i", strtotime($date));
                                }
                                ?>
                            </p>
                        </div>
                    </div>
                </a>
                <a href="index.php?controller=recipes&action=like&id=<?= $recipe['rec_id'] ?>"
                    style='text-decoration: none; color: white;'>
                    <div class="save_recipe_button">
                        <span class="save">Sauvegarder</span>
                        <span>
                            <?= $likes['NBLIKES'] ?>
                        </span>
                        <?php
                        if ($isLiked == true) {
                            ?>
                            <i class="fa-solid fa-heart" style="color: #ffffff;"></i>
                            <?php
                        } else {
                            ?>
                            <i class="fa-regular fa-heart" style="color: #ffffff;"></i>
                            <?php
                        }
                        ?>
                    </div>
                </a>
            </div>
        </div>
        <div class="tags component">
            <h3>Tags</h3>
            <?php
            if (sizeof($tags) == 0) {
                ?>
                <div class="alert alert-secondary" role="alert">Aucun tag</div>
                <?php
            } else {
                ?>
                <div>
                    <?php
                    foreach ($tags as $key => $tag) {
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
                        ?>
                        <a href="index.php?controller=filtre&action=tagsSearch&tag_id=<?= $tag['tag_id'] ?>&tag_title=<?= str_replace(" ", "%20", $tag['tag_title']) ?>"
                            class="tag" style="background-color: <?= $color ?>;">
                            <?= $tag['tag_title'] ?>
                        </a>
                        <?php
                    }
                    ?>
                </div>
                <?php
            }
            ?>
        </div>
        <div class="comments component">
            <h3>Commentaires</h3>
            <?php
            if (sizeof($comments) == 0) {
                ?>
                <div class="alert alert-secondary" role="alert">Aucun commentaire pour le moment</div>
                <?php require('view/addComment.php'); ?>
                <?php
            } else {
                ?>
                <div>
                    <?php
                    foreach ($comments as $key => $comment) {
                        if ($comment['isAuthorised'] == 0) {
                            if ($_SESSION['login'] == false) {
                                continue;
                            } else if ($_SESSION['login']->users_id != $comment['users_id'] && $_SESSION['login']->users_type != 1) {
                                continue;
                            }
                        }
                        ?>
                        <div class="comment">
                            <?php
                            if ($_SESSION['login'] != false && ($_SESSION['login']->users_id == $comment['users_id'] || $_SESSION['login']->users_type == 1)) {
                                ?>
                                <div class="comment_buttons">
                                    <a href="index.php?controller=comment&action=delete&rid=<?= $comment['rec_id'] ?>&uid=<?= $comment['users_id'] ?>"
                                        class="btn btn-danger" title="Supprimer le commentaire">
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
                            <a href="index.php?controller=account&action=showProfil&id=<?= $comment['users_id'] ?>"
                                class="authorProfilLink">
                                <div class="author">
                                    <div class="user_pp" <?php
                                    srand($comment['users_id']);
                                    $randColor = "#" . str_pad(dechex(rand(0xb9b9b9, 0xFFFFFF)), 6, 0, STR_PAD_LEFT);
                                    echo "style=\"background-color: $randColor;\"";
                                    ?>>
                                        <span>
                                            <?= substr($comment['users_pseudo'], 0, 1) ?>
                                        </span>
                                    </div>
                                    <div>
                                        <p>
                                            <?= $comment['users_pseudo'] ?>
                                        </p>
                                        <p>
                                            <?php
                                            if ($comment['isAuthorised'] == 1) {
                                                if ($comment['com_date'] < date("Y-m-d H:i:s", strtotime("-1 day"))) {
                                                    echo "Publié le " . date("d/m/Y", strtotime($comment['com_date']));
                                                } else {
                                                    echo "Publié à " . date("H:i", strtotime($comment['com_date']));
                                                }
                                            } else {
                                                echo "En attente de validation";
                                            }
                                            ?>
                                        </p>
                                    </div>
                                </div>
                            </a>
                            <p class="comment">
                                <?= $comment['com_content'] ?>
                            </p>
                        </div>
                        <?php
                        if ($key != sizeof($comments) - 1) {
                            ?>
                            <hr>
                            <?php
                        }
                    }
                    require('view/addComment.php');
                    ?>
                </div>
                <?php
            }
            ?>

        </div>
    </div>
    <div class="column col_right">
        <div class="ingredients component">
            <div>
                <h3>Ingrédients</h3>
                <div class="person_number btn-group">
                    <button type="button" class="btn btn-outline-primary" id="removePerson">-</button>
                    <span class="btn btn-outline-primary">
                        <?= $recipe['rec_nb_person'] . ($recipe['rec_nb_person'] > 1 ? " personnes" : "personne") ?>
                    </span>
                    <button type="button" class="btn btn-outline-primary" id="addPerson">+</button>
                </div>
            </div>
            <?php
            if (sizeof($ingredients) == 0) {
                ?>
                <div class="alert alert-secondary" role="alert">Aucun ingrédient</div>
                <?php
            } else {
                ?>
                <table>
                    <tr>
                        <th>Ingrédient</th>
                        <th>Quantité</th>
                    </tr>
                    <?php
                    foreach ($ingredients as $key => $ingredient) {
                        ?>
                        <tr>
                            <td>
                                <?= $ingredient['ing_title'] ?>
                            </td>
                            <td>
                                <?= $ingredient['ing_quantity'] . " " . $ingredient['ing_unit'] ?>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                </table>
                <?php
            }
            ?>
        </div>
        <div class="recipe_content component">
            <h3>Indications</h3>
            <p>
                <?= nl2br($recipe['rec_content']) ?>
            </p>
        </div>
    </div>
</article>
<script src="resources/script/ingredientQuantity.js"></script>