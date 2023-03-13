<?php
// Vérification que le formulaire a été soumis
if (isset($_POST['titre']) && isset($_POST['categorie']) && isset($_POST['auteur']) && isset($_POST['image'])) {
    // Connexion à la base de données
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "Biblio";
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Vérification de la connexion
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Vérification de la session
    session_start();
    if (isset($_SESSION['user'])) {
        $id_user = $_SESSION['user']['id'];
        // Parcours des résultats postés
        for ($i = 0; $i < count($_POST['titre']); $i++) {
            // Récupération des données
            $titre = $_POST['titre'][$i];
            $categorie = $_POST['categorie'][$i];
            $auteur = $_POST['auteur'][$i];
            $image = $_POST['image'][$i];

            $requete = "INSERT INTO panier (id_utilisateur, titre, categorie, auteur, image) VALUES ('$id_user', '$titre', '$categorie', '$auteur', '$image')";

            // Exécution de la requête
            if ($conn->query($requete) === TRUE) {
                echo "Livre ajouté au panier avec succès.";
            } else {
                echo "Erreur : " . $requete . "<br>" . $conn->error;
            }
        }
    } else {
        echo "Erreur : utilisateur non trouvé.";
    }
    header('location:prive.php');
}
?>
