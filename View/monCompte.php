<?php
require_once('../Controller/monCompteController.php');
require_once('../Template/header.inc.php'); ?>



<!-- Affichage des info membre dans un formulaire avec historique des commandes-->
<div class="container my-5 w-75 w-md-50">
  <?php foreach ($arrayInfoMembre as $values) :  ?>
    <form class="row g-3" method="POST">
      <h3 class="text-center">Mes informations</h3>
      <div class="col-md-12">
        <label for="pseudo_membre" class="form-label">Pseudo</label>
        <div class="input-group">
          <span class="input-group-text" id="basic-addon1"><i class="bi bi-person-fill"></i></span>
          <input input type="text" class="form-control" name="pseudo_membre" maxlength="20" pattern="[a-zA-Z0-9-_.]{1,20}" title="caractères acceptés : a-zA-Z0-9-_." aria-label="Username" aria-describedby="basic-addon1" value="<?= $values['pseudo']; ?>" readonly>
        </div>
      </div>

      <div class="col-12">
        <label for="civilite_membre" class="form-label">Civilité</label>
        <div class="input-group">
          <input type="text" class="form-control" name="civilite_membre" value="<?= $values['civilite']; ?>" readonly>
        </div>
      </div>

      <div class="col-12 ">
        <label for="nom_membre" class="form-label">Nom</label>
        <div class="input-group ">
          <span class="input-group-text" id="basic-addon1"><i class="bi bi-pencil-fill"></i></span>
          <input type="text" class="form-control" name="nom_membre" value="<?= $values['nom']; ?>" readonly>
        </div>
      </div>

      <div class="col-12">
        <label for="prenom_membre" class="form-label">Prénom</label>
        <div class="input-group ">
          <span class="input-group-text" id="basic-addon1"><i class="bi bi-pencil-fill"></i></span>
          <input type="text" class="form-control" name="prenom_membre" value="<?= $values['prenom']; ?>" readonly>
        </div>
      </div>

      <div class="col-md-12">
        <label for="email_membre" class="form-label">Email</label>
        <div class="input-group">
          <span class="input-group-text" id="basic-addon1"><i class="bi bi-envelope-fill"></i></span>
          <input type="email" class="form-control" name="email_membre" value="<?= $values['email']; ?>" readonly>
        </div>
      </div>

      <div class="col-md-12">
        <label for="mdp_membre" class="form-label">Mot de passe</label>
        <div class="input-group">
          <span class="input-group-text" id="basic-addon1"><i class="bi bi-shield-lock-fill"></i></span>
          <input type="password" class="form-control" name="mdp_membre" value="<?= $values['mdp']; ?>">
        </div>
      </div>

      <div class="col-12 ">
        <label for="statut_membre" class="form-label">Statut</label>
        <div class="input-group">
          <span class="input-group-text" id="basic-addon1"><i class="bi bi-person-check-fill"></i></span>
          <input type="text" class="form-control" name="statut_membre" value="<?= $values['statut']; ?>" readonly>
        </div>
      </div>

      <div class="col-12 text-center">
        <button type="submit" class="btn btn-success" name="enregistrer_membre">Enregistrer les changements</button>
      </div>
    </form>
  <?php endforeach; ?>
</div>

<!-- Affichage des commandes passées -->

<div class="container mt-4 table-responsive">
  <h3 class="text-center">Mes commandes passées</h3>
  <table class="table m-4">
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
      </tr>
    </thead>
    <tbody>
      <?php foreach ($arrayCommandesMembre as $values) :  ?>
        <tr>
          <td><?= $values['id_commande']; ?></td>
          <td><?= $values['prenom']; ?> <?= $values['nom']; ?> - <?= $values['email']; ?></td>
          <td><?= $values['vehicule_id_vehicule']; ?> - <?= $values['titre_vehicule']; ?></td>
          <td><?= $values['agence_id_agence']; ?> - <?= $values['titre_agence']; ?></td>
          <td><?= $values['date_heure_depart']; ?></td>
          <td><?= $values['date_heure_fin']; ?></td>
          <td><?= $values['prix_total']; ?>€</td>
          <td><?= $values['date_enregistrement']; ?></td>
        </tr>

      <?php endforeach; ?>

    </tbody>
  </table>
</div>





<?php
require_once("../Template/footer.inc.php");
?>