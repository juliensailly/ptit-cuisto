<h4>Informations personnelles</h4>
<form action="index.php?controller=account&action=changeProfilInformation&id=<?= $_SESSION['login']->users_id ?>"
  method="POST" class="changeUserInfo">
  <?php
  $users = $_SESSION['login'];
  ?>

  <div id="change-name-inputs">
    <div>
      <label for="nameM">Prénom :</label>
      <input type="text" id="nameM" name="name" class="form-control" value="<?= $users->users_name ?>">
    </div>
    <div>
      <label for="surnameM">Nom :</label>
      <input type="text" id="surnameM" name="surname" class="form-control" value="<?= $users->users_lastname ?>">
    </div>
  </div>
  <div>
    <label for="pseudoM">Pseudonyme :</label>
    <input type="text" id="pseudoM" name="pseudo" class="form-control" value="<?= $users->users_pseudo ?>">
  </div>
  <div>
    <label for="sign-up-mailM">Adresse mail :</label>
    <input type="email" id="sign-up-mailM" name="sign-up-mail" class="form-control" value="<?= $users->users_email ?>">
  </div>
  <div class="submitBtn">
    <a href="index.php?controller=account&action=changePassword" class="btn btn-outline-primary">Modifier mon mot de passe</a>
    <input type="submit" id="submit" class="btn btn-primary" value="Modifier">
  </div>
</form>

<h4>Supprimer mon compte</h4>
<p>J'ai conscience que la suppression de mon compte est irréversible et que toutes mes informations personnelles seront supprimées.</p>
<a href="index.php?controller=account&action=deleteAccount" class="btn btn-danger">Supprimer mon compte</a>