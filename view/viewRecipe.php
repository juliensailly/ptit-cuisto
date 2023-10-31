<h2 class="recipe_title">
    <?= $recipe['rec_title'] ?>
</h2>
<a href="index.php?controller=filtre&action=categories">
    <h4 class="recipe_category"><i>
            <?= $recipe['cat_title'] ?>
        </i></h4>
</a>

<article id="recipe_view">
    <div class="column">
        <div class="component">
            <div class="img_container">
                <img src="<?= $recipe['rec_image_src'] ?>" alt="<?= $recipe['rec_title'] ?>">
            </div>
            <div class="author_save">
                <div class="author">
                    <img src="https://picsum.photos/50/50" alt="PP">
                    <div>
                        <p>
                            <?= $recipe['users_pseudo'] ?>
                        </p>
                        <?php
                        $date = $recipe['rec_creation_date'];
                        if (isset($recipe['rec_modification_date'])) {
                            $date = $recipe['rec_modification_date'];
                        }
                        ?>
                        <p>Publié le
                            <?= $date ?>
                        </p>
                    </div>
                </div>
                <form method="POST" action="" class="save_recipe">
                    <button class="save_recipe_button" type="submit">
                        <input value="Sauvegarder" style="display: none;">
                        <span class="save">Sauvegarder</span>
                        <span>
                            <?= $likes['NBLIKES'] ?>
                        </span>
                        <i class="fa-regular fa-heart" style="color: #ffffff;"></i>
                    </button>
                </form>
            </div>
        </div>
        <div class="tags component">
            <h3>Tags</h3>
            <?php
            if (sizeof($tags) == 0) {
                ?>
                <div class="alert alert-warning" role="alert">Aucun tag</div>
                <?php
            } else {
                ?>
                <div>
                    <?php
                    foreach ($tags as $key => $tag) {
                        ?>
                        <span class="tag">
                            <?= $tag['tag_title'] ?>
                        </span>
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
                <div class="alert alert-warning" role="alert">Aucun commentaire pour le moment</div>
                <?php
            } else {
                ?>
                <div>
                    <?php
                    foreach ($comments as $key => $comment) {
                        ?>
                        <div class="comment">
                            <div class="author">
                                <img src="https://picsum.photos/50/50" alt="PP">
                                <div>
                                    <p>
                                        <?= $comment['users_pseudo'] ?>
                                    </p>
                                    <p>Publié le
                                        <?= $comment['com_date'] ?>
                                    </p>
                                </div>
                            </div>
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
                    ?>
                </div>
                <?php
            }
            ?>

        </div>
    </div>
    <div class="column">
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
                <div class="alert alert-warning" role="alert">Aucun ingrédient</div>
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
                <?= $recipe['rec_content'] ?>
            </p>
        </div>
    </div>
</article>
<script src="resources/script/ingredientQuantity.js"></script>