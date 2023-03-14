<?php include('nav.php')?>
<?php
$user_id = $_SESSION['user']['id'];
        $connexion= new mysqli("localhost","root","","biblio");
        $requete = "SELECT * FROM user WHERE id = $user_id";
        $res = $connexion->query($requete);
        $user = mysqli_fetch_assoc($res);
?>
<div class="cadre2">
<form method="post" action="update.php">
  <input type="hidden" name="id" value="<?php echo $user_id; ?>">
  <p>Nom du compte : <input type="text" name="nom" value="<?php echo $user['nom']; ?>"></p>
  <p>Email : <input type="email" name="email" value="<?php echo $user['email']; ?>"></p>
  <p>Mot de passe : <input type="password" name="mdp" value=""></p>
  <input type="submit" name="update_button" value="Modifier">
</form>
<br>
<form method="post" action="suppr_user.php" class="supprimer">
<input type="hidden" name="id" value="<?php echo $user_id; ?>">
<input type="submit" name="delete_button" value="Supprimer mon compte">
</form>
</div>