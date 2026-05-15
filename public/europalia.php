<?php
$page_title = "Festival Europalia - La Perche Tendue";
$page_description = "Présentation du projet Europalia soutenu par l'association La Perche Tendue.";
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
  <h2 class="text-center">Festival Europalia</h2>
  <div class="intro-text"><p><?= getC($pdo,'europalia-intro') ?></p></div>
  <div class="qui-grid">
    <div class="qui-item">
      <img src="assets/images/festival.jpg" alt="Le festival">
      <h3><?= getC($pdo,'europalia-festival-titre') ?></h3>
      <p><?= getC($pdo,'europalia-festival-texte') ?></p>
    </div>
    <div class="qui-item">
      <img src="assets/images/equipe.jpg" alt="Notre participation">
      <h3><?= getC($pdo,'europalia-participation-titre') ?></h3>
      <p><?= getC($pdo,'europalia-participation-texte') ?></p>
    </div>
    <div class="qui-item">
      <img src="assets/images/valeurs.jpg" alt="Notre vision">
      <h3><?= getC($pdo,'europalia-culture-titre') ?></h3>
      <p><?= getC($pdo,'europalia-culture-texte') ?></p>
    </div>
  </div>
  <div style="text-align:center;margin-top:40px;">
    <a href="evenements.php" class="btn btn-sm">← Voir tous nos événements</a>
  </div>
</section>
<?php include_once '../includes/footer.php'; ?>
