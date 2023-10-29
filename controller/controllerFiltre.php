<?php

require_once(File::build_path(array("model", "modelFiltres.php")));
require_once(File::build_path(array("lib", "session.php")));

class controllerFiltre
{
  public static function readAll()
  {
    $pageTitle = "Accueil";
    require(File::build_path(array("view", "navbar.php")));
    phpinfo();
    require(File::build_path(array("view", "footer.php")));
  }

  public static function categories() {
    $pageTitle = "Filtre - Catégories";
    require(File::build_path(array("view", "navbar.php")));
    
    $rep = modelFiltres::getCategories();
    
    require(File::build_path(array("view", "filtres/categories.php")));

    require(File::build_path(array("view", "footer.php")));
  }

  public static function titleSearch() {
    $pageTitle = "Filtre - Recherche par titre";
    require(File::build_path(array("view", "navbar.php")));
    require(File::build_path(array("view", "filtres/titleSearch.php")));
    require(File::build_path(array("view", "footer.php")));
  }

  public static function ingredientsSearch() {
    $pageTitle = "Filtre - Recherche par ingrédients";
    require(File::build_path(array("view", "navbar.php")));

    $ingredients = modelFiltres::getIngredients();
    require(File::build_path(array("view", "filtres/ingredientsSearch.php")));
    require(File::build_path(array("view", "footer.php")));
  }
}