<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> 
        <?php 
        if (!isset($y))  echo $pageTitle;
        else echo "Ptit-Cuisto";
        ?>
    </title>
    <link rel="stylesheet" href="resources/css/style.css">
    <link rel="stylesheet" href="resources/css/bootstrap.min.css">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link rel="icon" href="/favicon.ico" type="image/x-icon">

</head>

<body>
    <nav class="navbar navbar-expand-sm navbar-light" id="neubar">
        <div class="container">
            <img src="../resources/img/Logo.png" height="60" alt="Logo de l'application">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
                aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav ms-auto ">
                    <li class="nav-item">
                        <a class="nav-link mx-2 active text-white txt" id="txt" aria-current="page" href="index.php">Accueil</a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link mx-2 text-white txt" href="index.php?controller=recipes">Nos recettes</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link mx-2 dropdown-toggle text-white txt" href="" id="navbarDropdownMenuLink"
                            role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Filtres
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <li><a class="dropdown-item text-white txt" href="index.php?controller=filtre&action=categories">Catégories</a></li>
                            <li><a class="dropdown-item text-white txt" href="index.php?controller=filtre&action=titleSearch">Titre</a></li>
                            <li><a class="dropdown-item text-white txt" href="index.php?controller=filtre&action=ingredientsSearch">Ingrédients</a></li>
                        </ul>
                    </li>
                    <li class='nav-item'>
                        <a href='index.php?controller=connexion' class='nav-link mx-2 text-white txt'>Connexion</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container">