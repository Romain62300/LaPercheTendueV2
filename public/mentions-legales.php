<?php
$page_title = "Mentions légales - La Perche Tendue";
$page_description = "Mentions légales et politique de confidentialité du site La Perche Tendue.";
require_once '../database/database.php';
function getC($pdo, $slug) {
    $stmt = $pdo->prepare("SELECT contenu FROM pages_contenu WHERE page_slug = ?");
    $stmt->execute([$slug]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row ? htmlspecialchars($row['contenu']) : '';
}
?>
<?php include_once '../includes/header.php'; ?>
<section class="mentions-legales container">
  <h2 class="text-center">Mentions légales</h2>
  <p style="background-color:#d9f7ff;padding:1rem;border-left:4px solid #007BFF;">
    Ce site respecte le RGPD. Vos données ne sont ni revendues ni partagées. <a href="#cookies">En savoir plus</a>.
  </p>
  <p><strong>Site :</strong> <?= getC($pdo,'mentions-site') ?></p>
  <p><strong>Responsable éditeur :</strong> Association La Perche Tendue</p>
  <h3>Identité de l'association</h3>
  <ul>
    <li><strong>Nom :</strong> Association La Perche Tendue</li>
    <li><strong>Épicerie de Lens :</strong> 56 rue Casimir Beugnet, 62300 Lens — 06 68 49 25 07</li>
    <li><strong>Épicerie d'Arras :</strong> 122 rue du Commandant Dumetz, 62000 Arras — 06 60 23 84 69</li>
    <li><strong>Email :</strong> <?= getC($pdo,'mentions-email') ?></li>
    <li><strong>Responsable de la publication :</strong> <?= getC($pdo,'mentions-responsable') ?></li>
  </ul>
  <h3>Hébergement</h3>
  <p><?= getC($pdo,'mentions-hebergeur') ?></p>
  <h3>Protection des données personnelles</h3>
  <p>Les données transmises via le formulaire de contact sont utilisées uniquement dans le cadre des missions de l'association. Elles ne sont ni revendues, ni transmises à des tiers.</p>
  <h3 id="cookies">Cookies</h3>
  <p>Le site utilise uniquement des cookies strictement nécessaires au bon fonctionnement.</p>
  <p>Les cookies tiers (YouTube, Facebook, etc.) sont soumis à votre consentement via le bandeau RGPD (TarteAuCitron.js).</p>
  <p>Vous pouvez modifier vos choix à tout moment via le bouton <strong>« Gestion des cookies »</strong> situé en bas de page.</p>
  <p style="margin-top:2rem;font-size:0.9em;color:#555;">Site développé et intégré par <strong>Romain Monier</strong> &ndash; développeur web</p>
  <p><strong>Dernière mise à jour :</strong> Mai 2026</p>
</section>
<?php include_once '../includes/footer.php'; ?>
