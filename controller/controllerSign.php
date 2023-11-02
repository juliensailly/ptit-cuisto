<?php
require_once(File::build_path(array("model", "modelAuthentification.php")));
require_once(File::build_path(array("model", "modelCreation.php")));
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

  public static function signUp(){
    $url = $_SERVER['HTTP_REFERER'];
    if(!isset($url) || empty($url) || str_contains($url, "?controller=sign&action=signUp")){
      $url = "index.php";
    }
    if(!isset($_POST['name']) || !isset($_POST['surname']) 
      || !isset($_POST['pseudo']) || !isset($_POST['sign-up-mail']) 
      || !isset($_POST['sign-up-password']) || !isset($_POST['password2'])){
        controllerErreur::erreur("Erreur lors de l'inscription");
        return;
    }
    
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $pseudo = $_POST['pseudo'];
    $mail = $_POST['sign-up-mail'];
    $password = $_POST['sign-up-password'];
    $password2 = $_POST['password2'];

    if($password != $password2){
      controllerErreur::erreur("Les mots de passe ne correspondent pas");
      return;
    }

    $type = "0";

    $user = new modelCreation($name, $surname, $pseudo, $mail, $password, $type);
    $user->createAccount($name, $surname, $pseudo, $mail, $password, $type);
    header("location:".$url);
  }
}
