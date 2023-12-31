<?php
require_once(File::build_path(array("model", "modelRecipes.php")));
require_once(File::build_path(array("model", "modelFiltres.php")));
require_once(File::build_path(array("model", "modelComment.php")));
require_once(File::build_path(array("lib", "session.php")));

class controllerRecipes
{
  public static function readAll()
  {
    $pageTitle = "Toutes les recettes";
    $recipes = modelRecipes::getRecipe();
    $tags = modelRecipes::getAllTags();
    $page = 1;
    if (isset($_GET['page'])) {
      if ($_GET['page'] > 0) {
        $page = $_GET['page'];
      }
    }
    require(File::build_path(array("view", "navbar.php")));
    require(File::build_path(array("view", "viewAllRecipe.php")));
    require(File::build_path(array("view", "footer.php")));
  }

  public static function read()
  {
    if (!isset($_GET["id"])) {
      controllerErreur::erreur("Problème dans l'affichage de la recette");
      return;
    }
    $pageTitle = "Recette";
    $recipe = modelRecipes::getRecipe($_GET["id"]);
    if ($recipe == false) {
      controllerErreur::erreur("Cette recette n'existe pas");
      return;
    }
    $likes = modelRecipes::getRecipeLikes($_GET["id"]);
    $tags = modelRecipes::getRecipeTags($_GET["id"]);
    $comments = modelRecipes::getRecipeComments($_GET["id"]);
    $currentUserComment = false;
    if ($_SESSION['login'] !== false) {
      $currentUserComment = modelComment::getComment($_GET["id"], $_SESSION['login']->users_id);
    }
    $ingredients = modelRecipes::getRecipeIngredients($_GET["id"]);
    if ($_SESSION['login'] === false) {
      $isLiked = false;
    } else {
      $isLiked = modelRecipes::isRecipeLiked($_SESSION['login']->users_id, $_GET["id"]);
    }
    if ($recipe['isAuthorised'] == 0) {
      if ($_SESSION['login'] === false) {
        controllerErreur::erreur("Cette recette n'est pas encore autorisée");
        return;
      } else if ($_SESSION['login']->users_id != $recipe['users_id'] && $_SESSION['login']->users_type != 1) {
        controllerErreur::erreur("Cette recette n'est pas encore autorisée");
        return;
      }
    }
    require(File::build_path(array("view", "navbar.php")));
    require(File::build_path(array("view", "viewRecipe.php")));

    require(File::build_path(array("view", "footer.php")));
  }

  public static function createForm()
  {
    $pageTitle = "Créer une recette";
    if ($_SESSION['login'] === false) {
      controllerErreur::erreur("Vous devez être connecté pour créer une recette");
      return;
    }
    if ($_SESSION['login']->users_status == 1) {
      controllerErreur::erreur("Votre compte a été suspendu, vous ne pouvez pas créer de recettes.");
      return;
    }

    $categories = modelFiltres::getCategories();

    require(File::build_path(array("view", "navbar.php")));
    require(File::build_path(array("view", "addRecipe.php")));
    require(File::build_path(array("view", "footer.php")));
  }

