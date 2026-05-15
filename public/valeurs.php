<?php
$page_title = "Nos valeurs - La Perche Tendue";
$page_description = "Les valeurs fondamentales qui guident l'action de La Perche Tendue au quotidien.";
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
  <h2 class="section-title">NOS VALEURS</h2>
  <div class="page-content">
    <p><?= getC($pdo,'valeurs-intro') ?></p>
    <p><strong>Solidarité</strong> : <?= getC($pdo,'valeurs-solidarite') ?></p>
    <p><strong>Respect</strong> : <?= getC($pdo,'valeurs-respect') ?></p>
    <p><strong>Engagement</strong> : <?= getC($pdo,'valeurs-engagement') ?></p>
    <p><strong>Bienveillance</strong> : <?= getC($pdo,'valeurs-bienveillance') ?></p>
    <a href="qui-sommes-nous.php" class="btn btn-sm">← Retour à Qui sommes-nous</a>
  </div>
</section>
<?php include_once '../includes/footer.php'; ?>
