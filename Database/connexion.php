<?php

// -------------------------------------------- Connexion à la base de données -------------------------------------------------------------------------------------------------------------

// Connexion à la base de données
try
{
    $connexion = new PDO("mysql:host=mysql.info.unicaen.fr:3306;dbname=name", 'user', 'mdp');
}

// Renvoi d'une erreur lors de l'échec à la connexion à la DB
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}
?>