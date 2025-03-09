<?php
include '../includes/header.php';
require '../database/database.php';

echo "<h2>Actualités</h2>";

$sql_actualites = "SELECT * FROM articles ORDER BY date_publication DESC";
$stmt_actualites = $pdo->query($sql_actualites);
$actualites = $stmt_actualites->fetchAll(PDO::FETCH_ASSOC);

if ($actualites) {
    echo "<ul>";
    foreach ($actualites as $article) {
        echo "<li><strong>" . htmlspecialchars($article['titre']) . "</strong><br>";
        echo "<p>" . nl2br(htmlspecialchars($article['contenu'])) . "</p>";
        echo "<small>Publié le : " . $article['date_publication'] . "</small></li><hr>";
    }
    echo "</ul>";
} else {
    echo "<p>Aucune actualité pour le moment.</p>";
}

include '../includes/footer.php';
?>
