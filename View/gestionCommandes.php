<?php
require_once("../Controller/commandeController.php");
require_once("../Template/header.inc.php");
ini_set('display_errors', '1');
?>

<?php if (isset($_SESSION['membre']['statut']) && $_SESSION['membre']['statut'] === 'admin') : ?>

  <!-- Filtre pour selectionner une agence en particulier -->
  <div class="container my-3">
    <form method="POST">
      <div class="row ">
        <div class="col-3">
          <select class="form-select" name="id_agence">
            <?php foreach ($arrayAgencesPourFiltreCommandes as $values) :  ?>
              <option value="<?= $values['id_agence']; ?>"><?= $values['titre']; ?></option>
            <?php endforeach; ?>
          </select>
        </div>
        <div class="col-3">
          <button type="submit" class="btn btn-success" name="btn_filtre_gestion_commande">Filtrer</button>
        </div>
      </div>
  </div>
  </form>
  </div>
  <!-- Fin filtre de selection d'une agence -->

  <!-- Affichage des commandes -->
  <div class="container mt-3 table-responsive">
    <h2>Commandes</h2>
    <table class="table">
      <thead class="table-dark">
        <tr>
          <th>Commande</th>
          <th>Membre</th>
          <th>Véhicule</th>
          <th>Agence</th>
          <th>Date et heure de départ</th>
          <th>Date et heure de retour</th>
          <th>Prix total</th>
          <th>Date et heure d'enregistrement</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <!-- Condition pour afficher la liste de toutes les commandes de la BDD si aucune sélection d'agence'-->
        <?php if (!isset($_POST["id_agence"])) { ?>
          <?php foreach ($arrayCommandes as $values) :  ?>
            <tr>
              <td><?= $values['id_commande']; ?></td>
              <td><?= $values['prenom']; ?> <?= $values['nom']; ?> - <?= $values['email']; ?></td>
              <td><?= $values['vehicule_id_vehicule']; ?> - <?= $values['titre_vehicule']; ?></td>
              <td><?= $values['agence_id_agence']; ?> - <?= $values['titre_agence']; ?></td>
              <td><?= $values['date_heure_depart']; ?></td>
              <td><?= $values['date_heure_fin']; ?></td>
              <td><?= $values['prix_total']; ?>€</td>
              <td><?= $values['date_enregistrement']; ?></td>
              <td>
                <a href="./detailCommande.php?param=detailCommande&id=<?= $values['id_commande']; ?>"><i class="bi bi-search"></i></a>
                <a href="./updateCommande.php?param=updateCommande&id=<?= $values['id_commande']; ?>&idAgence=<?= $values['agence_id_agence']; ?>"><i class="bi bi-pencil-square"></i></a>
                <a href="?param=deleteCommande&id=<?= $values['id_commande']; ?>" onclick="return(confirm('Etes-vous sûr de vouloir supprimer cette entrée?'));"><i class="bi bi-trash"></i></a>
              </td>
            </tr>
          <?php endforeach; ?>

        <?php } else { ?>

          <?php foreach ($arrayCommandesFiltreByAgence as $values) :  ?>
            <tr>
              <td><?= $values['id_commande']; ?></td>
              <td><?= $values['prenom']; ?> <?= $values['nom']; ?> - <?= $values['email']; ?></td>
              <td><?= $values['vehicule_id_vehicule']; ?> - <?= $values['titre_vehicule']; ?></td>
              <td><?= $values['agence_id_agence']; ?> - <?= $values['titre_agence']; ?></td>
              <td><?= $values['date_heure_depart']; ?></td>
              <td><?= $values['date_heure_fin']; ?></td>
              <td><?= $values['prix_total']; ?>€</td>
              <td><?= $values['date_enregistrement']; ?></td>
              <td>
                <a href="./detailCommande.php?param=detailCommande&id=<?= $values['id_commande']; ?>"><i class="bi bi-search"></i></a>
                <a href="./updateCommande.php?param=updateCommande&id=<?= $values['id_commande']; ?>"><i class="bi bi-pencil-square"></i></a>
                <a href="?param=deleteCommande&id=<?= $values['id_commande']; ?>" onclick="return(confirm('Etes-vous sûr de vouloir supprimer cette entrée?'));"><i class="bi bi-trash"></i></a>
              </td>
            </tr>
          <?php endforeach; ?>

        <?php } ?>
      </tbody>
    </table>
  </div>

<?php else : ?>
  <h5 class="text-primary text-center mt-5"><i class="bi bi-exclamation-circle-fill"></i> Vous n'avez pas accès à cette page, vous n'êtes pas admin.</h5>
<?php endif; ?>

<?php
require_once("../Template/footer.inc.php");
?>