<?php
$page_title = "Parrainage - La Perche Tendue";
$page_description = "Soutenez une personne ou une famille via notre programme de parrainage solidaire.";
require_once '../database/database.php';

function getContenu($pdo, $slug) {
    $stmt = $pdo->prepare("SELECT contenu FROM pages_contenu WHERE page_slug = ?");
    $stmt->execute([$slug]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row ? nl2br(htmlspecialchars($row['contenu'])) : '';
}
?>
<?php include '../includes/header.php'; ?>

<div class="parrainage-container">
    <div class="parrainage-banner">
        <h2 class="text-center">Pourquoi parrainer ?</h2>
        <p><?= getContenu($pdo, 'parrainage-pourquoi') ?></p>
    </div>

    <div class="parrainage-info">
        <h2>Comment ça marche ?</h2>
        <p><?= getContenu($pdo, 'parrainage-comment') ?></p>

        <h2>Comment participer ?</h2>
        <p>Contactez-nous à l'adresse suivante :
            <a href="mailto:<?= htmlspecialchars($pdo->query("SELECT contenu FROM pages_contenu WHERE page_slug='parrainage-contact'")->fetchColumn()) ?>">
                <?= htmlspecialchars($pdo->query("SELECT contenu FROM pages_contenu WHERE page_slug='parrainage-contact'")->fetchColumn()) ?>
            </a>
        </p>

        <a href="inscription-parrainage.php" class="btn-parrain">Devenir Parrain</a>
    </div>
</div>

<?php include '../includes/footer.php'; ?>
