<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="style.css">
    <script defer src="app.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script defer src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>BookMaZone</title>
</head>
<body>
<div class="cadre">
<nav class="navbar background">
    <ul class="nav-list">
        <li><h1><a href="index.php" class="titre">Book<span class="title">MaZone</span></a></h1></li>
        <?php
            session_start();
            if(isset($_SESSION['user'])){
                $data = $_SESSION['user']['nom'];
        ?>
                <li>
                    <div class="search-container">
                        <form action="recherche.php" method="get">
                            <input name="nom" type="text" placeholder="Rechercher ici">
                            <input type="image" src="./img/loupe.png">
                        </form>
                    </div>
                </li>
                <li>
                    <div class="dropdown">
                        <button class="btn3">Compte</button>
                        <div class="dropdown-content hidden">
                            <a href="prive.php" class="dropdown-link">Panier</a><br>
                            <a href="modif.php" class="dropdown-link"><?php echo $data; ?></a><br>
                            <a href="deco.php" class="dropdown-link">Se déconnecter</a>
                        </div>
                    </div>
                </li>
        <?php } else { ?>
                <li><a href="inscription.php" class="btn2">Inscription</a></li>
                <li><a href="connexion.php" class="btn2">Connexion</a></li>
                <li>
                    <div class="search-container">
                        <form action="recherche.php" method="get">
                            <input name="nom" type="text" placeholder="Rechercher ici">
                            <input type="image" src="./img/loupe.png">
                        </form>
                    </div>
                </li>
        <?php } ?>
    </ul>   
</nav>
</div>
