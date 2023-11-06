<?php
require_once(File::build_path(array("model", "model.php")));

class modelAccount {
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

  public static function getUser($users_id) {
    $model = new model();
    $model->init();
    $sql = "SELECT users_id, users_pseudo, users_email, users_lastname, users_name, users_inscription_date, users_type, users_status from users
    where users_id = :users_id";
    $req_prep = $model::$pdo->prepare($sql);
    $req_prep->bindParam(':users_id', $users_id);
    $req_prep->execute();
    $req_prep->setFetchMode(PDO::FETCH_CLASS, 'model');
    return $req_prep->fetch();
  }
}