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
    $sql = "SELECT * FROM recipes WHERE cat_id = $categoriesID";
    $req_prep = $model::$pdo->prepare($sql);
    $req_prep->execute();
    $req_prep->setFetchMode(PDO::FETCH_CLASS, 'model');
    return $req_prep->fetchAll();
  }

  public static function getRecipesByTitle($words) {
    $model = new model();
    $model->init();
    $sql = "SELECT * FROM recipes WHERE upper(rec_title) LIKE ";
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

  public static function getRecipesByIngredients($tab_ing_id) {
    $model = new model();
    $model->init();
    $sql = "SELECT * FROM recipes WHERE rec_id IN (SELECT rec_id FROM rec_ing WHERE ing_id IN (";
    foreach ($tab_ing_id as $key => $value) {
      $sql .= $value;
      if ($key != count($tab_ing_id) - 1) {
        $sql .= ", ";
      }
    }
    $sql .= "))";
    var_dump($sql);
    $req_prep = $model::$pdo->prepare($sql);
    $req_prep->execute();
    $req_prep->setFetchMode(PDO::FETCH_CLASS, 'model');
    return $req_prep->fetchAll();
  }
}