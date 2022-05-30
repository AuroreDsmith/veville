<?php
require_once("../Config/bdd.php");
ini_set('display_errors', '1');
session_start();

$contenu = "";

/////////////////////////////////////////////////////////////////////////////////
// INSCRIPTION SIGN UP
/////////////////////////////////////////////////////////////////////////////////
if (isset($_POST["enregistrer_membre"])) {
  if (!empty($_POST['pseudo_membre']) && !empty($_POST['civilite_membre']) && !empty($_POST['nom_membre']) && !empty($_POST['prenom_membre']) && !empty($_POST['email_membre']) && !empty($_POST['mdp_membre']) && !empty($_POST['statut_membre'])) {
    // print_r($_POST);
    postMembre($_POST, $pdo);
  } else {
    $contenu = "Champs vides";
  }
}

function postMembre($values, $pdo)
{
  global $contenu;
  $pseudo_strip_tags = strip_tags(trim($values['pseudo_membre']));
  $pseudo  = strtolower($pseudo_strip_tags);

  $nom_strip_tags = strip_tags(trim($values['nom_membre']));
  $nom = strtolower($nom_strip_tags);

  $prenom_strip_tags = strip_tags(trim($values['prenom_membre']));
  $prenom = strtolower($prenom_strip_tags);

  $email_strip_tags = strip_tags(trim($values['email_membre']));
  $email = strtolower($email_strip_tags);

  $mdp = strip_tags(trim($values['mdp_membre']));


  $verif_caractere = preg_match('#^[a-zA-Z0-9._-]+$#', $pseudo);
  if (!$verif_caractere && (strlen($pseudo) < 1 || strlen($pseudo) > 20)) // 
  {
    $contenu .= "<div class='erreur'>Le pseudo doit contenir entre 1 et 20 caractères. <br> Caractère accepté : Lettre de A à Z et chiffre de 0 à 9</div>";
  } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $contenu = "Entrez une adresse mail valide";
  } else if (strlen($mdp) < 6) {
    $contenu = "Le mot de passe doit contenir au moins 6 caractères";
  } else {
    try {
      $membre = $pdo->query("SELECT * FROM membre WHERE pseudo = '$pseudo'");

      if ($membre->rowCount() >= 1) {
        $contenu = "Désolé, ce pseudo existe déjà. Veuillez en choisir un autre.";
        return false;
      } else {
        $new_mdp = password_hash($mdp, PASSWORD_DEFAULT);

        $membre = $pdo->prepare("INSERT INTO membre VALUES (NULL, :pseudo, :mdp, :nom, :prenom, :email, :civilite, :statut, now())");
        $membre->bindParam(":pseudo", $pseudo, PDO::PARAM_STR);
        $membre->bindParam(":mdp", $new_mdp, PDO::PARAM_STR);
        $membre->bindParam(":nom", $nom, PDO::PARAM_STR);
        $membre->bindParam(":prenom", $prenom, PDO::PARAM_STR);
        $membre->bindParam(":email", $email, PDO::PARAM_STR);
        $membre->bindParam(":civilite", $values['civilite_membre'], PDO::PARAM_STR);
        $membre->bindParam(":statut", $values['statut_membre'], PDO::PARAM_STR);
        $membre->execute();
      }
    } catch (PDOException $e) {
      echo $e->getMessage();
    }
  }
}


/////////////////////////////////////////////////////////////////////////////////
// CONNEXION SIGN 
/////////////////////////////////////////////////////////////////////////////////

if (isset($_POST["connexion_membre"])) {
  if (!empty($_POST['pseudo_membre']) && !empty($_POST['mdp_membre'])) {
    sign($_POST, $pdo);
  }
}

function sign($values, $pdo)
{
  global $contenu;
  $pseudo_strip_tags = strip_tags(trim($values['pseudo_membre']));
  $pseudo  = strtolower($pseudo_strip_tags);
  $password = strip_tags($values['mdp_membre']);

  if (empty($pseudo)) {
    $contenu = "Veuillez entrer un pseudo";
  } else if (empty($password)) {
    $contenu = "Veuillez entrer un mot de passe";
  } else {
    try {
      $membre = $pdo->prepare("SELECT * FROM membre WHERE pseudo=?");
      $membre->execute([$pseudo]);
      $user = $membre->fetch(PDO::FETCH_ASSOC);

      if (is_countable($user) && count($user) > 1) {
        if (password_verify($password, $user["mdp"])) {
          foreach ($user as $key => $values) {
            $_SESSION['membre'][$key] = $values;
          }
          $contenu = "Connexion réussie";
        } else {
          $contenu = "Mot de passe erroné";
        }
      } else {
        $contenu = "Erreur de pseudo";
      }
    } catch (PDOException $e) {
      $e->getMessage();
    }
  }
}



/////////////////////////////////////////////////////////////////////////////////
// DECONNEXION
/////////////////////////////////////////////////////////////////////////////////

$actions = isset($_GET['actions']) ? $_GET['actions'] : NULL;
if ($actions === "logout") {
  logout();
}

function logout()
{
  session_destroy();
  header('Location: pageHome.php');
}
