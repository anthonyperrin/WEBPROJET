<?php
function DisplayFormDeconnection() {
    ?>
    <form action="index.php" method="post">
        <input type="submit" name="submitdeconnection" value="Se déconnecter">
    </form>
    <?php
}

function CheckFormDeconnection() {
    if (isset($_POST['submitdeconnection'])) {
        session_destroy();
        header("Location: index.php");
    }
}


?>
