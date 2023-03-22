<?php include('nav.php') ?>
<div class="cadre2">
    <?php
if (empty($_GET['nom'])) {
    ?>
    <script>
        alert("Veuillez entrer un terme de recherche.");
        window.location.href = "index.php";
    </script>
    <?php
} else {
    // Récupération du terme de recherche
    $searchTerm = $_GET['nom'];

    // Connexion à l'API Google Books
    $url = "https://www.googleapis.com/books/v1/volumes?q=" . urlencode($searchTerm) . "&langRestrict=fr";
    $url .= "intitle:" . urlencode($searchTerm) . "+";
    $url .= "inauthor:" . urlencode($searchTerm) . "+";
    $url .= "subject:" . urlencode($searchTerm);

    $response = file_get_contents($url);
    $data = json_decode($response, true);

    // Affichage des résultats
    if (isset($data['items'])) {
        foreach ($data['items'] as $item) {
            $title = $item['volumeInfo']['title'];
            $author = isset($item['volumeInfo']['authors']) ? implode(", ", $item['volumeInfo']['authors']) : "Auteur inconnu";
            $genre = isset($item['volumeInfo']['categories']) ? implode(", ", $item['volumeInfo']['categories']) : "Genre inconnu";
            $image = isset($item['volumeInfo']['imageLinks']['thumbnail']) ? $item['volumeInfo']['imageLinks']['thumbnail'] : "https://via.placeholder.com/128x192.png?text=Image+indisponible";
            $summary = isset($item['volumeInfo']['description']) ? wordwrap(substr($item['volumeInfo']['description'], 0, 400), 100, "<br>\n") . '...' : 'Résumé non disponible';
            ?>
            <div class="book">
                <div class="book-cover">
                    <img src="<?php echo $image; ?>" alt="<?php echo $title; ?>">
                </div>
                <div class="book-info">
                    <h2><?php echo $title; ?></h2>
                    <p><?php echo $author; ?></p>
                    <p><?php echo $genre; ?></p>
                    <h6 class="description"><?php echo $summary; ?></h6>
                    <?php if(isset($_SESSION['user'])){ ?>
                        <form method="post" action="ajout_panier.php">
                            <input type="hidden" name="titre[]" value="<?php echo $title; ?>">
                            <input type="hidden" name="categorie[]" value="<?php echo $genre; ?>">
                            <input type="hidden" name="auteur[]" value="<?php echo $author; ?>">
                            <input type="hidden" name="image[]" value="<?php echo $image; ?>">
                            <input type="submit" value="Ajouter au panier" class="ajouter-panier">
                        </form>
                    <?php } ?>
                </div>
            </div>
            <hr>
            <?php
        }
    } else {
        echo "Aucun résultat trouvé pour votre recherche.";
    }
}
?>
</div>
</body>
</html>
