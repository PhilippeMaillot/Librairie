<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="cadre">
<nav class="navbar background">
        <ul class="nav-list">
                <li><a href="index.php" class="btn">Accueil</a></li>
                <?php
            session_start();
            if(isset($_SESSION['user'])){
            ?>
                <li><a href="prive.php" class="btn">Bibliothèque privé</a></li>
                <li><a href="deco.php" class="btn">Deconnexion</a></li>
                <?php } else { ?>
                <li><a href="inscription.php" class="btn">Inscription</a></li>
                <li><a href="connexion.php" class="btn">Connexion</a></li>
                <?php } ?>
                <div class="search-container">
                <form action="recherche.php" method="get">
                <input name="nom" type="text" placeholder="Rechercher ici">
                <input type="submit" value="Rechercher" class="recherche">
            </form>
        </div>
        </ul>   
    </nav>
</div>
</body>
</html>
