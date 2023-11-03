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

    public static function getAwaitingRecipes() {
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

    public static function validRecipe($rec_id) {
        $model = new model();
        $model->init();
        $sql = "UPDATE recipes
        SET isAuthorised = 1
        WHERE rec_id = :rec_id";
        $req_prep = $model::$pdo->prepare($sql);
        $req_prep->bindParam(':rec_id', $rec_id);
        return $req_prep->execute();
    }
}