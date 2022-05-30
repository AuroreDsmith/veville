<?php
require_once("../Config/bdd.php");
require_once("../Controller/authController.php");
ini_set('display_errors', '1');


$contenu = '';
//Fonction dans authController
if (isset($_POST["enregistrer_membre"])) {
  if (!empty($_POST['pseudo_membre']) && !empty($_POST['civilite_membre']) && !empty($_POST['nom_membre']) && !empty($_POST['prenom_membre']) && !empty($_POST['email_membre']) && !empty($_POST['mdp_membre']) && !empty($_POST['statut_membre'])) {
    // print_r($_POST);
    postMembre($_POST, $pdo);
  } else {
    $contenu = "Champs vides";
  }
}

//Fonction pour récupérer les données de la BDD
function getAllMembres($pdo)
{
  // echo '<pre>'; print_r($pdo); echo '</pre>';  pour test
  $request = $pdo->prepare("SELECT * FROM membre");
  $request->execute();
  return $request->fetchAll(PDO::FETCH_ASSOC);  //retourne un tableau associatif

}
$arrayMembres = getAllMembres($pdo);
// echo '<pre>'; print_r($arrayArticles); '</pre>';



///////////////////////////////////////////////////////////////////////
// AFFICHER UN MEMBRE EN DETAIL
$param = isset($_GET['param']) ? $_GET['param'] : NULL;
$_GET['id'] = isset($_GET['id']) ? $_GET['id'] : NULL;
if ($param === "detailMembre") {
  detailMembre($pdo, $_GET['id']);
}

function detailMembre($pdo, $id)
{

  $request = $pdo->prepare("SELECT * FROM membre WHERE id_membre='$id'");
  $request->execute();
  return $request->fetchAll(PDO::FETCH_ASSOC);
}

$arrayDetailMembre = detailMembre($pdo, $_GET['id']);


/////////////////////////////////////////////////////////////////////////
// AFFICHER UN MEMBRE DANS LE FORMULAIRE

$edit = isset($_GET['param']) ? $_GET['param'] : NULL;
if ($edit === "updateMembre") {
  afficher_membre_pour_edition($pdo, $_GET['id']);
}

function  afficher_membre_pour_edition($pdo, $id)
{
  if (isset($id) and !empty($id)) {
    // $get_id = htmlspecialchars($id);

    $request = $pdo->prepare("SELECT * FROM membre WHERE id_membre='$id'");
    $request->execute();

    // Vérification que l'article existe bien
    if ($request->rowCount() == 1) {
      return $request->fetchAll(PDO::FETCH_ASSOC);
    }
  }
}
$arrayAfficherMembre =  afficher_membre_pour_edition($pdo, $_GET['id']);



//////////////////////////////////////////////////////////////////////
// UPDATE MEMBRE DANS LA BASE DE DONNEES
if (isset($_POST['modifier_membre'])) {
  putMembre($pdo, $_GET['id'], $_POST);
}

function putMembre($pdo, $id, $values)
{
  $request = $pdo->prepare("UPDATE membre SET
                  pseudo = :pseudo,
                  mdp = :mdp,
                  nom = :nom,
                  prenom = :prenom,
                  email = :email,
                  civilite = :civilite,
                  statut = :statut
                  WHERE id_membre='$id'");

  $request->execute(array(
    ':pseudo' => $values['pseudo_membre'],
    ':mdp' => $values['mdp_membre'],
    ':nom' => $values['nom_membre'],
    ':prenom' => $values['prenom_membre'],
    ':email' => $values['email_membre'],
    ':civilite' => $values['civilite_membre'],
    ':statut' => $values['statut_membre']
  ));

  // Redirection vers la page gestionMembres.php
  header('Location: gestionMembres.php');
}


//////////////////////////////////////////////////////////////////
// DELETE UN MEMBRE
$param = isset($_GET['param']) ? $_GET['param'] : NULL;
if ($param === "deleteMembre") {
  deleteMembre($pdo, $_GET['id']);
}

function deleteMembre($pdo, $id)
{

  $request = $pdo->prepare("DELETE FROM membre WHERE id_membre='$id'");
  $request->execute();

  // Redirection vers la page pageHome.php
  header('Location: gestionMembres.php');
}
