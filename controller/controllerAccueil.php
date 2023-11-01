<?php
require_once(File::build_path(array("model", "modelAccueil.php")));
require_once(File::build_path(array("lib", "session.php")));
class controllerAccueil
{
  public static function readAll()
  {
    $pageTitle = "Accueil";
    require(File::build_path(array("view", "navbar.php")));
    $mostLikedRecipes = modelAccueil::getMostLikedRecipe();
    $mostRecentRecipes = modelAccueil::getMostRecentRecipe();
    $edito = modelAccueil::getEdito();
    require(File::build_path(array("view/accueil", "accueil.php")));
    require(File::build_path(array("view", "footer.php")));
  }
}
