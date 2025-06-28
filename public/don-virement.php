<?php
$page_title = "Don par virement - La Perche Tendue";
$page_description = "Effectuez un don par virement bancaire pour soutenir nos actions solidaires.";
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title><?= $page_title ?></title>
  <meta name="description" content="<?= $page_description ?>">
  <meta property="og:title" content="<?= $page_title ?>" />
  <meta property="og:description" content="<?= $page_description ?>" />
  <meta property="og:image" content="https://ton-site.com/public/assets/images/logo.png" />
  <meta property="og:url" content="https://ton-site.com/don-virement.php" />
  <meta property="og:type" content="website">
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="<?= $page_title ?>">
  <meta name="twitter:description" content="<?= $page_description ?>">
  <meta name="twitter:image" content="https://ton-site.com/public/assets/images/logo.png">
  <link rel="canonical" href="https://ton-site.com/don-virement.php">
  <link rel="icon" href="/public/assets/images/favicon.png" type="image/png">
  <?php include_once '../includes/header.php'; ?>
</head>
<body>
<section class="page-detail container">
  <h2 class="section-title">Faire un don par virement</h2>
  <p>Vous pouvez soutenir notre association via un virement bancaire sécurisé.</p>
  <p>Voici nos coordonnées bancaires :</p>

  <ul style="text-align: left; max-width: 600px; margin: auto;">
    <li><strong>Nom du bénéficiaire :</strong> Association La Perche Tendue</li>
    <li><strong>IBAN :</strong> FR76 XXXX XXXX XXXX XXXX XXXX XXX</li>
    <li><strong>BIC :</strong> ABCDXXXX</li>
    <li><strong>Banque :</strong> Crédit Mutuel Lens</li>
  </ul>

  <p style="margin-top: 1rem;">
    N'oubliez pas de préciser "Don [Votre nom]" dans le motif du virement.  
    Un reçu peut vous être envoyé sur demande.
  </p>
</section>
<?php include_once '../includes/footer.php'; ?>
</body>
</html>
