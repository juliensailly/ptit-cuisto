<?php
require_once(File::build_path(array("model", "modelAccount.php")));
require_once(File::build_path(array("model", "modelRecipes.php")));
require_once(File::build_path(array("lib", "session.php")));

class controllerAccount{
  /* Récupérer la liste des types */
  public static function readAll(){
    $pageTitle = "Tous les types";
    $tab_t = modelTypes::readAll();
    require (File::build_path(array("view", "navbar.php")));
    require	(File::build_path(array("view", "accountView.php")));
    require (File::build_path(array("view", "footer.php")));
  }

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
}
