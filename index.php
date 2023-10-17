<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">;     
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ptit Cuisto</title>
</head>
<body>
    <?php
    if (isset($_GET['id'])) {
        var_dump($_GET['id']);
    } else {
        header("Location: /View/homepage.php", true, 301);  
        exit();
    }
    ?>


    
</body>
</html>