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
    <link rel="stylesheet" href="resources/css/style.css">
    <script src=""></script> <!-- Inclure ici votre js -->
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon"> <!-- Inclure ici votre favicon -->
    <link rel="icon" href="/favicon.ico" type="image/x-icon">

</head>

<body>
    <nav class="navbar navbar-expand-sm navbar-light" id="neubar">
        <div class="container">
            <img src="../resources/img/Logo.png" height="60" />
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
                aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav ms-auto ">
                    <li class="nav-item">
                        <a class="nav-link mx-2 active text-white txt" id="txt" aria-current="page" href="#">Accueil</a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link mx-2 text-white txt" href="#">Nos recettes</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link mx-2 dropdown-toggle text-white txt" href="#" id="navbarDropdownMenuLink"
                            role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Filtres
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <li><a class="dropdown-item text-white txt" href="#">Catégories</a></li>
                            <li><a class="dropdown-item text-white txt" href="#">Titre</a></li>
                            <li><a class="dropdown-item text-white txt" href="#">Ingrédients</a></li>
                        </ul>
                    </li>
                    <li class='nav-item'>
                        <a href='' class='nav-link mx-2 text-white txt'>Connexion</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <link href="resources/css/bootstrap.min.css" rel="stylesheet">
    <script src="resources/script/bootstrap.bundle.min.js"></script>
</html>