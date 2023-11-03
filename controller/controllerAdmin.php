<?php
require_once(File::build_path(array("model", "modelAdmin.php")));
require_once(File::build_path(array("lib", "session.php")));

class controllerAdmin {
  public static function adminDashboard()
  {
    $pageTitle = "Tableau de bord - Administration";
    
    require(File::build_path(array("view", "navbar.php")));
    require(File::build_path(array("view", "adminDashboard.php")));
    require(File::build_path(array("view", "footer.php")));
  }
}