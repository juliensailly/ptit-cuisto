<?php

class modelTags extends model {

  public function __construct($id){
    $this->id = $id;
    $this->table = "likes";
    $this->init();
  }

  //Requêtes CUD

  public function create($userId,$recId){
    $sql = "INSERT INTO " . $this->table . " (lik_id, users_id,rec_id) VALUES (:id, :userId, :recId)";
    $req_prep = $this->pdo->prepare($sql);
    $req_prep->bindParam(':id', NULL, PDO::PARAM_NULL);
    $req_prep->bindParam(':userId', $userId, PDO::PARAM_INT);
    $req_prep->bindParam(':recId', $recId, PDO::PARAM_INT);
    return $req_prep->execute();
  }

  public function delete($userId){
    $sql = "DELETE FROM " . $this->table . " WHERE users_id = :id";
    $req_prep = $this->pdo->prepare($sql);
    $req_prep->bindParam(':id', $userId, PDO::PARAM_STR);
    return $req_prep->execute();
  }
}
