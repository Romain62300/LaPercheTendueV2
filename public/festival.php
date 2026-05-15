<?php
$page_title = "Festival solidaire - La Perche Tendue";
$page_description = "Participez à notre festival annuel pour découvrir nos actions et nos partenaires.";
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
  <h2 class="text-center"><?= getC($pdo,'festival-titre') ?></h2>
  <p class="text-center"><?= getC($pdo,'festival-intro') ?></p>
</section>
<?php include_once '../includes/footer.php'; ?>
