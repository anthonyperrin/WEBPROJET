<?php
try {
  $bdd = new PDO('mysql:host=127.0.0.1;dbname=espace_membre', 'root', '');
  $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  echo 'Échec lors de la connexion : ' . $e->getMessage();
}

//Affichage du formulaire
function DisplayFormInscription() {?>
  <form class="bg-faded" action="inscription.php" method="POST">
    <input type="text" name="nom" placeholder="Nom..."><br>
    <input type="text" name="prenom" placeholder="Prénom..."><br>
    <input type="text" name="pseudo" placeholder="Pseudo..."><br><br>

    <input type="date" name="datenaissance"><br><br>

    <input type="text" name="adresse1" placeholder="Adresse..."><br>
    <input type="text" name="adresse2" placeholder="Complément d'adresse..."><br>
    <input type="text" name="ville" placeholder="Ville..."><br>
    <input type="number" name="cp" placeholder="Code postal..."><br><br>

    <input type="tel" name="telephone" placeholder="Téléphone..."><br>
    <input type="email" name="mail" placeholder="Mail...">
    <input type="email" name="mail2" placeholder="Confirmation du mail..."><br><br>

    <input type="password" name="mdp" placeholder="Mot de passe...">
    <input type="password" name="mdp2" placeholder="Mot de passe"><br><br>

    <input type="submit" name="forminscription" value="S'inscrire">
  </form>
  <?php
}

//Vérification des données
function CheckFormInscription($bdd) {
  //Si on valide le formulaire
  if(isset($_POST['forminscription'])) {
    //Variables du formulaire d'inscription
    $nom = htmlspecialchars($_POST['nom']);
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
    //Traitement du formulaire d'inscription
    //Si tous les champs sont remplis
    if(!empty($nom) AND !empty($prenom) AND !empty($pseudo) AND !empty($datenaissance) AND !empty($adresse1) AND!empty($mail) AND !empty($mail2) AND !empty($mdp) AND !empty($mdp2)) {
      $pseudolenght = strlen($pseudo);
      //Si le pseudo est plus court que 100 caractères
      if ($pseudolenght <= 100) {
        //Si le CP a bien la forme "34000"
        if (preg_match("#^[0-9]{5}$#", $cp)) {
          //Si le tel a bien la forme 06 09 09 09 09
          if (preg_match("#^0[0-9]{9}$#", $tel)) {
            //Si les deux mails correspondent
            if ($mail == $mail2) {
              //Si l'email est valide
              if (filter_var($mail, FILTER_VALIDATE_EMAIL)) {
                //On regarde si l'email est déjà utilisé
                $reqmail = $bdd->prepare("SELECT * FROM membre WHERE Mail_Membre = ?");
                $reqmail->execute(array($mail));
                $mailexist = $reqmail->rowCount();
                //Si il n'est pas encore utilisé
                if ($mailexist == 0) {
                  //Si les mots de passe correspondent
                  if ($mdp == $mdp2) {
                    //On rentre les valeurs du formulaire dans la bdd
                    $insertmbr = $bdd->prepare("INSERT INTO `membre` (`Nom_Membre`, `Prenom_Membre`, `Pseudo_Membre`, `DateNai_Membre`, `Adresse1_Membre`, `Adresse2_Membre`, `Ville_Membre`, `CP_Membre`, `Tel_Membre`, `Mail_Membre`, `Mdp_Membre`)
                    VALUES ('$nom', '$prenom', '$pseudo','$datenaissance', '$adresse1', '$adresse2','$ville', '$cp', '$tel', '$mail', '$mdp')");
                    $insertmbr->execute(array($pseudo, $mail, $mdp));
                    $erreur = "Votre compte a bien été créé ! <a href=\"index.php\">Me Connecter</a>";
                  } else {
                    $erreur = "La vérification des mots de passe a échoué";
                  }
                } else {
                  $erreur = "Mail déjà utilisé !";
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
    //On affiche le résultat de la validation du formulaire d'inscription
    echo $erreur;
  }
}
?>
