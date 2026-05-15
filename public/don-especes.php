<?php
$page_title = "Don en espèces - La Perche Tendue";
$page_description = "Rendez-vous à notre local pour effectuer un don en espèces.";
require_once '../database/database.php';
function getC($pdo, $slug) {
    $stmt = $pdo->prepare("SELECT contenu FROM pages_contenu WHERE page_slug = ?");
    $stmt->execute([$slug]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row ? htmlspecialchars($row['contenu']) : '';
}
?>
<?php include_once '../includes/header.php'; ?>
<section class="page-detail container">
  <h2 class="section-title">Faire un don en espèces</h2>
  <p>Vous pouvez venir nous rencontrer directement à notre épicerie solidaire pour effectuer un don en main propre.</p>
  <p><strong>Adresse :</strong><br><?= getC($pdo,'don-especes-adresse') ?></p>
  <p><strong>Horaires :</strong><br><?= getC($pdo,'don-especes-horaires') ?></p>
  <p>Merci de demander un reçu au moment du don si vous en avez besoin.</p>
</section>
<?php include_once '../includes/footer.php'; ?>
