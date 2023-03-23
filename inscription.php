<?php include('nav.php') ?>
<script>
function validerFormulaire() {
  var nom = document.getElementById("nom").value;
  var email = document.getElementById("email").value;
  var mdp = document.getElementById("mdp").value;
  
  if (nom == "" || email == "" || mdp == "") {
    alert("Veuillez remplir tous les champs");
    return false; // empêche l'envoi du formulaire si des champs sont vides
  }
  
  return true; // autorise l'envoi du formulaire si tous les champs sont remplis
}
</script>
<div class="cadre2">
    <form action="php_insc.php" method="get">
        <p>Nom <input id="nom" name="nom" type="text"/></p> 
        <p>Email <input id="email" name="email" type="email"/></p>
        <p>Mot de passe <input id="mdp" name="mdp" type="password"></p>
        <input type="submit" onclick="return validerFormulaire()" class="btn2" value="Confirmer"/><br/>
    </form> 
</div>
</body>
</html>