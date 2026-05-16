<?php
session_start();
require_once '../includes/auth.php';
require_admin();
require_once '../database/database.php';
require_once '../includes/csrf.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    csrf_verify();
    $id = (int)($_POST['id'] ?? 0);
    if ($id > 0) {
        $pdo->prepare("DELETE FROM articles WHERE id = ?")->execute([$id]);
        header("Location: liste-articles.php?succes=supprime");
        exit();
    }
}

// Affichage confirmation
$id = (int)($_GET['id'] ?? 0);
if (!$id) {
    header("Location: liste-articles.php");
    exit();
}
$article = $pdo->prepare("SELECT titre FROM articles WHERE id = ?");
$article->execute([$id]);
$article = $article->fetch(PDO::FETCH_ASSOC);
if (!$article) {
    header("Location: liste-articles.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Supprimer article</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body class="p-4">
    <div class="alert alert-danger" style="max-width:600px;margin:50px auto;">
        <h4>⚠️ Supprimer cet article ?</h4>
        <p><strong><?= htmlspecialchars($article['titre']) ?></strong></p>
        <p>Cette action est irréversible.</p>
        <form method="POST">
            <?= csrf_token_field() ?>
            <input type="hidden" name="id" value="<?= $id ?>">
            <button type="submit" class="btn btn-danger">Oui, supprimer</button>
            <a href="liste-articles.php" class="btn btn-secondary">Annuler</a>
        </form>
    </div>
</body>
</html>
