<?php
require_once(File::build_path(array("model", "model.php")));

class modelAccount
{
  public static function getUser($users_id)
  {
    $model = new model();
    $model->init();
    $sql = "SELECT users_id, users_pseudo, users_email, users_lastname, users_name, users_inscription_date, users_type, users_status from users
    where users_id = :users_id";
    $req_prep = $model::$pdo->prepare($sql);
    $req_prep->bindParam(':users_id', $users_id);
    $req_prep->execute();
    $req_prep->setFetchMode(PDO::FETCH_CLASS, 'model');
    return $req_prep->fetch();
  }

  public static function getUsersRecipes($users_id)
  {
    $model = new model();
    $model->init();
    $sql = "SELECT rec_id, rec_title, cat_id, cat_title, rec_summary, rec_image_src, rec_creation_date, rec_modification_date from recipes
        join category using(cat_id)
        join users using(users_id)
        where users_id = :users_id and isAuthorised = 1";
    $req_prep = $model::$pdo->prepare($sql);
    $req_prep->bindParam(':users_id', $users_id);
    $req_prep->execute();
    $req_prep->setFetchMode(PDO::FETCH_CLASS, 'model');
    return $req_prep->fetchAll();
  }

  public static function getUsersLikedRecipes($userId)
  {
    $model = new model();
    $model->init();
    $sql = "SELECT rec_id, rec_title, cat_id, cat_title, rec_summary, rec_image_src, rec_creation_date, rec_modification_date from recipes
    join category using(cat_id)
    join likes using(rec_id)
    where likes.users_id = :users_id";
    $req_prep = $model::$pdo->prepare($sql);
    $req_prep->bindParam(':users_id', $userId);
    $req_prep->execute();
    $req_prep->setFetchMode(PDO::FETCH_CLASS, 'model');
    return $req_prep->fetchAll();
  }

  public static function modifyUserInfo($users_id, $users_pseudo, $users_email, $users_lastname, $users_name)
  {
    $model = new model();
    $model->init();
    $sql = "UPDATE users SET users_pseudo = :users_pseudo, users_email = :users_email, users_lastname = :users_lastname, 
    users_name = :users_name WHERE users_id = :users_id";
    $req_prep = $model::$pdo->prepare($sql);
    $values = array(
      "users_id" => $users_id,
      "users_pseudo" => $users_pseudo,
      "users_email" => $users_email,
      "users_lastname" => $users_lastname,
      "users_name" => $users_name
    );
    $req_prep->execute($values);
    return true;
  }

  public static function getUserNbReceivedLikes($userId)
  {
    $model = new model();
    $model->init();
    $sql = "SELECT COUNT(*) as NBRECEIVEDLIKES FROM likes
    JOIN recipes USING(rec_id)
    WHERE recipes.users_id = :users_id";
    $req_prep = $model::$pdo->prepare($sql);
    $req_prep->bindParam(':users_id', $userId);
    $req_prep->execute();
    $req_prep->setFetchMode(PDO::FETCH_CLASS, 'model');
    return $req_prep->fetch();
  }

  public static function modifyUserPassword($users_id, $users_password)
  {
    $model = new model();
    $model->init();
    $sql = "UPDATE users SET users_password = :users_password WHERE users_id = :users_id";
    $req_prep = $model::$pdo->prepare($sql);
    $values = array(
      "users_id" => $users_id,
      "users_password" => password_hash($users_password, PASSWORD_DEFAULT)
    );
    $req_prep->execute($values);
    return true;
  }

  public static function deleteLikes($users_id)
  {
    $model = new model();
    $model->init();
    $sql = "DELETE FROM likes WHERE users_id = :users_id";
    $req_prep = $model::$pdo->prepare($sql);
    $req_prep->bindParam(':users_id', $users_id);
    return $req_prep->execute();
  }

  public static function deleteComments($users_id)
  {
    $model = new model();
    $model->init();
    $sql = "DELETE FROM comments WHERE users_id = :users_id";
    $req_prep = $model::$pdo->prepare($sql);
    $req_prep->bindParam(':users_id', $users_id);
    $req_prep->execute();
    return $req_prep->execute();
  }

  public static function deleteEdito($users_id)
  {
    $model = new model();
    $model->init();
    $sql = "DELETE FROM edito WHERE users_id = :users_id";
    $req_prep = $model::$pdo->prepare($sql);
    $req_prep->bindParam(':users_id', $users_id);
    return $req_prep->execute();
  }

  public static function updateRecipesToDeletedUser($users_id)
  {
    $model = new model();
    $model->init();
    $sql = "UPDATE recipes SET users_id = 0 WHERE users_id = :users_id";
    $req_prep = $model::$pdo->prepare($sql);
    $req_prep->bindParam(':users_id', $users_id);
    return $req_prep->execute();
  }

  public static function deleteUser($users_id)
  {
    $model = new model();
    $model->init();
    $sql = "DELETE FROM users WHERE users_id = :users_id";
    $req_prep = $model::$pdo->prepare($sql);
    $req_prep->bindParam(':users_id', $users_id);
    return $req_prep->execute();
  }
}