  public static function create()
  {
    if ($_SESSION['login'] === false) {
      controllerErreur::erreur("Vous devez être connecté pour créer une recette");
      return;
    }

    controllerRecipes::parametersCheck();
    $regex = "/(?:\d+\s)?(?:[a-zA-ZÀ-ÖØ-öø-ÿ0-9]+(?:\s[a-zA-ZÀ-ÖØ-öø-ÿ0-9]+)*)/";

    if (!empty($_POST['selectedIngredients']) && !empty($_POST['selectedTags'])) {
      $ingredients = json_decode($_POST['selectedIngredients'], true);
      $tags = json_decode($_POST['selectedTags'], true);
    } else {
      $ingredients = array();
      $tags = array();
    }

    $isAuthorised = 0;
    if ($_SESSION['login']->users_type == 1) {
      $isAuthorised = 1;
    }
    $rec_id = modelRecipes::createRecipe($_POST['title'], $_POST['content'], $_POST['summary'], $_POST['category'], $_SESSION['login']->users_id, $_POST['nbPerson'], $isAuthorised);
    if ($rec_id == false) {
      controllerErreur::erreur("Erreur lors de l'insertion' de la recette.<br>" .
        "<button class=\"btn btn-primary\" onclick=\"history.back()\">Retour au formulaire</button>");
      return;
    }

    $target_dir = "resources/img/recipes_images/";
    $target_file = $target_dir . "rec_" . $rec_id . "." . strtolower(pathinfo(basename($_FILES["image"]["name"]), PATHINFO_EXTENSION));
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $fileOk = true;
    if (
      !in_array(
        $imageFileType,
        array(
          "jpg",
          "png",
          "jpeg"
        )
      )
    ) {
      $fileOk = false;
    }
    if ($_FILES["image"]["size"] > 1000000) {
      $fileOk = false;
    }

    if ($fileOk) {
      if (!move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        controllerErreur::erreur("Erreur lors de l'upload du fichier.<br>" .
          "<button class=\"btn btn-primary\" onclick=\"history.back()\">Retour au formulaire</button>");
        return;
      }

      if (modelRecipes::updateRecipeImgPath($rec_id, "rec_" . $rec_id . "." . strtolower(pathinfo(basename($_FILES["image"]["name"]), PATHINFO_EXTENSION))) == false) {
        controllerErreur::erreur("Erreur lors de la création de la recette (image).<br>" .
          "<button class=\"btn btn-primary\" onclick=\"history.back()\">Retour au formulaire</button>");
        return;
      }
    }

    foreach ($ingredients as $ingredient) {
      if (!preg_match($regex, $ingredient['title']) || !preg_match($regex, $ingredient['quantity'])) {
        controllerErreur::erreur("Le texte entré n'est pas valide (nom d'un ingrédient : " . preg_match($regex, $ingredient['title']) . " : " . preg_match($regex, $ingredient['quantity']) . "<br>" .
          "<button class=\"btn btn-primary\" onclick=\"history.back()\">Retour au formulaire</button>");
        return;
      }

      $ing_id = modelRecipes::getIngredientByTitle($ingredient['title']);
      if ($ing_id == false) {
        $ing_id = modelRecipes::createIngredient($ingredient['title']);
      } else {
        $ing_id = $ing_id['ing_id'];
      }

      $quantity = preg_replace('/[a-zA-Z]+/', '', $ingredient['quantity']);
      $unit = preg_replace('/[0-9]+/', '', $ingredient['quantity']);
      $quantity = trim($quantity);
      if ($quantity == "")
        $quantity = 1;
      $unit = trim($unit);
      if ($unit == "")
        $unit = "unité";

      if (modelRecipes::createRecipeIngredient($rec_id, $ing_id, $quantity, $unit) == false) {
        controllerErreur::erreur("Erreur lors de la création de la recette (ingrédient).<br>" .
          "<button class=\"btn btn-primary\" onclick=\"history.back()\">Retour au formulaire</button>");
        return;
      }
    }

    foreach ($tags as $tag) {
      if (!preg_match($regex, $tag['title'])) {
        controllerErreur::erreur("Le texte entré n'est pas valide (nom d'un tag).<br>" .
          "<button class=\"btn btn-primary\" onclick=\"history.back()\">Retour au formulaire</button>");
        return;
      }

      $tag_id = modelRecipes::getTagByTitle($tag['title']);
      if ($tag_id == false) {
        $tag_id = modelRecipes::createTag($tag['title']);
      } else {
        $tag_id = $tag_id['tag_id'];
      }

      if (modelRecipes::createRecipeTag($rec_id, $tag_id) == false) {
        controllerErreur::erreur("Erreur lors de la création de la recette (tag).<br>" .
          "<button class=\"btn btn-primary\" onclick=\"history.back()\">Retour au formulaire</button>");
        return;
      }
    }

    header('Location: index.php?controller=recipes&action=read&id=' . $rec_id);
  }

  public static function parametersCheck()
  {
    $regex = "/(?:\d+\s)?(?:[a-zA-ZÀ-ÖØ-öø-ÿ0-9]+(?:\s[a-zA-ZÀ-ÖØ-öø-ÿ0-9]+)*)/";
    if (!isset($_POST['title']) || !isset($_POST['summary']) || !isset($_POST['content']) || !isset($_POST['category']) || !isset($_POST['selectedIngredients']) || !isset($_POST['selectedTags'])) {
      controllerErreur::erreur("Erreur lors de la création de la recette.<br>" .
        "Les champs obligatoires sont : titre, résumé, contenu et catégorie de la recette.<br>" .
        "Les champs facultatifs sont : image, ingrédients et tags.<br>" .
        "<button class=\"btn btn-primary\" onclick=\"history.back()\">Retour au formulaire</button>");
      return;
    }

    if (!preg_match($regex, $_POST['title']) || !preg_match($regex, $_POST['summary']) || !preg_match($regex, $_POST['content'])) {
      controllerErreur::erreur("Le texte entré n'est pas valide (titre, description, indications).<br>" .
        "<button class=\"btn btn-primary\" onclick=\"history.back()\">Retour au formulaire</button>");
      return;
    }

    $category = modelRecipes::getCategoryByID($_POST['category']);
    if (!is_numeric($_POST['category']) || $category === false) {
      controllerErreur::erreur("La catégorie entrée n'est pas valide.<br>" .
        "<button class=\"btn btn-primary\" onclick=\"history.back()\">Retour au formulaire</button>");
      return;
    }
  }

