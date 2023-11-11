<form action="index.php?controller=account&action=changePassword&id=<?= $_SESSION['login']->users_id ?>" method="POST"
  class="changeUserInfo">
  <?php
  $users = $_SESSION['login'];
  ?>

  <div>
    <label for="name">Ancien mot de passe :</label>
    <input type="password" id="old-password" name="old-password" class="form-control">
  </div>
  <div id="name-inputs">
    <div>
      <label for="surname">Nouveau mot de passe :</label>
      <input type="password" id="new-password" name="new-password" class="form-control">
    </div>
    <div>
      <label for="pseudo">Confirmation du nouveau mot de passe :</label>
      <input type="password" id="new-password2" name="new-password2" class="form-control">
    </div>
  </div>
  <input type="submit" id="submit" class="btn btn-primary" value="Modifier">
</form>