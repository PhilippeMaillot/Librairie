<?php include('nav.php') ?>
                <div class="cadre2">
        <div class="panier">
<?php

// Vérification que l'utilisateur est authentifié
if (isset($_SESSION['user'])) {
    // Connexion à la base de données
    $conn = new mysqli("localhost", "root", "", "Biblio");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Récupération des livres dans le panier de l'utilisateur
    $id_user = $_SESSION['user']['id'];
    $sql = "SELECT * FROM panier WHERE id_utilisateur = '$id_user'";
    $result = $conn->query($sql);

    // Affichage des livres
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<li>";
            echo "<div>";
            echo "<img src='" . $row['image'] . "'>";
            echo "<h2>" . $row['titre'] . "</h2>";
            echo "<p>Auteur : " . $row['auteur'] . "</p>";
            echo "<p>Catégorie : " . $row['categorie'] . "</p>";
            echo "</div>";
            ?>
            <form action="suppr_livre.php" method="POST">
                <input type="hidden" name="id_panier" value="<?php echo $row['id_panier']; ?>">
                <button type="submit" class="btn2">Supprimer</button>
            </form>
            <?php
            echo "</li>";
        }
    } else {
        echo "Votre bibliothèque est vide";
    }
}
?>
</ul>
        </div>
</div>
</body>
</html> 