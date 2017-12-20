<?php
//Connnexion base de données

try {
  $bdd = new PDO('mysql:host=127.0.0.1;dbname=espace_membre', 'root', '');
  $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  echo 'Échec lors de la connexion : ' . $e->getMessage();
}

//Formulaire de recherche de livre par titre, auteur ou catégorie
function FormRechercheLivre($bdd){
  ?>
  <form class="col-5" action="index.php" method="post">
    <select class="form-control"  name="optionrecherchelivre">
      <option value="1">Titre</option>
      <option value="2">Auteur</option>
      <option value="3">Catégorie</option>
    </select>
    <br>
    <input class="form-control" type="search" name="inputrecherchelivre" placeholder="Titre, auteur, ou catégorie...">
    <br>
    <input class="btn btn-primary" type="submit" name="submitrecherchelivre" value="Rechercher">
  </form>
  <br>
  <?php
  //Test de validation du formulaire de recherche de livre
  if (isset($_POST['submitrecherchelivre'])) {
    $inputrecherche = $_POST['inputrecherchelivre'];
    $requete = 'SELECT Titre_Livre FROM livre WHERE TRUE';
    // Cas 1:
    // On cherche par titre
    switch ($_POST['optionrecherchelivre']) {
      case 1:
      $requete = "SELECT Titre_Livre, Nom_Auteur, Prenom_Auteur, Type_Categorie
                  FROM livre, auteur, categorie
                  WHERE livre.ID_Categorie=categorie.ID_Categorie AND livre.ID_Auteur=auteur.ID_Auteur AND livre.Titre_Livre
                  LIKE '%" . $inputrecherche . "%'";
      break;
      // Cas 2:
      // On cherche par auteur
      case 2:
        $requete = "SELECT Titre_Livre, Nom_Auteur, Prenom_Auteur, Type_Categorie
                    FROM livre, auteur, categorie
                    WHERE livre.ID_Categorie=categorie.ID_Categorie AND livre.ID_Auteur=auteur.ID_Auteur AND auteur.Nom_Auteur
                    LIKE '%" . $inputrecherche . "%'";
      break;
      // Cas 3:
      // On cherche par catégorie
      case 3:
        $requete = "SELECT Titre_Livre, Nom_Auteur, Prenom_Auteur, Type_Categorie
                    FROM livre, categorie, auteur
                    WHERE livre.ID_Categorie=categorie.ID_Categorie AND livre.ID_Auteur=auteur.ID_Auteur AND categorie.Type_Categorie
                    LIKE '%" . $inputrecherche . "%'";
      break;
    }
    //Requête de test
    $requser = $bdd->query($requete);
    $displaylistelivre = $requser->fetchall();
    //On display la liste des livres trouvés
    foreach ($displaylistelivre as $recherche) {
      echo '<li>"' . $recherche['Titre_Livre'] . '", <em>' .
      $recherche['Prenom_Auteur'] . ' ' . $recherche['Nom_Auteur'] . ', <span class="text-secondary">' .
      $recherche['Type_Categorie'] . '</span>' .
      '</em>' . '</li>';
    }
    //Si on trouve aucun livre, on affiche une erreur
    $testrecherchelivre = $requser->rowCount();
    if ($testrecherchelivre == 0) {
      echo 'Aucun livre ne correspond à cette recherche.';
    }
  }
}
?>