  public static function editForm()
  {
    $pageTitle = "Modifier une recette";
    if ($_SESSION['login'] === false) {
      controllerErreur::erreur("Vous devez être connecté pour modifier une recette");
      return;
    } else if ($_SESSION['login']->users_id != modelRecipes::getRecipe($_GET["id"])['users_id'] && $_SESSION['login']->users_type != 1) {
      controllerErreur::erreur("Seul le propriétaire de cette recette peut la modifier");
      return;
    }

    $recipe = modelRecipes::getRecipe($_GET["id"]);
    $tags = modelRecipes::getRecipeTags($_GET["id"]);
    $ingredients = modelRecipes::getRecipeIngredients($_GET["id"]);

    $categories = modelFiltres::getCategories();

    require(File::build_path(array("view", "navbar.php")));
    require(File::build_path(array("view", "editRecipe.php")));
    require(File::build_path(array("view", "footer.php")));
  }

  public static function edit()
  {
    if ($_SESSION['login'] === false) {
      controllerErreur::erreur("Vous devez être connecté pour modifier une recette");
      return;
    } else if ($_SESSION['login']->users_id != modelRecipes::getRecipe($_GET["id"])['users_id'] && $_SESSION['login']->users_type != 1) {
      controllerErreur::erreur("Seul le propriétaire de cette recette peut la modifier");
      return;
    }
    if (!isset($_GET["id"])) {
      controllerErreur::erreur("Problème dans la modification de la recette");
      return;
    }

    controllerRecipes::parametersCheck();
    $regex = "/(?:\d+\s)?(?:[a-zA-ZÀ-ÖØ-öø-ÿ0-9]+(?:\s[a-zA-ZÀ-ÖØ-öø-ÿ0-9]+)*)/";

    if (!empty($_POST['selectedIngredients']) && !empty($_POST['selectedTags'])) {
      $ingredients = json_decode($_POST['selectedIngredients'], true);
      $tags = json_decode($_POST['selectedTags'], true);
    } else {
      $ingredients = array();
      $tags = array();
    }

    $old_recipe = modelRecipes::getRecipe($_GET["id"]);

    if ($_POST['title'] != $old_recipe['rec_title']) {
      if (modelRecipes::updateRecipeField($_GET["id"], "rec_title", $_POST['title'], true) == false) {
        controllerErreur::erreur("Erreur lors de la modification de la recette (titre).<br>" .
          "<button class=\"btn btn-primary\" onclick=\"history.back()\">Retour au formulaire</button>");
        return;
      }
    }
    if ($_POST["summary"] != $old_recipe["rec_summary"]) {
      if (modelRecipes::updateRecipeField($_GET["id"], "rec_summary", $_POST['summary'], true) == false) {
        controllerErreur::erreur("Erreur lors de la modification de la recette (description).<br>" .
          "<button class=\"btn btn-primary\" onclick=\"history.back()\">Retour au formulaire</button>");
        return;
      }
    }
    if ($_POST["content"] != $old_recipe["rec_content"]) {
      if (modelRecipes::updateRecipeField($_GET["id"], "rec_content", $_POST['content'], true) == false) {
        controllerErreur::erreur("Erreur lors de la modification de la recette (instructions).<br>" .
          "<button class=\"btn btn-primary\" onclick=\"history.back()\">Retour au formulaire</button>");
        return;
      }
    }
    if ($_POST["category"] != $old_recipe["cat_id"]) {
      if (modelRecipes::updateRecipeField($_GET["id"], "cat_id", $_POST['category'], false) == false) {
        controllerErreur::erreur("Erreur lors de la modification de la recette (catégorie).<br>" .
          "<button class=\"btn btn-primary\" onclick=\"history.back()\">Retour au formulaire</button>");
        return;
      }
    }
    if ($_POST["nbPerson"] != $old_recipe["rec_nb_person"]) {
      if (modelRecipes::updateRecipeField($_GET["id"], "rec_nb_person", $_POST['nbPerson'], false) == false) {
        controllerErreur::erreur("Erreur lors de la modification de la recette (nombre de personnes).<br>" .
          "<button class=\"btn btn-primary\" onclick=\"history.back()\">Retour au formulaire</button>");
        return;
      }
    }

    modelRecipes::deleteRecipeIngredients($_GET["id"]);

    foreach ($ingredients as $ingredient) {
      if (!preg_match($regex, $ingredient['title']) || !preg_match($regex, $ingredient['quantity'])) {
        controllerErreur::erreur("Le texte entré n'est pas valide (nom d'un ingrédient : " . preg_match($regex, $ingredient['title']) . " : " . preg_match($regex, $ingredient['quantity']) . "<br>" .
          "<button class=\"btn btn-primary\" onclick=\"history.back()\">Retour au formulaire</button>");
        return;
      }

      $ing_id = modelRecipes::getIngredientByTitle($ingredient['title']);
      if ($ing_id == false) {
        $ing_id = modelRecipes::createIngredient($ingredient['title']);
      } else {
        $ing_id = $ing_id['ing_id'];
      }

      $quantity = preg_replace('/[a-zA-Z]+/', '', $ingredient['quantity']);
      $unit = preg_replace('/[0-9]+/', '', $ingredient['quantity']);
      $quantity = trim($quantity);
      if ($quantity == "")
        $quantity = 1;
      $unit = trim($unit);
      if ($unit == "")
        $unit = "unité";

      if (modelRecipes::createRecipeIngredient($_GET["id"], $ing_id, $quantity, $unit) == false) {
        controllerErreur::erreur("Erreur lors de la création de la recette (ingrédient).<br>" .
          "<button class=\"btn btn-primary\" onclick=\"history.back()\">Retour au formulaire</button>");
        return;
      }
    }

    modelRecipes::deleteRecipeTags($_GET["id"]);

    foreach ($tags as $tag) {
      if (!preg_match($regex, $tag['title'])) {
        controllerErreur::erreur("Le texte entré n'est pas valide (nom d'un tag).<br>" .
          "<button class=\"btn btn-primary\" onclick=\"history.back()\">Retour au formulaire</button>");
        return;
      }

      $tag_id = modelRecipes::getTagByTitle($tag['title']);
      if ($tag_id == false) {
        $tag_id = modelRecipes::createTag($tag['title']);
      } else {
        $tag_id = $tag_id['tag_id'];
      }

      if (modelRecipes::createRecipeTag($_GET["id"], $tag_id) == false) {
        controllerErreur::erreur("Erreur lors de la création de la recette (tag).<br>" .
          "<button class=\"btn btn-primary\" onclick=\"history.back()\">Retour au formulaire</button>");
        return;
      }
    }

    // File update
    $target_dir = "resources/img/recipes_images/";
    $target_file = $target_dir . "rec_" . $_GET['id'] . "." . strtolower(pathinfo(basename($_FILES["image"]["name"]), PATHINFO_EXTENSION));
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $fileOk = true;
    if (
      !in_array(
        $imageFileType,
        array(
          "jpg",
          "png",
          "jpeg"
        )
      )
    ) {
      $fileOk = false;
    }
    if ($_FILES["image"]["size"] > 1000000) {
      $fileOk = false;
    }

    if ($fileOk) {
      if (file_exists($target_file)) {
        unlink($target_file);
      }
      if (!move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        controllerErreur::erreur("Erreur lors de l'upload du fichier.<br>" .
          "<button class=\"btn btn-primary\" onclick=\"history.back()\">Retour au formulaire</button>");
        return;
      }
      if (modelRecipes::updateRecipeImgPath($_GET['id'], "rec_" . $_GET['id'] . "." . strtolower(pathinfo(basename($_FILES["image"]["name"]), PATHINFO_EXTENSION))) == false) {
        controllerErreur::erreur("Erreur lors de la modification de la recette (image).<br>" .
          "<button class=\"btn btn-primary\" onclick=\"history.back()\">Retour au formulaire</button>");
        return;
      }
    }

    if (!modelRecipes::updateRecipeField($_GET['id'], "rec_modification_date", "CURRENT_TIMESTAMP", false)) {
      controllerErreur::erreur("Erreur lors de la modification de la recette (date de modification).<br>" .
        "<button class=\"btn btn-primary\" onclick=\"history.back()\">Retour au formulaire</button>");
      return;
    }

    if ($_SESSION['login']->users_type != 1) {
      if (!modelRecipes::setIsAuthorised($_GET['id'], 0)) {
        controllerErreur::erreur("Erreur lors de la modification de la recette (autorisation).<br>" .
          "<button class=\"btn btn-primary\" onclick=\"history.back()\">Retour au formulaire</button>");
        return;
      }
    }

    header('Location: index.php?controller=recipes&action=read&id=' . $_GET["id"]);
  }

