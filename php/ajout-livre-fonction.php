<?php
//Connnexion base de données
try {
  $bdd = new PDO('mysql:host=127.0.0.1;dbname=espace_membre', 'root', '');
  $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  echo 'Échec lors de la connexion : ' . $e->getMessage();
}

function DisplayFormAjoutAuteur() {
  ?>
    <form class="" action="admin.php" method="get">
      <input type="text" name="nomauteur" placeholder="">
      <input type="text" name="prenomauteur" placeholder="">
      <input type="date" name="datenaissauteur">
      <input type="submit" name="formajoutauteur" value="Valider">

    </form>
}
 ?>
