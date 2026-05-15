<?php
$page_title = "Nos activités - La Perche Tendue";
$page_description = "Découvrez les différentes actions menées par l'association La Perche Tendue à Lens.";
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
  <h2 class="text-center">Nos activités</h2>
  <div class="intro-text"><p><?= getC($pdo,'activites-intro') ?></p></div>
  <div class="qui-grid">
    <div class="qui-item">
      <img src="assets/images/epicerie.jpg" alt="Aide alimentaire">
      <h3><?= getC($pdo,'activites-alimentaire-titre') ?></h3>
      <p><?= getC($pdo,'activites-alimentaire-texte') ?></p>
      <a href="epicerie.php" class="btn btn-sm">En savoir plus</a>
    </div>
    <div class="qui-item">
      <img src="assets/images/equipe.jpg" alt="Accompagnement social">
      <h3><?= getC($pdo,'activites-social-titre') ?></h3>
      <p><?= getC($pdo,'activites-social-texte') ?></p>
      <a href="contact.php" class="btn btn-sm">Nous rejoindre</a>
    </div>
    <div class="qui-item">
      <img src="assets/images/valeurs.jpg" alt="Lien social">
      <h3><?= getC($pdo,'activites-lien-titre') ?></h3>
      <p><?= getC($pdo,'activites-lien-texte') ?></p>
      <a href="evenements.php" class="btn btn-sm">Voir les événements</a>
    </div>
    <div class="qui-item">
      <img src="assets/images/engagement.jpg" alt="Parrainage">
      <h3><?= getC($pdo,'activites-parrainage-titre') ?></h3>
      <p><?= getC($pdo,'activites-parrainage-texte') ?></p>
      <a href="parrainage.php" class="btn btn-sm">Devenir parrain</a>
    </div>
    <div class="qui-item">
      <img src="assets/images/parade.jpg" alt="Activités culturelles">
      <h3><?= getC($pdo,'activites-culture-titre') ?></h3>
      <p><?= getC($pdo,'activites-culture-texte') ?></p>
      <a href="evenements.php" class="btn btn-sm">Voir les événements</a>
    </div>
    <div class="qui-item">
      <img src="assets/images/festival.jpg" alt="Bénévolat">
      <h3><?= getC($pdo,'activites-benevolat-titre') ?></h3>
      <p><?= getC($pdo,'activites-benevolat-texte') ?></p>
      <a href="contact.php" class="btn btn-sm">Devenir bénévole</a>
    </div>
  </div>
</section>
<?php include_once '../includes/footer.php'; ?>
