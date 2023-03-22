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
            $titre = $conn->real_escape_string($_POST['titre'][$i]);
            $categorie = $conn->real_escape_string($_POST['categorie'][$i]);
            $auteur = $conn->real_escape_string($_POST['auteur'][$i]);
            $image = $conn->real_escape_string($_POST['image'][$i]);
            $requete = "INSERT INTO panier (id_utilisateur, titre, categorie, auteur, image) VALUES ('$id_user', '$titre', '$categorie', '$auteur', '$image')";

            // Exécution de la requête
            if ($conn->query($requete) === TRUE) {
                header('location:prive.php');
            } else {
                echo "Erreur : " . $requete . "<br>" . $conn->error;
            }
        }
    } else {
        echo "Erreur : utilisateur non trouvé.";
    }
}
?>
