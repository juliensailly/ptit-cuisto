<?php
require_once(File::build_path(array("model", "model.php")));

class modelTags {
  /** ATTRIBUTS **/
  private $tag_title;

  /** CONSTRUCTEUR **/
  public function __construct($tag = NULL/*, $something = NULL*/){
    if(!is_null($tag)/* && !is_null($something)*/){
      $this->tag_title = $tag;
      /*$this->something = $something;*/
    }
  }

  /** GETTERS **/
  public function getTitle(){
    return $this->tag_title;
  }

  /** SETTERS **/
  public function setTag($rename){
    $this->tag_title = $rename;
  }

  /** METHODES **/
  public static function readAll(){
    $sql = "SELECT * FROM tag";
    $rep = model::$pdo->query($sql);
    $rep->setFetchMode(PDO::FETCH_CLASS, 'modelTags');
    return $rep->fetchAll();
  }

  public function readTags(){
    $sql="SELECT tag_title from tag";
    $rep = model::$pdo->query($sql);
    $rep->setFetchMode(PDO::FETCH_CLASS, 'modelTags');
    return $rep->fetchAll();

  }

  public function readTagsForOneRecipe($recipeId){
    $sql="SELECT tag_title from tags_list WHERE rec_id = :rec_id";
    $req_prep = model::$pdo->prepare($sql);
    $req_prep->bindParam(':rec_id', $recipeId, PDO::PARAM_INT);
    $req_prep->execute();
    return $req_prep->fetchAll();

  }

  public function create(){
    $sql = "INSERT INTO tag (idType, tag_title) VALUES (:id, :title)";
    $req_prep = model::$pdo->prepare($sql);
    $values = array("id" => NULL, "title" => $this->tag_title);
    $req_prep->execute($values);
  }

  public function update(){
    $sql = 'UPDATE tag SET tag_title = :newTitle';
    $req_prep = model::$pdo->prepare($sql);
    $values = array("newTitle" => $this->tag_title);
    $req_prep->execute($values);
  }

  public function delete(){
    $sql = "DELETE FROM tag WHERE tag_title = :title";
    $req_prep = model::$pdo->prepare($sql);
    $values = array("title" => $this->tag_title);
    $req_prep->execute($values);
  }
}
