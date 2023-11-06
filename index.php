<?php
    $d_s = DIRECTORY_SEPARATOR;
    ini_set('display_errors',0);
    include(__DIR__ . $d_s . "model" . $d_s . "modelAuthentification.php");
    session_start();
    if(!isset($_SESSION['login'])){
        $_SESSION['login'] = false;
    }
    require_once(__DIR__ . $d_s . "lib" . $d_s . "file.php");
    require_once(File::build_path(array("controller", "routeur.php")));
?>
