<?php
require_once(File::build_path(array("model", "modelComment.php")));
require_once(File::build_path(array("lib", "session.php")));



class controllerComment{
  
  public static function add(){
    
    if (!isset($_POST['comment-content']) || !isset($_POST['comment-title']) || !isset($_GET["id"])) {
        controllerErreur::erreur("Eléments non définis");
        return;
    }
    $test = false;
    $id = $_GET["id"];
    $idUser = $_SESSION['login']->users_id;
    $pageTitle = "Ajouter un commentaire";
    if(isset($_POST['comment-content']) && isset($_POST['comment-title'])){
        $content = $_POST['comment-content'];
        $title = $_POST['comment-title'];
        var_dump($id); var_dump($idUser); var_dump($title); var_dump($content);
        $test = modelComment::create($id,$idUser,$title,$content);
        var_dump($test);
        if($test !== true){
            controllerErreur::erreur("Erreur lors de l'insertion du commentaire.<br>" .
            "<button class=\"btn btn-primary\" onclick=\"history.back()\">Retour au formulaire</button>");
            return; 
        }
        require (File::build_path(array("View", "navbar.php")));
        require (File::build_path(array("View", "viewRecipe.php")));
		    require (File::build_path(array("View", "footer.php")));
    }
  }
}

