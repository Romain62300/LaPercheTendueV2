<meta charset="UTF-8">
<title>La Perche Tendue</title>
<meta name="description" content="Association solidaire à Lens : épicerie sociale, dons, accompagnement et entraide.">
<!-- Open Graph -->
<meta property="og:title" content="La Perche Tendue" />
<meta property="og:description" content="Association solidaire à Lens : épicerie sociale, dons, accompagnement et entraide." />
<meta property="og:image" content="https://ton-site.com/public/assets/images/logo.png" />
<meta property="og:url" content="https://ton-site.com/contact.php" />
<meta property="og:type" content="website">
<!-- Twitter Card -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="La Perche Tendue">
<meta name="twitter:description" content="Association solidaire à Lens : épicerie sociale, dons, accompagnement et entraide.">
<meta name="twitter:image" content="https://ton-site.com/public/assets/images/logo.png">
<link rel="canonical" href="https://ton-site.com/contact.php">
<link rel="icon" href="/public/assets/images/favicon.png" type="image/png">
<?php
$page_title = "Contact - La Perche Tendue";
$page_description = "Contactez l'association La Perche Tendue via notre formulaire sécurisé.";
?>
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
