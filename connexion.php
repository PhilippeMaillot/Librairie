<?php include('nav.php') ?>
<div class="cadre2">
    <?php if (isset($message)) { ?>
        <p><?php echo $message; ?></p>
    <?php } ?>
    <form action="php_co.php">
        <p>Email <input name="email" type="email"></p>
        <p>Mot de passe <input name="mdp" type="password"></p>
        <input type="submit" class="btn2" value="Confirmer"><br/>
    </form>
</div>
</body>
</html>
