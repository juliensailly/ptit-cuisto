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
    $id = -1;
    if (isset($_GET["id"])) {
      $id = $_GET["id"];
    }
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
    require(File::build_path(array("view", "filtres/ingredientsSearch.php")));
    require(File::build_path(array("view", "footer.php")));
  }

  public static function tagsSearch() {
    $pageTitle = "Filtre - Recherche par tags";
    require(File::build_path(array("view", "navbar.php")));
    require(File::build_path(array("view", "filtres/tagsSearch.php")));
    require(File::build_path(array("view", "footer.php")));
  }
}