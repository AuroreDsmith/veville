<?php
require_once('../Controller/authController.php');
require_once('../Controller/monCompteController.php'); ?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Véville, location de voitures citadines et de luxe, 24h/24 et 7j/7" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="../Assets/style.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
  <link rel="icon" type="image/png" sizes="32x32" href="../Assets/img/flaticon32x32.png">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
  <title>Véville - Location de voitures</title>
</head>

<body class="d-flex flex-column min-vh-100" id="back-to-top">
  <!-- ************NAVBAR**************** -->
  <nav class="navbar navbar-expand-xl bg-dark navbar-dark sticky-top">
    <div class="container-fluid">
      <a class="navbar-brand" href="../View/pageHome.php"><img src="../Assets/img/kindpng_4829002_veville.png" alt="logo" height="45"></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="collapsibleNavbar">
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="../View/pageHome.php">Accueil</a>
          </li>
          <?php if (isset($_SESSION['membre']['statut']) && $_SESSION['membre']['statut'] === 'admin') : ?>
            <li class="nav-item">
              <a class="nav-link" href="pageDashboard.php">Dashboard</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="?actions=logout">Se déconnecter</a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link disabled text-success"><i class="fas fa-user fa-fw"></i>Connecté en tant que: <strong><?= $_SESSION['membre']['pseudo']; ?></strong></a>
            </li>
          <?php endif; ?>
          <?php if (isset($_SESSION['membre']['statut']) && $_SESSION['membre']['statut'] === 'membre') : ?>
            <li class="nav-item">
              <a class="nav-link" href="monCompte.php?param=infoMembre&idMembre=<?= $_SESSION['membre']['id_membre']; ?>">Mon compte</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="pageContact.php">Contactez-nous</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="?actions=logout">Se déconnecter</a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link disabled text-success"><i class="fas fa-user fa-fw"></i>Connecté en tant que: <strong><?= $_SESSION['membre']['pseudo']; ?></strong></a>
            </li>
          <?php endif; ?>
          <?php if (empty($_SESSION)) : ?>
            <li class="nav-item">
              <!-- Button trigger modal -->
              <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#signup">S'inscrire</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#sign">Se connecter</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="pageContact.php">Contactez-nous</a>
            </li>
          <?php endif; ?>
        </ul>
      </div>
    </div>
  </nav>
  <!-- ************FIN NAVBAR**************** -->

  <!-- ****************************************************************** -->
  <!-- Modal pour inscription-->
  <!-- ****************************************************************** -->
  <div class="modal fade signup-form" id="signup" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h2 class="modal-title" id="exampleModalLabel">S'inscrire</h2>

          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body text-center">
          <form class="row g-3" method="POST">
            <div class="col-12">
              <div class="input-group">
                <span class="input-group-text" id="basic-addon1"><i class="bi bi-person-fill"></i></span>
                <input input type="text" class="form-control" name="pseudo_membre" placeholder="Pseudo" maxlength="20" pattern="[a-zA-Z0-9-_.]{1,20}" title="caractères acceptés : a-zA-Z0-9-_." aria-label="Username" aria-describedby="basic-addon1" required>
              </div>
            </div>

            <div class="col-12">
              <div class="input-group">
                <select class="form-select" name="civilite_membre" required>
                  <option value="femme">Femme</option>
                  <option value="homme">Homme</option>
                </select>
              </div>
            </div>

            <div class="col-12 ">
              <div class="input-group ">
                <span class="input-group-text" id="basic-addon1"><i class="bi bi-pencil-fill"></i></span>
                <input type="text" class="form-control" name="nom_membre" placeholder="Nom" required>
              </div>
            </div>

            <div class="col-12 ">
              <div class="input-group ">
                <span class="input-group-text" id="basic-addon1"><i class="bi bi-pencil-fill"></i></span>
                <input type="text" class="form-control" name="prenom_membre" placeholder="Prénom" required>
              </div>
            </div>

            <div class="col-md-12">
              <div class="input-group">
                <span class="input-group-text" id="basic-addon1"><i class="bi bi-envelope-fill"></i></span>
                <input type="email" class="form-control" name="email_membre" placeholder="email" required>
              </div>
            </div>

            <div class="col-md-12">
              <div class="input-group">
                <span class="input-group-text" id="basic-addon1"><i class="bi bi-shield-lock-fill"></i></span>
                <input type="password" class="form-control" name="mdp_membre" placeholder="Mot de passe" required>
              </div>
            </div>

            <div class="col-12">
              <div class="input-group">
                <span class="input-group-text" id="basic-addon1"><i class="bi bi-person-check-fill"></i></span>
                <select class="form-select" name="statut_membre" required>
                  <option value="membre">Membre</option>
                  <option value="admin">Admin</option>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label class="checkbox-inline"><input type="checkbox" required="required"> J'accepte la <a href="#">Politique de confidentialité</a></label>
            </div>

            <div class="col-12 text-center">
              <!-- Button trigger modal pour message après enregistrement-->
              <button type="submit" class="btn btn-primary" name="enregistrer_membre" data-bs-toggle="modal" data-bs-target="#message">Enregistrer</button>

            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- ****************************************************************** -->
  <!-- FIN MODAL POUR INSCRIPTION-->
  <!-- ****************************************************************** -->

  <!-- ****************************************************************** -->
  <!-- Modal pour connexion-->
  <!-- ****************************************************************** -->
  <div class="modal fade signup-form" id="sign" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h2 class="modal-title" id="exampleModalLabel">Se connecter</h2>

          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body text-center">
          <form class="row g-3" method="POST">
            <div class="col-12">
              <div class="input-group">
                <span class="input-group-text" id="basic-addon1"><i class="bi bi-person-fill"></i></span>
                <input input type="text" class="form-control" name="pseudo_membre" placeholder="Pseudo" maxlength="20" pattern="[a-zA-Z0-9-_.]{1,20}" title="caractères acceptés : a-zA-Z0-9-_." aria-label="Username" aria-describedby="basic-addon1" required>
              </div>
            </div>

            <div class="col-md-12">
              <div class="input-group">
                <span class="input-group-text" id="basic-addon1"><i class="bi bi-shield-lock-fill"></i></span>
                <input type="password" class="form-control" name="mdp_membre" placeholder="Mot de passe" required>
              </div>
            </div>

            <div class="col-12 text-center">
              <button type="submit" class="btn btn-primary" name="connexion_membre">Enregistrer</button>

            </div>
          </form>
        </div>
      </div>
    </div>
  </div>


  <!-- ****************************************************************** -->
  <!-- FIN Modal pour connexion-->
  <!-- ****************************************************************** -->

  </header>