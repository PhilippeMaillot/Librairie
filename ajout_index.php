<?php
session_start();
$userID = $_SESSION['user']['id'];
$titre = $_POST['titre'];
$categorie = $_POST['categorie'];
$auteur = $_POST['auteur'];
$image = $_POST['image'];
$connexion = new mysqli("localhost", "root", "", "Biblio");
$stmt = $connexion->prepare("INSERT INTO panier (id_utilisateur, titre, categorie, auteur, image) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("issss", $userID, $titre, $categorie, $auteur, $image);
$stmt->execute();
$stmt->close();
$connexion->close();
header('location:prive.php')
?>