<?php
$page_title = "Faire un don - La Perche Tendue";
$page_description = "Aidez notre association grâce à un don par carte, virement ou en espèces.";
require_once '../database/database.php';
function getC($pdo, $slug) {
    $stmt = $pdo->prepare("SELECT contenu FROM pages_contenu WHERE page_slug = ?");
    $stmt->execute([$slug]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row ? htmlspecialchars($row['contenu']) : '';
}
?>
<?php include_once '../includes/header.php'; ?>

<section class="dons-section container">
  <h2 class="text-center">Faire un don</h2>
  <div class="dons-grid">
    <div class="don-item">
      <a href="don-carte.php"><img src="assets/images/don-carte.jpg" alt="Don par carte"></a>
      <h3>PAR CARTE</h3>
      <p><?= getC($pdo,'dons-carte-texte') ?></p>
      <a href="don-carte.php" class="btn btn-sm">Faire un don</a>
    </div>
    <div class="don-item">
      <a href="don-virement.php"><img src="assets/images/don-virement.jpg" alt="Don par virement"></a>
      <h3>PAR VIREMENT</h3>
      <p><?= getC($pdo,'dons-virement-texte') ?></p>
      <a href="don-virement.php" class="btn btn-sm">En savoir plus</a>
    </div>
    <div class="don-item">
      <a href="don-especes.php"><img src="assets/images/don-especes.jpg" alt="Don en espèces"></a>
      <h3>EN ESPÈCES</h3>
      <p><?= getC($pdo,'dons-especes-texte') ?></p>
      <a href="don-especes.php" class="btn btn-sm">En savoir plus</a>
    </div>
  </div>
</section>

<?php include_once '../includes/footer.php'; ?>
