<?php session_start(); ?>
<?php
include("php/retirerLivre-fonction.php");
ini_set("display_errors",0);
error_reporting(0);
?>

<?php
//Connnexion base de données
try {
  $bdd = new PDO('mysql:host=127.0.0.1;dbname=espace_membre', 'root', '');
  $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  echo 'Échec lors de la connexion : ' . $e->getMessage();
}
?>
<!doctype html>
<html lang="en">
  <head>
    <title>La maison du livre</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
  </head>

  <body>
    <header class="">
      <!-- Navigation -->
      <nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top" style="margin-bottom: 50px;">
        <div class="container">
          <a class="navbar-brand" href="#">La maison du Livre - administrateur</a>
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
    <section>
      <br><br><br>
      <div class="container">
        <br><br>
        <h2>Retirer un livre</h2>
        <br><br>
        <!-- Formulaire emprunt livre -->
        <form action="retirerlivre.php" method="POST">
          <div class="row">
            <div class="col">
              <input class="form-control" type="text" placeholder="Code ISBN du livre" name="CodeISBM"><br/>
            </div>
            <div class="col">
              <input class="form-control" type="date" name="date" value="<?php echo date('Y-m-d'); ?>"><br/>
            </div>
          </div>
          <?php
          $date = date('Y-m-d', strtotime($_POST['date']));
          $CodeISBM = htmlspecialchars($_POST['CodeISBM']);
          //appelle fonction
          retirerLivre($bdd, $CodeISBM, $date);
          ?>
          <br><br>
          <input class="btn btn-primary" type="submit" value="Retirer">
        </form>

      </div>
    </section>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
  </body>
</html>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js"
integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh"
crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js"
integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ"
crossorigin="anonymous"></script>
</body>
</html>
