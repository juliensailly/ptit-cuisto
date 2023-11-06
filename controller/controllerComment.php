<?php
require_once(File::build_path(array("model", "modelComment.php")));
require_once(File::build_path(array("lib", "session.php")));

class controllerTypes{
  

  public static function add(){
    $pageTitle = "Ajouter un commentaire";
    $idRecipe = $_GET['id'];
    $idUser = $_SESSION['login']->users_id;
    if(isset($_POST['comment-content']) && isset($_POST['comment-title'])){
        $comm = modelComment::create($idRecipe,$idUser,$_POST['comment-title'],$_POST['comment-content']);
        if($comm === false){
            controllerErreur::erreur("Erreur lors de l'insertion' de la recette.<br>" .
            "<button class=\"btn btn-primary\" onclick=\"history.back()\">Retour au formulaire</button>");
          return;            
        }
    }
    header("location:".$_SERVER['HTTP_REFERER']);
  }
}
