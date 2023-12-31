<?php
require_once(File::build_path(array("model", "model.php")));

class modelFiltres {
    private $nomType;
    public function __construct($nom = NULL)
    {
        if (!is_null($nom)) {
            $this->nomType = $nom;
        }
    }

    public function getNomType() {
        return $this->nomType;
    }

    public function setNomType($nom) {
        $this->nomType = $nom;
    }

    public static function getCategories() {
        $model = new model();
        $model->init();
        $sql = "SELECT cat_id, cat_title FROM category";
        $rep = $model::$pdo->query($sql);
        $rep->setFetchMode(PDO::FETCH_CLASS, 'model');
        return $rep->fetchAll();
    }
}