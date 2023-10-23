<?php

class modelIngredients extends model {

  public function __construct(){
    $this->table = "ingredient";
    $this->init(); //Connexion à la base
  }

  //Requêtes CUD

  public function create($nomIngredient, $desc){
    $sql = "INSERT INTO " . $this->table . " (ing_id, ing_title, ing_desc) VALUES (:id, :nom, :desc)";
    $req_prep = model::$pdo->prepare($sql);
    $req_prep->bindParam(':id', NULL, PDO::PARAM_NULL);
    $req_prep->bindParam(':nom', $nomIngredient, PDO::PARAM_STR);
    $req_prep->bindParam(':desc', $desc, PDO::PARAM_STR);
    $req_prep->execute();
  }

  public function updateIngredient($oldIngredient, $newIngredient) {
    $sql = "UPDATE " . $this->table . " SET nomType = :new WHERE nomType = :old";
    $req_prep = model::$pdo->prepare($sql);
    $req_prep->bindParam(':old', $oldIngredient, PDO::PARAM_STR);
    $req_prep->bindParam(':new', $newIngredient, PDO::PARAM_STR);
    $req_prep->execute();
  }

  public function updateDesc($ingredient, $newDesc) {
    $sql = "UPDATE " . $this->table . " SET ing_desc = :new WHERE ing_title = :ing";
    $req_prep = model::$pdo->prepare($sql);
    $req_prep->bindParam(':ing', $ingredient, PDO::PARAM_STR);
    $req_prep->bindParam(':new', $newDesc, PDO::PARAM_STR);
    $req_prep->execute();
  }

  public function delete($nomIngredient){
    $sql = "DELETE FROM " . $this->table . " WHERE ing_title = :nom";
    $req_prep = model::$pdo->prepare($sql);
    $req_prep->bindParam(':nom', $nomIngredient, PDO::PARAM_STR);
    $req_prep->execute();
  }
}