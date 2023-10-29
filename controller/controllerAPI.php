<?php
require_once(File::build_path(array("model", "modelAPI.php")));
require_once(File::build_path(array("lib", "session.php")));

class controllerAPI{

    public static function filtre() {
        if (!isset($_GET["cat_id"])) return;
        $cat_id = $_GET["cat_id"];
        $tab_t = modelAPI::getRecipesByCategories($cat_id);
        echo json_encode($tab_t);
    }
}