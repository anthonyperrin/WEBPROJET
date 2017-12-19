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
      <form class="" action="index.php" method="POST">
          <input type="mail" name="mailconnection" placeholder="Email de connection...">
          <input type="password" name="mdpconnection" placeholder="Mot de passe...">
          <input type="submit" name="formconnection" placeholder="Se connecter">
      </form>
      <a href="inscription.php">S'inscrire</a><br>
      <a href="admin.php">Espace administrateur</a>
    <?php
}

//Vérification du formulaire
//[OUT] = 
function CheckFormConnection($bdd) {
    if (isset($_POST['formconnection'])) {
        $mailconnect = $_POST['mailconnection'];
        $mdpconnect = sha1($_POST['mdpconnection']);
        $erreur = "";
        //si les deux champs sont remplis
        if (!empty($mailconnect) AND !empty($mdpconnect)) {
            //on regarde si le couple mdp mail correspond à un couple prérempli dans la bdd
            $requser = $bdd->prepare("SELECT * FROM membre WHERE Mail_Membre = ? AND Mdp_Membre = ?");
            $requser->execute(array($mailconnect, $mdpconnect));
            $userexist = $requser->rowCount();
            //si il retourne une ligne
            if ($userexist == 1) {
                $userinfo = $requser->fetch();
                //on met les infos du l'utilisateur en $_SESSION
                $_SESSION = $userinfo;
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
