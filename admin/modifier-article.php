<?php
require_once '../database/database.php';
include_once '../includes/header.php';

// Vérifie si l'ID est passé dans l'URL
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo "<p>ID d'article invalide.</p>";
    include_once '../includes/footer.php';
    exit;
}

$id = (int)$_GET['id'];
$message = "";

// Traitement du formulaire
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $titre = $_POST['titre'] ?? '';
    $contenu = $_POST['contenu'] ?? '';

    if (!empty($titre) && !empty($contenu)) {
        $stmt = $pdo->prepare("UPDATE articles SET titre = :titre, contenu = :contenu WHERE id = :id");
        $stmt->execute([
            'titre' => $titre,
            'contenu' => $contenu,
            'id' => $id
        ]);
        $message = "✅ Article mis à jour avec succès.";
    } else {
        $message = "❌ Merci de remplir tous les champs.";
    }
}

// Récupère les infos de l'article
$stmt = $pdo->prepare("SELECT * FROM articles WHERE id = :id");
$stmt->execute(['id' => $id]);
$article = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$article) {
    echo "<p>Article non trouvé.</p>";
    include_once '../includes/footer.php';
    exit;
}
?>

<section class="container">
    <h2 class="section-title">Modifier un article</h2>

    <?php if ($message): ?>
        <p style="color: <?= str_starts_with($message, '✅') ? 'green' : 'red'; ?>"><?= $message; ?></p>
    <?php endif; ?>

    <form method="POST" class="form-style-boite">
        <div class="form-group">
            <label for="titre">Titre</label>
            <input type="text" id="titre" name="titre" value="<?= htmlspecialchars($article['titre']) ?>" required>
        </div>
        <div class="form-group">
            <label for="contenu">Contenu</label>
            <textarea id="contenu" name="contenu" rows="8" required><?= htmlspecialchars($article['contenu']) ?></textarea>
        </div>
        <button type="submit" class="btn-submit">Mettre à jour</button>
    </form>
</section>

<?php include_once '../includes/footer.php'; ?>
