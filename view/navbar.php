<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        <?php if (!isset($y)) {
            echo $pageTitle;
        } ?>
    </title>
    <link rel="stylesheet" href=""> <!-- Inclure ici votre css -->
    <script src=""></script> <!-- Inclure ici votre js -->
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon"> <!-- Inclure ici votre favicon -->
    <link rel="icon" href="/favicon.ico" type="image/x-icon">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</head>

<body>

    <nav class="navbar navbar-expand-lg" style="background-color:#7890cd;">
        <div class="container-fluid">
            <img src='../resources/img/Logo.png' alt='' class='navbar-brand' style="height:50px;">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class='d-flex'>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <style>
                        .navbar-nav a {
                            color: white;
                        }

                        .navbar-nav a:hover {
                            color: black;
                        }
                    </style>
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class='nav-item'>
                            <a href='' class='nav-link'>Accueil</a>
                        </li>
                        <li class='nav-item'><a href='' class='nav-link'>Nos recettes</a></li>
                        <style>
                            .dropdown:hover .dropdown-menu {
                                display: block;
                                background-color: #7890cd;
                            }

                            .dropdown-menu a:hover {
                                color: black;
                                background-color: #7890cd;
                            }
                        </style>
                        <li class="nav-item dropdown">
                            <a class=" dropdown nav-link dropdown-toggle" href="#" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Dropdown
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Catégories</a></li>
                                <li>
                                    <hr class='dropdown-divider'>
                                </li>
                                <li><a href='' class='dropdown-item'>Titre</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="#">Ingrédients</a></li>
                            </ul>
                        </li>
                        <li class='nav-item'><a href='' class='nav-link'>Connexion</a></li>
                    </ul>

                </div>
            </div>
        </div>
    </nav>