<div class="comment-background" style="display: none;">
    <div class="comment-window">
        <div class="comment-header">
            <h3>Déposer un commentaire</h3>
            <img src="resources/img/xmark-solid.svg" alt="xmark icon" class="xmark">
        </div>
        <form action="index.php?controller=comment&action=add" method="POST">
            <div>
                <label for="comment-title">Titre :</label>
                <input type="text" id="comment-title" name="comment-title" class="form-control" required>
            </div>
            <div>
                <label for="comment-content">Avis :</label>
                <textarea name="comment-content" id="comment-content" cols="30" rows="10"></textarea>
            </div>
            <input type="submit" class="btn btn-primary" value="Envoyer">
        </form>
    </div>
</div>
<scri