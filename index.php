<?php include('nav.php') ?>
  <div class="cadre2">
    <?php
    if (isset($_SESSION['user'])) {
      $connexion = new mysqli("localhost", "root", "", "biblio");
      $requete = "SELECT * FROM user WHERE nom = '".$_SESSION['user']['nom']."'";
      $result = $connexion->query($requete);
      if ($result->num_rows > 0) {
        $data = $result->fetch_assoc();
        echo "Bienvenue sur BookMaZone " . $data['nom'] . ", une petite envie de lire ? ";
      }
    } 
    ?>
    <h1> Voici notre recommandation du jour : <h1>
    <hr>
    <?php
    $authors = array('Herman Melville', 'Charles Dickens', 'Jane Austen', 'Edgar Allan Poe', 'Mark Twain', 'Agatha Christie', 'J.K. Rowling', 'Gabriel García Márquez', 'Ernest Hemingway', 'Toni Morrison');
    $q = urlencode('inauthor:' . $authors[array_rand($authors)]);
    $maxResults = 10;
    $url = "https://www.googleapis.com/books/v1/volumes?q=$q&maxResults=$maxResults&langRestrict=fr";
    $jsonData = file_get_contents($url);

// Conversion des données JSON en tableau associatif PHP
    $data = json_decode($jsonData, true);

// Vérification des erreurs
   if (isset($data['error'])) {
    echo 'Erreur : ' . $data['error']['message'];
    exit();
}

$randomBooks = array_rand($data['items'], 10);

foreach ($randomBooks as $bookIndex) {
  $volumeInfo = $data['items'][$bookIndex]['volumeInfo'];
?>
  <div class="book">
  <div class="book-cover">
          <img src="<?= (isset($volumeInfo['imageLinks']['thumbnail']) ? $volumeInfo['imageLinks']['thumbnail'] : 'https://via.placeholder.com/128x192?text=Image+non+disponible') ?>">
      </div>
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
                    <span class="add-to-cart-message"></span>
                    <input type="submit" value="Ajouter au panier" class="ajouter-panier">
                </form>
          <?php } ?>
      </div>
  </div>
  <hr>
<?php
} ?>
</div>
</body>
</html>
