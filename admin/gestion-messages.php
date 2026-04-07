<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
require_once '../database/database.php';

// Suppression d'un message
if (isset($_GET['supprimer'])) {
    $id = (int)$_GET['supprimer'];
    $pdo->prepare("DELETE FROM contacts WHERE id = ?")->execute([$id]);
    header("Location: gestion-messages.php?succes=supprime");
    exit();
}

$messages = $pdo->query("SELECT * FROM contacts ORDER BY date_envoi DESC")->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Messages - Administration</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        body { background-color: #f0f2f5; }
        .sidebar { background-color: #2E4369; min-height: 100vh; padding: 0; width: 250px; position: fixed; top: 0; left: 0; }
        .sidebar-logo { padding: 20px; text-align: center; border-bottom: 1px solid rgba(255,255,255,0.1); }
        .sidebar-logo img { height: 60px; border-radius: 8px; }
        .sidebar-logo h2 { color: white; font-size: 0.9rem; margin-top: 8px; }
        .sidebar-nav { padding: 20px 0; }
        .sidebar-nav a { display: block; padding: 12px 24px; color: rgba(255,255,255,0.8); text-decoration: none; transition: all 0.2s; font-weight: 500; }
        .sidebar-nav a:hover, .sidebar-nav a.active { background-color: rgba(255,255,255,0.1); color: white; border-left: 3px solid #C62828; }
        .sidebar-nav a i { width: 20px; margin-right: 10px; }
        .main-content { margin-left: 250px; padding: 30px; }
        .top-bar { background: white; padding: 15px 30px; margin: -30px -30px 30px -30px; display: flex; justify-content: space-between; align-items: center; box-shadow: 0 2px 4px rgba(0,0,0,0.05); }
        .section-card { background: white; border-radius: 12px; padding: 24px; box-shadow: 0 2px 10px rgba(0,0,0,0.06); }
        .btn-rouge { background-color: #C62828; color: white; border: none; }
        .btn-rouge:hover { background-color: #A31F1F; color: white; }
    </style>
</head>
<body>

<div class="sidebar">
    <div class="sidebar-logo">
        <img src="/LaPercheTendue/LaPercheTendueV2/public/assets/images/logo.jpg" alt="Logo">
        <h2>Administration</h2>
    </div>
    <nav class="sidebar-nav">
        <a href="dashboard.php"><i class="fas fa-tachometer-alt"></i>Tableau de bord</a>
        <a href="liste-articles.php"><i class="fas fa-newspaper"></i>Articles</a>
        <a href="ajout-article.php"><i class="fas fa-plus-circle"></i>Nouvel article</a>
        <a href="gestion-messages.php" class="active"><i class="fas fa-envelope"></i>Messages</a>
        <a href="gestion-membres.php"><i class="fas fa-users"></i>Membres</a>
        <a href="gestion-dons.php"><i class="fas fa-hand-holding-heart"></i>Dons</a>
        <hr style="border-color: rgba(255,255,255,0.1); margin: 10px 20px;">
        <a href="/LaPercheTendue/LaPercheTendueV2/public/index.php" target="_blank"><i class="fas fa-external-link-alt"></i>Voir le site</a>
        <a href="logout.php"><i class="fas fa-sign-out-alt"></i>Déconnexion</a>
    </nav>
</div>

<div class="main-content">
    <div class="top-bar">
        <h1 style="font-size: 1.4rem; font-weight: 700; color: #2E4369; margin: 0;">
            <i class="fas fa-envelope me-2"></i>Messages de contact
        </h1>
        <a href="dashboard.php" class="btn btn-sm btn-outline-secondary">← Retour</a>
    </div>

    <?php if (isset($_GET['succes'])): ?>
        <div class="alert alert-success">✅ Message supprimé avec succès.</div>
    <?php endif; ?>

    <div class="section-card">
        <?php if ($messages): ?>
        <table class="table table-hover">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Email</th>
                    <th>Téléphone</th>
                    <th>Message</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($messages as $msg): ?>
                <tr>
                    <td><?= $msg['id'] ?></td>
                    <td><?= htmlspecialchars($msg['nom']) ?></td>
                    <td><?= htmlspecialchars($msg['prenom'] ?? '') ?></td>
                    <td><a href="mailto:<?= $msg['email'] ?>"><?= htmlspecialchars($msg['email']) ?></a></td>
                    <td><?= htmlspecialchars($msg['telephone'] ?? 'N/A') ?></td>
                    <td><?= htmlspecialchars(substr($msg['message'], 0, 80)) ?>...</td>
                    <td><?= date('d/m/Y H:i', strtotime($msg['date_envoi'])) ?></td>
                    <td>
                        <a href="?supprimer=<?= $msg['id'] ?>" 
                           class="btn btn-sm btn-danger"
                           onclick="return confirm('Supprimer ce message ?')">
                            <i class="fas fa-trash"></i>
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php else: ?>
            <p class="text-muted text-center py-4">
                <i class="fas fa-inbox fa-2x mb-3 d-block"></i>
                Aucun message reçu pour le moment.
            </p>
        <?php endif; ?>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
