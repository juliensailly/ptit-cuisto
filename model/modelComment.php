<?php
require_once(File::build_path(array("model", "model.php")));

class modelComment extends model{

  public function __construct($id= null)
  {
    $this->table = "comments";
    $this->id = $id;
    $this->init(); //Connexion à la base
  }

  public static function getComment($rec_id, $users_id) {
    $model = new Model();
    $model->init();
    $sql = "SELECT rec_id, users_id, com_content, com_date FROM comments WHERE rec_id = :rec AND users_id = :user";
    $req_prep = model::$pdo->prepare($sql);
    $req_prep->bindParam(":rec", $rec_id, PDO::PARAM_INT);
    $req_prep->bindParam(":user", $users_id, PDO::PARAM_INT);
    $req_prep->execute();
    return $req_prep->fetch(PDO::FETCH_ASSOC);
  }

  public static function addComment($rec_id, $users_id, $content, $isAuthorised = 0){
    $model = new Model();
    $model->init();
    $sql = "INSERT INTO comments(rec_id, users_id, com_date, com_content, isAuthorised) VALUES 
    (:rec, :user, NOW(), :com_content, :isAuthorised)";
    $req_prep = model::$pdo->prepare($sql);
    $req_prep->bindParam(":rec", $rec_id, PDO::PARAM_INT);
    $req_prep->bindParam(":user", $users_id, PDO::PARAM_INT);
    $req_prep->bindParam(":com_content", $content, PDO::PARAM_STR);
    $req_prep->bindParam(":isAuthorised", $isAuthorised, PDO::PARAM_INT);
    echo "INSERT INTO comments(rec_id, users_id, com_date, com_content, isAuthorised) VALUES 
    (".$rec_id.", ".$users_id.", NOW(), '".$content."', ".$isAuthorised.")";
    return $req_prep->execute();
  }

  public static function updateComment($rec_id, $users_id, $content, $isAuthorised = 0) {
    $model = new Model();
    $model->init();
    $sql = "UPDATE comments SET com_date = NOW(), com_content = :com_content, isAuthorised = :isAuthorised WHERE rec_id = :rec AND users_id = :user";
    $req_prep = model::$pdo->prepare($sql);
    $req_prep->bindParam(":rec", $rec_id, PDO::PARAM_INT);
    $req_prep->bindParam(":user", $users_id, PDO::PARAM_INT);
    $req_prep->bindParam(":com_content", $content, PDO::PARAM_STR);
    $req_prep->bindParam(":isAuthorised", $isAuthorised, PDO::PARAM_INT);
    return $req_prep->execute();
  }

  public static function deleteComment($rec_id, $users_id) {
    $model = new Model();
    $model->init();
    $sql = "DELETE FROM comments WHERE rec_id = :rec AND users_id = :user";
    $req_prep = model::$pdo->prepare($sql);
    $req_prep->bindParam(":rec", $rec_id, PDO::PARAM_INT);
    $req_prep->bindParam(":user", $users_id, PDO::PARAM_INT);
    return $req_prep->execute();
  }
}
