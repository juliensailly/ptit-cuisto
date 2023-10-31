<?php
require_once(File::build_path(array("model", "model.php")));

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

  public static function getRecipe($rec_id = NULL) {
    $model = new Model();
    $model->init();

    if ($rec_id == NULL) {
      $sql = "SELECT rec_id, rec_title, rec_summary, rec_image_src FROM recipes";
      $req_prep = model::$pdo->prepare($sql);
      $req_prep->execute();
      return $req_prep->fetchAll();
    } else {
      $sql = "SELECT rec_title, cat_id, cat_title, rec_image_src, users_id, users_pseudo, rec_creation_date, rec_modification_date, rec_nb_person, rec_content FROM recipes
      join category using (cat_id)
      join users using (users_id)
      WHERE rec_id = $rec_id";
      $req_prep = model::$pdo->prepare($sql);
      $req_prep->execute();
      return $req_prep->fetch();
    }
  }

  public static function getRecipeLikes($rec_id) {
    $model = new Model();
    $model->init();
    $sql = "SELECT COUNT(*) as NBLIKES FROM likes WHERE rec_id = :id";
    $req_prep = model::$pdo->prepare($sql);
    $req_prep->bindParam(':id', $rec_id, PDO::PARAM_INT);
    $req_prep->execute();
    return $req_prep->fetch();
  }

  public static function getRecipeComments($rec_id) {
    $model = new Model();
    $model->init();
    $sql = "SELECT users_id, users_pseudo, com_date, com_content FROM comments
    JOIN users using (users_id)
    WHERE rec_id = :id
    order by com_date desc";
    $req_prep = model::$pdo->prepare($sql);
    $req_prep->bindParam(':id', $rec_id, PDO::PARAM_INT);
    $req_prep->execute();
    return $req_prep->fetchAll();
  }

  public static function getRecipeTags($rec_id) {
    $model = new Model();
    $model->init();
    $sql = "SELECT tag_title from tag
    join tags_list using (tag_id)
    where rec_id = :id";
    $req_prep = model::$pdo->prepare($sql);
    $req_prep->bindParam(':id', $rec_id, PDO::PARAM_INT);
    $req_prep->execute();
    return $req_prep->fetchAll();
  }

  public static function getRecipeIngredients($rec_id) {
    $model = new Model();
    $model->init();
    $sql = "select ing_title, ing_quantity, ing_unit from ingredient
    join ingredients_list using (ing_id)
    where rec_id = :id";
    $req_prep = model::$pdo->prepare($sql);
    $req_prep->bindParam(':id', $rec_id, PDO::PARAM_INT);
    $req_prep->execute();
    return $req_prep->fetchAll();
  }
}

