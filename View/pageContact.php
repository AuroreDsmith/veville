<?php
require_once("../Template/header.inc.php");
ini_set('display_errors', '1'); ?>



<div class="container my-5 w-75 w-md-50">
  <form class="row g-3" method="POST">
    <h3>Nous contacter</h3>
    <div class="col-12">
      <label for="civilite_membre" class="form-label">Civilité</label>
      <div class="input-group">
        <select class="form-select" name="civilite_membre" required>
          <option value="femme">Mme</option>
          <option value="homme">M.</option>
        </select>
      </div>
    </div>

    <div class="col-12">
      <label for="nom_membre" class="form-label">Nom</label>
      <div class="input-group ">
        <span class="input-group-text" id="basic-addon1"><i class="bi bi-pencil-fill"></i></span>
        <input type="text" class="form-control" name="nom_membre" placeholder="Nom" required>
      </div>
    </div>

    <div class="col-12">
      <label for="prenom_membre" class="form-label">Prénom</label>
      <div class="input-group ">
        <span class="input-group-text" id="basic-addon1"><i class="bi bi-pencil-fill"></i></span>
        <input type="text" class="form-control" name="prenom_membre" placeholder="Prénom" required>
      </div>
    </div>

    <div class="col-12">
      <label for="email_membre" class="form-label">Email</label>
      <div class="input-group">
        <span class="input-group-text" id="basic-addon1"><i class="bi bi-envelope-fill"></i></span>
        <input type="email" class="form-control" name="email_membre" placeholder="email" required>
      </div>
    </div>

    <div class="col-12">
      <label for="contact_sujet" class="form-label">Sujet</label>
      <div class="input-group ">
        <span class="input-group-text" id="basic-addon1"><i class="bi bi-pencil-fill"></i></span>
        <input type="text" class="form-control" name="contact_sujet" placeholder="Sujet" required>
      </div>
    </div>

    <div class="col-12">
      <label for="contact_message" class="form-label">Message</label>
      <textarea name="contact_message" class="form-control border rounded" cols="30" rows="10" placeholder="Message" required></textarea>
    </div>

    <div class="form-group">
      <label class="checkbox-inline"><input type="checkbox" required="required"> J'accepte la <a href="#">Politique de confidentialité</a></label>
    </div>

    <div class="col-12 text-center">
      <button type="submit" class="btn btn-success" name="valider_message_contact">Envoyer votre message</button>
    </div>



  </form>
</div>




<?php
require_once("../Template/footer.inc.php");
?>