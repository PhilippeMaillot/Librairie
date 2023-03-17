<?php
session_start();

// Check if the user is logged in
$userID = $_SESSION['user']['id'];

// Get the book information from the form
$titre = $_POST['titre'];
$categorie = $_POST['categorie'];
$auteur = $_POST['auteur'];
$image = $_POST['image'];

// Connect to the database
$connexion = new mysqli("localhost", "root", "", "Biblio");

// Prepare the SQL query
$stmt = $connexion->prepare("INSERT INTO panier (id_utilisateur, titre, categorie, auteur, image) VALUES (?, ?, ?, ?, ?)");

// Bind the parameters
$stmt->bind_param("issss", $userID, $titre, $categorie, $auteur, $image);

// Execute the query
if ($stmt->execute()) {
    echo "Le livre a été ajouté au panier avec succès.";
} else {
    echo "Une erreur est survenue lors de l'ajout du livre au panier : " . $connexion->error;
}

// Close the statement and the database connection
$stmt->close();
$connexion->close();
header('location:prive.php')
?>