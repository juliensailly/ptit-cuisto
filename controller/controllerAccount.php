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

    $user = modelAccount::getUser($_GET['id']);
    $nbReceivedLiked = modelAccount::getUserNbReceivedLikes($_SESSION['login']->users_id);
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

    if(isset($_POST['name']) && isset($_POST['surname']) 
      && isset($_POST['pseudo']) && isset($_POST['sign-up-mail'])){
        $name = $_POST['name'];
        $surname = $_POST['surname'];
        $pseudo = $_POST['pseudo'];
        $mail = $_POST['sign-up-mail'];

        if(modelCreation::checkIfEmailUsed($mail) != 0 && $mail != $_SESSION['login']->users_email){
          controllerErreur::erreur("L'adresse mail est déjà utilisée");
          return;
        }

        if(!preg_match("/^([A-Za-zÀ-ÖØ-öø-ÿ]+)$/", $name) || !preg_match("/^([A-Za-zÀ-ÖØ-öø-ÿ]+)$/", $surname)){
          controllerErreur::erreur("Le prénom ou le nom n'est pas valide");
          return;
        }

        if(!preg_match("/^[\w\.-]+@[a-zA-Z\d\.-]+\.[a-zA-Z]{2,}$/", $mail)){
          controllerErreur::erreur("L'adresse mail n'est pas valide");
          return;
        }

        $bool = modelAccount::modifyUserInfo($_SESSION['login']->users_id, $pseudo, $mail, $surname, $name);

        $_SESSION['login']->users_name = $name;
        $_SESSION['login']->users_lastname = $surname;
        $_SESSION['login']->users_pseudo = $pseudo;
        $_SESSION['login']->users_email = $mail;
        if($bool){
          header('Location: index.php?controller=account&action=showProfil&id='.$_SESSION['login']->users_id);
        }
    }else{
        $name = $_SESSION['login']->users_name;
        $surname = $_SESSION['login']->users_lastname;
        $pseudo = $_SESSION['login']->users_pseudo;
        $mail = $_SESSION['login']->users_email;
    }
    require (File::build_path(array("view", "navbar.php")));
    require (File::build_path(array("view", "changeInfo.php")));
    require (File::build_path(array("view", "footer.php")));
  }

  public static function changePassword(){
    if (!isset($_GET['id'])) {
      controllerErreur::erreur("Les paramètres n'ont pas été correctement renseignés.");
      return;
    }
    $pageTitle = "Profile - Modification";
    if (!isset($_SESSION["login"])) {
      controllerErreur::erreur("Vous n'êtes pas connecté.");
      return;
    }

    if(isset($_POST['old-password']) && isset($_POST['new-password']) && isset($_POST['new-password2'])){
      $oldPassword = $_POST['old-password'];
      $newPassword = $_POST['new-password'];
      $newPassword2 = $_POST['new-password2'];

      if($newPassword != $newPassword2){
        controllerErreur::erreur("Les mots de passe ne correspondent pas");
        return;
      }

      if(!modelAuthentification::checkPassword($_SESSION['login']->users_email, $oldPassword)){
        controllerErreur::erreur("Le mot de passe actuel n'est pas correct");
        return;
      }

      $bool = modelAccount::modifyUserPassword($_SESSION['login']->users_id, $newPassword);

      if($bool){
        header('Location: index.php?controller=account&action=showProfil&id='.$_SESSION['login']->users_id);
      }
      $_SESSION['login']->users_password = $newPassword;
    }
    require (File::build_path(array("view", "navbar.php")));
    require (File::build_path(array("view", "changePassword.php")));
    require (File::build_path(array("view", "footer.php")));
  }
}
