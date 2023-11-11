<h3>Confirmation de la suppression du compte -
    <?= $_SESSION['login']->users_pseudo ?>
</h3>

<form action="index.php?controller=account&action=deleteAccount" method="post" class="deleteAccountForm">
    <div>
        <label for="passwordD">Mot de passe :</label>
        <input type="password" id="passwordD" name="password" class="form-control">
    </div>
    <div class="form-check form-switch">
        <input class="form-check-input" name="leaveRecipeCheck" value="1" checked type="checkbox" role="switch" id="leaveRecipeCheck">
        <label class="form-check-label" for="leaveRecipeCheck">Conserver mes recettes sur le site (vous ne serez plus affiché comme l'auteur)</label>
    </div>
    <input type="submit" id="submit" class="btn btn-danger" value="Supprimer définitivement le compte">
</form>