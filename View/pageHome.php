<?php
require_once('../Controller/homeController.php');
require_once('../Template/header.inc.php'); ?>


<div id="home-image">
  <h1 id="home-text">Bienvenu à bord</h1>
  <p>Location de voiture 24h/24 et7j/7</p>

  <!-- Formulaire de réservation -->
  <div id="home-form">
    <div id="form_reservation">
      <form method="POST">
        <div class="row align-items-end g-3" id="home-input">
          <div class="col-12 col-md-3">
            <label for="id_agence" class="form-label"><i class="bi bi-geo-alt-fill"></i> Adresse de départ</label>
            <select class="form-select" name="id_agence">
              <?php foreach ($arrayAgencesHome as $values) :  ?>
                <option value="<?= $values['id_agence']; ?>"><?= $values['titre']; ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <!-- Affichage de date/heure réservation si défini -->
          <?php if (isset($_POST['date_heure_depart'])) : ?>
            <div class="col-12 col-md-3">
              <label for="date_heure_depart" class="form-label"><i class="bi bi-calendar3"></i> Début de location</label>
              <input type="datetime-local" class="form-control" name="date_heure_depart" required value="<?= $_POST['date_heure_depart']; ?>">
            </div>
          <?php else : ?>
            <div class="col-12 col-md-3">
              <label for="date_heure_depart" class="form-label"><i class="bi bi-calendar3"></i> Début de location</label>
              <input type="datetime-local" class="form-control" name="date_heure_depart" required>
            </div>
          <?php endif; ?>
          <?php if (isset($_POST['date_heure_fin'])) : ?>
            <div class="col-12 col-md-3">
              <label for="date_heure_fin" class="form-label"><i class="bi bi-calendar3"></i> Fin de location</label>
              <input type="datetime-local" class="form-control" name="date_heure_fin" required value="<?= $_POST['date_heure_fin']; ?>">
            </div>
          <?php else : ?>
            <div class="col-12 col-md-3">
              <label for="date_heure_fin" class="form-label"><i class="bi bi-calendar3"></i> Fin de location</label>
              <input type="datetime-local" class="form-control" name="date_heure_fin" required>
            </div>
          <?php endif; ?>
          <div class="col-12 col-md-3 text-start" id="valider_vehicule">
            <button type="submit" class="btn btn-success" name="valider_vehicule">Valider un véhicule</button>
          </div>
        </div>
      </form>
    </div>
  </div>
  <!-- FIN Formulaire de réservation -->
</div>

