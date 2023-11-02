<?php
require_once(File::build_path(array("model", "model.php")));

class modelCreation{
    private $nom;
    private $prenom;
    private $pseudo;
    private $mail;
    private $password;
    private $type;

    public function __construct($nom = NULL, $prenom = NULL, $pseudo = NULL, $mail = NULL, $password = NULL, $type = NULL){
        if (!is_null($nom) && !is_null($prenom) && !is_null($pseudo) 
            && !is_null($mail) && !is_null($password) && !is_null($type)) {
                $this->nom = $nom;
                $this->prenom = $prenom;
                $this->pseudo = $pseudo;
                $this->mail = $mail;
                $this->password = $password;
                $this->type = $type;
        }
    }

    public function getNom(){
        return $this->nom;
    }

    public function getPrenom(){
        return $this->prenom;
    }

    public function getPseudo(){
        return $this->pseudo;
    }

    public function getMail(){
        return $this->mail;
    }

    public function getPassword(){
        return $this->password;
    }

    public function getType(){
        return $this->type;
    }

    public function setNom($nom){
        $this->nom = $nom;
    }

    public function setPrenom($prenom){
        $this->prenom = $prenom;
    }

    public function setPseudo($pseudo){
        $this->pseudo = $pseudo;
    }

    public function setMail($mail){
        $this->mail = $mail;
    }

    public function setPassword($password){
        $this->password = $password;
    }


    public static function createAccount($prenom, $nom, $pseudo, $mail, $password, $type){
        $model = new model();
        $model->init();
        $sql = "INSERT INTO users (users_name, users_lastname, users_pseudo, users_email, users_password, users_type) VALUES (:name, :surname, :pseudo, :mail, :password, :type)";
        $req_prep = $model::$pdo->prepare($sql);
        $values = array(
            "surname" => $nom,
            "name" => $prenom,
            "pseudo" => $pseudo,
            "mail" => $mail,
            "password" => password_hash($password, PASSWORD_DEFAULT),
            "type" => $type
        );
        print_r($values);
        print_r($sql);

        $req_prep->execute($values);
    }
}