<?php
ini_set("display_errors",0);error_reporting(0);
?>
  <?php
  function retirerLivre($bdd, $CodeISBM,$Date){
      $emprunt=$bdd->prepare("UPDATE livre SET Stock=Stock-1 WHERE CodeISBM = ?");
    try {
      $emprunt->execute(array($CodeISBM));
    } catch (PDOException $e) {
      echo $e->getMessage();
    }

    $emprunter=$bdd->prepare("INSERT INTO `exemplaire`(`DateDebut_Emprunt`, `CodeISBM`) 
                             
                              VALUES ('$Date','$CodeISBM')");
    try {
      $emprunter->execute(array(
          'CodeISBM' => $CodeISBM
      ));
    } catch (PDOException $e) {
      echo $e->getMessage();
    }
    $livreExist = $emprunt->rowCount();
    if ($livreExist==1) {
      $emprunt --;
      echo "Le livre a été emprunté";
    }else {
      echo "Le livre n'existe pas";
    }
  }
?>
