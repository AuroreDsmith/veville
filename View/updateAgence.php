<?php
require_once("../Controller/agenceController.php");
require_once("../Template/header.inc.php");
?>

<?php if (isset($_SESSION['membre']['statut']) && $_SESSION['membre']['statut'] === 'admin') : ?>

  <div class="container my-5 w-50">
    <?php foreach ($arrayAfficherAgence as $values) :  ?>
      <form class="row g-3" method="POST">
        <h3>Modifier une Agence</h3>
        <div class="col-md-12">
          <label for="titre_agence" class="form-label">Titre</label>
          <input type="text" class="form-control" name="titre_agence" value="<?= $values['titre']; ?>">
        </div>
        <div class="col-12 col-md-4">
          <label for="adresse_agence" class="form-label">Adresse</label>
          <input type="text" class="form-control" name="adresse_agence" value="<?= $values['adresse']; ?>">
        </div>
        <div class="col-12 col-md-4">
          <label for="cp_agence" class="form-label">Code Postal</label>
          <input type="text" class="form-control" name="cp_agence" value="<?= $values['cp']; ?>">
        </div>
        <div class="col-12 col-md-4">
          <label for="ville_agence" class="form-label">Ville</label>
          <input type="text" class="form-control" name="ville_agence" value="<?= $values['ville']; ?>">
        </div>
        <div class="col-12">
          <label for="photo_agence" class="form-label">Photo</label>
          <input type="text" class="form-control" name="photo_agence" value="<?= $values['photo']; ?>">
        </div>

        <div class="col-12">
          <label for="description_agence" class="form-label">Description</label>
          <input type="text" class="form-control" name="description_agence" value="<?= $values['description']; ?>">
        </div>

        <div class="col-12 text-center">
          <button type="submit" class="btn btn-primary" name="modifier_agence">Enregistrer</button>
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