<form action="index.php?controller=account&action=changePassword&id=<?= $_SESSION['login']->users_id ?>"
  method="POST">
  <?php
  $users = $_SESSION['login'];
  ?>

  <div id="name-inputs">
    <div>
      <label for="name">Old password :</label>
      <input type="password" id="old-password" name="old-password" class="form-control">
    </div>
    <div>
      <label for="surname">new Password :</label>
      <input type="password" id="new-password" name="new-password" class="form-control">
    </div>
  </div>
  <div>
    <label for="pseudo">Confirm Password :</label>
    <input type="password" id="new-password2" name="new-password2" class="form-control">
  </div>
  <input type="submit" id="submit" class="btn btn-primary" value="Modifier">
</form>