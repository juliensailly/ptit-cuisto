<?php
require_once(File::build_path(array("model", "modelAPI.php")));
require_once(File::build_path(array("lib", "session.php")));

class controllerAPI{

    public static function categoryFilter() {
        $id = "";
        if (isset($_GET["id"])) $id = $_GET["id"];
        $data = modelAPI::getRecipesByCategories($id);
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
    }

    public static function titleFilter() {
        $words = "";
        if (isset($_GET["words"]) && $_GET["words"] != "") $words = explode(" ", $_GET["words"]);
        $data = modelAPI::getRecipesByTitle($words);
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
    }

    public static function getIngredients() {
        if (!isset($_GET["searchText"])) {
            $data = modelAPI::getIngredients();
        } else {
            $data = modelAPI::getIngredients($_GET["searchText"]);
        }
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

    public static function getTags() {
        if (!isset($_GET["searchText"])) {
            $searchText = "";
        } else {
            $searchText = $_GET["searchText"];
        };
        $data = modelAPI::getTags($searchText);
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
    }
}