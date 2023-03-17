<?php
$connexion= new mysqli("localhost","root","","biblio");
$mail = $_POST["email"];
$id = $_POST["id"];
$nom = $_POST["nom"];
if (!empty($_POST["mdp"])) {
  // Si le champ du mot de passe n'est pas vide, on hash le mot de passe
  $password = $_POST["mdp"];
  $options = ['cost' => 10];
  $hash = password_hash($password, PASSWORD_BCRYPT, $options);
  $requete = "UPDATE user SET email='$mail', mdp='$hash', nom='$nom' WHERE id='$id'";
} else {
  // Si le champ du mot de passe est vide, on ne modifie que l'e-mail
  $requete = "UPDATE user SET email='$mail', nom='$nom' WHERE id='$id'";
}
$res = $connexion->query($requete);
session_start();
session_destroy();
header('Location: index.php');
?>