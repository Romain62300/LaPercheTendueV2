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

<!-- Coordonnées des épiceries -->
<section class="page-section container">
  <h2 class="text-center" style="margin-bottom: 30px;">NOS ÉPICERIES</h2>
  <div class="row g-4 justify-content-center">

    <div class="col-md-5">
      <div class="card h-100 shadow-sm border-0 p-4">
        <h3 class="mb-3" style="color:#c0392b;">📍 Épicerie de Lens</h3>
        <p><strong>Adresse :</strong><br>56 rue Casimir Beugnet<br>62300 Lens</p>
        <p><strong>Téléphone :</strong><br>
          <a href="tel:0668492507">06 68 49 25 07</a>
        </p>
        <p><strong>Horaires :</strong><br>Du mardi au samedi<br>13h – 18h</p>
      </div>
    </div>

    <div class="col-md-5">
      <div class="card h-100 shadow-sm border-0 p-4">
        <h3 class="mb-3" style="color:#c0392b;">📍 Épicerie d'Arras</h3>
        <p><strong>Adresse :</strong><br>122 rue du Commandant Dumetz<br>62000 Arras</p>
        <p><strong>Téléphone :</strong><br>
          <a href="tel:0660238469">06 60 23 84 69</a>
        </p>
        <p><strong>Horaires :</strong><br>Du mardi au samedi<br>12h – 17h</p>
      </div>
    </div>

  </div>
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