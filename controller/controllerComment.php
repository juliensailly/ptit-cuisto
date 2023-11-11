<?php
require_once(File::build_path(array("model", "modelComment.php")));
require_once(File::build_path(array("lib", "session.php")));



class controllerComment
{

  public static function add()
  {
    $pageTitle = "Ajouter un commentaire";
    if (
      !isset($_POST['comment-content']) || !isset($_POST['comment-title'])
      || !isset($_GET["id"]) || !isset($_POST['comment-content']) || !isset($_POST['comment-title'])
    ) {
      controllerErreur::erreur("Eléments non définis");
      return;
    }
    if ($_SESSION['login'] == false) {
      controllerErreur::erreur("Vous devez être connecté pour ajouter un commentaire.<br>" .
        "<button class=\"btn btn-primary\" onclick=\"history.back()\">Retour à la recette</button>");
      return;
    }

    $id = $_GET["id"];
    $idUser = $_SESSION['login']->users_id;
    $content = $_POST['comment-content'];
    $title = $_POST['comment-title'];
    if (!modelComment::create($id, $idUser, $title, $content)) {
      controllerErreur::erreur("Erreur lors de l'insertion du commentaire.<br>" .
        "<button class=\"btn btn-primary\" onclick=\"history.back()\">Retour à la recette</button>");
      return;
    }

    header("Location: index.php?action=read&id=" . $id);
  }

  public static
}

