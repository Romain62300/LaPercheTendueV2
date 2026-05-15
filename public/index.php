<?php
$page_title = "Accueil - La Perche Tendue";
$page_description = "Association solidaire à Lens : épicerie sociale, dons, parrainage et accompagnement.";
require_once '../database/database.php';

function getC($pdo, $slug) {
    $stmt = $pdo->prepare("SELECT contenu FROM pages_contenu WHERE page_slug = ?");
    $stmt->execute([$slug]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row ? htmlspecialchars($row['contenu']) : '';
}
function getPhoto($pdo, $page, $section, $defaut = 'actu1.jpg') {
    $stmt = $pdo->prepare("SELECT nom_fichier FROM pages_photos WHERE page_slug = ? AND section_slug = ?");
    $stmt->execute([$page, $section]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row ? htmlspecialchars($row['nom_fichier']) : $defaut;
}
?>
<?php include_once '../includes/header.php'; ?>

<section class="services container">
  <h2 class="text-center">« <?= getC($pdo, 'accueil-services-titre') ?> »</h2>
  <div class="services-grid">
    <div class="service">
      <a href="nos-activites.php">
        <img src="assets/images/<?= getPhoto($pdo,'accueil','service1','actu1.jpg') ?>?v=2" alt="Activités">
        <p>« <?= getC($pdo, 'accueil-service1-texte') ?> »</p>
      </a>
    </div>
    <div class="service">
      <a href="evenements.php">
        <img src="assets/images/<?= getPhoto($pdo,'accueil','service2','actu2.jpg') ?>?v=2" alt="Événements">
        <p>« <?= getC($pdo, 'accueil-service2-texte') ?> »</p>
      </a>
    </div>
    <div class="service">
      <a href="epicerie.php">
        <img src="assets/images/<?= getPhoto($pdo,'accueil','service3','epicerie.jpg') ?>?v=2" alt="Épicerie">
        <p>« <?= getC($pdo, 'accueil-service3-texte') ?> »</p>
      </a>
    </div>
  </div>
</section>

<section class="actualites container">
  <h2 class="text-center">« <?= getC($pdo, 'accueil-actu-titre') ?> »</h2>
  <div class="actualites-grid">
    <a href="nos-activites.php" class="actualite">
      <img src="assets/images/<?= getPhoto($pdo,'accueil','actu1','actu1.jpg') ?>?v=2" alt="Actu 1">
      <h3>« <?= getC($pdo, 'accueil-actu1-titre') ?> »</h3>
      <p><?= getC($pdo, 'accueil-actu1-texte') ?></p>
    </a>
    <a href="festival.php" class="actualite">
      <img src="assets/images/<?= getPhoto($pdo,'accueil','actu2','festival.jpg') ?>?v=2" alt="Festival">
      <h3>« <?= getC($pdo, 'accueil-actu2-titre') ?> »</h3>
      <p><?= getC($pdo, 'accueil-actu2-texte') ?></p>
    </a>
    <a href="parade.php" class="actualite">
      <img src="assets/images/<?= getPhoto($pdo,'accueil','actu3','parade.jpg') ?>?v=2" alt="Parade">
      <h3>« <?= getC($pdo, 'accueil-actu3-titre') ?> »</h3>
      <p><?= getC($pdo, 'accueil-actu3-texte') ?></p>
    </a>
  </div>
</section>

<section class="perche-section container">
  <h2 class="text-center">« <?= getC($pdo, 'accueil-perche-titre') ?> »</h2>
  <div class="perche-grid">
    <div class="perche-item">
      <img src="assets/images/<?= getPhoto($pdo,'accueil','perche1','perche1.jpg') ?>?v=2" alt="Perche 1">
      <p>« 2022-09-01 »</p>
      <a class="btn btn-primary" href="perche1.php">Télécharger</a>
    </div>
    <div class="perche-item">
      <img src="assets/images/<?= getPhoto($pdo,'accueil','perche2','perche2.jpg') ?>?v=2" alt="Perche 2">
      <p>« 2022-09-07 »</p>
      <a class="btn btn-primary" href="perche2.php">Télécharger</a>
    </div>
    <div class="perche-item">
      <img src="assets/images/<?= getPhoto($pdo,'accueil','perche3','perche3.jpg') ?>?v=2" alt="Perche 3">
      <p>« 2022-10-01 »</p>
      <a class="btn btn-primary" href="perche3.php">Télécharger</a>
    </div>
  </div>
</section>

<?php include_once '../includes/footer.php'; ?>
