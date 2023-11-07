<?php
require_once(File::build_path(array("model", "modelComment.php")));
require_once(File::build_path(array("lib", "session.php")));

class controllerTypes{
  

  public static function add(){
    if (!isset($_POST['comment-content']) || !isset($_POST['comment-title'])) {
        controllerErreur::erreur("Erreur lors de l'ajout du commentaire");
        return;
    }
    $pageTitle = "Ajouter un commentaire";
    $idRecipe = $_GET['id'];
    $idUser = $_SESSION['login']->users_id;
    if(isset($_POST['comment-content']) && isset($_POST['comment-title'])){
        $content = $_POST['comment-content'];
        $title = $_POST['comment-title'];
        echo $idRecipe,$idUser,$title,$content;
        $commentaire = modelComment::create($idRecipe,$idUser,$title,$content);
        if(!$commentaire){
            controllerErreur::erreur("Erreur lors de l'insertion' du commentaire.<br>" .
            "<button class=\"btn btn-primary\" onclick=\"history.back()\">Retour au formulaire</button>");
            return; 
        }
        require (File::build_path(array("view", "navbar.php")));
        require (File::build_path(array("view", "accueil.php")));
		require File::build_path(array("view", "footer.php"));

    }
  }
}

