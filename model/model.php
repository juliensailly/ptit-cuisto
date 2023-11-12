<?php
require_once("config/config.php");

class model{
  public static $pdo = null;

  public $table;
  public $id;

  public static function init(){
    $login = conf::getLogin();
    $hostname = conf::getHostname();
    $database_name = conf::getDatabase();
    $password = conf::getPassword();

    try{
      self::$pdo = new PDO('mysql:host='.$hostname.';dbname='.$database_name.';charset=utf8', $login, $password);
    } catch(PDOException $e) {
      echo $e->getMessage();
      self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      die();
    }
  }

  public function getAll(){
    $sql = "SELECT * FROM". $this->table;
    $query = $this->pdo->prepare($sql);
    $query->execute();
    return $query->fetchAll();
  }

  public function getElementById(){
    $sql = "SELECT * FROM". $this->table . " WHERE id = " .$this->id;
    $query = $this->pdo->prepare($sql);
    $query->execute();
    return $query->fetch();
  }

  public function logOut(){
    $this->pdo = null;
  }
}
?>
