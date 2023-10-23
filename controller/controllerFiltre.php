<?php

require_once(File::build_path(array("model", "model.php")));
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
    
    $sql = "select * from category";
    $rep = model::$pdo->query($sql);
    $rep->setFetchMode(PDO::FETCH_CLASS, 'controllerFiltre');
    $rep = $rep->fetchAll();
    
    require(File::build_path(array("view", "filtres/categories.php")));

    require(File::build_path(array("view", "footer.php")));
  }
}