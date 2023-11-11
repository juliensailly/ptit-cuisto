<?php
require_once(File::build_path(array("model", "modelAccount.php")));
require_once(File::build_path(array("model", "modelRecipes.php")));
require_once(File::build_path(array("model", "modelCreation.php")));
require_once(File::build_path(array("lib", "session.php")));

class controllerAccount
{
  public static function showProfil()
  {
    if (!isset($_GET['id'])) {
      controllerErreur::erreur("Les paramètres n'ont pas été correctement renseignés.");
      return;
    }
    $pageTitle = "Mon compte";

    $user = modelAccount::getUser($_GET['id']);
    $nbReceivedLiked = modelAccount::getUserNbReceivedLikes($_GET['id']);
    $usersRecipes = modelAccount::getUsersRecipes($_GET['id']);
    $usersLikedRecipes = modelAccount::getUsersLikedRecipes($_GET['id']);
    $pageTitle = "Profil - " . $user->users_pseudo;
    require(File::build_path(array("view", "navbar.php")));
    require(File::build_path(array("view", "accountView.php")));
    require(File::build_path(array("view", "footer.php")));
  }

  public static function changeProfilInformation()
  {
    if (!isset($_GET['id'])) {
      controllerErreur::erreur("Les paramètres n'ont pas été correctement renseignés.");
      return;
    }
    $pageTitle = "Profile - Modification";
    if (!isset($_SESSION["login"])) {
      controllerErreur::erreur("Vous n'êtes pas connecté.");
      return;
    }

    if (
      isset($_POST['name']) && isset($_POST['surname'])
      && isset($_POST['pseudo']) && isset($_POST['sign-up-mail'])
    ) {
      $name = $_POST['name'];
      $surname = $_POST['surname'];
      $pseudo = $_POST['pseudo'];
      $mail = $_POST['sign-up-mail'];

      if (modelCreation::checkIfEmailUsed($mail) != 0 && $mail != $_SESSION['login']->users_email) {
        controllerErreur::erreur("L'adresse mail est déjà utilisée");
        return;
      }

      if (!preg_match("/^([A-Za-zÀ-ÖØ-öø-ÿ]+)$/", $name) || !preg_match("/^([A-Za-zÀ-ÖØ-öø-ÿ]+)$/", $surname)) {
        controllerErreur::erreur("Le prénom ou le nom n'est pas valide");
        return;
      }

      if (!preg_match("/^[\w\.-]+@[a-zA-Z\d\.-]+\.[a-zA-Z]{2,}$/", $mail)) {
        controllerErreur::erreur("L'adresse mail n'est pas valide");
        return;
      }

      $bool = modelAccount::modifyUserInfo($_SESSION['login']->users_id, $pseudo, $mail, $surname, $name);

      $_SESSION['login']->users_name = $name;
      $_SESSION['login']->users_lastname = $surname;
      $_SESSION['login']->users_pseudo = $pseudo;
      $_SESSION['login']->users_email = $mail;
      if ($bool) {
        header('Location: index.php?controller=account&action=showProfil&id=' . $_SESSION['login']->users_id);
      }
    } else {
      $name = $_SESSION['login']->users_name;
      $surname = $_SESSION['login']->users_lastname;
      $pseudo = $_SESSION['login']->users_pseudo;
      $mail = $_SESSION['login']->users_email;
    }
    require(File::build_path(array("view", "navbar.php")));
    require(File::build_path(array("view", "changeInfo.php")));
    require(File::build_path(array("view", "footer.php")));
  }

  public static function changePassword()
  {
    $pageTitle = "Profil - Modification du mot de passe";
    if ($_SESSION["login"] == false) {
      controllerErreur::erreur("Vous n'êtes pas connecté.");
      return;
    }

    if (isset($_POST['old-password']) && isset($_POST['new-password']) && isset($_POST['new-password2'])) {
      $oldPassword = $_POST['old-password'];
      $newPassword = $_POST['new-password'];
      $newPassword2 = $_POST['new-password2'];

      if ($newPassword != $newPassword2) {
        controllerErreur::erreur("Les mots de passe ne correspondent pas");
        return;
      }

      $temp = modelAuthentification::checkPassword($_SESSION['login']->users_email, $oldPassword);

      if ($temp == -1 || $temp == 0) {
        controllerErreur::erreur("Le mot de passe actuel n'est pas correct");
        return;
      }

      $bool = modelAccount::modifyUserPassword($_SESSION['login']->users_id, $newPassword);

      if ($bool) {
        header('Location: index.php?controller=account&action=showProfil&id=' . $_SESSION['login']->users_id);
      }
      $_SESSION['login']->users_password = password_hash($newPassword, PASSWORD_DEFAULT);
      ;
    }
    require(File::build_path(array("view", "navbar.php")));
    require(File::build_path(array("view", "changePassword.php")));
    require(File::build_path(array("view", "footer.php")));
  }

