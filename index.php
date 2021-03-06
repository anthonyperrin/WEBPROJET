<?php session_start(); ?>
<?php include ("php/connection-fonction.php"); ?>
<?php include ("php/inscription-fonction.php"); ?>
<?php include ("php/deconnection-fonction.php"); ?>
<?php include ("php/recherche-livre-fonction.php"); ?>
<?php
ini_set("display_errors",0);
error_reporting(0);

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
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">
      <div class="container">
        <a class="navbar-brand" href="#">La maison du Livre</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
              <a class="nav-link" href="index.php">Accueil
                <span class="sr-only">(current)</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="inscription.php">Inscription</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="profil.php">Profil</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </header>
  <section>
    <div class="container">
      <br><br><br>
      <h2>Bienvenue sur le site de La Maison du Livre</h2>
      <br><br>
      <?php
      $_SESSION = CheckFormConnection($bdd);
      //Si l'utilisateur est connecté, on affiche la recherche de livre, sinon, on affiche le formaulaire de connexion
      if (empty($_SESSION)) {

        //Affichage formulaire de connexion
        DisplayFormConnection();
        //Connexion
        CheckFormInscription($bdd);

      } else { //si on est connectés
        ?>
        <h4>Rechercher un livre</h4>
        <br>
        <ul class="list-group" id="list-tab" role="tablist">
          <?php
          //affichage de la recherche de livre
          FormRechercheLivre($bdd);
          ?>
        </ul>


        <?php
        //Affichage du bouton de déconnexion
        DisplayFormDeconnection();
        //Déconnexion
        CheckFormDeconnection();
      }
      ?>
      <br><br><br>
    </div>
  </section>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
</body>
</html>
