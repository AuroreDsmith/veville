<?php
require_once("../Controller/agenceController.php");
require_once("../Template/header.inc.php");
ini_set('display_errors', '1');
?>

<?php if (isset($_SESSION['membre']['statut']) && $_SESSION['membre']['statut'] === 'admin') : ?>
  <div class="container mt-3 table-responsive">
    <h2>Agences</h2>
    <table class="table text-center">
      <thead class="table-dark">
        <tr>
          <th>Agence</th>
          <th>Titre</th>
          <th>Adresse</th>
          <th>Ville</th>
          <th>Code Postal</th>
          <th>Description</th>
          <th>Photo</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($arrayAgences as $values) :  ?>
          <tr>
            <td><?= $values['id_agence']; ?></td>
            <td><?= $values['titre']; ?></td>
            <td><?= $values['adresse']; ?></td>
            <td><?= $values['ville']; ?></td>
            <td><?= $values['cp']; ?></td>
            <td><?= $values['description']; ?></td>
            <td><img src="<?= $values['photo']; ?>" height="100"></td>
            <td>
              <a href="./detailAgence.php?param=detailAgence&id=<?= $values['id_agence']; ?>"><i class="bi bi-search"></i></a>
              <a href="./updateAgence.php?param=updateAgence&id=<?= $values['id_agence']; ?>"><i class="bi bi-pencil-square"></i></a>
              <a href="?param=deleteAgence&id=<?= $values['id_agence']; ?>" onclick="return(confirm('Etes-vous sûr de vouloir supprimer cette entrée?'));"><i class="bi bi-trash"></i></a>
            </td>
          </tr>

        <?php endforeach; ?>
        <!-- end foreach -->

      </tbody>
    </table>
  </div>


  <div class="container my-5 w-75 w-md-50">
    <form class="row g-3" method="POST">
      <h3>Ajouter une agence</h3>
      <div class="col-md-12">
        <label for="titre_agence" class="form-label">Titre</label>
        <input type="text" class="form-control" name="titre_agence" placeholder="Titre de l'agence">
      </div>
      <div class="col-md-12">
        <label for="adresse_agence" class="form-label">Adresse</label>
        <input type="text" class="form-control" name="adresse_agence" placeholder="Adresse">
      </div>
      <div class="col-12 col-md-6">
        <label for="cp_agence" class="form-label">Code Postal</label>
        <input type="text" class="form-control" name="cp_agence" placeholder="Code postal">
      </div>
      <div class="col-12 col-md-6">
        <label for="ville_agence" class="form-label">Ville</label>
        <input type="text" class="form-control" name="ville_agence" placeholder="Ville">
      </div>
      <div class="col-12">
        <label for="photo_agence" class="form-label">Photo</label>
        <input type="text" class="form-control" name="photo_agence" placeholder="lien photo agence">
      </div>
      <div class="col-12">
        <label for="description_agence" class="form-label">Description</label>
        <input type="text" class="form-control" name="description_agence" placeholder="Description">
      </div>

      <div class="col-12 text-center">
        <button type="submit" class="btn btn-success" name="enregistrer_agence">Enregistrer</button>
      </div>
    </form>
  </div>

<?php else : ?>
  <h5 class="text-primary text-center mt-5"><i class="bi bi-exclamation-circle-fill"></i> Vous n'avez pas accès à cette page, vous n'êtes pas admin.</h5>
<?php endif; ?>

<?php
require_once("../Template/footer.inc.php");
?>