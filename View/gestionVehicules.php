<?php
require_once("../Controller/vehiculeController.php");
require_once("../Template/header.inc.php");
ini_set('display_errors', '1');
?>

<?php if (isset($_SESSION['membre']['statut']) && $_SESSION['membre']['statut'] === 'admin') : ?>

  <!-- Filtre pour selectionner une agence en particulier -->
  <div class="container my-3">
    <form method="POST">
      <div class="row ">
        <div class="col-5 col-md-3">
          <select class="form-select" name="id_agence">
            <?php foreach ($arrayAgencesPourVehicules as $values) :  ?>
              <option value="<?= $values['id_agence']; ?>"><?= $values['titre']; ?></option>
            <?php endforeach; ?>
          </select>
        </div>
        <div class="col-3">
          <button type="submit" class="btn btn-success" name="btn_filtre_gestion_vehicule">Filtrer</button>
        </div>
      </div>
  </div>
  </form>
  </div>
  <!-- Fin filtre de selection d'une agence -->

  <!-- Affichage des véhicules -->
  <div class="container mt-3 table-responsive">
    <h2>Véhicules</h2>
    <table class="table">
      <thead class="table-dark">
        <tr>
          <th>Véhicule</th>
          <th>Agence</th>
          <th>Titre</th>
          <th>Marque</th>
          <th>Modèle</th>
          <th>Description</th>
          <th>Photo</th>
          <th>Prix</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <!-- Condition pour afficher la liste de tous les véhicules de la BDD si aucune sélection d'agence'-->
        <?php if (!isset($_POST["id_agence"])) { ?>
          <?php foreach ($arrayVehicules as $values) :  ?>
            <tr>
              <td><?= $values['id_vehicule']; ?></td>
              <td><?= $values['titre_agence']; ?></td>
              <td><?= $values['titre']; ?></td>
              <td><?= $values['marque']; ?></td>
              <td><?= $values['modele']; ?></td>
              <td><?= $values['description']; ?></td>
              <td><img src="<?= $values['photo']; ?>" height="100"></td>
              <td><?= $values['prix_journalier']; ?>€</td>
              <td>
                <a href="./detailVehicule.php?param=detailVehicule&id=<?= $values['id_vehicule']; ?>"><i class="bi bi-search"></i></a>
                <a href="./updateVehicule.php?param=updateVehicule&id=<?= $values['id_vehicule']; ?>"><i class="bi bi-pencil-square"></i></a>
                <a href="?param=deleteVehicule&id=<?= $values['id_vehicule']; ?>"><i class="bi bi-trash"></i></a>
              </td>
            </tr>
          <?php endforeach; ?>

        <?php } else { ?>

          <?php foreach ($arrayVehiculesFiltreByAgence as $values) :  ?>
            <tr>
              <td><?= $values['id_vehicule']; ?></td>
              <td><?= $values['titre_agence']; ?></td>
              <td><?= $values['titre']; ?></td>
              <td><?= $values['marque']; ?></td>
              <td><?= $values['modele']; ?></td>
              <td><?= $values['description']; ?></td>
              <td><img src="<?= $values['photo']; ?>" height="100"></td>
              <td><?= $values['prix_journalier']; ?>€</td>
              <td>
                <a href="./detailVehicule.php?param=detailVehicule&id=<?= $values['id_vehicule']; ?>"><i class="bi bi-search"></i></a>
                <a href="./updateVehicule.php?param=updateVehicule&id=<?= $values['id_vehicule']; ?>"><i class="bi bi-pencil-square"></i></a>
                <a href="?param=deleteVehicule&id=<?= $values['id_vehicule']; ?>" onclick="return(confirm('Etes-vous sûr de vouloir supprimer cette entrée?'));"><i class="bi bi-trash"></i></a>
              </td>
            </tr>
          <?php endforeach; ?>

        <?php } ?>

      </tbody>
    </table>
  </div>


  <!-- Formulaire pour ajouter un véhicule -->
  <div class="container my-5 w-75 w-md-50">
    <form class="row g-3" method="POST">
      <h3>Ajouter un véhicule</h3>
      <div class="col-md-12">
        <label for="titre_vehicule" class="form-label">Titre</label>
        <input type="text" class="form-control" name="titre_vehicule" placeholder="Titre du véhicule">
      </div>
      <div class="col-12">
        <label for="id_agence" class="form-label">Agence</label>
        <select class="form-select" name="id_agence">
          <?php foreach ($arrayAgencesPourVehicules as $values) :  ?>
            <option value="<?= $values['id_agence']; ?>"><?= $values['titre']; ?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <div class="col-12 col-md-4">
        <label for="marque_vehicule" class="form-label">Marque</label>
        <input type="text" class="form-control" name="marque_vehicule" placeholder="Marque">
      </div>
      <div class="col-12 col-md-4">
        <label for="modele_vehicule" class="form-label">Modèle</label>
        <input type="text" class="form-control" name="modele_vehicule" placeholder="Modèle">
      </div>
      <div class="col-12 col-md-4">
        <label for="prix_vehicule" class="form-label">Prix/jour (€)</label>
        <input type="text" class="form-control" name="prix_vehicule" placeholder="Prix journalier">
      </div>
      <div class="col-12">
        <label for="photo_vehicule" class="form-label">Photo</label>
        <input type="text" class="form-control" name="photo_vehicule" placeholder="lien photo vehicule">
      </div>

      <div class="col-12">
        <label for="description_vehicule" class="form-label">Description</label>
        <input type="text" class="form-control" name="description_vehicule" placeholder="Description du véhicule">
      </div>

      <div class="col-12 text-center">
        <button type="submit" class="btn btn-success" name="enregistrer_vehicule">Enregistrer</button>
      </div>
    </form>
  </div>

<?php else : ?>
  <h5 class="text-primary text-center mt-5"><i class="bi bi-exclamation-circle-fill"></i> Vous n'avez pas accès à cette page, vous n'êtes pas admin.</h5>
<?php endif; ?>

<?php
require_once("../Template/footer.inc.php");
?>