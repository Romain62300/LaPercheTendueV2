<?php include_once '../includes/header.php'; ?>

<!-- Image du haut -->
<section class="form-image-top">
  <img src="assets/images/contact-epicerie.jpg" alt="Photo de l'équipe à l'épicerie" class="image-contact">
</section>

<!-- Formulaire dans boîte grise -->
<section class="form-style-boite">
  <h2 class="form-title">Nous Contacter :</h2>

  <form action="traitement_contact.php" method="POST" class="form-boite">
    <div class="form-ligne">
      <div class="form-colonne">
        <label for="nom">Entrez votre nom :</label>
        <input type="text" id="nom" name="nom" placeholder="Votre nom" required>
      </div>
      <div class="form-colonne">
        <label for="prenom">Entrez votre prénom :</label>
        <input type="text" id="prenom" name="prenom" placeholder="Votre prénom" required>
      </div>
    </div>

    <div class="form-ligne">
      <div class="form-colonne">
        <label for="email">Entrez votre mail :</label>
        <input type="email" id="email" name="email" placeholder="Votre mail" required>
      </div>
      <div class="form-colonne">
        <label for="telephone">Entrez votre numéro de tél :</label>
        <input type="tel" id="telephone" name="telephone" placeholder="Votre numéro de téléphone">
      </div>
    </div>

    <label for="message">Entrez votre message ici :</label>
    <textarea id="message" name="message" placeholder="Entrez votre message ici" required></textarea>

    <div class="checkbox-container">
  <input type="checkbox" id="rgpd" name="rgpd" required>
  <label for="rgpd">J’accepte la politique de confidentialité</label>
</div>

    <button type="submit" class="btn-form-grey">Envoyé</button>
  </form>
</section>

<?php include_once '../includes/footer.php'; ?>
