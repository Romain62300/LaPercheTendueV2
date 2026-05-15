<?php
$page_title = "Notre engagement - La Perche Tendue";
$page_description = "Découvrez les engagements solidaires de notre association.";
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
  <h2 id="engagement" class="section-title">Notre engagement</h2>
  <div class="page-content">
    <p><?= getC($pdo,'engagement-texte1') ?></p>
    <p><?= getC($pdo,'engagement-texte2') ?></p>
    <p><?= getC($pdo,'engagement-texte3') ?></p>
    <a href="qui-sommes-nous.php" class="btn btn-sm">← Retour à Qui sommes-nous</a>
  </div>
</section>
<?php include_once '../includes/footer.php'; ?>
