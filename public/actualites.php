<?php
$page_title = "Actualités - La Perche Tendue";
$page_description = "Suivez les dernières nouvelles et événements de l'association La Perche Tendue.";

require '../database/database.php';
include '../includes/header.php';

$sql_actualites = "SELECT * FROM articles ORDER BY date_publication DESC";
$stmt_actualites = $pdo->query($sql_actualites);
$actualites = $stmt_actualites->fetchAll(PDO::FETCH_ASSOC);
?>

<section class="actualites container">
  <h2 class="section-title">Actualités</h2>
  <?php if (!empty($actualites)) : ?>
    <div class="actualites-grid">
      <?php foreach ($actualites as $article) : ?>
        <article class="actualite">

          <?php if (!empty($article['image'])) : ?>
            <img
              src="assets/images/<?php echo htmlspecialchars($article['image']); ?>"
              alt="<?php echo htmlspecialchars($article['titre']); ?>">
          <?php endif; ?>

          <h3><?php echo htmlspecialchars($article['titre']); ?></h3>

          <p><?php echo nl2br(htmlspecialchars($article['contenu'])); ?></p>

          <small>
            Publié le : <?php echo htmlspecialchars($article['date_publication']); ?>
          </small>
        </article>
      <?php endforeach; ?>
    </div>
  <?php else : ?>
    <p>Aucune actualité pour le moment.</p>
  <?php endif; ?>
</section>

<?php include '../includes/footer.php'; ?>