<?php
require_once(File::build_path(array("model", "modelRecipes.php")));
require_once(File::build_path(array("lib", "session.php")));

class controllerRecipes{
  public static function readAll(){
    $pageTitle = "Toutes les recettes";
    $recipes = modelRecipes::getRecipe();
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
}