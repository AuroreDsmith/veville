<?php
require_once("../Controller/membreController.php");
require_once("../Template/header.inc.php");
ini_set('display_errors', '1');
?>

<?php if (isset($_SESSION['membre']['statut']) && $_SESSION['membre']['statut'] === 'admin') : ?>
  <div class="container mt-3 text-center table-responsive">
    <h2>Membres</h2>
    <table class="table ">
      <thead class="table-dark">
        <tr>
          <th>Id_membre</th>
          <th>Pseudo</th>
          <th>Nom</th>
          <th>Prénom</th>
          <th>email</th>
          <th>Civilité</th>
          <th>Statut</th>
          <th>Date d'enregistrement</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($arrayMembres as $values) :  ?>
          <tr>
            <td><?= $values['id_membre']; ?></td>
            <td><?= $values['pseudo']; ?></td>
            <td><?= $values['nom']; ?></td>
            <td><?= $values['prenom']; ?></td>
            <td><?= $values['email']; ?></td>
            <td><?= $values['civilite']; ?></td>
            <td><?= $values['statut']; ?></td>
            <td><?= $values['date_enregistrement']; ?></td>
            <td>
              <a href="./detailMembre.php?param=detailMembre&id=<?= $values['id_membre']; ?>"><i class="bi bi-search"></i></a>
              <a href="./updateMembre.php?param=updateMembre&id=<?= $values['id_membre']; ?>"><i class="bi bi-pencil-square"></i></a>
              <a href="?param=deleteMembre&id=<?= $values['id_membre']; ?>" onclick="return(confirm('Etes-vous sûr de vouloir supprimer cette entrée?'));"><i class="bi bi-trash"></i></a>
            </td>
          </tr>

        <?php endforeach; ?>
        <!-- end foreach -->

      </tbody>
    </table>
  </div>

  <div class="container my-5 w-75 w-md-50">
    <form class="row g-3" method="POST">
      <h3>Ajouter un membre</h3>
      <div class="col-md-12">
        <label for="pseudo_membre" class="form-label">Pseudo</label>
        <div class="input-group">
          <span class="input-group-text" id="basic-addon1"><i class="bi bi-person-fill"></i></span>
          <input input type="text" class="form-control" name="pseudo_membre" placeholder="Pseudo" maxlength="20" pattern="[a-zA-Z0-9-_.]{1,20}" title="caractères acceptés : a-zA-Z0-9-_." aria-label="Username" aria-describedby="basic-addon1" required>
        </div>
      </div>

      <div class="col-12 col-lg-2">
        <label for="civilite_membre" class="form-label">Civilité</label>
        <div class="input-group">
          <select class="form-select" name="civilite_membre" required>
            <option value="femme">Femme</option>
            <option value="homme">Homme</option>
          </select>
        </div>
      </div>

      <div class="col-12 col-lg-5">
        <label for="nom_membre" class="form-label">Nom</label>
        <div class="input-group ">
          <span class="input-group-text" id="basic-addon1"><i class="bi bi-pencil-fill"></i></span>
          <input type="text" class="form-control" name="nom_membre" placeholder="Nom" required>
        </div>
      </div>

      <div class="col-12 col-lg-5">
        <label for="prenom_membre" class="form-label">Prénom</label>
        <div class="input-group ">
          <span class="input-group-text" id="basic-addon1"><i class="bi bi-pencil-fill"></i></span>
          <input type="text" class="form-control" name="prenom_membre" placeholder="Prénom" required>
        </div>
      </div>

      <div class="col-md-12">
        <label for="email_membre" class="form-label">Email</label>
        <div class="input-group">
          <span class="input-group-text" id="basic-addon1"><i class="bi bi-envelope-fill"></i></span>
          <input type="email" class="form-control" name="email_membre" placeholder="email" required>
        </div>
      </div>

      <div class="col-md-12">
        <label for="mdp_membre" class="form-label">Mot de passe</label>
        <div class="input-group">
          <span class="input-group-text" id="basic-addon1"><i class="bi bi-shield-lock-fill"></i></span>
          <input type="password" class="form-control" name="mdp_membre" placeholder="Mot de passe" required>
        </div>
      </div>

      <div class="col-12 col-md-4">
        <label for="statut_membre" class="form-label">Statut</label>
        <div class="input-group">
          <span class="input-group-text" id="basic-addon1"><i class="bi bi-person-check-fill"></i></span>
          <select class="form-select" name="statut_membre" required>
            <option value="membre">Membre</option>
            <option value="admin">Admin</option>
          </select>
        </div>
      </div>

      <div class="col-12 text-center">
        <button type="submit" class="btn btn-success" name="enregistrer_membre">Enregistrer</button>
      </div>
    </form>
  </div>

  <p class="text-danger font-weight-bold text-center"><?= $contenu; ?></p>


<?php else : ?>
  <h5 class="text-primary text-center mt-5"><i class="bi bi-exclamation-circle-fill"></i> Vous n'avez pas accès à cette page, vous n'êtes pas admin.</h5>
<?php endif; ?>

<?php
require_once("../Template/footer.inc.php");
?>