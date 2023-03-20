<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="style.css">
    <script defer src="app.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
</head>
<body>
<div class="cadre">
    <h1>Book ma zone</h1>
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
    if (isset($_SESSION['user'])) {
      $connexion = new mysqli("localhost", "root", "", "biblio");
      $requete = "SELECT * FROM user WHERE nom = '".$_SESSION['user']['nom']."'";
      $result = $connexion->query($requete);
      if ($result->num_rows > 0) {
        $data = $result->fetch_assoc();
        echo "Bienvenue sur Bookmazon " . $data['nom'] . ", une petite envie de lire ? ";
      } else {
        echo "Impossible de récupérer les informations de l'utilisateur connecté.";
      }
    } 
    ?>
    <h1> Voici notre recommandation du jour : <h1>

    <?php
    // Paramètres de recherche
    $authors = array('Herman Melville', 'Charles Dickens', 'Jane Austen', 'Edgar Allan Poe', 'Mark Twain', 'Agatha Christie', 'J.K. Rowling', 'Gabriel García Márquez', 'Ernest Hemingway', 'Toni Morrison');
    $q = urlencode('inauthor:' . $authors[array_rand($authors)]);
    $maxResults = 10;
    $langRestrict = 'fr';

    // URL de recherche
    $url = "https://www.googleapis.com/books/v1/volumes?q=$q&maxResults=$maxResults&langRestrict=$langRestrict";
    $jsonData = file_get_contents($url);

// Conversion des données JSON en tableau associatif PHP
$data = json_decode($jsonData, true);

// Vérification des erreurs
if (isset($data['error'])) {
    echo 'Erreur : ' . $data['error']['message'];
    exit();
}

// Récupération de 10 livres aléatoires
$randomBooks = array_rand($data['items'], 10);

// Parcours des livres aléatoires et affichage des informations
foreach ($randomBooks as $bookIndex) {
  $volumeInfo = $data['items'][$bookIndex]['volumeInfo'];
?>
  <div class="book">
      <div class="book-info">
          <h2><?= $volumeInfo['title'] ?></h2>
          <p>Auteur(s) : <?= (isset($volumeInfo['authors']) ? implode(', ', $volumeInfo['authors']) : 'Information non disponible') ?></p>
          <p>Editeur : <?= (isset($volumeInfo['publisher']) ? $volumeInfo['publisher'] : 'Information non disponible') ?></p>
          <p>Date de publication : <?= (isset($volumeInfo['publishedDate']) ? $volumeInfo['publishedDate'] : 'Information non disponible') ?></p>
          <p>Nombre de pages : <?= (isset($volumeInfo['pageCount']) ? $volumeInfo['pageCount'] : 'Information non disponible') ?></p>
          <?php if(isset($_SESSION['user'])){ ?>
            <form method="post" action="ajout_index.php">
                    <input type="hidden" name="titre" value="<?= isset($volumeInfo['title']) ? $volumeInfo['title'] : 'Information non disponible' ?>">
                    <input type="hidden" name="categorie" value="<?= isset($volumeInfo['categories'][0]) ? $volumeInfo['categories'][0] : 'Information non disponible' ?>">
                    <input type="hidden" name="auteur" value="<?= isset($volumeInfo['authors'][0]) ? $volumeInfo['authors'][0] : 'Information non disponible' ?>">
                    <input type="hidden" name="image" value="<?= isset($volumeInfo['imageLinks']['thumbnail']) ? $volumeInfo['imageLinks']['thumbnail'] : 'https://via.placeholder.com/128x192?text=Image+non+disponible' ?>">
                    <input type="submit" value="Ajouter au panier" class="ajouter-panier">
                </form>
                <div class="add-to-cart-message"></div>
          <?php } ?>
      </div>
      <div class="book-cover">
          <img src="<?= (isset($volumeInfo['imageLinks']['thumbnail']) ? $volumeInfo['imageLinks']['thumbnail'] : 'https://via.placeholder.com/128x192?text=Image+non+disponible') ?>">
      </div>
  </div>
<?php
} ?>
</div>
</body>
</html>
