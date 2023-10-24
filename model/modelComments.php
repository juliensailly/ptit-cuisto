<?php

class modelComments extends model {

  public function __construct($id){
    $this->id = $id;
    $this->table = "comments";
    $this->init(); //Connexion à la base
  }

  //Requêtes CUD

  public function create($nomCategory, $desc){
    $sql = "INSERT INTO " . $this->table . " (com_id, com_date, com_title, com_content) VALUES (:id, :date, :nom, :desc)";
    $req_prep = $this->pdo->prepare($sql);
    $req_prep->bindParam(':id', NULL, PDO::PARAM_INT);
    $req_prep->bindParam(':date', NULL, PDO::PARAM_STR);
    $req_prep->bindParam(':nom', $nomIngredient, PDO::PARAM_STR);
    $req_prep->bindParam(':desc', $desc, PDO::PARAM_STR);
    return $req_prep->execute();
  }

  //En cours (clé étrangère users_id ?)
  public function updateComment($newDesc) {
    $sql = "UPDATE " . $this->table . " SET com_content = :new WHERE users_id = :id";
    $req_prep = $this->pdo->prepare($sql);
    $req_prep->bindParam(':id', $this->id, PDO::PARAM_INT);
    $req_prep->bindParam(':new', $newDesc, PDO::PARAM_STR);
    $req_prep->execute();
    return $req_prep->rowCount() > 0;
  }

  public function delete(){
    $sql = "DELETE FROM " . $this->table . " WHERE com_id = :id";
    $req_prep = $this->pdo->prepare($sql);
    $req_prep->bindParam(':id', $this->id, PDO::PARAM_INT);
    $req_prep->execute();
    return $query->execute();
  }
}