<?php
$connexion=new mysqli("localhost","root","","Biblio");
$id = $_POST['id_panier'];
$requete = "DELETE FROM panier WHERE id_panier='$id'";
$connexion->query($requete);
header('Location: prive.php');
exit;
?>
