<?php
require_once(File::build_path(array("model", "model.php")));

class modelAdmin
{
    private $nomType;

    public function __construct($nom = NULL)
    {
        if (!is_null($nom)) {
            $this->nomType = $nom;
        }
    }

    public function getNomType()
    {
        return $this->nomType;
    }

    public function setNomType($nom)
    {
        $this->nomType = $nom;
    }

    public static function getAwaitingRecipes()
    {
        $model = new model();
        $model->init();
        $sql = "SELECT rec_id, rec_title, cat_id, cat_title, rec_summary, rec_image_src, rec_creation_date, rec_modification_date from recipes
        join category using(cat_id)
        where isAuthorised = 0
        order by rec_modification_date desc, rec_creation_date desc";
        $req_prep = $model::$pdo->prepare($sql);
        $req_prep->execute();
        $req_prep->setFetchMode(PDO::FETCH_CLASS, 'model');
        return $req_prep->fetchAll();
    }

    public static function validRecipe($rec_id)
    {
        $model = new model();
        $model->init();
        $sql = "UPDATE recipes
        SET isAuthorised = 1
        WHERE rec_id = :rec_id";
        $req_prep = $model::$pdo->prepare($sql);
        $req_prep->bindParam(':rec_id', $rec_id);
        return $req_prep->execute();
    }

    public static function getAwaitingComments()
    {
        $model = new model();
        $model->init();
        $sql = "SELECT comments.rec_id, comments.users_id, com_content, com_date, rec_title, rec_summary, users_pseudo, cat_id, cat_title from comments
        join recipes using(rec_id)
        join users on(comments.users_id = users.users_id)
        join category using (cat_id)
        where comments.isAuthorised = 0
        order by rec_id, com_date desc";
        $req_prep = $model::$pdo->prepare($sql);
        $req_prep->execute();
        $req_prep->setFetchMode(PDO::FETCH_CLASS, 'model');
        return $req_prep->fetchAll();
    }

    public static function validComment($rec_id, $users_id)
    {
        $model = new model();
        $model->init();
        $sql = "UPDATE comments
        SET isAuthorised = 1
        WHERE rec_id = :rec_id
        AND users_id = :users_id";
        $req_prep = $model::$pdo->prepare($sql);
        $req_prep->bindParam(':rec_id', $rec_id);
        $req_prep->bindParam(':users_id', $users_id);
        return $req_prep->execute();
    }

    public static function deleteComment($rec_id, $users_id) {
        $model = new model();
        $model->init();
        $sql = "DELETE FROM comments
        WHERE rec_id = :rec_id
        AND users_id = :users_id";
        $req_prep = $model::$pdo->prepare($sql);
        $req_prep->bindParam(':rec_id', $rec_id);
        $req_prep->bindParam(':users_id', $users_id);
        return $req_prep->execute();
    }

    public static function getCurrentEdito() {
        $model = new model();
        $model->init();
        $sql = "SELECT edi_title, edi_content from edito
        order by edi_date desc
        limit 1";
        $req_prep = $model::$pdo->prepare($sql);
        $req_prep->execute();
        $req_prep->setFetchMode(PDO::FETCH_CLASS, 'model');
        return $req_prep->fetch();
    }

    public static function addEdito($users_id, $edi_title, $edi_content) {
        $model = new model();
        $model->init();
        $sql = "INSERT INTO edito (users_id, edi_title, edi_content, edi_date)
        VALUES (:users_id, :edi_title, :edi_content, NOW())";
        $req_prep = $model::$pdo->prepare($sql);
        $req_prep->bindParam(':users_id', $users_id);
        $req_prep->bindParam(':edi_title', $edi_title);
        $req_prep->bindParam(':edi_content', $edi_content);
        return $req_prep->execute();
    }

    public static function getUsers() {
        $model = new model();
        $model->init();
        $sql = "SELECT users_id, users_name, users_lastname, users_pseudo, users_email, users_type, users_inscription_date from users
        order by users_inscription_date desc";
        $req_prep = $model::$pdo->prepare($sql);
        $req_prep->execute();
        $req_prep->setFetchMode(PDO::FETCH_CLASS, 'model');
        return $req_prep->fetchAll();
    }
}