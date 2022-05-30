<?php
require_once("../Config/bdd.php");
ini_set('display_errors', '1');

if (isset($_POST["enregistrer_vehicule"])) {
  postVehicule($_POST, $pdo);
}

function postVehicule($values, $pdo)
{
  $request = $pdo->prepare("INSERT INTO vehicule VALUES (NULL, :id_agence, :titre, :marque, :modele, :description, :photo, :prix_journalier)");
  $request->bindParam(":id_agence", $values['id_agence'], PDO::PARAM_STR);
  $request->bindParam(":titre", $values['titre_vehicule'], PDO::PARAM_STR);
  $request->bindParam(":marque", $values['marque_vehicule'], PDO::PARAM_STR);
  $request->bindParam(":modele", $values['modele_vehicule'], PDO::PARAM_STR);
  $request->bindParam(":description", $values['description_vehicule'], PDO::PARAM_STR);
  $request->bindParam(":photo", $values['photo_vehicule'], PDO::PARAM_STR);
  $request->bindParam(":prix_journalier", $values['prix_vehicule'], PDO::PARAM_STR);

  $request->execute();
}


//Fonction pour récupérer les données de la BDD
function getAllVehicules($pdo)
{
  // echo '<pre>'; print_r($pdo); echo '</pre>';  pour test
  $request = $pdo->prepare("SELECT vehicule.*, agences.titre AS titre_agence FROM vehicule INNER JOIN agences USING (id_agence)");
  $request->execute();
  return $request->fetchAll(PDO::FETCH_ASSOC);  //retourne un tableau associatif

}
$arrayVehicules = getAllVehicules($pdo);
// echo '<pre>'; print_r($arrayArticles); '</pre>';

////////////////////////////////////////////////////////////////////////
// AFFICHER UN VEHICULE EN DETAIL
$param = isset($_GET['param']) ? $_GET['param'] : NULL;
$_GET['id'] = isset($_GET['id']) ? $_GET['id'] : NULL;
if ($param === "detailVehicule") {
  detailVehicule($pdo, $_GET['id']);
}

function detailVehicule($pdo, $id)
{

  $request = $pdo->prepare("SELECT * FROM vehicule WHERE id_vehicule='$id'");
  $request->execute();
  return $request->fetchAll(PDO::FETCH_ASSOC);
}

$arrayDetailVehicule = detailVehicule($pdo, $_GET['id']);


/////////////////////////////////////////////////////////////////////////
// AFFICHER UN VEHICULE DANS LE FORMULAIRE

$edit = isset($_GET['param']) ? $_GET['param'] : NULL;
if ($edit === "updateVehicule") {

  afficher_vehicule_pour_edition($pdo, $_GET['id']);
}

function  afficher_vehicule_pour_edition($pdo, $id)
{
  if (isset($id) and !empty($id)) {
    // $get_id = htmlspecialchars($id);

    $request = $pdo->prepare("SELECT vehicule.*, agences.titre AS titre_agence FROM vehicule INNER JOIN agences USING (id_agence) WHERE id_vehicule='$id'");
    $request->execute();

    // Vérification que l'article existe bien
    if ($request->rowCount() == 1) {
      return $request->fetchAll(PDO::FETCH_ASSOC);
    }
  }
}
$arrayAfficherVehicule =  afficher_vehicule_pour_edition($pdo, $_GET['id']);



//////////////////////////////////////////////////////////////////////////
// AFFICHAGE CHOIX AGENCE DANS LE FORMULAIRE
function getAllAgencesPourVehiculeEdition($pdo)
{
  // echo '<pre>'; print_r($pdo); echo '</pre>';  pour test
  $request = $pdo->prepare("SELECT * FROM agences");
  $request->execute();
  return $request->fetchAll(PDO::FETCH_ASSOC);  //retourne un tableau associatif

}
$arrayAgencesPourVehicules = getAllAgencesPourVehiculeEdition($pdo);


///////////////////////////////////////////////////////////////////////
//Fonction pour récupérer les vehicules de la BDD filtré par agence
$_POST["id_agence"] = isset($_POST["id_agence"]) ? $_POST["id_agence"] : NULL;
if (isset($_POST["btn_filtre_gestion_vehicule"])) {
  getAllVehiculesFiltreByAgence($_POST["id_agence"], $pdo);
}

function getAllVehiculesFiltreByAgence($id_agence, $pdo)
{
  $request = $pdo->prepare("SELECT vehicule.*, agences.titre AS titre_agence 
  FROM vehicule 
  INNER JOIN agences 
  USING (id_agence) 
  WHERE id_agence ='$id_agence'");

  $request->execute();
  return $request->fetchAll(PDO::FETCH_ASSOC);  //retourne un tableau associatif

}
$arrayVehiculesFiltreByAgence = getAllVehiculesFiltreByAgence($_POST["id_agence"], $pdo);




//////////////////////////////////////////////////////////////////////
// UPDATE DE LA BASE DE DONNEES
if (isset($_POST['modifier_vehicule'])) {
  putVehicule($pdo, $_GET['id'], $_POST);
}

function putVehicule($pdo, $id, $values)
{
  $request = $pdo->prepare("UPDATE vehicule SET
                  id_agence = :id_agence,
                  titre = :titre,
                  marque = :marque,
                  modele = :modele,
                  description = :description,
                  photo = :photo,
                  prix_journalier = :prix_journalier
                  WHERE id_vehicule='$id'");

  $request->execute(array(
    ':id_agence' => $values['id_agence'],
    ':titre' => $values['titre_vehicule'],
    ':marque' => $values['marque_vehicule'],
    ':modele' => $values['modele_vehicule'],
    ':description' => $values['description_vehicule'],
    ':photo' => $values['photo_vehicule'],
    ':prix_journalier' => $values['prix_vehicule']
  ));

  // Redirection vers la page gestionVehicule.php
  header('Location: gestionVehicules.php');
}


//////////////////////////////////////////////////////////////////
// DELETE UN ARTICLE
$param = isset($_GET['param']) ? $_GET['param'] : NULL;
if ($param === "deleteVehicule") {
  deleteVehicule($pdo, $_GET['id']);
}

function deleteVehicule($pdo, $id)
{

  $request = $pdo->prepare("DELETE FROM vehicule WHERE id_vehicule='$id'");
  $request->execute();

  // Redirection vers la page pageHome.php
  header('Location: gestionVehicules.php');
}
