<?php
$page_title = "Don en espèces - La Perche Tendue";
$page_description = "Rendez-vous à notre local pour effectuer un don en espèces et soutenir nos actions solidaires.";
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
  <meta property="og:url" content="https://ton-site.com/don-especes.php" />
  <meta property="og:type" content="website">
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="<?= $page_title ?>">
  <meta name="twitter:description" content="<?= $page_description ?>">
  <meta name="twitter:image" content="https://ton-site.com/public/assets/images/logo.png">
  <link rel="canonical" href="https://ton-site.com/don-especes.php">
  <link rel="icon" href="/public/assets/images/favicon.png" type="image/png">
  <?php include_once '../includes/header.php'; ?>
</head>
<body>
<section class="page-detail container">
  <h2 class="section-title">Faire un don en espèces</h2>
  <p>
    Vous pouvez venir nous rencontrer directement à notre épicerie solidaire pour effectuer un don en main propre.
  </p>
  <p>
    Adresse : <br>
    <strong>Association La Perche Tendue</strong><br>
    24 avenue Raoul Briquet, appartement 3<br>
    62300 Lens
  </p>
  <p>
    Horaires d'ouverture :<br>
    Lundi au vendredi : 8h30 - 12h30 / 13h30 - 17h00
  </p>
  <p>
    Merci de demander un reçu au moment du don si vous en avez besoin.
  </p>
</section>
<?php include_once '../includes/footer.php'; ?>
</body>
</html>
