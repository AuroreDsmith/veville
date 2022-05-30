<?php
require_once("../Controller/commandeController.php");
require_once("../Template/header.inc.php");
?>

<?php if (isset($_SESSION['membre']['statut']) && $_SESSION['membre']['statut'] === 'admin') : ?>

  <div class="container my-5 w-50">
    <?php foreach ($arrayDetailCommande as $values) :  ?>
      <form class="row g-3" method="POST">
        <h3>Modifier une commande</h3>
        <div class="col-md-12">
          <label for="id_commande" class="form-label">Id de commande</label>
          <input type="text" class="form-control" name="id_commande" value="<?= $values['id_commande']; ?>" readonly>
        </div>

        <div class="col-md-12">
          <label for="id_membre" class="form-label">Id du Membre</label>
          <input type="text" class="form-control" name="id_membre" value="<?= $values['id_membre']; ?>" readonly>
        </div>

        <div class="col-12">
          <label for="id_agence" class="form-label">Agence</label>
          <select class="form-select" name="id_agence">
            <option value="<?= $values['agence_id_agence']; ?>"><?= $values['titre_agence']; ?></option>
          <?php endforeach; ?>
          <?php foreach ($arrayAgencesPourFiltreCommandes as $values) :  ?>
            <option value="<?= $values['id_agence']; ?>"><?= $values['titre']; ?></option>
          <?php endforeach; ?>
          </select>
        </div>

        <?php foreach ($arrayDetailCommande as $values) :  ?>
          <div class="col-12">
            <label for="titre_vehicule" class="form-label">Vehicule</label>
            <select class="form-select" name="titre_vehicule">
              <option value="<?= $values['vehicule_id_vehicule']; ?>"><?= $values['titre_vehicule']; ?></option>
            <?php endforeach; ?>
            <?php foreach ($arrayVehiculesPourFiltreCommandes as $values) :  ?>
              <option value="<?= $values['id_vehicule']; ?>"><?= $values['titre']; ?></option>
            <?php endforeach; ?>
            </select>
          </div>

          <?php foreach ($arrayDetailCommande as $values) :  ?>
            <div class="col-12 col-md-4">
              <label for="date_heure_depart" class="form-label">Date et heure de départ</label>
              <input type="datetime-local" class="form-control" name="date_heure_depart" value="<?= $values['date_heure_depart']; ?>" required>
            </div>
            <div class="col-12 col-md-4">
              <label for="date_heure_fin" class="form-label">Date et heure de fin</label>
              <input type="datetime-local" class="form-control" name="date_heure_fin" value="<?= $values['date_heure_fin']; ?>" required>
            </div>
          <?php endforeach; ?>
          <div class="col-12 text-center">
            <button type="submit" class="btn btn-success" name="modifier_commande">Enregistrer</button>
          </div>
      </form>
  </div>

<?php else : ?>
  <h5 class="text-primary text-center mt-5"><i class="bi bi-exclamation-circle-fill"></i> Vous n'avez pas accès à cette page, vous n'êtes pas admin.</h5>
<?php endif; ?>

<?php
require_once("../Template/footer.inc.php");
?>