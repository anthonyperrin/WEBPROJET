<?php
//Affichage du formulaire de déconnexion
function DisplayFormDeconnection() {
    ?>
    <br><br>
    <form action="index.php" method="post">
        <input class="btn btn-danger" type="submit" name="submitdeconnection" value="Se déconnecter">
    </form>
    <?php
}

//Suppression de la session, tableau où sont stockées les valeurs de l'utilisateur connecté
//La fonction nous redirige vers index.php
function CheckFormDeconnection() {
    if (isset($_POST['submitdeconnection'])) {
        session_destroy();
        header("Location: index.php");
    }
}


?>
