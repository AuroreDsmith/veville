<?php
require_once("../Controller/vehiculeController.php");
require_once("../Template/header.inc.php");
?>

<?php if (isset($_SESSION['membre']['statut']) && $_SESSION['membre']['statut'] === 'admin') : ?>

  <div class="container my-5 w-50">
    <?php foreach ($arrayAfficherVehicule as $values) :  ?>
      <form class="row g-3" method="POST">
        <h3>Modifier un véhicule</h3>
        <div class="col-md-12">
          <label for="titre_vehicule" class="form-label">Titre</label>
          <input type="text" class="form-control" name="titre_vehicule" value="<?= $values['titre']; ?>">
        </div>

        <div class="col-12">
          <label for="id_agence" class="form-label">Agence</label>
          <select class="form-select" name="id_agence">
            <option value="<?= $values['id_agence']; ?>"><?= $values['titre_agence']; ?></option>
          <?php endforeach; ?>
          <?php foreach ($arrayAgencesPourVehicules as $values) :  ?>
            <option value="<?= $values['id_agence']; ?>"><?= $values['titre']; ?></option>
          <?php endforeach; ?>
          </select>
        </div>
        <?php foreach ($arrayAfficherVehicule as $values) :  ?>
          <div class="col-12 col-md-4">
            <label for="marque_vehicule" class="form-label">Marque</label>
            <input type="text" class="form-control" name="marque_vehicule" value="<?= $values['marque']; ?>">
          </div>
          <div class="col-12 col-md-4">
            <label for="modele_vehicule" class="form-label">Modèle</label>
            <input type="text" class="form-control" name="modele_vehicule" value="<?= $values['modele']; ?>">
          </div>
          <div class="col-12 col-md-4">
            <label for="prix_vehicule" class="form-label">Prix/jour (€)</label>
            <input type="text" class="form-control" name="prix_vehicule" value="<?= $values['prix_journalier']; ?>">
          </div>
          <div class="col-12">
            <label for="photo_vehicule" class="form-label">Photo</label>
            <input type="text" class="form-control" name="photo_vehicule" value="<?= $values['photo']; ?>">
          </div>

          <div class="col-12">
            <label for="description_vehicule" class="form-label">Description</label>
            <input type="text" class="form-control" name="description_vehicule" value="<?= $values['description']; ?>">
          </div>

          <div class="col-12 text-center">
            <button type="submit" class="btn btn-primary" name="modifier_vehicule">Enregistrer</button>
          </div>
      </form>
    <?php endforeach; ?>
  </div>

<?php else : ?>
  <h5 class="text-primary text-center mt-5"><i class="bi bi-exclamation-circle-fill"></i> Vous n'avez pas accès à cette page, vous n'êtes pas admin.</h5>
<?php endif; ?>

<?php
require_once("../Template/footer.inc.php");
?>