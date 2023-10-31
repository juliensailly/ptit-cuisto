<h2 class="recipe_title"><?= $recipe['rec_title']?></h2>
<h4 class="recipe_category"><i><?= $recipe['cat_title']?></i></h4>

<article id="recipe_view">
    <div class="column">
        <div class="component">
            <div class="img_container">
                <img src="<?= $recipe['rec_image_src']?>" alt="<?= $recipe['rec_title']?>">
            </div>
            <div class="author_save">
                <div class="author">
                    <img src="https://picsum.photos/50/50" alt="PP">
                    <div>
                        <p><?= $recipe['users_pseudo']?></p>
                        <?php
                            $date = $recipe['rec_creation_date'];
                            if (isset($recipe['rec_modification_date'])) {
                                $date = $recipe['rec_modification_date'];
                            }
                        ?>
                        <p>Publié le <?= $date?></p>
                    </div>
                </div>
                <form method="POST" action="" class="save_recipe">
                    <button class="save_recipe_button" type="submit">
                        <input value="Sauvegarder" style="display: none;">
                        <span class="save">Sauvegarder</span>
                        <span>3</span>
                        <i class="fa-regular fa-heart" style="color: #ffffff;"></i>
                    </button>
                </form>
            </div>
        </div>
        <div class="tags component">
            <h3>Tags</h3>
            <div>
                <span>Tag</span>
                <span>Tag plus long</span>
                <span>Tag moyen</span>
                <span>Tag moyen</span>
                <span>Tag plus long</span>
            </div>
        </div>
        <div class="comments component">
            <h3>Commentaires</h3>
            <div>
                <div class="comment">
                    <div class="author">
                        <img src="https://picsum.photos/50/50" alt="PP">
                        <div>
                            <p>Michel</p>
                            <p>Publié le 01/01/2021</p>
                        </div>
                    </div>
                    <p>it amen eslorem ipsum sit amen es lorem ipsum dolor sit
                        amen eslorem sit ipsum dolor sit amen eslorem ipsum sit
                        amen eslorem ipsum.
                    </p>
                </div>
                <hr>
                <div class="comment">
                    <div class="author">
                        <img src="https://picsum.photos/50/50" alt="PP">
                        <div>
                            <p>Michel</p>
                            <p>Publié le 01/01/2021</p>
                        </div>
                    </div>
                    <p>it amen eslorem ipsum sit amen es lorem ipsum dolor sit
                        amen eslorem sit ipsum dolor sit amen eslorem ipsum sit
                        amen eslorem ipsum.
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="column">
        <div class="ingredients component">
            <div>
                <h3>Ingrédients</h3>
                <div class="person_number btn-group">
                    <button type="button" class="btn btn-outline-primary">-</button>
                    <span class="btn btn-outline-primary">4 personnes</span>
                    <button type="button" class="btn btn-outline-primary">+</button>
                </div>
            </div>
            <table>
                <tr>
                    <th>Ingrédient</th>
                    <th>Quantité</th>
                </tr>
                <tr>
                    <td>Ingrédient 1</td>
                    <td>Quantité 1</td>
                </tr>
                <tr>
                    <td>Ingrédient 2</td>
                    <td>Quantité 2</td>
                </tr>
                <tr>
                    <td>Ingrédient 3</td>
                    <td>Quantité 3</td>
                </tr>
            </table>

        </div>
        <div class="recipe_content component">
            <h3>Indications</h3>
            <p> <?= $recipe['rec_content']?> </p>
        </div>
    </div>
</article>