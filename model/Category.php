<?php

class Category extends model {

  public function __construct($id){
    $this->table = "category";
    $this->id = $id;
    $this->init(); //Connexion à la base
  }

  //Requêtes CUD

  public function create($nomCategory, $desc){
    $sql = "INSERT INTO " . $this->table . " (cat_id, cat_title, cat_desc) VALUES (:id, :title, :desc)";
    $req_prep = $this->pdo->prepare($sql);
    $req_prep->bindParam(':id', NULL, PDO::PARAM_INT);
    $req_prep->bindParam(':title', $nomCategory, PDO::PARAM_STR);
    $req_prep->bindParam(':desc', $desc, PDO::PARAM_STR);
    return $req_prep->execute();
  }

  public function update($newTitle) {
    $sql = "UPDATE " . $this->table . " SET cat_title = :new WHERE cat_id = :id";
    $req_prep = $this->pdo->prepare($sql);
    $req_prep->bindParam(':id', $this->id, PDO::PARAM_INT);
    $req_prep->bindParam(':new', $newTitle, PDO::PARAM_STR);
    $req_prep->execute();
    return $req_prep->rowCount() > 0;
  }

  public function delete(){
    $sql = "DELETE FROM " . $this->table . " WHERE cat_id = :id";
    $req_prep = $this->pdo->prepare($sql);
    $req_prep->bindParam(':id', $this->id, PDO::PARAM_INT);
    $req_prep->execute();
    return $query->execute();
  }
}