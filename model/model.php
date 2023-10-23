<?php
require_once(File::build_path(array("config", "conf.php")));

abstract class  model{
  public $table;
  public $id;

  public function init(){
    $login = conf::getLogin();
    $hostname = conf::getHostname();
    $database_name = conf::getDatabase();
    $password = conf::getPassword();

    $con = null;

    try{
      $this->con = new PDO("mysql:host=$hostname;dbname=$database_name", $login, $password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
    } catch(PDOException $e) {
      echo $e->getMessage();
      $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      die();
    }
  }

  public function getAll(){
    $sql = "SELECT * FROM". $this->table;
    $query = $this->con->prepare($sql);
    $query->execute();
    return $query->fetchAll();
  }

  public function getElementById(){
    $sql = "SELECT * FROM". $this->table . " WHERE id = " .$this->id;
    $query = $this->con->prepare($sql);
    $query->execute();
    return $query->fetch();

  }
}