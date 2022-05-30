<?php
require_once("../Controller/commandeController.php");
require_once("../Template/header.inc.php");
?>

<?php if (isset($_SESSION['membre']['statut']) && $_SESSION['membre']['statut'] === 'admin') : ?>
  <div class="container mt-5 ">
    <h3>Détail commande</h3>
    <div class="row p-5 ">
      <div class="col-12 mb-0 d-flex align-items-center">
        <div class="text-align-left align-self-center mx-auto">
          <?php foreach ($arrayDetailCommande as $values) :  ?>
            <h1 class="text-success">Id de commande : <?= $values['id_commande']; ?></h1>
            <h4>Agence : <?= $values['agence_id_agence'] . "-" . $values['titre_agence']; ?></h4>
            <h4>Membre : <?= $values['membre_id_membre']; ?> - <?= $values['prenom']; ?> <?= $values['nom']; ?></h4>
            <p class="m-0 p-0">Vehicule : <?= $values['vehicule_id_vehicule'] . "-" . $values['titre_vehicule']; ?></p>
            <p class="m-0 p-0">Date et heure de départ : <?= $values['date_heure_depart']; ?></p>
            <p class="m-0 p-0">Date et heure de fin : <?= $values['date_heure_fin']; ?></p>
            <p class="m-0 p-0">Prix total : <?= $values['prix_total'] . "€"; ?></p>
            <p>Date et heure d'enregistrement : <?= $values['date_enregistrement']; ?></p>

            <a href="./updateCommande.php?param=updateCommande&id=<?= $values['id_commande']; ?>" class="btn btn-success">Modifier</a>
            <a href="?param=deleteCommande&id=<?= $values['id_commande']; ?>" class="btn btn-danger" onclick="return(confirm('Etes-vous sûr de vouloir supprimer cette entrée?'));">Supprimer</a>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </div>


<?php else : ?>
  <h5 class="text-primary text-center mt-5"><i class="bi bi-exclamation-circle-fill"></i> Vous n'avez pas accès à cette page, vous n'êtes pas admin.</h5>
<?php endif; ?>

<?php require_once("../Template/footer.inc.php"); ?>