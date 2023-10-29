<?php
require_once(File::build_path(array("model", "modelAPI.php")));
require_once(File::build_path(array("lib", "session.php")));

class controllerAPI{

    public static function filtre() {
        if (!isset($_GET["cat_id"])) return;
        $cat_id = $_GET["cat_id"];
        $data = modelAPI::getRecipesByCategories($cat_id);
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
    }
}