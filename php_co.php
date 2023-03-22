<?php
$message = '';
if(isset($_GET['email']) && isset($_GET['mdp'])) {
    $mail= $_GET['email'];
    $mdp= $_GET['mdp'];

    $connexion= new mysqli("localhost","root","","Biblio");
    $requete="SELECT * FROM user WHERE email='$mail'";
    $res = $connexion->query($requete);

    if(mysqli_num_rows($res) == 1) {
        $ligne= mysqli_fetch_assoc($res);
        $hash = $ligne['mdp'];
        if (password_verify($mdp, $hash)) {
            session_start();
            $_SESSION['user'] = $ligne;
            header('Location: co_reussi.php');
        } else {
            $message = 'Le mot de passe est incorrect.';
        }
    } else {
        $message = 'L\'adresse e-mail que vous avez entré n\'est assignée à aucun compte.';
    }
}

include('connexion.php');
?>