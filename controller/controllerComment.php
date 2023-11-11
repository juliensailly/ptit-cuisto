<?php
require_once(File::build_path(array("model", "modelComment.php")));
require_once(File::build_path(array("lib", "session.php")));



class controllerComment
{

  public static function add()
  {
    if (!isset($_GET["id"]) || !isset($_POST['comment-content'])) {
      controllerErreur::erreur("Eléments non définis");
      return;
    }
    if ($_SESSION['login'] == false) {
      controllerErreur::erreur("Vous devez être connecté pour ajouter un commentaire.<br>" .
        "<button class=\"btn btn-primary\" onclick=\"history.back()\">Retour à la recette</button>");
      return;
    }

    $rec_id = $_GET["id"];
    $users_id = $_SESSION['login']->users_id;
    $content = $_POST['comment-content'];
    $isAuthorised = $_SESSION['login']->users_type;

    $old_comment = modelComment::getComment($rec_id, $users_id);
    if ($old_comment !== false) {
      if (!modelComment::updateComment($rec_id, $users_id, $content, $isAuthorised)) {
        controllerErreur::erreur("Erreur lors de la mise à jour du commentaire.<br>" .
          "<button class=\"btn btn-primary\" onclick=\"history.back()\">Retour à la recette</button>");
        return;
      }
    } else {
      if (!modelComment::addComment($rec_id, $users_id, $content, $isAuthorised)) {
        controllerErreur::erreur("Erreur lors de l'insertion du commentaire.<br>" .
          "<button class=\"btn btn-primary\" onclick=\"history.back()\">Retour à la recette</button>");
        return;
      }
    }
    
    header("Location: index.php?controller=recipes&action=read&id=" . $rec_id);
    return;
  }
}

