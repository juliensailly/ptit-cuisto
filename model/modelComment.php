<?php
require_once(File::build_path(array("model", "model.php")));

class modelTypes{
  /** ATTRIBUTS **/
  private $nomType;
  /*private $something;*/

  /** CONSTRUCTEUR **/
  public function __construct($nom = NULL/*, $something = NULL*/){
    if(!is_null($nom)/* && !is_null($something)*/){
      $this->nomType = $nom;
      /*$this->something = $something;*/
    }
  }

  /** GETTERS **/
  public function getNomType(){
    return $this->nomType;
  }

  /*public function getSomething(){
  return $this->something;
  }*/

  /** SETTERS **/
  public function setNomType($nom){
    $this->nomType = $nom;
  }



  public function create($recid, $userid, $title, $content){
    $model = new model();
    $model->init();
    $sql = "INSERT INTO comments(rec_id, users_id,com_date,com_title,com_content,isAuthorised) VALUES (
        :rec, :user, :date, :com_title, :com_content, :isAuthorised)";
    $req_prep = $model::$pdo->prepare($sql);
    $req_prep->bindParam(":rec", $recid, PDO::PARAM_INT);
    $req_prep->bindParam(":user", $userid, PDO::PARAM_INT);
    $req_prep->bindParam(":date", $recid, PDO::PARAM_STR);
    $req_prep->bindParam(":com_title", $title, PDO::PARAM_STR);
    $req_prep->bindParam(":com_content", $content, PDO::PARAM_STR);
    $req_prep->bindParam(":isAuthorised", 1, PDO::PARAM_INT);
    return $req_prep->execute();  
  }
}
?>