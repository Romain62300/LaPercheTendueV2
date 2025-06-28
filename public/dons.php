<meta charset="UTF-8">
<title>La Perche Tendue</title>
<meta name="description" content="Association solidaire à Lens : épicerie sociale, dons, accompagnement et entraide.">
<!-- Open Graph -->
<meta property="og:title" content="La Perche Tendue" />
<meta property="og:description" content="Association solidaire à Lens : épicerie sociale, dons, accompagnement et entraide." />
<meta property="og:image" content="https://ton-site.com/public/assets/images/logo.png" />
<meta property="og:url" content="https://ton-site.com/dons.php" />
<meta property="og:type" content="website">
<!-- Twitter Card -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="La Perche Tendue">
<meta name="twitter:description" content="Association solidaire à Lens : épicerie sociale, dons, accompagnement et entraide.">
<meta name="twitter:image" content="https://ton-site.com/public/assets/images/logo.png">
<link rel="canonical" href="https://ton-site.com/dons.php">
<link rel="icon" href="/public/assets/images/favicon.png" type="image/png">
<?php
$page_title = "Faire un don - La Perche Tendue";
$page_description = "Aidez notre association grâce à un don par carte, virement ou en espèces.";
?>
<?php include_once '../includes/header.php'; ?>

<section class="dons-section container">
  <h2 class="section-title">FAIRE UN DON</h2>
  <div class="dons-grid">

    <div class="don-item">
      <a href="don-carte.php">
        <img src="assets/images/don-carte.jpg" alt="Don par carte">
      </a>
      <h3>PAR CARTE</h3>
      <p>Effectuez un don en ligne de manière simple et sécurisée.</p>
      <a href="don-carte.php" class="btn btn-sm">Faire un don</a>
    </div>

    <div class="don-item">
      <a href="don-virement.php">
        <img src="assets/images/don-virement.jpg" alt="Don par virement">
      </a>
      <h3>PAR VIREMENT</h3>
      <p>Vous pouvez faire un virement bancaire directement sur notre compte.</p>
      <a href="don-virement.php" class="btn btn-sm">En savoir plus</a>
    </div>

    <div class="don-item">
      <a href="don-especes.php">
        <img src="assets/images/don-especes.jpg" alt="Don en espèces">
      </a>
      <h3>EN ESPÈCES</h3>
      <p>Rendez-vous à notre local pour effectuer un don en main propre.</p>
      <a href="don-especes.php" class="btn btn-sm">En savoir plus</a>
    </div>

  </div>
</section>

<?php include_once '../includes/footer.php'; ?>