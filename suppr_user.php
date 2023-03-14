<?php
$connexion=new mysqli("localhost","root","","Biblio");

$id_utilisateur = $_POST['id'];

$connexion->query('DELETE FROM panier WHERE id_utilisateur = ' . $id_utilisateur);

$connexion->query('DELETE FROM user WHERE id = ' . $id_utilisateur);

$connexion->close();

session_start();
session_destroy();
header('location:index.php');
?>

