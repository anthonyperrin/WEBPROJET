<?php
try {
  $bdd = new PDO('mysql:host=127.0.0.1;dbname=espace_membre', 'root', '');
  $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  echo 'Échec lors de la connexion : ' . $e->getMessage();
}
//Affichage du formulaire
function DisplayFormEdition() {?>
  <form class="bg-faded" action="profil.php" method="POST">
    <h4>Informations personnelles :</h4><br>
    <div class="row">
      <div class="col">
        <input class="form-control" type="text" name="nom" placeholder="Nom..."><br>
      </div>
      <div class="col">
        <input class="form-control" type="text" name="prenom" placeholder="Prénom..."><br>
      </div>
    </div>
    <input class="form-control" type="text" name="pseudo" placeholder="Pseudo..."><br><br>

    <input class="form-control" type="date" name="datenaissance"><br><br>
    <h4>Adresse :</h4><br>
    <input class="form-control" type="text" name="adresse1" placeholder="Adresse..."><br>
    <input class="form-control" type="text" name="adresse2" placeholder="Complément d'adresse..."><br>
    <div class="row">
      <div class="col">
        <input class="form-control" type="text" name="ville" placeholder="Ville..."><br>
      </div>
      <div class="col">
        <input class="form-control" type="number" name="cp" placeholder="Code postal..."><br><br>
      </div>
    </div>

    <h4>Coordonnées :</h4><br>
    <input class="form-control" type="tel" name="telephone" placeholder="Téléphone..."><br>
    <div class="row">
      <div class="col">
        <input class="form-control" type="email" name="mail" placeholder="Mail...">
      </div>
      <div class="col">
        <input class="form-control" type="email" name="mail2" placeholder="Confirmation du mail..."><br><br>
      </div>
    </div>

    <h4>Mot de passe :</h4><br>
    <div class="row">
      <div class="col">
        <input class="form-control" type="password" name="mdp" placeholder="Mot de passe...">
      </div>
      <div class="col">
        <input class="form-control" type="password" name="mdp2" placeholder="Mot de passe"><br><br>
      </div>
    </div>

    <input class="btn btn-primary" type="submit" name="forminscription" value="Editer mon profil">
    <br><br><br><br>
    <?php
  }
  //Vérification des données
  function CheckFormEdition($bdd) {
    if(isset($_POST['formedition'])) {
      //Variables du formulaire d'édition du profil

      $id = $_SESSION['ID_Membre'];
      $nom = htmlspecialchars($_SESSION['nom']);
      $prenom = htmlspecialchars($_POST['prenom']);
      $pseudo = htmlspecialchars($_POST['pseudo']);

      $datenaissance = $_POST['datenaissance'];

      $adresse1 = htmlspecialchars($_POST['adresse1']);
      $adresse2 = htmlspecialchars($_POST['adresse2']);
      $ville = htmlspecialchars($_POST['ville']);
      $cp = $_POST['cp'];

      $tel = $_POST['telephone'];
      $mail = htmlspecialchars($_POST['mail']);
      $mail2 = htmlspecialchars($_POST['mail2']);

      $mdp = sha1($_POST['mdp']);
      $mdp2 = sha1($_POST['mdp2']);
      //Traitement du formulaire de changement de profil
      if(!empty($nom) AND !empty($prenom) AND !empty($pseudo) AND !empty($datenaissance) AND
      !empty($adresse1) AND!empty($mail) AND !empty($mail2) AND !empty($mdp) AND !empty($mdp2)) {
        $pseudolenght = strlen($pseudo);
        //si le pseudo
        if ($pseudolenght <= 100) {
          //si le code est de format 34000
          if (preg_match("#^[0-9]{5}$#", $cp)) {
            //Si le tel est de format 06 09 09 09 09
            if (preg_match("#^0[0-9]{9}$#", $tel)) {
              //Si les deux mails correspondent
              if ($mail == $mail2) {
                //Si l'email est correct
                if (filter_var($mail, FILTER_VALIDATE_EMAIL)) {
                  //Si les mots de passe correspondent
                  if ($mdp == $mdp2) {
                    //On update les données dans la bdd
                    $modifmbr = $bdd->prepare("UPDATE `membre`
                      SET `Nom_Membre`='$nom',
                      `Prenom_Membre`='$prenom',
                      `Pseudo_Membre`='$pseudo',
                      `DateNai_Membre`='$datenaissance',
                      `Adresse1_Membre`='$adresse1',
                      `Adresse2_Membre`='$adresse2',
                      `Ville_Membre`='$ville',
                      `CP_Membre`='$cp',
                      `Tel_Membre`='$tel',
                      `Mail_Membre`='$mail',
                      `Mdp_membre`='$mdp'
                      WHERE ID_Membre = ?");
                      $modifmbr->execute(array($nom, $prenom, $pseudo, $datenaissance, $adresse1, $adresse2, $ville, $cp, $tel, $mail, $mdp));
                      echo "Votre compte a bien été mise à jour ! <a href=\"index.php\">Retourner à l'accueil</a>";
                    } else {
                      $erreur = "La vérification des mots de passe a échoué";
                    }
                  } else {
                    $erreur = "Email invalide !";
                  }
                } else {
                  $erreur = "La vérification du mail a échoué !";
                }
              } else {
                $erreur = "Numéro de téléphone invalide !";
              }
            } else {
              $erreur = "Code postal invalide !";
            }
          } else {
            $erreur = "Pseudo ne doit pas dépasser 100 caractères !";
          }
        } else{
          $erreur = "Tous les champs ne sont pas remplis";
        }
        echo $erreur;
      }
    }
    ?>
