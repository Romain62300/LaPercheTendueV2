<?php
session_start();
if (!isset($_SESSION['user_id'])) { header("Location: login.php"); exit(); }
require_once '../database/database.php';

if (isset($_GET['supprimer'])) {
    $pdo->prepare("DELETE FROM contacts WHERE id = ?")->execute([(int)$_GET['supprimer']]);
    header("Location: gestion-messages.php?succes=1");
    exit();
}

$messages = $pdo->query("SELECT * FROM contacts ORDER BY date_envoi DESC")->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Messages - Admin</title>
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
        .table th{color:#2E4369;font-weight:600;font-size:0.9rem;}
        .table td{font-size:0.9rem;vertical-align:middle;}
        .msg-preview{max-width:250px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;}
        .btn-delete{background:#C62828;color:white;border:none;border-radius:6px;padding:5px 12px;font-size:0.85rem;cursor:pointer;}
        .btn-delete:hover{background:#A31F1F;}
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
        <a href="gestion-messages.php" class="active"><i class="fa fa-envelope"></i> Messages</a>
        <a href="gestion-membres.php"><i class="fa fa-users"></i> Membres</a>
        <a href="gestion-dons.php"><i class="fa fa-hand-holding-heart"></i> Dons</a>
        <a href="/LaPercheTendueV2/public/index.php" target="_blank"><i class="fa fa-globe"></i> Voir le site</a>
        <a href="logout.php" style="margin-top:20px;color:#ff6b6b;"><i class="fa fa-sign-out-alt"></i> Se déconnecter</a>
    </div>
</div>
<div class="main-content">
    <div class="topbar">
        <h1><i class="fa fa-envelope"></i> Messages reçus (<?= count($messages) ?>)</h1>
    </div>
    <?php if (isset($_GET['succes'])): ?>
        <div style="background:#d4edda;border:1px solid #28a745;color:#155724;border-radius:8px;padding:12px;margin-bottom:20px;">✅ Message supprimé.</div>
    <?php endif; ?>
    <div class="card-section">
        <?php if (empty($messages)): ?>
            <p style="text-align:center;color:#888;padding:40px;">Aucun message reçu.</p>
        <?php else: ?>
        <table class="table table-hover">
            <thead>
                <tr><th>Nom</th><th>Prénom</th><th>Email</th><th>Téléphone</th><th>Message</th><th>Date</th><th>Action</th></tr>
            </thead>
            <tbody>
                <?php foreach ($messages as $m): ?>
                <tr>
                    <td><?= htmlspecialchars($m['nom']) ?></td>
                    <td><?= htmlspecialchars($m['prenom']) ?></td>
                    <td><a href="mailto:<?= htmlspecialchars($m['email']) ?>"><?= htmlspecialchars($m['email']) ?></a></td>
                    <td><?= htmlspecialchars($m['telephone'] ?? '-') ?></td>
                    <td class="msg-preview" title="<?= htmlspecialchars($m['message']) ?>"><?= htmlspecialchars($m['message']) ?></td>
                    <td><?= date('d/m/Y H:i', strtotime($m['date_envoi'])) ?></td>
                    <td>
                        <button class="btn-delete" onclick="if(confirm('Supprimer ce message ?')) window.location='gestion-messages.php?supprimer=<?= $m['id'] ?>'">
                            <i class="fa fa-trash"></i>
                        </button>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php endif; ?>
    </div>
</div>
</body>
</html>
