<?php
require_once(File::build_path(array("model", "modelComment.php")));
require_once(File::build_path(array("lib", "session.php")));



class controllerComment{
  
  public static function add(){
    if (!isset($_POST['comment-content']) || !isset($_POST['comment-title']) || !isset($_GET["id"])) {
        controllerErreur::erreur("Eléments non définis");
        return;
    }
    $id = $_GET["id"];
    $idUser = $_SESSION['login']->users_id;
    $pageTitle = "Ajouter un commentaire";
    if(isset($_POST['comment-content']) && isset($_POST['comment-title'])){
        $content = $_POST['comment-content'];
        $title = $_POST['comment-title'];
        $insert = modelComment::create($id,$idUser,$title,$content);
        if(!isset($insert)){
            controllerErreur::erreur("Erreur lors de l'insertion du commentaire.<br>" .
            "<button class=\"btn btn-primary\" onclick=\"history.back()\">Retour au formulaire</button>");
            return; 
        }
        require_once(File::build_path(array("View", "navbar.php")));
        require_once(File::build_path(array("View", "viewRecipe.php")));
		    require_once(File::build_path(array("View", "footer.php")));
    }
  }
}

