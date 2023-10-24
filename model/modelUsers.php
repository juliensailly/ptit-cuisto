<?php

class modelIngredients extends model {

  public function __construct($id){
    $this->table = "users";
    $this->id = $id;
    $this->init(); //Connexion à la base
  }

  //Requêtes CUD

  public function create($email, $password, $lastname, $name, $date){
    $sql = "INSERT INTO " . $this->table . " (users_id, users_email, users_password, users_lastname, users_name, users_inscription_date, users_type, users_status) 
    VALUES (:id, :email, :password, :lastname, :name, :date, :type, :status)";
    $req_prep = $this->pdo->prepare($sql);
    $req_prep->bindParam(':id', NULL, PDO::PARAM_INT);
    $req_prep->bindParam(':email', $email, PDO::PARAM_STR);
    $req_prep->bindParam(':password', $password, PDO::PARAM_STR);
    $req_prep->bindParam(':lastname', $lastname, PDO::PARAM_STR);
    $req_prep->bindParam(':name', $name, PDO::PARAM_STR);
    $req_prep->bindParam(':date', $date, PDO::PARAM_STR);
    $req_prep->bindParam(':type', 0, PDO::PARAM_INT);
    $req_prep->bindParam(':status', 0, PDO::PARAM_INT);
    return $req_prep->execute();
  }

  public function updateLastname($newLName) {
    $sql = "UPDATE " . $this->table . " SET users_lastname = :new WHERE users_id = :id";
    $req_prep = $this->pdo->prepare($sql);
    $req_prep->bindParam(':id', $this->id, PDO::PARAM_INT);
    $req_prep->bindParam(':new', $newLName, PDO::PARAM_STR);
    $req_prep->execute();
    return $req_prep->rowCount() > 0;
  }

  public function updateName($newName) {
    $sql = "UPDATE " . $this->table . " SET users_name = :new WHERE users_id = :id";
    $req_prep = $this->pdo->prepare($sql);
    $req_prep->bindParam(':id', $this->id, PDO::PARAM_INT);
    $req_prep->bindParam(':new', $newName, PDO::PARAM_STR);
    $req_prep->execute();
    return $req_prep->rowCount() > 0;
  }

  public function updateEmail($newEmail){
    $sql = "UPDATE " . $this->table . " SET users_email = :new WHERE users_id = :id";
    $req_prep = $this->pdo->prepare($sql);
    $req_prep->bindParam(':id', $this->id, PDO::PARAM_INT);
    $req_prep->bindParam(':new', $newEmail, PDO::PARAM_STR);
    $req_prep->execute();
    return $req_prep->rowCount() > 0;
  }

  public function updatePassword($newPassword){
    $sql = "UPDATE " . $this->table . " SET users_password = :new WHERE users_id = :id";
    $req_prep = $this->pdo->prepare($sql);
    $req_prep->bindParam(':id', $this->id, PDO::PARAM_INT);
    $req_prep->bindParam(':new', $newPassword, PDO::PARAM_STR);
    $req_prep->execute();
    return $req_prep->rowCount() > 0;
  }

  public function delete(){
    $sql = "DELETE FROM " . $this->table . " WHERE users_id = :id";
    $req_prep = $this->pdo->prepare($sql);
    $req_prep->bindParam(':id', $this->id, PDO::PARAM_INT);
    $req_prep->execute();
    return $query->execute();
  }
}