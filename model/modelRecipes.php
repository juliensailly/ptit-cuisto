<?php
require_once(File::build_path(array("model", "model.php")));

class modelRecipes extends model
{

  public function __construct($id)
  {
    $this->table = "recipes";
    $this->id = $id;
    $this->init(); //Connexion à la base
  }

  //Requêtes CUD

  public function create($title, $content, $summary, $catId, $dateC, $image, $dateM, $userId, $nbPerson)
  {
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

  public function updateRecipe($newRecipe)
  {
    $sql = "UPDATE " . $this->table . " SET rec_title = :new WHERE rec_id = :id";
    $req_prep = $this->pdo->prepare($sql);
    $req_prep->bindParam(':id', $this->id, PDO::PARAM_INT);
    $req_prep->bindParam(':new', $newRecipe, PDO::PARAM_STR);
    $req_prep->execute();
    return $req_prep->rowCount() > 0;
  }

  public function delete()
  {
    $sql = "DELETE FROM " . $this->table . " WHERE rec_id = :id";
    $req_prep = $this->pdo->prepare($sql);
    $req_prep->bindParam(':id', $this->id, PDO::PARAM_INT);
    return $req_prep->execute();
  }

  public static function getRecipe($rec_id = NULL)
  {
    $model = new Model();
    $model->init();

    if ($rec_id == NULL) {
      $page = 1;
      if (isset($_GET['page'])) {
        if ($_GET['page'] > 0) {
          $page = $_GET['page'];
        }
      }
      $sql = "SELECT rec_id, rec_title, cat_id, cat_title, rec_summary, rec_image_src, isAuthorised FROM recipes
      join category using (cat_id)
      where isAuthorised = 1
      order by rec_modification_date desc, rec_creation_date desc LIMIT " . (($page - 1) * 10) . "," . 10;
      $req_prep = model::$pdo->prepare($sql);
      $req_prep->execute();
      return $req_prep->fetchAll();
    } else {
      $sql = "SELECT rec_id, rec_title, cat_id, cat_title, rec_image_src, users_id, users_pseudo, rec_creation_date, rec_modification_date, rec_nb_person, rec_content, isAuthorised FROM recipes
      join category using (cat_id)
      join users using (users_id)
      WHERE rec_id = $rec_id";
      $req_prep = model::$pdo->prepare($sql);
      $req_prep->execute();
      return $req_prep->fetch();
    }
  }

  public static function getAllTags() {
    $model = new Model();
    $model->init();
    $sql = "select tag_id, tag_title, rec_id from tag join tags_list using (tag_id);";
    $req_prep = model::$pdo->prepare($sql);
    $req_prep->execute();
    return $req_prep->fetchAll();
  }

  public static function getRecipeLikes($rec_id)
  {
    $model = new Model();
    $model->init();
    $sql = "SELECT COUNT(*) as NBLIKES FROM likes WHERE rec_id = :id";
    $req_prep = model::$pdo->prepare($sql);
    $req_prep->bindParam(':id', $rec_id, PDO::PARAM_INT);
    $req_prep->execute();
    return $req_prep->fetch();
  }

  public static function getRecipeComments($rec_id)
  {
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

  public static function getRecipeTags($rec_id)
  {
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

  public static function getRecipeIngredients($rec_id)
  {
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

  public static function getCategoryByID($cat_id) {
    $model = new Model();
    $model->init();
    $sql = "SELECT cat_title FROM category WHERE cat_id = :id";
    $req_prep = model::$pdo->prepare($sql);
    $req_prep->bindParam(':id', $cat_id, PDO::PARAM_INT);
    $req_prep->execute();
    return $req_prep->fetch();
  }

  public static function getIngredientByTitle($title) {
    $model = new Model();
    $model->init();
    $sql = "SELECT ing_id FROM ingredient WHERE upper(ing_title) = upper(:title)";
    $req_prep = model::$pdo->prepare($sql);
    $req_prep->bindParam(':title', $title, PDO::PARAM_STR);
    $req_prep->execute();
    return $req_prep->fetch();
  }

  public static function createIngredient($title) {
    $model = new Model();
    $model->init();
    $sql = "INSERT INTO ingredient (ing_title) VALUES (:title)";
    $req_prep = model::$pdo->prepare($sql);
    $req_prep->bindParam(':title', $title, PDO::PARAM_STR);
    $req_prep->execute();
    if ($req_prep->rowCount() > 0) {
      return model::$pdo->lastInsertId();
    } else {
      return false;
    }
  }

  public static function createRecipe($rec_title, $rec_content, $rec_summary, $cat_id, $users_id, $rec_nb_person, $rec_image_src = "placeholder.jpg") {
    $model = new Model();
    $model->init();
    $sql = "INSERT INTO recipes (rec_title, rec_content, rec_summary, cat_id, rec_creation_date, rec_modification_date, users_id, rec_nb_person, rec_image_src) VALUES (:title, :content, :summary, :cat_id, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, :users_id, :rec_nb_person, :rec_image_src)";
    $req_prep = model::$pdo->prepare($sql);
    $req_prep->bindParam(':title', $rec_title, PDO::PARAM_STR);
    $req_prep->bindParam(':content', $rec_content, PDO::PARAM_STR);
    $req_prep->bindParam(':summary', $rec_summary, PDO::PARAM_STR);
    $req_prep->bindParam(':cat_id', $cat_id, PDO::PARAM_INT);
    $req_prep->bindParam(':users_id', $users_id, PDO::PARAM_INT);
    $req_prep->bindParam(':rec_nb_person', $rec_nb_person, PDO::PARAM_INT);
    $req_prep->bindParam(':rec_image_src', $rec_image_src, PDO::PARAM_STR);
    $req_prep->execute();
    if ($req_prep->rowCount() > 0) {
      return model::$pdo->lastInsertId();
    } else {
      return false;
    }
  }

  public static function createRecipeIngredient($rec_id, $ing_id, $ing_quantity, $ing_unit) {
    $model = new Model();
    $model->init();
    $sql = "INSERT INTO ingredients_list (rec_id, ing_id, ing_quantity, ing_unit) VALUES (:rec_id, :ing_id, :ing_quantity, :ing_unit)";
    $req_prep = model::$pdo->prepare($sql);
    $req_prep->bindParam(':rec_id', $rec_id, PDO::PARAM_INT);
    $req_prep->bindParam(':ing_id', $ing_id, PDO::PARAM_INT);
    $req_prep->bindParam(':ing_quantity', $ing_quantity, PDO::PARAM_INT);
    $req_prep->bindParam(':ing_unit', $ing_unit, PDO::PARAM_STR);
    return $req_prep->execute();
  }

  public static function getTagByTitle($title) {
    $model = new Model();
    $model->init();
    $sql = "SELECT tag_id FROM tag WHERE upper(tag_title) = upper(:title)";
    $req_prep = model::$pdo->prepare($sql);
    $req_prep->bindParam(':title', $title, PDO::PARAM_STR);
    $req_prep->execute();
    return $req_prep->fetch();
  }

  public static function createTag($title) {
    $model = new Model();
    $model->init();
    $sql = "INSERT INTO tag (tag_title) VALUES (:title)";
    $req_prep = model::$pdo->prepare($sql);
    $req_prep->bindParam(':title', $title, PDO::PARAM_STR);
    $req_prep->execute();
    if ($req_prep->rowCount() > 0) {
      return model::$pdo->lastInsertId();
    } else {
      return false;
    }
  }

  public static function createRecipeTag($rec_id, $tag_id) {
    $model = new Model();
    $model->init();
    $sql = "INSERT INTO tags_list (rec_id, tag_id) VALUES (:rec_id, :tag_id)";
    $req_prep = model::$pdo->prepare($sql);
    $req_prep->bindParam(':rec_id', $rec_id, PDO::PARAM_INT);
    $req_prep->bindParam(':tag_id', $tag_id, PDO::PARAM_INT);
    return $req_prep->execute();
  }

  public static function updateRecipeImgPath($rec_id, $img_path = "") {
    $model = new Model();
    $model->init();
    $sql = "UPDATE recipes SET rec_image_src = :img_path WHERE rec_id = :id";
    $req_prep = model::$pdo->prepare($sql);
    $req_prep->bindParam(':img_path', $img_path, PDO::PARAM_STR);
    $req_prep->bindParam(':id', $rec_id, PDO::PARAM_INT);
    return $req_prep->execute();
  }
}

