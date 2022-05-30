<?php
require_once("../Config/bdd.php");
ini_set('display_errors', '1');


///////////////////////////////////////////////////////////////////////
//Fonctions pour récupérer tous les Vehicules de la BDD trié par prix croissant et par prix décroissant
$_GET['triParPrix'] = isset($_GET['triParPrix']) ? $_GET['triParPrix'] : NULL;
if (isset($_GET['btn_filtre_gestion_vehicule'])) {
  getAllVehiculesHomePrixCroissant($pdo);
  getAllVehiculesHomePrixDecroissant($pdo);
}

function getAllVehiculesHomePrixCroissant($pdo)
{
  // echo '<pre>'; print_r($pdo); echo '</pre>';  pour test
  $request = $pdo->prepare("SELECT vehicule.*, agences.titre AS titre_agence 
  FROM vehicule 
  INNER JOIN agences 
  USING (id_agence)
  ORDER BY prix_journalier ASC");
  $request->execute();
  return $request->fetchAll(PDO::FETCH_ASSOC);  //retourne un tableau associatif
}
$arrayVehiculesHomePrixCroissant = getAllVehiculesHomePrixCroissant($pdo);


function getAllVehiculesHomePrixDecroissant($pdo)
{
  // echo '<pre>'; print_r($pdo); echo '</pre>';  pour test
  $request = $pdo->prepare("SELECT vehicule.*, agences.titre AS titre_agence 
  FROM vehicule 
  INNER JOIN agences 
  USING (id_agence)
  ORDER BY prix_journalier DESC");
  $request->execute();
  return $request->fetchAll(PDO::FETCH_ASSOC);  //retourne un tableau associatif
}
$arrayVehiculesHomePrixDecroissant = getAllVehiculesHomePrixDecroissant($pdo);

//////////////////////////////////////////////////////////////////////////
// AFFICHAGE CHOIX AGENCE DANS HOME
function getAllAgencesPourHome($pdo)
{
  // echo '<pre>'; print_r($pdo); echo '</pre>';  pour test
  $request = $pdo->prepare("SELECT * FROM agences");
  $request->execute();
  return $request->fetchAll(PDO::FETCH_ASSOC);  //retourne un tableau associatif

}
$arrayAgencesHome = getAllAgencesPourHome($pdo);

/////////////////////////////////////////////////////////////////////////
// AFFICHER LE NOMBRE DE VEHICULES
////////////////////////////////////////////////////////////////////////
$_POST["id_agence"] = isset($_POST["id_agence"]) ? $_POST["id_agence"] : NULL;
if (isset($_POST["valider_vehicule"])) {
  afficher_nbre_vehicule_home($_POST["id_agence"], $pdo);
  getAllVehiculesHomeByAgencePrixCroissant($_POST["id_agence"], $pdo);
  calculateDateInterval($_POST);
}

if (isset($_GET['btn_filtre_gestion_vehicule2'])) {
  getAllVehiculesHomeByAgencePrixCroissant($_POST["id_agence"], $pdo);
  getAllVehiculesHomeByAgencePrixDecroissant($_POST["id_agence"], $pdo);
}

function  afficher_nbre_vehicule_home($id_agence, $pdo)
{
  if (isset($id_agence) and !empty($id_agence)) {
    $request = $pdo->prepare("SELECT id_vehicule 
    FROM vehicule 
    INNER JOIN agences 
    USING (id_agence) 
    WHERE id_agence ='$id_agence'");
    $request->execute();
    $count = $request->rowCount();
    return $count;
  }
}
$affichage_nbre_vehicule_home = afficher_nbre_vehicule_home($_POST["id_agence"], $pdo);



///////////////////////////////////////////////////////////////////////
//Fonctions pour récupérer les vehicules de la BDD par agence et par prix croissant ou décroissant
function getAllVehiculesHomeByAgencePrixCroissant($id_agence, $pdo)
{
  $request = $pdo->prepare("SELECT vehicule.*, agences.titre AS titre_agence 
  FROM vehicule 
  INNER JOIN agences 
  USING (id_agence) 
  WHERE id_agence ='$id_agence'
  ORDER BY prix_journalier ASC");

  $request->execute();
  return $request->fetchAll(PDO::FETCH_ASSOC);  //retourne un tableau associatif

}
$arrayVehiculesHomeByAgencePrixCroissant = getAllVehiculesHomeByAgencePrixCroissant($_POST["id_agence"], $pdo);


function getAllVehiculesHomeByAgencePrixDecroissant($id_agence, $pdo)
{
  $request = $pdo->prepare("SELECT vehicule.*, agences.titre AS titre_agence 
  FROM vehicule 
  INNER JOIN agences 
  USING (id_agence) 
  WHERE id_agence ='$id_agence'
  ORDER BY prix_journalier DESC");

  $request->execute();
  return $request->fetchAll(PDO::FETCH_ASSOC);  //retourne un tableau associatif

}
$arrayVehiculesHomeByAgencePrixDecroissant = getAllVehiculesHomeByAgencePrixDecroissant($_POST["id_agence"], $pdo);

///////////////////////////////////////////////////////////////////////
//Fonction pour calculer l'intervalle de temps entre deux dates
$_POST["date_heure_depart"] = isset($_POST["date_heure_depart"]) ? $_POST["date_heure_depart"] : NULL;
$_POST["date_heure_fin"] = isset($_POST["date_heure_fin"]) ? $_POST["date_heure_fin"] : NULL;

function calculateDateInterval($values)
{
  $startDate = new DateTime($values['date_heure_depart']);
  $endDate = new DateTime($values['date_heure_fin']);

  $difference = $endDate->diff($startDate);
  return $difference->format("%a");
}
$dateInterval = calculateDateInterval($_POST);

//////////////////////////////////////////////////////////////////////////
//Fonction pour ajouter les infos de commande dans la BDD (table commande)
//////////////////////////////////////////////////////////////////////////
$param = isset($_GET['param']) ? $_GET['param'] : NULL;
$_GET = isset($_GET) ? $_GET : NULL;
if ($param === "reserverVehicule") {
  postCommande($_GET, $pdo);
}

function postCommande($values, $pdo)
{
  $prix_total = $values['prixJournalier'] * $values['dateInterval'];
  $request = $pdo->prepare("INSERT INTO commande VALUES (NULL, :id_membre, :id_vehicule, :id_agence, :date_heure_depart, :date_heure_fin, :prix_total, now())");
  $request->bindParam(":id_membre", $values['idSession'], PDO::PARAM_INT);
  $request->bindParam(":id_vehicule", $values['idVehicule'], PDO::PARAM_INT);
  $request->bindParam(":id_agence", $values['idAgence'], PDO::PARAM_INT);
  $request->bindParam(":date_heure_depart", $values['dateDepart'], PDO::PARAM_STR);
  $request->bindParam(":date_heure_fin", $values['dateFin'], PDO::PARAM_STR);
  $request->bindParam(":prix_total", $prix_total, PDO::PARAM_INT);

  $request->execute();
}
