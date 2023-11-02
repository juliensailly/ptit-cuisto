<?php
require_once(File::build_path(array("model", "modelRecipes.php")));
require_once(File::build_path(array("model", "modelFiltres.php")));
require_once(File::build_path(array("lib", "session.php")));

class controllerRecipes{
  public static function readAll(){
    $pageTitle = "Toutes les recettes";
    $recipes = modelRecipes::getRecipe();
    $tags = modelRecipes::getAllTags();
    $page = 1;
    if (isset($_GET['page'])) {
      if ($_GET['page'] > 0) {
        $page = $_GET['page'];
      }
    }
    require (File::build_path(array("view", "navbar.php")));
    require	(File::build_path(array("view", "viewAllRecipe.php")));
    require (File::build_path(array("view", "footer.php")));
  }

  public static function read(){
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
    require (File::build_path(array("view", "navbar.php")));
    require	(File::build_path(array("view", "viewRecipe.php")));
    require (File::build_path(array("view", "footer.php")));
  }

  public static function createForm() {
    $pageTitle = "Créer une recette";
    if ($_SESSION['login'] === false) {
      controllerErreur::erreur("Vous devez être connecté pour créer une recette");
      return;
    }

    $tags = modelRecipes::getAllTags();
    $categories = modelFiltres::getCategories();
    
    require (File::build_path(array("view", "navbar.php")));
    require	(File::build_path(array("view", "addRecipe.php")));
    require (File::build_path(array("view", "footer.php")));
  }

  public static function create() {
    if ($_SESSION['login'] === false) {
      controllerErreur::erreur("Vous devez être connecté pour créer une recette");
      return;
    }
    if (!isset($_POST['title']) || !isset($_POST['content']) || !isset($_POST['summary']) || !isset($_POST['catId']) || !isset($_POST['nbPerson'])) {
      controllerErreur::erreur("Erreur lors de la création de la recette");
      return;
    }
    
  }
}