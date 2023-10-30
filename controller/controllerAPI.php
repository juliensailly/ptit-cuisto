<?php
require_once(File::build_path(array("model", "modelAPI.php")));
require_once(File::build_path(array("lib", "session.php")));

class controllerAPI{

    public static function categoryFilter() {
        if (!isset($_GET["cat_id"])) return;
        $cat_id = $_GET["cat_id"];
        $data = modelAPI::getRecipesByCategories($cat_id);
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
    }

    public static function titleFilter() {
        if (!isset($_GET["words"])) return;
        $words = explode(" ", $_GET["words"]);
        $data = modelAPI::getRecipesByTitle($words);
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
    }

    public static function getIngredients() {
        $data = modelAPI::getIngredients();
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
    }

    public static function ingredientsFilter() {
        if (!isset($_GET["tab_ing_id"])) {
            $tab_ing_id = array();
        } else {
            $tab_ing_id = explode(",", $_GET["tab_ing_id"]);
        }
        $data = modelAPI::getRecipesByIngredients($tab_ing_id);
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
    }
}