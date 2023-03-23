<?php include('nav.php') ?>
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