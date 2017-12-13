<?php
//Connnexion base de données
try {
    $bdd = new PDO('mysql:host=127.0.0.1;dbname=espace_membre', 'root', '');
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Échec lors de la connexion : ' . $e->getMessage();
}

//Affichage du formulaire de connexion
function DisplayFormConnection() {
    ?>
    <div class="container bg-faded">
        <form class="" action="index.php" method="POST">
            <input type="mail" name="mailconnection" placeholder="Email de connection...">
            <input type="password" name="mdpconnection" placeholder="Mot de passe...">
            <input type="submit" name="formconnection" placeholder="Se connecter">
        </form>
        <a href="inscription.php">S'inscrire</a><br>
        <a href="admin.php">Espace administrateur</a>
    </div>
    <?php
}

//Vérification du formulaire
function CheckFormConnection($bdd) {
    if (isset($_POST['formconnection'])) {
        $mailconnect = $_POST['mailconnection'];
        $mdpconnect = sha1($_POST['mdpconnection']);
        $erreur = "";
        if (!empty($mailconnect) AND !empty($mdpconnect)) {
            $requser = $bdd->prepare("SELECT * FROM membre WHERE Mail_Membre = ? AND Mdp_Membre = ?");
            $requser->execute(array($mailconnect, $mdpconnect));
            $userexist = $requser->rowCount();
            if ($userexist == 1) {
                $userinfo = $requser->fetch();
                $_SESSION = $userinfo;
                //header("Location: index.php?id=".$_SESSION['0']);
                echo 'vous êtes connecté!';
            } else {
                $erreur = "Mail ou mot de passe incorrect !";
            }
        } else {
            $erreur = "Tous les champs doivent être complétés !";
        }
        echo $erreur;
    }
    return $_SESSION;
}


?>
