<?php

class modelTags extends model {

  public function __construct($id){
    $this->id = $id;
    $this->table = "tag";
    $this->init();
  }

  //Requêtes CUD

  public function create($nomTag){
    $sql = "INSERT INTO " . $this->table . " (tag_id, tag_title) VALUES (:id, :nom)";
    $req_prep = model::$pdo->prepare($sql);
    $req_prep->bindParam(':id', NULL, PDO::PARAM_NULL);
    $req_prep->bindParam(':nom', $nomTag, PDO::PARAM_STR);
    return $req_prep->execute();
  }

  public function update($oldTag, $newTag) {
    $sql = "UPDATE " . $this->table . " SET tag_title = :new WHERE tag_id = :id";
    $req_prep = model::$pdo->prepare($sql);
    $req_prep->bindParam(':id', $this->id, PDO::PARAM_STR);
    $req_prep->bindParam(':new', $newTag, PDO::PARAM_STR);
    $req_prep->execute();
    return $req_prep->rowCount() > 0;
}

  public function delete($nomTag){
    $sql = "DELETE FROM " . $this->table . " WHERE tag_title = :nom";
    $req_prep = model::$pdo->prepare($sql);
    $req_prep->bindParam(':nom', $nomTag, PDO::PARAM_STR);
    return $req_prep->execute();
  }
}
