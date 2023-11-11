<form action="index.php?controller=account&action=changeProfilInformation&id=<?= $_SESSION['login']->users_id ?>"
  method="POST" class="changeUserInfo">
  <?php
  $users = $_SESSION['login'];
  ?>

  <div id="name-inputs">
    <div>
      <label for="name">Prénom :</label>
      <input type="text" id="name" name="name" class="form-control" value=<?= $users->users_name ?>>
    </div>
    <div>
      <label for="surname">Nom :</label>
      <input type="text" id="surname" name="surname" class="form-control" value=<?= $users->users_lastname ?>>
    </div>
  </div>
  <div>
    <label for="pseudo">Pseudonyme :</label>
    <input type="text" id="pseudo" name="pseudo" class="form-control" value=<?= $users->users_pseudo ?>>
  </div>
  <div>
    <label for="sign-up-mail">Adresse mail :</label>
    <input type="email" id="sign-up-mail" name="sign-up-mail" class="form-control" value=<?= $users->users_email ?>>
  </div>
  <input type="submit" id="submit" class="btn btn-primary" value="Modifier">
</form>