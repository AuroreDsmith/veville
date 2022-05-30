<?php
require_once("../Controller/MembreController.php");
require_once("../Template/header.inc.php");
?>

<?php if (isset($_SESSION['membre']['statut']) && $_SESSION['membre']['statut'] === 'admin') : ?>

  <div class="container my-5 w-50">
    <?php foreach ($arrayAfficherMembre as $values) :  ?>
      <form class="row g-3" method="POST">
        <h3>Modifier les informations d'un membre</h3>
        <div class="col-md-12">
          <label for="pseudo_membre" class="form-label">Pseudo</label>
          <div class="input-group">
            <span class="input-group-text" id="basic-addon1"><i class="bi bi-person-fill"></i></span>
            <input input type="text" class="form-control" name="pseudo_membre" placeholder="Pseudo" maxlength="20" pattern="[a-zA-Z0-9-_.]{1,20}" title="caractères acceptés : a-zA-Z0-9-_." aria-label="Username" aria-describedby="basic-addon1" required value="<?= $values['pseudo']; ?>">
          </div>
        </div>
      <?php endforeach; ?>
      <div class="col-12 col-md-2">
        <label for="civilite_membre" class="form-label">Civilité</label>
        <div class="input-group">
          <select class="form-select" name="civilite_membre" required>
            <?php foreach ($arrayAfficherMembre as $values) :  ?>
              <option value="<?= $values['civilite']; ?>"><?= $values['civilite']; ?></option>
            <?php endforeach; ?>

            <?php foreach ($arrayAfficherMembre as $values) :  ?>
              <?php if ($values['civilite'] === "femme") { ?>
                <option value="homme">Homme</option>
              <?php } else { ?>
                <option value="femme">Femme</option>
              <?php } ?>
            <?php endforeach; ?>
          </select>
        </div>
      </div>
      <?php foreach ($arrayAfficherMembre as $values) :  ?>
        <div class="col-12 col-md-5">
          <label for="nom_membre" class="form-label">Nom</label>
          <div class="input-group ">
            <span class="input-group-text" id="basic-addon1"><i class="bi bi-pencil-fill"></i></span>
            <input type="text" class="form-control" name="nom_membre" placeholder="Nom" required value="<?= $values['nom']; ?>">
          </div>
        </div>

        <div class="col-12 col-md-5">
          <label for="prenom_membre" class="form-label">Prénom</label>
          <div class="input-group ">
            <span class="input-group-text" id="basic-addon1"><i class="bi bi-pencil-fill"></i></span>
            <input type="text" class="form-control" name="prenom_membre" placeholder="Prénom" required value="<?= $values['prenom']; ?>">
          </div>
        </div>

        <div class="col-md-12">
          <label for="email_membre" class="form-label">Email</label>
          <div class="input-group">
            <span class="input-group-text" id="basic-addon1"><i class="bi bi-envelope-fill"></i></span>
            <input type="email" class="form-control" name="email_membre" placeholder="email" required value="<?= $values['email']; ?>">
          </div>
        </div>

        <div class="col-md-12">
          <label for="mdp_membre" class="form-label">Mot de passe</label>
          <div class="input-group">
            <span class="input-group-text" id="basic-addon1"><i class="bi bi-shield-lock-fill"></i></span>
            <input type="password" class="form-control" name="mdp_membre" placeholder="Mot de passe" required value="<?= $values['mdp']; ?>">
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
          <button type="submit" class="btn btn-primary" name="modifier_membre">Enregistrer</button>
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