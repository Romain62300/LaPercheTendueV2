<?php
$page_title = "Don par virement - La Perche Tendue";
$page_description = "Effectuez un don par virement bancaire pour soutenir nos actions solidaires.";
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
  <h2 class="section-title">Faire un don par virement</h2>
  <p>Vous pouvez soutenir notre association via un virement bancaire sécurisé.</p>
  <ul style="text-align:left;max-width:600px;margin:auto;">
    <li><strong>Nom du bénéficiaire :</strong> Association La Perche Tendue</li>
    <li><strong>IBAN :</strong> <?= getC($pdo,'don-virement-iban') ?></li>
    <li><strong>BIC :</strong> <?= getC($pdo,'don-virement-bic') ?></li>
    <li><strong>Banque :</strong> <?= getC($pdo,'don-virement-banque') ?></li>
  </ul>
  <p style="margin-top:1rem;">N'oubliez pas de préciser "Don [Votre nom]" dans le motif du virement. Un reçu peut vous être envoyé sur demande.</p>
</section>
<?php include_once '../includes/footer.php'; ?>
