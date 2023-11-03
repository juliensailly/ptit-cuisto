<?php
require_once(File::build_path(array("model", "model.php")));

class modelAccueil {
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

  public static function getMostLikedRecipe($nb = 5) {
    $model = new model();
    $model->init();
    $sql = "SELECT rec_id, rec_title, rec_image_src, count(*) as nblikes from recipes
    join likes using (rec_id)
    where isAuthorised = 1
    group by rec_id, rec_title, rec_image_src
    order by count(*) desc
    LIMIT :nb";
    $req_prep = $model::$pdo->prepare($sql);
    $req_prep->bindParam(':nb', $nb, PDO::PARAM_INT);
    $req_prep->execute();
    $req_prep->setFetchMode(PDO::FETCH_CLASS, 'model');
    return $req_prep->fetchAll();
  }

  public static function getMostRecentRecipe() {
    $model = new model();
    $model->init();
    $sql = "SELECT rec_id, rec_title, rec_summary, rec_image_src, rec_creation_date, rec_modification_date from recipes
    where isAuthorised = 1
    order by rec_modification_date desc, rec_creation_date desc
    LIMIT 5";
    $req_prep = $model::$pdo->prepare($sql);
    $req_prep->execute();
    $req_prep->setFetchMode(PDO::FETCH_CLASS, 'model');
    return $req_prep->fetchAll();
  }

  public static function getEdito() {
    $model = new model();
    $model->init();
    $sql = "SELECT edi_title, edi_content from edito
    order by edi_date desc
    limit 1";
    $req_prep = $model::$pdo->prepare($sql);
    $req_prep->execute();
    $req_prep->setFetchMode(PDO::FETCH_CLASS, 'model');
    return $req_prep->fetch();
  }
}