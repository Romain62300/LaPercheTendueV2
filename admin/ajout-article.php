<?php
$page_title = "Ajouter un article - Admin - La Perche Tendue";
$page_description = "Page d'ajout d'un nouvel article dans l'administration.";
?>
<?php
require_once '../includes/session.php'; // sécurité session admin
require_once '../includes/header.php';
require_once '../database/database.php';

// Traitement du formulaire
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $titre = $_POST['titre'] ?? '';
    $contenu = $_POST['contenu'] ?? '';

    if (!empty($titre) && !empty($contenu)) {
        $sql = "INSERT INTO articles (titre, contenu, date_publication) VALUES (:titre, :contenu, NOW())";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['titre' => $titre, 'contenu' => $contenu]);
        $message = "Article ajouté avec succès !";
    } else {
        $message = "Veuillez remplir tous les champs.";
    }
}
?>

<section class="page-section container">
  <h2 class="section-title">Ajouter un article</h2>

  <?php if (isset($message)): ?>
    <p style="color: green;"><?= htmlspecialchars($message) ?></p>
  <?php endif; ?>

  <form method="POST" action="" class="form-boite">
    <div class="form-group">
      <label for="titre">Titre :</label>
      <input type="text" id="titre" name="titre" required>
    </div>
    <div class="form-group">
      <label for="contenu">Contenu :</label>
      <textarea id="contenu" name="contenu" rows="8" required></textarea>
    </div>
    <button type="submit" class="btn-submit">Ajouter</button>
  </form>
</section>

<?php include_once '../includes/footer.php'; ?>
