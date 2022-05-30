<?php
require_once("../Controller/agenceController.php");
require_once("../Template/header.inc.php");
?>

<?php if (isset($_SESSION['membre']['statut']) && $_SESSION['membre']['statut'] === 'admin') : ?>
  <?php foreach ($arrayDetailAgence as $values) :  ?>
    <div class="container mt-5">
      <div class="row p-5">
        <div class="mx-auto col-md-8 col-lg-6 order-lg-last text-center ">
          <img class="img-fluid" src="<?= $values['photo']; ?>" alt="photo detail agence">
        </div>
        <div class="col-lg-6 mb-0 d-flex align-items-center">
          <div class="text-align-left align-self-center">
            <h1 class="h1 text-success"><?= $values['titre']; ?></h1>
            <h3 class="h2"><?= $values['ville']; ?></h3>
            <h5 class="h5"><?= $values['adresse']; ?></h5>
            <h5 class="h5"><?= $values['cp']; ?></h5>
            <p><?= $values['description']; ?></p>

            <a href="./updateAgence.php?param=updateAgence&id=<?= $values['id_agence']; ?>" class="btn btn-success">Modifier</a>
            <a href="?param=deleteAgence&id=<?= $values['id_agence']; ?>" class="btn btn-danger" onclick="return(confirm('Etes-vous sûr de vouloir supprimer cette entrée?'));">Supprimer</a>

          </div>
        </div>
      </div>
    </div>
  <?php endforeach; ?>

<?php else : ?>
  <h5 class="text-primary text-center mt-5"><i class="bi bi-exclamation-circle-fill"></i> Vous n'avez pas accès à cette page, vous n'êtes pas admin.</h5>
<?php endif; ?>

<?php require_once("../Template/footer.inc.php"); ?>