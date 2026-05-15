<?php
$page_title = "International - La Perche Tendue";
$page_description = "Les actions internationales de solidarité menées par La Perche Tendue en Afrique et ailleurs.";
require_once '../database/database.php';
function getC($pdo, $slug) {
    $stmt = $pdo->prepare("SELECT contenu FROM pages_contenu WHERE page_slug = ?");
    $stmt->execute([$slug]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row ? htmlspecialchars($row['contenu']) : '';
}
?>
<?php include_once '../includes/header.php'; ?>
<section class="page-section container">
  <h2 class="text-center">INTERNATIONAL</h2>
  <div class="intro-text"><p><?= getC($pdo,'international-intro') ?></p></div>
  <div class="actualites-grid">
    <article class="actualite">
      <img src="assets/images/parade.jpg" alt="Niger">
      <h3><?= getC($pdo,'international-niger-titre') ?></h3>
      <p><?= getC($pdo,'international-niger-texte') ?></p>
      <small>🌍 Action en cours</small>
    </article>
    <article class="actualite">
      <img src="assets/images/festival.jpg" alt="Cameroun">
      <h3><?= getC($pdo,'international-cameroun-titre') ?></h3>
      <p><?= getC($pdo,'international-cameroun-texte') ?></p>
      <small>🤝 Partenariat actif</small>
    </article>
    <article class="actualite">
      <img src="assets/images/actu1.jpg" alt="Échanges culturels">
      <h3><?= getC($pdo,'international-echanges-titre') ?></h3>
      <p><?= getC($pdo,'international-echanges-texte') ?></p>
      <small>🎉 Événements réguliers</small>
    </article>
  </div>
  <div class="perche-section" style="margin-top:50px;text-align:center;">
    <h3 style="margin-bottom:15px;"><?= getC($pdo,'international-cta') ?></h3>
    <p style="color:#666;max-width:600px;margin:0 auto 20px;">Don, bénévolat ou partenariat — votre soutien nous permet d'agir toujours plus loin pour ceux qui en ont besoin.</p>
    <a href="faire-un-don.php" class="btn-don" style="margin-right:10px;">Faire un don</a>
    <a href="contact.php" class="btn-don">Nous contacter</a>
  </div>
</section>
<?php include_once '../includes/footer.php'; ?>
