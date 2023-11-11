<hr>
<button type="button" class="btn btn-primary commentModalBtn" data-bs-toggle="modal" data-bs-target="#commentModal">
    Ajouter un commentaire
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
                    <label for="comment-content">Partagez votre avis sur cette recette</label>
                    <textarea class="form-control" name="comment-content" id="comment-content" rows="3"
                        required></textarea>
                </div>
                <div class="modal-footer">
                    <input type="submit" class="btn btn-primary" value="Envoyer">
                </div>
            </form>

        </div>
    </div>
</div>