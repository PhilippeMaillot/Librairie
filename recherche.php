<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Résultats de recherche</title>
    <link rel="stylesheet" href="style.css">
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
    <?php
        // Récupération du terme de recherche
        $searchTerm = $_GET['nom'];

        // Connexion à l'API Google Books
        $url = "https://www.googleapis.com/books/v1/volumes?q=".urlencode($searchTerm)."&langRestrict=fr&maxResults=30";
        $response = file_get_contents($url);
        $data = json_decode($response, true);

        // Affichage des résultats
        if (isset($data['items'])) {
            ?>

            <?php
            foreach($data['items'] as $item) {
                $title = $item['volumeInfo']['title'];
                $author = isset($item['volumeInfo']['authors']) ? implode(", ", $item['volumeInfo']['authors']) : "Auteur inconnu";
                $genre = isset($item['volumeInfo']['categories']) ? implode(", ", $item['volumeInfo']['categories']) : "Genre inconnu";
                $image = isset($item['volumeInfo']['imageLinks']['thumbnail']) ? $item['volumeInfo']['imageLinks']['thumbnail'] : "https://via.placeholder.com/128x192.png?text=Image+indisponible";
                ?>
                <form method="post" action="ajout_panier.php">
                <div class="book-result">
                    <h3><?php echo $title; ?></h3>
                    <p><?php echo $author; ?></p>
                    <p><?php echo $genre; ?></p>
                    <img src="<?php echo $image; ?>" alt="<?php echo $title; ?>">
                    <input type="hidden" name="titre[]" value="<?php echo $title; ?>">
                    <input type="hidden" name="categorie[]" value="<?php echo $genre; ?>">
                    <input type="hidden" name="auteur[]" value="<?php echo $author; ?>">
                    <input type="hidden" name="image[]" value="<?php echo $image; ?>">          
                    <input type="hidden" name="auteur[]" value="<?php echo $author; ?>">
                    <input type="submit" value="Ajouter au panier" class="ajouter-panier">
            </form>
                </div>
<?php
        }
    } else {
        echo "Aucun résultat trouvé pour votre recherche.";
    }
?>
</div>
</body>
</html>

