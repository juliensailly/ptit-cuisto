<?php
require_once(File::build_path(array("model", "modelAuthentification.php")));
require_once(File::build_path(array("lib", "session.php")));

class controllerSign{
  public static function signIn(){
    if (!isset($_POST['sign-in-mail']) || !isset($_POST['sign-in-password'])) {
        controllerErreur::erreur("Erreur lors de la connexion");
        return;
    }

    $mail = $_POST['sign-in-mail'];
    $password = $_POST['sign-in-password'];

    $user = modelAuthentification::checkPassword($mail, $password);
    if ($user == false) {
        controllerErreur::erreur("Adresse mail ou mot de passe incorrect");
        return;
    }

    $_SESSION['login'] = $user;

  }
}
