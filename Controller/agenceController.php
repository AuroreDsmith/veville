<?php
require_once("../Config/bdd.php");
ini_set('display_errors', '1');

if (isset($_POST["enregistrer_agence"])) {
  postAgence($_POST, $pdo);
}

function postAgence($values, $pdo)
{
  $request = $pdo->prepare("INSERT INTO agences VALUES (NULL, :titre, :adresse, :ville, :cp, :description, :photo)");
  $request->bindParam(":titre", $values['titre_agence'], PDO::PARAM_STR);
  $request->bindParam(":adresse", $values['adresse_agence'], PDO::PARAM_STR);
  $request->bindParam(":ville", $values['ville_agence'], PDO::PARAM_STR);
  $request->bindParam(":cp", $values['cp_agence'], PDO::PARAM_INT);
  $request->bindParam(":description", $values['description_agence'], PDO::PARAM_STR);
  $request->bindParam(":photo", $values['photo_agence'], PDO::PARAM_STR);

  $request->execute();
}


//Fonction pour récupérer les données de la BDD
function getAllAgences($pdo)
{
  // echo '<pre>'; print_r($pdo); echo '</pre>';  pour test
  $request = $pdo->prepare("SELECT * FROM agences");
  $request->execute();
  return $request->fetchAll(PDO::FETCH_ASSOC);  //retourne un tableau associatif

}
$arrayAgences = getAllAgences($pdo);
// echo '<pre>'; print_r($arrayArticles); '</pre>';




///////////////////////////////////////////////////////////////////////
// AFFICHER UNE AGENCE EN DETAIL
$param = isset($_GET['param']) ? $_GET['param'] : NULL;
$_GET['id'] = isset($_GET['id']) ? $_GET['id'] : NULL;
if ($param === "detailAgence") {
  detailAgence($pdo, $_GET['id']);
}

function detailAgence($pdo, $id)
{

  $request = $pdo->prepare("SELECT * FROM agences WHERE id_agence='$id'");
  $request->execute();
  return $request->fetchAll(PDO::FETCH_ASSOC);
}

$arrayDetailAgence = detailAgence($pdo, $_GET['id']);


/////////////////////////////////////////////////////////////////////////
// AFFICHER UN ARTICLE DANS LE FORMULAIRE
$mode_edition = 0;

$edit = isset($_GET['param']) ? $_GET['param'] : NULL;
if ($edit === "updateAgence") {
  $mode_edition = 1;
  afficher_agence_pour_edition($pdo, $_GET['id']);
}

function  afficher_agence_pour_edition($pdo, $id)
{
  if (isset($id) and !empty($id)) {
    // $get_id = htmlspecialchars($id);

    $request = $pdo->prepare("SELECT * FROM agences WHERE id_agence='$id'");
    $request->execute();

    // Vérification que l'article existe bien
    if ($request->rowCount() == 1) {
      return $request->fetchAll(PDO::FETCH_ASSOC);
    }
  }
}
$arrayAfficherAgence =  afficher_agence_pour_edition($pdo, $_GET['id']);



//////////////////////////////////////////////////////////////////////
// UPDATE DE LA BASE DE DONNEES
if (isset($_POST['modifier_agence'])) {
  putAgence($pdo, $_GET['id'], $_POST);
}

function putAgence($pdo, $id, $values)
{
  $request = $pdo->prepare("UPDATE agences SET
                  titre = :titre,
                  adresse = :adresse,
                  ville = :ville,
                  cp = :cp,
                  description = :description,
                  photo = :photo
                  WHERE id_agence='$id'");

  $request->execute(array(
    ':titre' => $values['titre_agence'],
    ':adresse' => $values['adresse_agence'],
    ':ville' => $values['ville_agence'],
    ':cp' => $values['cp_agence'],
    ':description' => $values['description_agence'],
    ':photo' => $values['photo_agence']
  ));

  // Redirection vers la page gestionVehicule.php
  header('Location: gestionAgences.php');
}


//////////////////////////////////////////////////////////////////
// DELETE UNE AGENCE
$param = isset($_GET['param']) ? $_GET['param'] : NULL;
if ($param === "deleteAgence") {
  deleteAgence($pdo, $_GET['id']);
}

function deleteAgence($pdo, $id)
{

  $request = $pdo->prepare("DELETE FROM agences WHERE id_agence='$id'");
  $request->execute();

  // Redirection vers la page pageHome.php
  header('Location: gestionAgences.php');
}