<div class="container mt-5">
  <!-- Condition pour afficher la liste de tous les véhicules de la BDD si aucune sélection de dates-->
  <?php if (!isset($_POST["id_agence"])) { ?>
    <h3>Nos véhicules</h3>
    <p>Pour réserver un véhicule, veuillez sélectionner une agence et les dates de réservation.</p>

    <!-- Form pour tri par prix croissant/décroissant -->
    <div>
      <form method="GET">
        <div class="row justify-content-end">
          <div class="col-4 col-md-2 text-end">
            <select class="form-select" name="triParPrix">
              <option value="croissant">Prix croissant</option>
              <option value="decroissant">Prix décroissant</option>
            </select>
          </div>
          <div class="col-2 col-md-1 text-start">
            <button type="submit" class="btn btn-success" name="btn_filtre_gestion_vehicule">Trier</button>
          </div>
        </div>
      </form>
    </div>
    <!-- Fin Form pour tri croissant/décroissant -->

    <?php if ($_GET['triParPrix'] == 'decroissant') : ?>
      <?php foreach ($arrayVehiculesHomePrixDecroissant as $values) :  ?>
        <div class="container mt-3 w-75">
          <div class="row p-5">
            <div class="mx-auto col-md-8 col-lg-6 order-lg-last text-center ">
              <img class="img-fluid" src="<?= $values['photo']; ?>" alt="photo detail vehicule">
            </div>
            <div class="col-lg-6 mb-0 d-flex align-items-center">
              <div class="text-align-left align-self-center">
                <h2 class="h2 text-success"><?= $values['titre']; ?></h2>
                <h3 class="h3"><?= $values['prix_journalier'] . "€/jour"; ?></h3>
                <h5 class="h5"><?= $values['titre_agence']; ?></h5>
                <h5 class="h5">Marque : <?= $values['marque']; ?></h5>
                <h5 class="h5">Modèle : <?= $values['modele']; ?></h5>
                <p><?= $values['description']; ?></p>
              </div>
            </div>
          </div>
        </div>
        <hr class="bg-secondary border-2 border-top w-75 mx-auto">
      <?php endforeach; ?>

    <?php else : ?>

      <?php foreach ($arrayVehiculesHomePrixCroissant as $values) :  ?>
        <div class="container mt-3 w-75">
          <div class="row p-5">
            <div class="mx-auto col-md-8 col-lg-6 order-lg-last text-center ">
              <img class="img-fluid" src="<?= $values['photo']; ?>" alt="photo detail vehicule">
            </div>
            <div class="col-lg-6 mb-0 d-flex align-items-center">
              <div class="text-align-left align-self-center">
                <h2 class="h2 text-success"><?= $values['titre']; ?></h2>
                <h3 class="h3"><?= $values['prix_journalier'] . "€/jour"; ?></h3>
                <h5 class="h5"><?= $values['titre_agence']; ?></h5>
                <h5 class="h5">Marque : <?= $values['marque']; ?></h5>
                <h5 class="h5">Modèle : <?= $values['modele']; ?></h5>
                <p><?= $values['description']; ?></p>
              </div>
            </div>
          </div>
        </div>
        <hr class="bg-secondary border-2 border-top w-75 mx-auto">
      <?php endforeach; ?>

    <?php endif; ?>

    <!-- sinon affichage des vehicules selon agence sélectionnée -->
  <?php } else { ?>
    <!-- nombre de résultats à afficher-->
    <p><strong><?= $affichage_nbre_vehicule_home; ?></strong> résultats</p>
    <!-- Form pour tri par prix croissant/décroissant -->
    <div class="me-3">
      <form method="GET">
        <div class="row justify-content-end">
          <div class="col-5 col-md-2 text-end">
            <select class="form-select" name="triParPrix">
              <option value="croissant">Prix croissant</option>
              <option value="decroissant">Prix décroissant</option>
            </select>
          </div>
          <div class="col-1 text-start">
            <button type="submit" class="btn btn-success" name="btn_filtre_gestion_vehicule">Trier</button>
          </div>
        </div>
      </form>
    </div>
    <!-- Fin Form pour tri croissant/décroissant -->
    <?php if ($_GET['triParPrix'] == 'decroissant') : ?>
      <!-- foreach pour afficher la liste des voitures selon agence sélectionnées  et prix décroissant-->
      <?php foreach ($arrayVehiculesHomeByAgencePrixDecroissant as $values) :  ?>
        <div class="container mt-3 w-75">
          <div class="row p-5">
            <div class="mx-auto col-md-8 col-lg-6 order-lg-last text-center ">
              <img class="img-fluid" src="<?= $values['photo']; ?>" alt="photo detail vehicule">
            </div>
            <div class="col-lg-6 mb-0 d-flex align-items-center">
              <div class="text-align-left align-self-center">
                <h2 class="h2 text-success"><?= $values['titre']; ?></h2>
                <h3 class="h3"><?= $values['prix_journalier'] * $dateInterval . "€"; ?></h3>
                <h5 class="h5"><?= $values['titre_agence']; ?></h5>
                <h5 class="h5">Marque : <?= $values['marque']; ?></h5>
                <h5 class="h5">Modèle : <?= $values['modele']; ?></h5>
                <p><?= $values['description']; ?></p>
                <!-- Si membre connecté alors réservation possible -->
                <?php if (isset($_SESSION['membre']['id_membre'])) : ?>
                  <a href="?param=reserverVehicule&idVehicule=<?= $values['id_vehicule']; ?>&idAgence=<?= $values['id_agence']; ?>&prixJournalier=<?= $values['prix_journalier']; ?>&idSession=<?= $_SESSION['membre']['id_membre']; ?>&dateDepart=<?= $_POST['date_heure_depart']; ?>&dateFin=<?= $_POST['date_heure_fin']; ?>&dateInterval=<?= $dateInterval; ?>" class="btn btn-success">Réserver et payer</a>
                  <!-- Sinon invitation à se connecter/s'inscrire -->
                <?php else : ?>
                  <a href="#!" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#sign">Réserver et payer</a>
                <?php endif; ?>
              </div>
            </div>
          </div>
        </div>
        <hr class="bg-secondary border-2 border-top w-75 mx-auto">
      <?php endforeach; ?>

    <?php else : ?>
      <!-- foreach pour afficher la liste des voitures selon agence sélectionnées  et prix croissant-->
      <?php foreach ($arrayVehiculesHomeByAgencePrixCroissant as $values) :  ?>
        <div class="container mt-3 w-75">
          <div class="row p-5">
            <div class="mx-auto col-md-8 col-lg-6 order-lg-last text-center ">
              <img class="img-fluid" src="<?= $values['photo']; ?>" alt="photo detail vehicule">
            </div>
            <div class="col-lg-6 mb-0 d-flex align-items-center">
              <div class="text-align-left align-self-center">
                <h2 class="h2 text-success"><?= $values['titre']; ?></h2>
                <h3 class="h3"><?= $values['prix_journalier'] * $dateInterval . "€"; ?></h3>
                <h5 class="h5"><?= $values['titre_agence']; ?></h5>
                <h5 class="h5">Marque : <?= $values['marque']; ?></h5>
                <h5 class="h5">Modèle : <?= $values['modele']; ?></h5>
                <p><?= $values['description']; ?></p>
                <!-- Si membre connecté alors réservation possible -->
                <?php if (isset($_SESSION['membre']['id_membre'])) : ?>
                  <a href="?param=reserverVehicule&idVehicule=<?= $values['id_vehicule']; ?>&idAgence=<?= $values['id_agence']; ?>&prixJournalier=<?= $values['prix_journalier']; ?>&idSession=<?= $_SESSION['membre']['id_membre']; ?>&dateDepart=<?= $_POST['date_heure_depart']; ?>&dateFin=<?= $_POST['date_heure_fin']; ?>&dateInterval=<?= $dateInterval; ?>" class="btn btn-success">Réserver et payer</a>
                  <!-- Sinon invitation à se connecter/s'inscrire -->
                <?php else : ?>
                  <a href="#!" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#sign">Réserver et payer</a>
                <?php endif; ?>
              </div>
            </div>
          </div>
        </div>
        <hr class="bg-secondary border-2 border-top w-75 mx-auto">
      <?php endforeach; ?>

    <?php endif; ?>

  <?php } ?>

</div>

<?php
require_once("../Template/footer.inc.php");
?>