  public static function deleteForm()
  {
    $pageTitle = "Supprimer une recette";
    if ($_SESSION['login'] === false) {
      controllerErreur::erreur("Vous devez être connecté pour supprimer une recette");
      return;
    }
    $recipe = modelRecipes::getRecipe($_GET["id"]);
    if ($recipe == false) {
      controllerErreur::erreur("Cette recette n'existe pas");
      return;
    }
    if ($_SESSION['login']->users_id != $recipe['users_id'] && $_SESSION['login']->users_type != 1) {
      controllerErreur::erreur("Seul le propriétaire de cette recette peut la supprimer");
      return;
    }

    require(File::build_path(array("view", "navbar.php")));
    require(File::build_path(array("view", "deleteRecipe.php")));
    require(File::build_path(array("view", "footer.php")));
  }

  public static function delete()
  {
    if ($_SESSION['login'] === false) {
      controllerErreur::erreur("Vous devez être connecté pour supprimer une recette");
      return;
    }
    $recipe = modelRecipes::getRecipe($_GET["id"]);
    if ($recipe == false) {
      controllerErreur::erreur("Cette recette n'existe pas");
      return;
    }
    if ($_SESSION['login']->users_id != $recipe['users_id'] && $_SESSION['login']->users_type != 1) {
      controllerErreur::erreur("Seul le propriétaire de cette recette peut la supprimer");
      return;
    }
    if (!isset($_GET["id"])) {
      controllerErreur::erreur("Problème dans la suppression de la recette");
      return;
    }

    if (modelRecipes::deleteRecipeTags($_GET["id"]) == false) {
      controllerErreur::erreur("Erreur lors de la suppression des tags de la recette.<br>" .
        "<button class=\"btn btn-primary\" onclick=\"history.back()\">Retour à la recette</button>");
      return;
    }

    if (modelRecipes::deleteRecipeIngredients($_GET["id"]) == false) {
      controllerErreur::erreur("Erreur lors de la suppression des ingrédients de la recette.<br>" .
        "<button class=\"btn btn-primary\" onclick=\"history.back()\">Retour à la recette</button>");
      return;
    }

    if (modelRecipes::deleteRecipeComments($_GET["id"]) == false) {
      controllerErreur::erreur("Erreur lors de la suppression des commentaires de la recette.<br>" .
        "<button class=\"btn btn-primary\" onclick=\"history.back()\">Retour à la recette</button>");
      return;
    }

    if (modelRecipes::deleteRecipeLikes($_GET["id"]) == false) {
      controllerErreur::erreur("Erreur lors de la suppression des likes de la recette.<br>" .
        "<button class=\"btn btn-primary\" onclick=\"history.back()\">Retour à la recette</button>");
      return;
    }

    if (modelRecipes::deleteRecipe($_GET["id"]) == false) {
      controllerErreur::erreur("Erreur lors de la suppression de la recette.<br>" .
        "<button class=\"btn btn-primary\" onclick=\"history.back()\">Retour à la recette</button>");
      return;
    }

    $target_dir = "resources/img/recipes_images/";
    $target_file = $target_dir . $recipe['rec_image_src'];
    if (file_exists($target_file) && $recipe['rec_image_src'] != "placeholder.jpg") {
      unlink($target_file);
    }

    header('Location: index.php?controller=recipes&action=readAll');
  }

  public static function like()
  {
    if ($_SESSION['login'] === false) {
      controllerErreur::erreur("Vous devez être connecté pour liker une recette");
      return;
    }
    if (!isset($_GET["id"])) {
      controllerErreur::erreur("Problème dans le like de la recette");
      return;
    }

    $isRecipeLiked = modelRecipes::isRecipeLiked($_SESSION['login']->users_id, $_GET["id"]);
    if ($isRecipeLiked == true) {
      modelRecipes::removeLike($_SESSION['login']->users_id, $_GET["id"]);
      $isLiked = false;
    } else {
      modelRecipes::addLike($_SESSION['login']->users_id, $_GET["id"]);
      $isLiked = true;
    }
    header('Location: index.php?controller=recipes&action=read&id=' . $_GET["id"]);
  }
}