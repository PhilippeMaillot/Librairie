<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Résultats</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="cadre">
    <h1>Bookmazon</h1>
    <nav class="navbar background">
        <ul class="nav-list">
                <li><a href="index.php" class="btn">Accueil</a></li>
                <?php
            session_start();
            if(isset($_SESSION['user'])){
                $data = $_SESSION['user']['nom'];
            ?>
                <li><a href="prive.php" class="btn">Liste de lecture</a></li>
                <li><a href="modif.php" class="btn"><?php echo $data; ?></a></li>
                <li><a href="deco.php" class="btn">Deconnexion</a></li>
                <?php } else { ?>
                <li><a href="inscription.php" class="btn">Inscription</a></li>
                <li><a href="connexion.php" class="btn">Connexion</a></li>
                <?php } ?>
                <div class="search-container">
                <form action="recherche.php" method="get">
                <input name="nom" type="text" placeholder="Rechercher ici">
                <input type="image" src="./img/loupe.png">
            </form>
        </div>
        </ul>   
    </nav>
    </div>
            <div class="cadre2">
    <?php
        // Récupération du terme de recherche
        $searchTerm = $_GET['nom'];

        // Connexion à l'API Google Books
        $url = "https://www.googleapis.com/books/v1/volumes?q=".urlencode($searchTerm);
        $response = file_get_contents($url);
        $data = json_decode($response, true);

        // Affichage des résultats
        if (isset($data['items'])) {
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
                    <?php if(isset($_SESSION['user'])){ ?>
                    <input type="submit" value="Ajouter au panier" class="ajouter-panier">
            <?php } ?>
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

