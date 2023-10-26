<?php

class modelRecipes extends model {

  public function __construct($id){
    $this->table = "recipes";
    $this->id = $id;
    $this->init(); //Connexion à la base
  }

  //Requêtes CUD

  public function create($title, $content, $summary, $catId, $dateC, $image, $dateM, $userId, $nbPerson){
    $sql = "INSERT INTO " . $this->table . " (rec_id, rec_title, rec_content, rec_summary, cat_id, rec_creation_date, 
    rec_image_src, rec_modification_date, users_id, rec_nb_person) 
    VALUES (:id, :title, :content, :summary, :catId, :dateC, :image, :dateM, :userId, :nbPerson)";
    $req_prep = $this->pdo->prepare($sql);
    $req_prep->bindParam(':id', NULL, PDO::PARAM_NULL);
    $req_prep->bindParam(':title', $title, PDO::PARAM_STR);
    $req_prep->bindParam(':content', $content, PDO::PARAM_STR);
    $req_prep->bindParam(':summary', $summary, PDO::PARAM_STR);
    $req_prep->bindParam(':catId', $catId, PDO::PARAM_INT);
    $req_prep->bindParam(':dateC', $dateC, PDO::PARAM_STR);
    $req_prep->bindParam(':image', $image, PDO::PARAM_STR);
    $req_prep->bindParam(':dateM', $dateM, PDO::PARAM_STR);
    $req_prep->bindParam(':userId', $userId, PDO::PARAM_INT);
    $req_prep->bindParam(':nbPerson', $nbPerson, PDO::PARAM_INT);
    return $req_prep->execute();
  }

  public function updateRecipe($newRecipe) {
    $sql = "UPDATE " . $this->table . " SET rec_title = :new WHERE rec_id = :id";
    $req_prep = $this->pdo->prepare($sql);
    $req_prep->bindParam(':id', $this->id, PDO::PARAM_INT);
    $req_prep->bindParam(':new', $newRecipe, PDO::PARAM_STR);
    $req_prep->execute();
    return $req_prep->rowCount() > 0;
  }

  public function delete(){
    $sql = "DELETE FROM " . $this->table . " WHERE rec_id = :id";
    $req_prep = $this->pdo->prepare($sql);
    $req_prep->bindParam(':id', $this->id, PDO::PARAM_INT);
    return $req_prep->execute();
  }
}