<?php
require_once(File::build_path(array("model", "model.php")));

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
            echo "No user with this email found <br>";
            return false;
        } else {
            if (password_verify($password, $user->users_password)) {
                echo "Authentification successfull <br>";
                return $user;
            } else {
                echo "Passwords does not match <br>";
                return false;
            }
        }
    }
}