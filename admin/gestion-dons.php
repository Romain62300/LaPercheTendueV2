<?php
session_start();
if (!isset($_SESSION['user_id'])) { header("Location: login.php"); exit(); }
require_once '../database/database.php';

$dons = $pdo->query("SELECT d.*, u.nom as donateur FROM dons d LEFT JOIN utilisateurs u ON d.utilisateur_id = u.id ORDER BY d.date_don DESC")->fetchAll(PDO::FETCH_ASSOC);
$total = $pdo->query("SELECT SUM(montant) FROM dons")->fetchColumn();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Dons - Admin</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        body{background:#f0f2f5;font-family:'Segoe UI',sans-serif;}
        .sidebar{background:#2E4369;min-height:100vh;width:250px;position:fixed;top:0;left:0;padding:20px 0;}
        .sidebar-logo{text-align:center;padding:20px;border-bottom:1px solid rgba(255,255,255,0.1);margin-bottom:20px;}
        .sidebar-logo img{height:60px;border-radius:50%;border:2px solid #C62828;}
        .sidebar-logo h2{font-size:0.95rem;margin-top:10px;color:white;}
        .sidebar-menu a{display:flex;align-items:center;gap:10px;padding:12px 24px;color:rgba(255,255,255,0.8);text-decoration:none;transition:all 0.2s;font-size:0.95rem;}
        .sidebar-menu a:hover,.sidebar-menu a.active{background:rgba(255,255,255,0.1);color:white;border-left:3px solid #C62828;}
        .sidebar-menu a i{width:20px;}
        .main-content{margin-left:250px;padding:30px;}
        .topbar{display:flex;justify-content:space-between;align-items:center;margin-bottom:30px;}
        .topbar h1{font-size:1.5rem;color:#2E4369;font-weight:700;margin:0;}
        .card-section{background:white;border-radius:12px;padding:24px;box-shadow:0 2px 12px rgba(0,0,0,0.06);}
        .stat-card{background:white;border-radius:12px;padding:24px;box-shadow:0 2px 12px rgba(0,0,0,0.06);display:flex;align-items:center;gap:16px;margin-bottom:24px;}
        .stat-icon{width:56px;height:56px;border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:1.4rem;color:white;background:#28a745;}
        .stat-info h3{font-size:1.8rem;font-weight:700;margin:0;color:#2E4369;}
        .stat-info p{margin:0;color:#888;font-size:0.9rem;}
        .table th{color:#2E4369;font-weight:600;font-size:0.9rem;}
        .table td{font-size:0.9rem;vertical-align:middle;}
        .badge-type{background:#2E4369;color:white;padding:3px 10px;border-radius:20px;font-size:0.8rem;}
    </style>
</head>
<body>
<div class="sidebar">
    <div class="sidebar-logo">
        <img src="/LaPercheTendueV2/public/assets/images/logo.jpg" alt="Logo">
        <h2>Administration</h2>
    </div>
    <div class="sidebar-menu">
        <a href="dashboard.php"><i class="fa fa-home"></i> Tableau de bord</a>
        <a href="liste-articles.php"><i class="fa fa-newspaper"></i> Articles</a>
        <a href="ajout-article.php"><i class="fa fa-plus"></i> Ajouter un article</a>
        <a href="gestion-messages.php"><i class="fa fa-envelope"></i> Messages</a>
        <a href="gestion-membres.php"><i class="fa fa-users"></i> Membres</a>
        <a href="gestion-dons.php" class="active"><i class="fa fa-hand-holding-heart"></i> Dons</a>
        <a href="/LaPercheTendueV2/public/index.php" target="_blank"><i class="fa fa-globe"></i> Voir le site</a>
        <a href="logout.php" style="margin-top:20px;color:#ff6b6b;"><i class="fa fa-sign-out-alt"></i> Se déconnecter</a>
    </div>
</div>
<div class="main-content">
    <div class="topbar">
        <h1><i class="fa fa-hand-holding-heart"></i> Gestion des dons</h1>
    </div>

    <div class="stat-card">
        <div class="stat-icon"><i class="fa fa-euro-sign"></i></div>
        <div class="stat-info">
            <h3><?= number_format((float)$total, 2, ',', ' ') ?> €</h3>
            <p>Total des dons reçus</p>
        </div>
    </div>

    <div class="card-section">
        <?php if (empty($dons)): ?>
            <p style="text-align:center;color:#888;padding:40px;">Aucun don enregistré pour le moment.</p>
        <?php else: ?>
        <table class="table table-hover">
            <thead>
                <tr><th>Donateur</th><th>Montant</th><th>Date</th></tr>
            </thead>
            <tbody>
                <?php foreach ($dons as $d): ?>
                <tr>
                    <td><?= htmlspecialchars($d['donateur'] ?? 'Anonyme') ?></td>
                    <td><strong><?= number_format((float)$d['montant'], 2, ',', ' ') ?> €</strong></td>
                    <td><?= date('d/m/Y', strtotime($d['date_don'])) ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php endif; ?>
    </div>
</div>
</body>
</html>
