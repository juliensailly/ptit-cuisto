<hr>
<?php
if ($_SESSION['login'] === false) { ?>
    <button type="button" class="btn btn-primary commentModalBtn" data-bs-toggle="modal"
        data-bs-target="#commentModal" disabled>Connectez-vous pour laisser un commentaire</button>
<?php return; } 
?>
<button type="button" class="btn btn-primary commentModalBtn" data-bs-toggle="modal" data-bs-target="#commentModal">
    <?php
    if ($currentUserComment !== false) {
        echo "Modifier mon commentaire";
    } else {
        echo "Ajouter un commentaire";
    }
    ?>
</button>

<div class="modal fade" id="commentModal" tabindex="-1" aria-labelledby="commentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="commentModalLabel">Commentaire</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="index.php?controller=comment&action=add&id=<?= $recipe['rec_id'] ?>" method="POST">
                <div class="modal-body">
                    <label for="comment-content">
                        <?php
                        if ($currentUserComment !== false) {
                            echo "Modifier votre commentaire";
                        } else {
                            echo "Partagez votre avis sur cette recette";
                        }
                        ?>
                    </label>
                    <textarea class="form-control" name="comment-content" id="comment-content" rows="3" required><?php
                    if ($currentUserComment !== false) {
                        echo $currentUserComment['com_content'];
                    }
                    ?></textarea>
                </div>
                <div class="modal-footer">
                    <input type="submit" class="btn btn-primary" value="Envoyer">
                </div>
            </form>

        </div>
    </div>
</div>