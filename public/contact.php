<?php
$page_title = "Contact - La Perche Tendue";
$page_description = "Contactez l'association La Perche Tendue via notre formulaire sécurisé.";
?>
<?php include_once '../includes/header.php'; ?>

<!-- Messages de retour -->
<?php if (isset($_GET['succes'])): ?>
  <div style="max-width:800px; margin:20px auto; padding:15px; background:#d4edda; border:1px solid #28a745; border-radius:8px; color:#155724; text-align:center;">
    ✅ Votre message a bien été envoyé ! Nous vous répondrons dans les plus brefs délais.
  </div>
<?php endif; ?>

<?php if (isset($_GET['erreur'])): ?>
  <div style="max-width:800px; margin:20px auto; padding:15px; background:#f8d7da; border:1px solid #dc3545; border-radius:8px; color:#721c24; text-align:center;">
    <?php
    switch ($_GET['erreur']) {
        case 'champs_manquants':
            echo '⚠️ Veuillez remplir tous les champs obligatoires.';
            break;
        case 'email_invalide':
            echo '⚠️ L\'adresse email saisie n\'est pas valide.';
            break;
        case 'rgpd':
            echo '⚠️ Vous devez accepter la politique de confidentialité.';
            break;
        case 'envoi_impossible':
            echo '❌ Une erreur est survenue lors de l\'envoi. Veuillez réessayer ou nous contacter directement.';
            break;
    }
    ?>
  </div>
<?php endif; ?>

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
      <label for="rgpd">J'accepte la politique de confidentialité</label>
    </div>

    <button type="submit" class="btn-form-grey">Envoyer</button>
  </form>
</section>

<?php include_once '../includes/footer.php'; ?>