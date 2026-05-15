<?php
$page_title = "Parade solidaire - La Perche Tendue";
$page_description = "Retour en images sur la parade organisée par l'association La Perche Tendue.";
require_once '../database/database.php';
function getC($pdo, $slug) {
    $stmt = $pdo->prepare("SELECT contenu FROM pages_contenu WHERE page_slug = ?");
    $stmt->execute([$slug]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row ? htmlspecialchars($row['contenu']) : '';
}
?>
<?php include_once '../includes/header.php'; ?>
<section class="page-section">
  <h2 class="text-center"><?= getC($pdo,'parade-titre') ?></h2>
  <p class="text-center"><?= getC($pdo,'parade-intro') ?></p>
</section>
<?php include_once '../includes/footer.php'; ?>