  public static function deleteAccountAction()
  {
    if ($_SESSION["login"] == false) {
      controllerErreur::erreur("Vous n'êtes pas connecté.");
      return;
    }
    if (!isset($_POST['password'])) {
      controllerErreur::erreur("Le mot de passe entré n'est pas valide.");
      return;
    }
    $password = $_POST['password'];
    $temp = modelAuthentification::checkPassword($_SESSION['login']->users_email, $password, false);
    if ($temp === -1 || $temp === 0) {
      controllerErreur::erreur("Le mot de passe actuel n'est pas correct");
      return;
    }

    if (modelAccount::deleteLikes($_SESSION['login']->users_id) == false) {
      controllerErreur::erreur("Erreur lors de la suppression des likes");
      return;
    }

    if (modelAccount::deleteComments($_SESSION['login']->users_id) == false) {
      controllerErreur::erreur("Erreur lors de la suppression des commentaires");
      return;
    }

    if (modelAccount::deleteEdito($_SESSION['login']->users_id) == false) {
      controllerErreur::erreur("Erreur lors de la suppression des editos");
      return;
    }

    if ((isset($_POST['leaveRecipeCheck']) && $_POST['leaveRecipeCheck'] == "1")) {
      if (modelAccount::updateRecipesToDeletedUser($_SESSION['login']->users_id) == false) {
        controllerErreur::erreur("Erreur lors de la suppression des recettes (update)");
        return;
      }

      if (modelAccount::deleteUser($_SESSION['login']->users_id) == false) {
        controllerErreur::erreur("Erreur lors de la suppression de l'utilisateur");
        return;
      }

      session_unset();
      session_destroy();
      header('Location: index.php');
    }

    $recipes = modelAccount::getUsersRecipes($_SESSION['login']->users_id);

    foreach ($recipes as $recipe) {
      if (modelRecipes::deleteRecipeTags($recipe->rec_id) == false) {
        controllerErreur::erreur("Erreur lors de la suppression des tags de la recette.<br>" .
          "<button class=\"btn btn-primary\" onclick=\"history.back()\">Retour à la recette</button>");
        return;
      }

      if (modelRecipes::deleteRecipeIngredients($recipe->rec_id) == false) {
        controllerErreur::erreur("Erreur lors de la suppression des ingrédients de la recette.<br>" .
          "<button class=\"btn btn-primary\" onclick=\"history.back()\">Retour à la recette</button>");
        return;
      }

      if (modelRecipes::deleteRecipeComments($recipe->rec_id) == false) {
        controllerErreur::erreur("Erreur lors de la suppression des commentaires de la recette.<br>" .
          "<button class=\"btn btn-primary\" onclick=\"history.back()\">Retour à la recette</button>");
        return;
      }

      if (modelRecipes::deleteRecipeLikes($recipe->rec_id) == false) {
        controllerErreur::erreur("Erreur lors de la suppression des likes de la recette.<br>" .
          "<button class=\"btn btn-primary\" onclick=\"history.back()\">Retour à la recette</button>");
        return;
      }

      if (modelRecipes::deleteRecipe($recipe->rec_id) == false) {
        controllerErreur::erreur("Erreur lors de la suppression de la recette.<br>" .
          "<button class=\"btn btn-primary\" onclick=\"history.back()\">Retour à la recette</button>");
        return;
      }

      $target_dir = "resources/img/recipes_images/";
      $target_file = $target_dir . $recipe->rec_image_src;
      if (file_exists($target_file) && $recipe->rec_image_src != "placeholder.jpg") {
        unlink($target_file);
      }
    }

    if (modelAccount::deleteUser($_SESSION['login']->users_id) == false) {
      controllerErreur::erreur("Erreur lors de la suppression de l'utilisateur");
      return;
    }

    session_unset();
    session_destroy();
    header('Location: index.php');
  }

  public static function deleteAccount()
  {
    $pageTitle = "Profil - Suppression du compte";
    if ($_SESSION["login"] == false) {
      controllerErreur::erreur("Vous n'êtes pas connecté.");
      return;
    }

    require(File::build_path(array("view", "navbar.php")));
    require(File::build_path(array("view", "deleteAccountView.php")));
    require(File::build_path(array("view", "footer.php")));
  }
}
