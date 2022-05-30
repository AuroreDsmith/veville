<?php
require_once("../Config/bdd.php");
ini_set('display_errors', '1');

//////////////////////////////////////////////////////////////////////////
// AFFICHAGE CHOIX AGENCE DANS LE FILTRE
function getAllAgencesPourFiltreCommandes($pdo)
{
  // echo '<pre>'; print_r($pdo); echo '</pre>';  pour test
  $request = $pdo->prepare("SELECT * FROM agences");
  $request->execute();
  return $request->fetchAll(PDO::FETCH_ASSOC);  //retourne un tableau associatif

}
$arrayAgencesPourFiltreCommandes = getAllAgencesPourFiltreCommandes($pdo);

///////////////////////////////////////////////////////////////////////
//Fonction pour récupérer les vehicules de la BDD
function getAllVehiculesPourFiltreCommandes($pdo)
{
  $request = $pdo->prepare("SELECT * FROM vehicule");

  $request->execute();
  return $request->fetchAll(PDO::FETCH_ASSOC);  //retourne un tableau associatif

}
$arrayVehiculesPourFiltreCommandes = getAllVehiculesPourFiltreCommandes($pdo);


//Fonction pour récupérer les données de la BDD
function getCommandes($pdo)
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
  ");
  $request->execute();
  return $request->fetchAll(PDO::FETCH_ASSOC);  //retourne un tableau associatif

}
$arrayCommandes = getCommandes($pdo);


///////////////////////////////////////////////////////////////////////
//Fonction pour récupérer les vehicules de la BDD filtré par agence
$_POST["id_agence"] = isset($_POST["id_agence"]) ? $_POST["id_agence"] : NULL;
if (isset($_POST["btn_filtre_gestion_vehicule"])) {
  getAllCommandesFiltreByAgence($_POST["id_agence"], $pdo);
}

function  getAllCommandesFiltreByAgence($id_agence, $pdo)
{
  $request = $pdo->prepare("SELECT commande.*, membre.id_membre AS membre_id_membre, nom, prenom, email, vehicule.id_vehicule AS vehicule_id_vehicule, vehicule.titre AS titre_vehicule, agences.id_agence AS agence_id_agence, agences.titre AS titre_agence 
  FROM commande
  INNER JOIN membre 
  ON membre.id_membre = commande.id_membre
  INNER JOIN vehicule 
  ON vehicule.id_vehicule = commande.id_vehicule
  INNER JOIN agences 
  ON agences.id_agence = commande.id_agence 
  WHERE agences.id_agence ='$id_agence'");

  $request->execute();
  return $request->fetchAll(PDO::FETCH_ASSOC);  //retourne un tableau associatif

}
$arrayCommandesFiltreByAgence =  getAllCommandesFiltreByAgence($_POST["id_agence"], $pdo);


///////////////////////////////////////////////////////////////////////
// AFFICHER UNE COMMANDE EN DETAIL
$param = isset($_GET['param']) ? $_GET['param'] : NULL;
$_GET['id'] = isset($_GET['id']) ? $_GET['id'] : NULL;
if ($param === "detailCommande" || $param === "updateCommande") {
  detailCommande($pdo, $_GET['id']);
}

function detailCommande($pdo, $id)
{
  $request = $pdo->prepare("SELECT commande.*, membre.id_membre AS membre_id_membre, pseudo, nom, prenom, email, vehicule.id_vehicule AS vehicule_id_vehicule, vehicule.titre AS titre_vehicule, agences.id_agence AS agence_id_agence, agences.titre AS titre_agence 
  FROM commande
  INNER JOIN membre 
  ON membre.id_membre = commande.id_membre
  INNER JOIN vehicule 
  ON vehicule.id_vehicule = commande.id_vehicule
  INNER JOIN agences 
  ON agences.id_agence = commande.id_agence
  WHERE id_commande = '$id'
  ");

  $request->execute();
  return $request->fetchAll(PDO::FETCH_ASSOC);
}

$arrayDetailCommande = detailCommande($pdo, $_GET['id']);



//////////////////////////////////////////////////////////////////////
// UPDATE DE LA BASE DE DONNEES
if (isset($_POST['modifier_commande'])) {
  putCommande($pdo, $_GET['id'], $_POST);
}

function putCommande($pdo, $id, $values)
{
  var_dump($values);
  $request = $pdo->prepare("UPDATE commande SET
                  id_membre = :id_membre,
                  vehicule.id_vehicule = :id_vehicule,
                  id_agence = :id_agence,
                  date_heure_depart = :date_heure_depart,
                  date_heure_fin = :date_heure_fin
                  WHERE id_commande='$id'");

  $request->execute(array(
    ':id_membre' => $values['id_membre'],
    ':id_vehicule' => $values['id_vehicule'],
    ':id_agence' => $values['id_agence'],
    ':date_heure_depart' => $values['date_heure_depart'],
    ':date_heure_fin' => $values['date_heure_fin']
  ));
  // Redirection vers la page gestionVehicule.php
  // header('Location: gestionCommandes.php');
}



//////////////////////////////////////////////////////////////////
// DELETE UNE COMMANDE
$param = isset($_GET['param']) ? $_GET['param'] : NULL;
if ($param === "deleteCommande") {
  deleteCommande($pdo, $_GET['id']);
}

function deleteCommande($pdo, $id)
{

  $request = $pdo->prepare("DELETE FROM commande WHERE id_commande='$id'");
  $request->execute();

  // Redirection vers la page pageHome.php
  header('Location: gestionCommandes.php');
}
