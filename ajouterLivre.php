<?php
include("php/ajouterLivre-fonction.php");
ini_set("display_errors",0);
error_reporting(0);
?>
<!doctype html>
<html lang="en">
<head>
  <title>Hello, world!</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
</head>
<body>
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
<br><br><br>
    <div class="container">
      <br><br>
      <h2>Ajouter un livre</h1>
        <br><br>
      <form action="ajouterLivre.php" method="post">
        <h4>Informations générales</h4>
        <br>
        <div class="row">
          <div class="col">
            <input class="form-control" type="text" name="Titre_Livre" placeholder="Titre du livre"><br />
          </div>
          <div class="col">
            <input class="form-control" type="text" placeholder="Code ISBN" name="CodeISBM"><br />
          </div>
          <div class="col">
            <input class="form-control" type="date" name="AnneeParution_Livre" placeholder="Année de sortie du livre"><br />
          </div>
        </div>
        <br>
        <h4>Stock</h4>
        <br>
        <input class="form-control" type="text" name="Stock" placeholder="Nombre d'exemplaire(s)"><br />
        <br>
        <h4>Auteur</h4>
        <br>
        <div class="row">
          <div class="col">
            <input class="form-control" type="text" name="Nom_Auteur" placeholder="Nom de l'auteur"><br />
          </div>
          <div class="col">
            <input class="form-control" type="text" name="Prenom_Auteur" placeholder="Prenom de l'auteur"><br />
          </div>
        </div>
        <br>
        <h4>Livre</h4>
        <br>
        <select class="form-control" name="Type_Categorie">
          <option value="RomansEtLittérature">Romans et littérature</option>
          <option value="RomanPolicier">Roman Policier</option>
          <option value="Romance">Romance</option>
          <option value="BD">Bande dessinées</option>
          <option value="Jeunesse">Jeunesse</option>
          <option value="LivreAdo">Livres Ado</option>
          <option value="BienEtre">Bien-être</option>
          <option value="Cuisine">Cuisine</option>
          <option value="Tourisme">Tourisme</option>
          <option value="LivresEtrangers">Livre étrangers</option>
        </select><br>
        <textarea class="form-control" name="Resume_Livre" rows="8" cols="80" placeholder="Résumé du livre"></textarea><br>
        <input class="btn btn-primary" type="submit" name="" value="Ajouter">
      </form>
      <br>
      <?php
      if ($_POST['Type_Categorie']== 'RomansEtLittérature') {
        $Type_Categorie = 1;
      }
      elseif ($_POST['Type_Categorie']== 'RomanPolicier' ) {
        $Type_Categorie = 2;
      }
      elseif ($_POST['Type_Categorie']== 'Romance' ) {
        $Type_Categorie = 3;
      }
      elseif ($_POST['Type_Categorie']== 'BD' ) {
        $Type_Categorie = 4;
      }
      elseif ($_POST['Type_Categorie']== 'Jeunesse' ) {
        $Type_Categorie = 5;
      }
      elseif ($_POST['Type_Categorie']== 'LivreAdo' ) {
        $Type_Categorie = 6;
      }
      elseif ($_POST['Type_Categorie']== 'BienEtre' ) {
        $Type_Categorie = 7;
      }
      elseif ($_POST['Type_Categorie']== 'Cuisine' ) {
        $Type_Categorie = 8;
      }
      elseif ($_POST['Type_Categorie']== 'Tourisme' ) {
        $Type_Categorie = 9;
      }
      elseif ($_POST['Type_Categorie']== 'LivresEtrangers' ) {
        $Type_Categorie = 10;
      }
      $CodeISBM = htmlspecialchars($_POST['CodeISBM']);
      $Titre_Livre = htmlspecialchars($_POST['Titre_Livre']);
      $AnneeParution_Livre = htmlspecialchars($_POST['AnneeParution_Livre']);
      $Nom_Auteur = htmlspecialchars($_POST['Nom_Auteur']);
      $Prenom_Auteur = htmlspecialchars($_POST['Prenom_Auteur']);
      $Resume_Livre = htmlspecialchars($_POST['Resume_Livre']);
      $Stock = htmlspecialchars($_POST['Stock']);

      verifChamp($bdd, $CodeISBM, $Titre_Livre, $AnneeParution_Livre, $Nom_Auteur, $Prenom_Auteur, $Resume_Livre, $Stock, $Type_Categorie);
      ?>
    </div>
    <br><br><br>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
  </body>
  </html>
