<?php
require_once(File::build_path(array("model", "modelRecipes.php")));
require_once(File::build_path(array("model", "modelFiltres.php")));
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
    $likes = modelRecipes::getRecipeLikes($_GET["id"]);
    $tags = modelRecipes::getRecipeTags($_GET["id"]);
    $comments = modelRecipes::getRecipeComments($_GET["id"]);
    $ingredients = modelRecipes::getRecipeIngredients($_GET["id"]);
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

    $tags = modelRecipes::getAllTags();
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

    $regex = "/^([A-Za-zÀ-ÖØ-öø-ÿ0-9]+)$/";
    if (!isset($_POST['title']) || !isset($_POST['summary']) || !isset($_POST['content']) || !isset($_POST['category']) || !isset($_POST['selectedIngredients']) || !isset($_POST['selectedTags'])) {
      controllerErreur::erreur("Erreur lors de la création de la recette.<br>" .
        "Les champs obligatoires sont : titre, résumé, contenu et catégorie de la recette.<br>" .
        "Les champs facultatifs sont : image, ingrédients et tags.<br>" .
        "<button class=\"btn btn-primary\" onclick=\"history.back()\">Retour au formulaire</button>");
      return;
    }

    if (!preg_match($regex, $_POST['title']) || !preg_match($regex, $_POST['summary']) || !preg_match($regex, $_POST['content'])) {
      controllerErreur::erreur("Le texte entré n'est pas valide.<br>" .
        "<button class=\"btn btn-primary\" onclick=\"history.back()\">Retour au formulaire</button>");
      return;
    }

    $category = modelRecipes::getCategoryByID($_POST['category']);
    if (!is_numeric($_POST['category']) || $category === false) {
      controllerErreur::erreur("La catégorie entrée n'est pas valide.<br>" .
        "<button class=\"btn btn-primary\" onclick=\"history.back()\">Retour au formulaire</button>");
      return;
    }

    if (!empty($_POST['selectedIngredients']) && !empty($_POST['selectedTags'])) {
      $ingredients = json_decode($_POST['selectedIngredients'], true);
      $tags = json_decode($_POST['selectedTags'], true);
    } else {
      $ingredients = array();
      $tags = array();
    }

    $rec_id = modelRecipes::createRecipe($_POST['title'], $_POST['content'], $_POST['summary'], $_POST['category'], $_SESSION['login']->users_id, $_POST['nbPerson']);

    foreach ($ingredients as $ingredient) {
      if (!preg_match($regex, $ingredient['title']) || !preg_match($regex, $ingredient['quantity'])) {
        controllerErreur::erreur("Le texte entré n'est pas valide.<br>" .
          "<button class=\"btn btn-primary\" onclick=\"history.back()\">Retour au formulaire</button>");
        return;
      }

      $ing_id = modelRecipes::getIngredientByTitle($ingredient['title']);
      if ($ing_id == false) {
        $ing_id = modelRecipes::createIngredient($ingredient['title']);
      }

      $quantity = preg_replace('/[a-zA-Z]+/', '', $ingredient['quantity']);
      $unit = preg_replace('/[0-9]+/', '', $ingredient['quantity']);
      $quantity = trim($quantity);
      $unit = trim($unit);
      if (modelRecipes::createRecipeIngredient($rec_id, $ing_id, $quantity, $unit) == false) {
        controllerErreur::erreur("Erreur lors de la création de la recette.<br>" .
          "<button class=\"btn btn-primary\" onclick=\"history.back()\">Retour au formulaire</button>");
        return;
      }
    }

    foreach ($tags as $tag) {
      if (!preg_match($regex, $tag['title'])) {
        controllerErreur::erreur("Le texte entré n'est pas valide.<br>" .
          "<button class=\"btn btn-primary\" onclick=\"history.back()\">Retour au formulaire</button>");
        return;
      }

      $tag_id = modelRecipes::getTagByTitle($tag['title']);
      if ($tag_id == false) {
        $tag_id = modelRecipes::createTag($tag['title']);
      }

      if (modelRecipes::createRecipeTag($rec_id, $tag_id) == false) {
        controllerErreur::erreur("Erreur lors de la création de la recette.<br>" .
          "<button class=\"btn btn-primary\" onclick=\"history.back()\">Retour au formulaire</button>");
        return;
      }
    }
  }
}