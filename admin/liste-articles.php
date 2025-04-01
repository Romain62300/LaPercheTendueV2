<?php
include_once '../includes/header.php';
require_once '../database/database.php';

// Récupération des articles
$sql = "SELECT * FROM articles ORDER BY date_publication DESC";
$stmt = $pdo->query($sql);
$articles = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<section class="container">
  <h2 class="section-title">Liste des actualités</h2>

  <?php if ($articles): ?>
    <table border="1" cellpadding="10" cellspacing="0" style="width:100%; border-collapse: collapse;">
      <thead>
        <tr>
          <th>ID</th>
          <th>Titre</th>
          <th>Date de publication</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($articles as $article): ?>
          <tr>
            <td><?= $article['id'] ?></td>
            <td><?= htmlspecialchars($article['titre']) ?></td>
            <td><?= $article['date_publication'] ?></td>
            <td>
              <a href="modifier-article.php?id=<?= $article['id'] ?>">✏️ Modifier</a> |
              <a href="supprimer-article.php?id=<?= $article['id'] ?>" onclick="return confirm('Supprimer cet article ?');">🗑️ Supprimer</a>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  <?php else: ?>
    <p>Aucun article pour le moment.</p>
  <?php endif; ?>
</section>

<?php include_once '../includes/footer.php'; ?>
