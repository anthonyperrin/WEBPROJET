<?php
//Connnexion base de données
try {
    $bdd = new PDO('mysql:host=127.0.0.1;dbname=espace_membre', 'root', '');
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Échec lors de la connexion : ' . $e->getMessage();
}
?>
<?php
function verifChamp( $bdd, $CodeISBM, $Titre_Livre, $AnneeParution_Livre, $Nom_Auteur, $Prenom_Auteur, $Resume_Livre, $Stock, $Type_Categorie){
    if (!empty($CodeISBM)) {
        if (!empty($Titre_Livre)) {
            if (!empty($AnneeParution_Livre)) {
                if (!empty($Nom_Auteur)) {
                    if (!empty($Prenom_Auteur)) {
                        if (!empty($Resume_Livre)) {
                            if (!empty($Stock)) {
                                if (!empty($Type_Categorie)) {
                                    if (preg_match("#^[0-9]{13}$#", $CodeISBM)) {
                                        if (preg_match("#^[A-Za-z]{0,25}$#",$Nom_Auteur)) {
                                            if (preg_match("#^[A-Za-z]{0,25}$#",$Prenom_Auteur)) {
                                                if (preg_match("#^[0-9]+$#", $Stock)) {
                                                    // ID AUTEUR DOIT CORESSPONDRE, A AJOUTER OUI JECRI MAL
                                                    $insertbook = $bdd->prepare("INSERT INTO `livre` (`CodeISBM`, `Titre_Livre`, `Resume_Livre`,`Stock`, `AnneeParution_Livre`, `ID_Categorie`)
                                                                                 VALUES ('$CodeISBM', '$Titre_Livre', '$Resume_Livre', '$Stock', '$AnneeParution_Livre', '$Type_Categorie')");
                                                    try {
                                                        $insertbook->execute(array($CodeISBM, $Titre_Livre, $Resume_Livre, $Stock, $AnneeParution_Livre, $Type_Categorie));
                                                        echo 'Le livre a bien été ajouté !';
                                                    } catch (PDOException $e) {
                                                        echo $e->getMessage();
                                                    }
                                                }else {
                                                    echo "Merci d'entrer un nombre d'exemplaire conforme.";
                                                }
                                            }else {
                                                echo "Merci d'entrer un prenom d'auteur valide.";
                                            }
                                        }else {
                                            echo "Merci d'entrer un bon nom d'auteur.";
                                        }
                                    }else {
                                        echo "Merci d'entrer un bon code ISBN.";
                                    }
                                }else {
                                    echo "Merci de choisir une categorie.";
                                }
                            }else {
                                echo "Le champ nombre d'exemplaire est vide !";
                            }
                        }else {
                            echo "Le champ résumé du livre est vide !";
                        }
                    }else {
                        echo "Le champ prenom auteur est vide !";
                    }
                }else {
                    echo "Le champ nom de l'auteur est vide !";
                }
            }else {
                echo "Le champ Année de parution est vide !";
            }
        }else {
            echo "Le champ Titre du livre est vide !";
        }
    }else {
        echo "Le champ code ISBN est vide !";
    }
}