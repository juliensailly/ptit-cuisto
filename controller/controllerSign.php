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
    if ($user === -1) {
        controllerErreur::erreur("Adresse mail ou mot de passe incorrect");
        return;
    }else if($user === 0){
        controllerErreur::erreur("Pas d'utilisateur avec cette adresse mail");
        return;
    }

    $_SESSION['login'] = $user;
    $url = $_SERVER['HTTP_REFERER'];
    if(!isset($url) || empty($url) || strpos($url, "?controller=sign&action=signUp") !== false || strpos($url, "?controller=sign&action=signIn") !== false || strpos($url, "?controller=erreur") !== false){
      $url = "index.php";
    }
    header("location:".$url);
  }

  public static function signUp(){
    $url = $_SERVER['HTTP_REFERER'];
    if(!isset($url) || empty($url) || strpos($url, "?controller=sign&action=signUp") !== false || strpos($url, "?controller=sign&action=signIn") !== false || strpos($url, "?controller=erreur") !== false){
      $url = "index.php";
    }
    if(!isset($_POST['name']) || !isset($_POST['surname']) 
      || !isset($_POST['pseudo']) || !isset($_POST['sign-up-mail']) 
      || !isset($_POST['sign-up-password']) || !isset($_POST['password2'])){
        controllerErreur::erreur("Erreur lors de l'inscription");
        return;
    }
    
    $pattern_name = "/^[a-zA-ZÀ-ÖØ-öø-ÿ'\s-]+$/";
    $pattern_email = "/^[\w\.-]+@[a-zA-Z\d\.-]+\.[a-zA-Z]{2,}$/";
    
    if(!preg_match($pattern_name, $_POST['name']) || !preg_match($pattern_name, $_POST['surname'])){
      controllerErreur::erreur("Le prénom ou le nom n'est pas valide");
      return;
    }

    if(!preg_match($pattern_email, $_POST['sign-up-mail'])){
      controllerErreur::erreur("L'adresse mail n'est pas valide");
      return;
    }


    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $pseudo = $_POST['pseudo'];
    $mail = $_POST['sign-up-mail'];
    $password = $_POST['sign-up-password'];
    $password2 = $_POST['password2'];
    
    if(modelCreation::checkIfEmailUsed($mail) != 0){
      controllerErreur::erreur("L'adresse mail est déjà utilisée");
      return;
    }

    if($password != $password2){
      controllerErreur::erreur("Les mots de passe ne correspondent pas");
      return;
    }

    $type = "0";

    $user = new modelCreation($name, $surname, $pseudo, $mail, $password, $type);
    $user->createAccount($name, $surname, $pseudo, $mail, $password, $type);
    $user = modelAuthentification::checkPassword($mail, $password);
    $_SESSION['login'] = $user;
    header("location:".$url);
  }

  public static function signOut(){
    $_SESSION['login'] = false;
    header("location:".$_SERVER['HTTP_REFERER']);
  }
}
