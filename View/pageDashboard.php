<?php
require_once("../Controller/authController.php");
require_once("../Controller/membreController.php");
require_once("../Controller/agenceController.php");
require_once("../Controller/vehiculeController.php");
require_once("../Controller/commandeController.php");
require_once("../Template/header.inc.php");
ini_set('display_errors', '1'); ?>


<?php if (isset($_SESSION['membre']['statut']) && $_SESSION['membre']['statut'] === 'admin') : ?>

  <div class="container">
    <!-- Contenu -->
    <div id="layoutSidenav_content">
      <main>
        <div class="container-fluid px-4">
          <h1 class="my-4"><i class="fas fa-tachometer-alt"></i> Dashboard</h1>

          <div class="row">
            <div class="col-12 col-md-6">
              <div class="card bg-primary text-white mb-4">
                <div class="card-body">Gestion Agences (<?= count($arrayAgences); ?>)</div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                  <a class="small text-white stretched-link" href="gestionAgences.php">Voir en détail</a>
                  <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
              </div>
            </div>
            <div class="col-12 col-md-6">
              <div class="card bg-warning text-white mb-4">
                <div class="card-body">Gestion Véhicules (<?= count($arrayVehicules); ?>)</div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                  <a class="small text-white stretched-link" href="gestionVehicules.php">Voir en détail</a>
                  <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
              </div>
            </div>
            <div class="col-12 col-md-6">
              <div class="card bg-success text-white mb-4">
                <div class="card-body">Gestion Membres (<?= count($arrayMembres); ?>)</div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                  <a class="small text-white stretched-link" href="gestionMembres.php">Voir en détail</a>
                  <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
              </div>
            </div>
            <div class="col-12 col-md-6">
              <div class="card bg-danger text-white mb-4">
                <div class="card-body">Gestion Commandes (<?= count($arrayCommandes); ?>)</div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                  <a class="small text-white stretched-link" href="gestionCommandes.php">Voir en détail</a>
                  <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
              </div>
            </div>
          </div>

          <div class="card mb-4">
            <div class="card-header">
              <i class="fas fa-table me-1"></i>
              Table Membre
            </div>
            <div class="card-body table-responsive">
              <table class="table table-hover">
                <thead class="table">
                  <tr>
                    <th>Id_membre</th>
                    <th>Pseudo</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>email</th>
                    <th>Civilité</th>
                    <th>Statut</th>
                    <th>Date d'enregistrement</th>
                    <th>Actions</th>
                  </tr>
                </thead>

                <tbody>
                  <?php foreach ($arrayMembres as $values) :  ?>
                    <tr>
                      <td><?= $values['id_membre']; ?></td>
                      <td><?= $values['pseudo']; ?></td>
                      <td><?= $values['nom']; ?></td>
                      <td><?= $values['prenom']; ?></td>
                      <td><?= $values['email']; ?></td>
                      <td><?= $values['civilite']; ?></td>
                      <td><?= $values['statut']; ?></td>
                      <td><?= $values['date_enregistrement']; ?></td>
                      <td>
                        <a href="./detailMembre.php?param=detailMembre&id=<?= $values['id_membre']; ?>"><i class="bi bi-search"></i></a>
                        <a href="./updateMembre.php?param=updateMembre&id=<?= $values['id_membre']; ?>"><i class="bi bi-pencil-square"></i></a>
                        <a href="?param=deleteMembre&id=<?= $values['id_membre']; ?>"><i class="bi bi-trash"></i></a>
                      </td>
                    </tr>

                  <?php endforeach; ?>

                </tbody>
              </table>
            </div>
          </div>
        </div>
      </main>
    </div>
  </div>


<?php else : ?>
  <h5 class="text-primary text-center mt-5"><i class="bi bi-exclamation-circle-fill"></i> Vous n'avez pas accès à cette page, vous n'êtes pas admin.</h5>
<?php endif; ?>

<?php
require_once("../Template/footer.inc.php");
?>