<?php session_start(); ?>
<?php include("php/editerProfil-fonction.php"); ?>
<?php
try {
  $bdd = new PDO('mysql:host=127.0.0.1;dbname=espace_membre', 'root', '');
  $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  echo 'Échec lors de la connexion : ' . $e->getMessage();
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>La maison du livre</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom fonts for this template -->
  <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <link href="vendor/simple-line-icons/css/simple-line-icons.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">

  <!-- Custom styles for this template -->
  <link href="css/business-frontpage.css" rel="stylesheet">
</head>
<body class="bg-light">
  <header class="masthead">
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top" style="margin-bottom: 50px;">
      <div class="container">
        <a class="navbar-brand" href="#">La maison du Livre</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link" href="index.php">Accueil
                <span class="sr-only">(current)</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="inscription.php">Inscription</a>
            </li>
            <li class="nav-item active">
              <a class="nav-link" href="profil.php">Profil</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

  </header>
  <div class="container">
    <br><br><br>
    <h2>Mon profil</h2>
    <?php
    //Affichage des données du profil stockées dans $_SESSION
    $NomSession = $_SESSION['Nom_Membre'];
    echo "<br><b>Nom : </b>" . $_SESSION['Nom_Membre'] . "<br>";
    echo "<b>Prénom : </b>" . $_SESSION['Prenom_Membre'] . "<br>";
    echo "<b>Pseudo : </b>" . $_SESSION['Pseudo_Membre'] . "<br><br>";
    echo "<b>Date de naissance : </b>" . $_SESSION['DateNai_Membre'] . "<span class='text-secondary'> [Année - Mois - Jours] </span><br><br>";
    echo "<b>Adresse : </b>" . $_SESSION['Adresse1_Membre'] . "<br>";
    echo "<b>Complément d'adresse : </b>" . $_SESSION['Adresse2_Membre'] . "<br>";
    echo "<b>Ville : </b>" . $_SESSION['Ville_Membre'] . "<br>";
    echo "<b>Code postal : </b>" . $_SESSION['CP_Membre'] . "<br><br>";
    echo "<b>Téléphone : </b>" . $_SESSION['Tel_Membre'] . "<br>";
    echo "<b>Mail : </b>" . $_SESSION['Mail_Membre'] . "<br><br>";
    ?>
    <br><br>
    <h2>Editer mon Profil</h2>
    <br>
    <?php
    DisplayFormEdition();
    CheckFormEdition($bdd);

    ?>
  </div>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
</body>
</html>
