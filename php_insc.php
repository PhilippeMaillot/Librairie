<?php
 $nom= $_GET['nom'];
 $mail= $_GET['email'];
 $password = $_GET['mdp'];
 $options = ['cost' => 10];
 $hash = password_hash($password, PASSWORD_BCRYPT, $options);
 $connexion=new mysqli("localhost","root","","Biblio");
 $requete="INSERT INTO user(nom, email, mdp) VALUES ('$nom', '$mail', '$hash')";
 $connexion->query($requete);
    include('connexion.php')
?>