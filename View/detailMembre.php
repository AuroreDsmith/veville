<?php
require_once("../Controller/membreController.php");
require_once("../Template/header.inc.php");
?>

<?php if (isset($_SESSION['membre']['statut']) && $_SESSION['membre']['statut'] === 'admin') : ?>
  <div class="container mt-5 ">
    <h3>Profil Membre</h3>
    <div class="row p-5 ">
      <div class="col-12 mb-0 d-flex align-items-center">
        <div class="text-align-left align-self-center mx-auto">
          <?php foreach ($arrayDetailMembre as $values) :  ?>
            <h1 class="text-success"><?= $values['pseudo']; ?></h1>
            <h4>Statut : <?= $values['statut']; ?></h4>
            <h4>Id : <?= $values['id_membre']; ?></h4>
            <p class="m-0 p-0">Prénom : <?= $values['prenom']; ?></p>
            <p class="m-0 p-0">Nom : <?= $values['nom']; ?></p>
            <p class="m-0 p-0">Email : <?= $values['email']; ?></p>
            <p class="m-0 p-0">Sexe : <?= $values['civilite']; ?></p>
            <p>Date d'enregistrement : <?= $values['date_enregistrement']; ?></p>

            <a href="./updateMembre.php?param=updateMembre&id=<?= $values['id_membre']; ?>" class="btn btn-success">Modifier</a>
            <a href="?param=deleteMembre&id=<?= $values['id_membre']; ?>" class="btn btn-danger" onclick="return(confirm('Etes-vous sûr de vouloir supprimer cette entrée?'));">Supprimer</a>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </div>


<?php else : ?>
  <h5 class="text-primary text-center mt-5"><i class="bi bi-exclamation-circle-fill"></i> Vous n'avez pas accès à cette page, vous n'êtes pas admin.</h5>
<?php endif; ?>

<?php require_once("../Template/footer.inc.php"); ?>