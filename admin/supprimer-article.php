<?php
require_once '../database/database.php';
include_once '../includes/header.php';

// Vérifie l'ID passé dans l'URL
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo "<p>ID invalide.</p>";
    include_once '../includes/footer.php';
    exit;
}

$id = (int)$_GET['id'];
$confirmation = $_GET['confirm'] ?? '';

if ($confirmation === 'oui') {
    // Suppression de l'article
    $stmt = $pdo->prepare("DELETE FROM articles WHERE id = :id");
    $stmt->execute(['id' => $id]);

    echo "<p style='color: green;'>✅ Article supprimé avec succès.</p>";
    echo "<p><a href='liste-articles.php' class='btn btn-sm'>Retour à la liste des articles</a></p>";
} else {
    // Demande confirmation
    echo "<h2 class='section-title'>Suppression d'un article</h2>";
    echo "<p style='color: red;'>⚠️ Êtes-vous sûr de vouloir supprimer l'article #$id ? Cette action est irréversible.</p>";
    echo "<p><a href='supprimer-article.php?id=$id&confirm=oui' class='btn btn-sm'>Oui, supprimer</a> ";
    echo " | <a href='liste-articles.php' class='btn btn-sm'>Annuler</a></p>";
}

include_once '../includes/footer.php';
?>
