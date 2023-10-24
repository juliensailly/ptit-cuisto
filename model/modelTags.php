<?php

class modelTags extends model {

  public function __construct(){
    $this->table = "tag";
    $this->init();
  }

  //Requêtes CUD

  public function create($nomTag){
    $sql = "INSERT INTO " . $this->table . " (tag_id, tag_title) VALUES (:id, :nom)";
    $req_prep = model::$pdo->prepare($sql);
    $req_prep->bindParam(':id', NULL, PDO::PARAM_NULL);
    $req_prep->bindParam(':nom', $nomTag, PDO::PARAM_STR);
    $req_prep->execute();
  }

  public function update($oldTag, $newTag) {
    $sql = "UPDATE " . $this->table . " SET tag_title = :new WHERE tag_title = :old";
    $req_prep = model::$pdo->prepare($sql);
    $req_prep->bindParam(':old', $oldTag, PDO::PARAM_STR);
    $req_prep->bindParam(':new', $newTag, PDO::PARAM_STR);
    $req_prep->execute();
}

  public function delete($nomTag){
    $sql = "DELETE FROM " . $this->table . " WHERE tag_title = :nom";
    $req_prep = model::$pdo->prepare($sql);
    $req_prep->bindParam(':nom', $nomTag, PDO::PARAM_STR);
    $req_prep->execute();
  }
}