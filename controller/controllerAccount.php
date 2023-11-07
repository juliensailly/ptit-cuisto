<?php
require_once(File::build_path(array("model", "modelAccount.php")));
require_once(File::build_path(array("model", "modelRecipes.php")));
require_once(File::build_path(array("model", "modelCreation.php")));
require_once(File::build_path(array("lib", "session.php")));

class controllerAccount{
  public static function showProfil() {
    if (!isset($_GET['id'])) {
      controllerErreur::erreur("Les paramètres n'ont pas été correctement renseignés.");
      return;
    }
    $pageTitle = "Mon compte";

    if (!isset($_SESSION['login'])) {
      controllerErreur::erreur("Vous n'êtes pas connecté.");
      return;
    }

    $usersRecipes = modelAccount::getUsersRecipes($_SESSION['login']->users_id);
    $usersLikedRecipes = modelAccount::getUsersLikedRecipes($_SESSION['login']->users_id);
    require (File::build_path(array("view", "navbar.php")));
    require (File::build_path(array("view", "accountView.php")));
    require (File::build_path(array("view", "footer.php")));
  }

  public static function changeProfilInformation(){
    if (!isset($_GET['id'])) {
      controllerErreur::erreur("Les paramètres n'ont pas été correctement renseignés.");
      return;
    }
    $pageTitle = "Profile - Modification";
    if (!isset($_SESSION["login"])) {
      controllerErreur::erreur("Vous n'êtes pas connecté.");
      return;
    }

    if(!isset($_POST['name']) || !isset($_POST['surname']) 
      || !isset($_POST['pseudo']) || !isset($_POST['sign-up-mail'])){
        $name = $_SESSION['login']->users_name;
        $surname = $_SESSION['login']->users_lastname;
        $pseudo = $_SESSION['login']->users_pseudo;
        $mail = $_SESSION['login']->users_email;
    }else{
      $name = $_POST['name'];
      $surname = $_POST['surname'];
      $pseudo = $_POST['pseudo'];
      $mail = $_POST['sign-up-mail'];
    }
    if(modelCreation::checkIfEmailUsed($mail) != 0 && $mail != $_SESSION['login']->users_email){
      controllerErreur::erreur("L'adresse mail est déjà utilisée");
      return;
    }

    modelAccount::modifyUserInfo($_SESSION['login']->users_id, $pseudo, $mail, $surname, $name);
    $_SESSION['login']->users_name = $name;
    $_SESSION['login']->users_lastname = $surname;
    $_SESSION['login']->users_pseudo = $pseudo;
    $_SESSION['login']->users_email = $mail;
    require (File::build_path(array("view", "navbar.php")));
    require (File::build_path(array("view", "changeInfo.php")));
    require (File::build_path(array("view", "footer.php")));
  }
}
