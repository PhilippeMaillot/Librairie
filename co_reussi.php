<?php
            session_start();
            if(isset($_SESSION['admin'])){
        ?>
<P>Bonjour vous êtes connecté <?= htmlspecialchars($_SESSION['admin']['nom']) ?> </p>
<?php } header("Location: index.php");
        exit;
?>
