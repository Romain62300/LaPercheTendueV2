<?php
$page_title = "Épicerie solidaire - La Perche Tendue";
$page_description = "Une aide alimentaire accessible à tous, proposée par nos épiceries solidaires à Lens et Arras.";
require_once '../database/database.php';

function getContenu($pdo, $slug) {
    $stmt = $pdo->prepare("SELECT contenu FROM pages_contenu WHERE page_slug = ?");
    $stmt->execute([$slug]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row ? nl2br(htmlspecialchars($row['contenu'])) : '';
}
?>
<?php include_once '../includes/header.php'; ?>

<section class="page-section container">
  <h2 class="text-center">Notre épicerie solidaire</h2>

  <div class="intro-text">
    <p><?= getContenu($pdo, 'epicerie-intro') ?></p>
  </div>

  <div class="qui-grid">
    <div class="qui-item">
      <img src="assets/images/epicerie.jpg" alt="Épicerie solidaire">
      <h3>Nos produits</h3>
      <p><?= getContenu($pdo, 'epicerie-produits') ?></p>
    </div>

    <div class="qui-item">
      <img src="assets/images/equipe.jpg" alt="Conditions d'accès">
      <h3>Qui peut en bénéficier ?</h3>
      <p><?= getContenu($pdo, 'epicerie-acces') ?></p>
    </div>

    <div class="qui-item">
      <img src="assets/images/engagement.jpg" alt="Nos épiceries">
      <h3>Nos épiceries</h3>
      <p>
        <strong>Épicerie de Lens</strong><br>
        56 rue Casimir Beugnet<br>
        62300 Lens<br>
        📞 <a href="tel:0668492507">06 68 49 25 07</a><br>
        <em>Ouvert du mardi au samedi de 13h à 18h</em>
      </p>
      <p style="margin-top: 15px;">
        <strong>Épicerie d'Arras</strong><br>
        122 rue du Commandant Dumetz<br>
        62000 Arras<br>
        📞 <a href="tel:0660238469">06 60 23 84 69</a><br>
        <em>Ouvert du mardi au samedi de 12h à 17h</em>
      </p>
    </div>
  </div>

  <div style="text-align:center; margin-top: 40px;">
    <a href="contact.php" class="btn btn-sm">Nous contacter pour plus d'informations</a>
  </div>
</section>

<?php include_once '../includes/footer.php'; ?>
