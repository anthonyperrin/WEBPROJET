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
    <div class="row">
      <div class="col-3">
        <input class="form-control" type="mail" name="mailconnection" placeholder="Email de connection...">
      </div>
      <div class="col-3">
        <input class="form-control" type="password" name="mdpconnection" placeholder="Mot de passe...">
      </div>
    </div>
    <br>
    <input class="btn btn-primary" type="submit" name="formconnection" placeholder="Se connecter">
  </form>
  <br>
  <a href="inscription.php">S'inscrire</a><br>
  <a href="admin.php">Espace administrateur</a>
  <?php
}

//Vérification du formulaire
//[OUT] = données de l'utilisateur dans $_SESSION
function CheckFormConnection($bdd) {
  //Si on valide le formulaire de connexion
  if (isset($_POST['formconnection'])) {
    $mailconnect = $_POST['mailconnection'];
    $mdpconnect = sha1($_POST['mdpconnection']);
    $erreur = "";
    //si les deux champs sont remplis
    if (!empty($mailconnect) AND !empty($mdpconnect)) {
      //on regarde si le couple mdp mail correspond à un couple prérempli dans la bdd
      $requserco = $bdd->prepare("SELECT * FROM membre WHERE Mail_Membre = ? AND Mdp_Membre = ?");
      $requserco->execute(array($mailconnect, $mdpconnect));
      $userexist = $requserco->rowCount();
      //si il retourne une ligne
      if ($userexist == 1) {
        $userinfo = $requserco->fetch();
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
