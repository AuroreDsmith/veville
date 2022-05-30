<?php
require_once("../Config/bdd.php");
ini_set('display_errors', '1');

///////////////////////////////////////////////////////////////////////
//Affichage des informations du compte membre
$param = isset($_GET['param']) ? $_GET['param'] : NULL;
$_GET['idMembre'] = isset($_GET['idMembre']) ? $_GET['idMembre'] : NULL;

if ($param === "infoMembre") {
  getMembreInfo($pdo, $_GET['idMembre']);
  getCommandesMembre($pdo, $_GET['idMembre']);
}

function getMembreInfo($pdo, $idMembre)
{
  $request = $pdo->prepare("SELECT * FROM membre WHERE id_membre='$idMembre'");
  $request->execute();
  return $request->fetchAll(PDO::FETCH_ASSOC);
}

$arrayInfoMembre = getMembreInfo($pdo, $_GET['idMembre']);


///////////////////////////////////////////////////////////////////////
//Affichage des commandes passées du membre
function getCommandesMembre($pdo, $idMembre)
{
  // echo '<pre>'; print_r($pdo); echo '</pre>';  pour test
  $request = $pdo->prepare("SELECT commande.*, membre.id_membre AS membre_id_membre, nom, prenom, email, vehicule.id_vehicule AS vehicule_id_vehicule, vehicule.titre AS titre_vehicule, agences.id_agence AS agence_id_agence, agences.titre AS titre_agence 
  FROM commande
  INNER JOIN membre 
  ON membre.id_membre = commande.id_membre
  INNER JOIN vehicule 
  ON vehicule.id_vehicule = commande.id_vehicule
  INNER JOIN agences 
  ON agences.id_agence = commande.id_agence
  WHERE membre.id_membre = '$idMembre'
  ");
  $request->execute();
  return $request->fetchAll(PDO::FETCH_ASSOC);  //retourne un tableau associatif

}
$arrayCommandesMembre = getCommandesMembre($pdo, $_GET['idMembre']);
