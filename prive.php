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
    <ul>
    <?php
// Vérification que l'utilisateur est authentifié
if (isset($_SESSION['user'])) {
// Connexion à la base de données
$conn = new mysqli("localhost", "root", "", "Biblio");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Récupération des livres dans le panier de l'utilisateur

$id_user = $_SESSION['user'];
$sql = "SELECT * FROM panier WHERE id_utilisateur = '$id_user'";
$result = $conn->query($sql);

// Affichage des livres
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<div>";
        echo "<img src='" . $row['image'] . "'>";
        echo "<h2>" . $row['titre'] . "</h2>";
        echo "<p>Auteur : " . $row['auteur'] . "</p>";
        echo "<p>Catégorie : " . $row['categorie'] . "</p>";
        echo "</div>";
     ?> <form action="suppr_livre.php" method="POST">
     <input type="hidden" name="id_panier" value="<?php echo $row['id_panier']; ?>">
     <button type="submit" class="btn">Supprimer</button>
 </form>
 <br>
 <?php
    }     
}
}
?>
</ul>
</div>
</body>
</html> 