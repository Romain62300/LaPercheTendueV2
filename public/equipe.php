<?php
$page_title = "Notre équipe - La Perche Tendue";
$page_description = "Découvrez les membres actifs et bénévoles de l'association La Perche Tendue.";
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
  <h2 id="equipe" class="section-title">Notre équipe</h2>
  <div class="page-content">
    <p><?= getC($pdo,'equipe-texte1') ?></p>
    <p><?= getC($pdo,'equipe-texte2') ?></p>
    <p><?= getC($pdo,'equipe-texte3') ?></p>
    <a href="qui-sommes-nous.php" class="btn btn-sm">← Retour à Qui sommes-nous</a>
  </div>
</section>
<?php include_once '../includes/footer.php'; ?>
