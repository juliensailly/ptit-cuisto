<?php
require_once(File::build_path(array("model", "model.php")));

class modelAPI {
  private $nomType;

  public function __construct($nom = NULL){
    if(!is_null($nom)){
      $this->nomType = $nom;
    }
  }

  public function getNomType(){
    return $this->nomType;
  }

  public function setNomType($nom){
    $this->nomType = $nom;
  }

  public static function getRecipesByCategories($categoriesID) {
    $model = new model();
    $model->init();
    $sql = "SELECT * FROM recipes WHERE cat_id = $categoriesID and isAuthorised = 1";
    $req_prep = $model::$pdo->prepare($sql);
    $req_prep->execute();
    $req_prep->setFetchMode(PDO::FETCH_CLASS, 'model');
    return $req_prep->fetchAll();
  }

  public static function getRecipesByTitle($words) {
    $model = new model();
    $model->init();
    $sql = "SELECT * FROM recipes WHERE isAuthorised = 1 and upper(rec_title) LIKE ";
    foreach ($words as $key => $value) {
      $sql .= "'%".strtoupper($value)."%' ";
      if ($key != count($words) - 1) {
        $sql .= "OR upper(rec_title) LIKE ";
      }
    }
    $sql .= "ORDER BY rec_title LIMIT 5";
    $req_prep = $model::$pdo->prepare($sql);
    $req_prep->execute();
    $req_prep->setFetchMode(PDO::FETCH_CLASS, 'model');
    return $req_prep->fetchAll();
  }

  public static function getIngredients($searchText = "") {
    $model = new model();
    $model->init();
    $sql = "SELECT * FROM ingredient where upper(ing_title) LIKE '%".strtoupper($searchText)."%' LIMIT 5";
    $req_prep = $model::$pdo->prepare($sql);
    $req_prep->execute();
    $req_prep->setFetchMode(PDO::FETCH_CLASS, 'model');
    return $req_prep->fetchAll();
  }

  public static function getRecipesByIngredients($tab_ing_id) {
    $model = new model();
    $model->init();
    $sql = "SELECT * FROM recipes WHERE isAuthorised = 1";
    if (count($tab_ing_id) > 0 && $tab_ing_id[0] != "") {
      $sql .= " and ";
      foreach ($tab_ing_id as $key => $value) {
        $sql .= "rec_id in (
          select rec_id from ingredients_list
          where ing_id = $value
          )";
        if ($key != count($tab_ing_id) - 1) {
          $sql .= " AND ";
        }
      }
    }
    $req_prep = $model::$pdo->prepare($sql);
    $req_prep->execute();
    $req_prep->setFetchMode(PDO::FETCH_CLASS, 'model');
    return $req_prep->fetchAll();
  }

  public static function getTags($searchText) {
    $model = new model();
    $model->init();
    $sql = "SELECT * FROM tag where upper(tag_title) LIKE '%".strtoupper($searchText)."%' LIMIT 5";
    $req_prep = $model::$pdo->prepare($sql);
    $req_prep->execute();
    $req_prep->setFetchMode(PDO::FETCH_CLASS, 'model');
    return $req_prep->fetchAll();
  }
}