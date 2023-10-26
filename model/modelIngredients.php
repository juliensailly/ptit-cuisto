<?php

class modelIngredients extends model {

  public function __construct($id){
    $this->id = $id;
    $this->table = "ingredient";
    $this->init(); //Connexion à la base
  }

  //Requêtes CUD

  public function create($nomIngredient, $desc){
    $sql = "INSERT INTO " . $this->table . " (ing_id, ing_title, ing_desc) VALUES (:id, :nom, :desc)";
    $req_prep = $this->pdo->prepare($sql);
    $req_prep->bindParam(':id', NULL, PDO::PARAM_NULL);
    $req_prep->bindParam(':nom', $nomIngredient, PDO::PARAM_STR);
    $req_prep->bindParam(':desc', $desc, PDO::PARAM_STR);
    $req_prep->execute();
  }

  public function update($newTitle) {
    $sql = "UPDATE " . $this->table . " SET ing_title = :new WHERE ing_id = :id";
    $req_prep = $this->pdo->prepare($sql);
    $req_prep->bindParam(':id', $this->id, PDO::PARAM_INT);
    $req_prep->bindParam(':new', $newTitle, PDO::PARAM_STR);
    $req_prep->execute();
  }

  public function updateDesc($newDesc) {
    $sql = "UPDATE " . $this->table . " SET ing_desc = :new WHERE ing_id = :id";
    $req_prep = $this->pdo->prepare($sql);
    $req_prep->bindParam(':id', $this->id, PDO::PARAM_INT);
    $req_prep->bindParam(':new', $newDesc, PDO::PARAM_STR);
    $req_prep->execute();
  }

  public function delete($nomIngredient){
    $sql = "DELETE FROM " . $this->table . " WHERE ing_title = :nom";
    $req_prep = $this->pdo->prepare($sql);
    $req_prep->bindParam(':nom', $nomIngredient, PDO::PARAM_STR);
    $req_prep->execute();
  }
}
?>