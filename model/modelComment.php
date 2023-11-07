<?php
require_once(File::build_path(array("model", "model.php")));

class modelComment extends model{

    public function __construct($id)
  {
    $this->table = "comments";
    $this->id = $id;
    $this->init(); //Connexion à la base
  }


  public static function create($recid, $userid, $title, $content){
    $model = new model();
    $model->init();
    $sql = "INSERT INTO comments(rec_id, users_id,com_date,com_title,com_content,isAuthorised) VALUES 
    (:rec, :user, :date, :com_title, :com_content, :isAuthorised)";
    $req_prep = model::$pdo->prepare($sql);
    $req_prep->bindParam(":rec", $recid, PDO::PARAM_INT);
    $req_prep->bindParam(":user", $userid, PDO::PARAM_INT);
    $req_prep->bindParam(":date", NOW(), PDO::PARAM_STR);
    $req_prep->bindParam(":com_title", $title, PDO::PARAM_STR);
    $req_prep->bindParam(":com_content", $content, PDO::PARAM_STR);
    $req_prep->bindParam(":isAuthorised", 0, PDO::PARAM_INT);
    return $req_prep->execute();  
  }
}
?>