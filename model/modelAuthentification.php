<?php
require_once("model.php");

class modelAuthentification
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

    public static function checkPassword($mail, $password)
    {
        $model = new model();
        $model->init();
        $sql = "SELECT * FROM users WHERE users_email = :mail";
        $req_prep = $model::$pdo->prepare($sql);
        $values = array(
            "mail" => $mail,
        );
        $req_prep->execute($values);
        $req_prep->setFetchMode(PDO::FETCH_CLASS, 'model');
        $user = $req_prep->fetch();
        if ($user == false) {
            return 0;
        } else {
            if (password_verify($password, $user->users_password)) {
                header("location:" . $_SERVER['HTTP_REFERER']);
                return $user;
            } else {
                return -1;
            }
        }
    }
}