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

    public static function getMostLikedRecipe($nb = 5)
    {

    }
}