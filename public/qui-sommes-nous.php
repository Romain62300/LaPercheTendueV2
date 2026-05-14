<?php
$page_title = "Qui sommes-nous ? - La Perche Tendue";
$page_description = "Découvrez l'association La Perche Tendue, ses valeurs, son équipe et son engagement solidaire.";
require_once '../database/database.php';

function getContenu($pdo, $slug) {
    $stmt = $pdo->prepare("SELECT contenu FROM pages_contenu WHERE page_slug = ?");
    $stmt->execute([$slug]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row ? nl2br(htmlspecialchars($row['contenu'])) : '';
}
?>
<?php include_once '../includes/header.php'; ?>

<section class="qui-sommes-nous container">
  <h2 class="text-center">Qui sommes-nous ?</h2>

  <div class="intro-text">
    <p><?= getContenu($pdo, 'qui-sommes-nous-intro') ?></p>
  </div>

  <div class="qui-grid">
    <div class="qui-item">
      <img src="assets/images/valeurs.jpg" alt="Nos valeurs">
      <h3>Nos valeurs</h3>
      <p><?= getContenu($pdo, 'qui-sommes-nous-valeurs') ?></p>
      <a href="valeurs.php" class="btn btn-sm">En savoir plus</a>
    </div>

    <div class="qui-item">
      <img src="assets/images/equipe.jpg" alt="Notre équipe">
      <h3>Notre équipe</h3>
      <p><?= getContenu($pdo, 'qui-sommes-nous-equipe') ?></p>
      <a href="equipe.php" class="btn btn-sm">En savoir plus</a>
    </div>

    <div class="qui-item">
      <img src="assets/images/engagement.jpg" alt="Notre engagement">
      <h3>Notre engagement</h3>
      <p><?= getContenu($pdo, 'qui-sommes-nous-engagement') ?></p>
      <a href="engagement.php" class="btn btn-sm">En savoir plus</a>
    </div>
  </div>
</section>

<?php include_once '../includes/footer.php'; ?>
