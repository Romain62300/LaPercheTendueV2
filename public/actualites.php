<meta charset="UTF-8">
<title>La Perche Tendue</title>
<meta name="description" content="Association solidaire à Lens : épicerie sociale, dons, accompagnement et entraide.">
<!-- Open Graph -->
<meta property="og:title" content="La Perche Tendue" />
<meta property="og:description" content="Association solidaire à Lens : épicerie sociale, dons, accompagnement et entraide." />
<meta property="og:image" content="https://ton-site.com/public/assets/images/logo.png" />
<meta property="og:url" content="https://ton-site.com/actualites.php" />
<meta property="og:type" content="website">
<!-- Twitter Card -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="La Perche Tendue">
<meta name="twitter:description" content="Association solidaire à Lens : épicerie sociale, dons, accompagnement et entraide.">
<meta name="twitter:image" content="https://ton-site.com/public/assets/images/logo.png">
<link rel="canonical" href="https://ton-site.com/actualites.php">
<link rel="icon" href="/public/assets/images/favicon.png" type="image/png">
<?php
$page_title = "Actualités - La Perche Tendue";
$page_description = "Suivez les dernières nouvelles et événements de l'association La Perche Tendue.";
?>
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
