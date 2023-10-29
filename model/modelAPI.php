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
    $sql = "SELECT * FROM recipes WHERE cat_id = :idC";
    $req_prep = $model::$pdo->prepare($sql);
    $values = array("idC" => $categoriesID);
    $req_prep->execute($values);
    $req_prep->setFetchMode(PDO::FETCH_CLASS, 'model');
    return $req_prep->fetchAll();
  }
}