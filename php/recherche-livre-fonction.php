<?php
//Connnexion base de données

try {
  $bdd = new PDO('mysql:host=127.0.0.1;dbname=espace_membre', 'root', '');
  $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  echo 'Échec lors de la connexion : ' . $e->getMessage();
}

function FormRechercheLivre($bdd){
  ?>
  <form class="" action="index.php" method="post">
    <input type="search" name="inputrecherchelivre" placeholder="Titre du livre...">
    <input type="submit" name="submitrecherchelivre" value="Rechercher">
  </form>
  <br>
  <?php
  if(isset($_POST['submitrecherchelivre'])){
    $titrelivre = $_POST['inputrecherchelivre'];
    $requser = $bdd->query('SELECT Titre_Livre FROM livre WHERE Titre_Livre LIKE "%'.$titrelivre.'%"');
    $displaylistelivre = $requser->fetchall();
    foreach ($displaylistelivre as $recherche) {
      echo '<a href="#">' . $recherche['Titre_Livre'] . '</a><br>';
      ?>

      <?php
    }

  }
  /*$requser = $bdd->query("SELECT ID_Auteur, Nom_Auteur FROM auteur");
  $queryauteur = $requser->fetchall();
  ?>
  <form class="" action="index.php" method="post">
    <label for="auteurselection">Auteurs</label>
    <select class="" name="auteur">
      <?php
      foreach ($queryauteur as $ligne) {
        ?>
        <option value="<?= $ligne["ID_Auteur"]; ?>"><?= $ligne["Nom_Auteur"]; ?></option>
        <?php
      }
      ?>
    </select>
    <input type="submit" name="submitrecherchelivreauteur" value="Rechercher">
  </form>
  <br><br><br>
  <?php
  //lorsqu'on lance la recherche
  if(isset($_POST['submitrecherchelivreauteur'])){
    $requser = $bdd->query("SELECT `Titre_Livre` FROM `livre`, `auteur` WHERE livre.ID_Auteur=auteur.ID_Auteur AND livre.ID_Auteur=$ligne\[\'ID_Auteur\'\]");
    $titrelivre = $requser->fetch();
    echo '<strong>Liste des livres :</strong><br>';
    echo '<a href="#">' . $titrelivre['Titre_Livre'] . '</a>';

  }*/
}
?>
