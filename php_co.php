<?php
 $mail= $_GET['email'];
 $mdp= $_GET['mdp'];

 $connexion= new mysqli("localhost","root","","Biblio");
 $requete="SELECT * FROM user WHERE email='$mail'";
 $res = $connexion->query($requete);
 $ligne= mysqli_fetch_assoc($res);
 $hash = $ligne['mdp'];
 if (password_verify($mdp, $hash)) {
    session_start();
    $_SESSION['user'] = $ligne;
 header('Location: co_reussi.php');
}
else{
    include('connexion.php');
}
?>