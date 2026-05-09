<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
require_once '../database/database.php';
 
// Statistiques
$nb_contacts = $pdo->query("SELECT COUNT(*) FROM contacts")->fetchColumn();
$nb_articles = $pdo->query("SELECT COUNT(*) FROM articles")->fetchColumn();
$nb_parrainages = $pdo->query("SELECT COUNT(*) FROM parrainages")->fetchColumn();
$nb_utilisateurs = $pdo->query("SELECT COUNT(*) FROM utilisateurs")->fetchColumn();
 
// Derniers messages
$derniers_contacts = $pdo->query("SELECT * FROM contacts ORDER BY date_envoi DESC LIMIT 5")->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de bord - Admin La Perche Tendue</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        body { background: #f0f2f5; font-family: 'Segoe UI', sans-serif; }
        .sidebar {
            background: #2E4369;
            min-height: 100vh;
            width: 250px;
            position: fixed;
            top: 0; left: 0;
            padding: 20px 0;
            color: white;
        }
        .sidebar-logo {
            text-align: center;
            padding: 20px;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            margin-bottom: 20px;
        }
        .sidebar-logo img {
            height: 60px;
            border-radius: 50%;
            border: 2px solid #C62828;
        }
        .sidebar-logo h2 {
            font-size: 0.95rem;
            margin-top: 10px;
            color: white;
        }
        .sidebar-menu a {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 12px 24px;
            color: rgba(255,255,255,0.8);
            text-decoration: none;
            transition: all 0.2s;
            font-size: 0.95rem;
        }
        .sidebar-menu a:hover, .sidebar-menu a.active {
            background: rgba(255,255,255,0.1);
            color: white;
            border-left: 3px solid #C62828;
        }
        .sidebar-menu a i { width: 20px; }
        .main-content {
            margin-left: 250px;
            padding: 30px;
        }
        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }
        .topbar h1 {
            font-size: 1.5rem;
            color: #2E4369;
            font-weight: 700;
            margin: 0;
        }
        .btn-logout {
            background: #C62828;
            color: white;
            border: none;
            border-radius: 8px;
            padding: 8px 16px;
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 600;
        }
        .btn-logout:hover { background: #A31F1F; color: white; }
        .stat-card {
            background: white;
            border-radius: 12px;
            padding: 24px;
            box-shadow: 0 2px 12px rgba(0,0,0,0.06);
            display: flex;
            align-items: center;
            gap: 16px;
        }
        .stat-icon {
            width: 56px;
            height: 56px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.4rem;
            color: white;
        }
        .stat-info h3 { font-size: 1.8rem; font-weight: 700; margin: 0; color: #2E4369; }
        .stat-info p { margin: 0; color: #888; font-size: 0.9rem; }
        .card-section {
            background: white;
            border-radius: 12px;
            padding: 24px;
            box-shadow: 0 2px 12px rgba(0,0,0,0.06);
            margin-top: 24px;
        }
        .card-section h2 {
            font-size: 1.1rem;
            color: #2E4369;
            font-weight: 700;
            margin-bottom: 20px;
            padding-bottom: 12px;
            border-bottom: 2px solid #f0f2f5;
        }
        .table th { color: #2E4369; font-weight: 600; font-size: 0.9rem; }
        .table td { font-size: 0.9rem; vertical-align: middle; }
        .badge-role {
            background: #2E4369;
            color: white;
            padding: 3px 10px;
            border-radius: 20px;
            font-size: 0.8rem;
        }
    </style>
</head>
<body>
 
<!-- Sidebar -->
<div class="sidebar">
    <div class="sidebar-logo">
        <img src="/LaPercheTendue/LaPercheTendueV2/public/assets/images/logo.jpg" alt="Logo">
        <h2>Administration</h2>
    </div>
    <div class="sidebar-menu">
        <a href="dashboard.php" class="active">
            <i class="fa fa-home"></i> Tableau de bord
        </a>
        <a href="liste-articles.php">
            <i class="fa fa-newspaper"></i> Articles
        </a>
        <a href="ajout-article.php">
            <i class="fa fa-plus"></i> Ajouter un article
        </a>
        <a href="gestion-membres.php">
            <i class="fa fa-users"></i> Membres
        </a>
        <a href="gestion-messages.php"><i class="fa fa-envelope"></i> Messages</a>
        <a href="gestion-dons.php">
            <i class="fa fa-hand-holding-heart"></i> Dons
        </a>
        <a href="/LaPercheTendue/LaPercheTendueV2/public/index.php" target="_blank">
            <i class="fa fa-globe"></i> Voir le site
        </a>
        <a href="logout.php" style="margin-top: 20px; color: #ff6b6b;">
            <i class="fa fa-sign-out-alt"></i> Se déconnecter
        </a>
    </div>
</div>
 
<!-- Contenu principal -->
<div class="main-content">
    <div class="topbar">
        <h1><i class="fa fa-tachometer-alt"></i> Tableau de bord</h1>
        <div>
            <span style="color:#888; font-size:0.9rem; margin-right:16px;">
                <i class="fa fa-user"></i> 
                <?= ($_SESSION['user_role'] == 'admin') ? 'Administrateur' : 'Membre' ?>
            </span>
            <a href="logout.php" class="btn-logout">
                <i class="fa fa-sign-out-alt"></i> Déconnexion
            </a>
        </div>
    </div>
 
    <!-- Statistiques -->
    <div class="row g-3">
        <div class="col-md-3">
            <div class="stat-card">
                <div class="stat-icon" style="background:#C62828;">
                    <i class="fa fa-envelope"></i>
                </div>
                <div class="stat-info">
                    <h3><?= $nb_contacts ?></h3>
                    <p>Messages reçus</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card">
                <div class="stat-icon" style="background:#2E4369;">
                    <i class="fa fa-newspaper"></i>
                </div>
                <div class="stat-info">
                    <h3><?= $nb_articles ?></h3>
                    <p>Articles publiés</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card">
                <div class="stat-icon" style="background:#28a745;">
                    <i class="fa fa-handshake"></i>
                </div>
                <div class="stat-info">
                    <h3><?= $nb_parrainages ?></h3>
                    <p>Parrainages</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card">
                <div class="stat-icon" style="background:#fd7e14;">
                    <i class="fa fa-users"></i>
                </div>
                <div class="stat-info">
                    <h3><?= $nb_utilisateurs ?></h3>
                    <p>Utilisateurs</p>
                </div>
            </div>
        </div>
    </div>
 
    <!-- Derniers messages -->
    <div class="card-section">
        <h2><i class="fa fa-envelope"></i> Derniers messages reçus</h2>
        <?php if (empty($derniers_contacts)): ?>
            <p style="color:#888; text-align:center;">Aucun message reçu pour le moment.</p>
        <?php else: ?>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Email</th>
                        <th>Téléphone</th>
                        <th>Message</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($derniers_contacts as $contact): ?>
                        <tr>
                            <td><?= htmlspecialchars($contact['nom']) ?></td>
                            <td><?= htmlspecialchars($contact['prenom']) ?></td>
                            <td>
                                <a href="mailto:<?= htmlspecialchars($contact['email']) ?>">
                                    <?= htmlspecialchars($contact['email']) ?>
                                </a>
                            </td>
                            <td><?= htmlspecialchars($contact['telephone'] ?? '-') ?></td>
                            <td><?= htmlspecialchars(substr($contact['message'], 0, 50)) ?>...</td>
                            <td><?= date('d/m/Y H:i', strtotime($contact['date_envoi'])) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
 
    <!-- Actions rapides -->
    <div class="card-section">
        <h2><i class="fa fa-bolt"></i> Actions rapides</h2>
        <div class="d-flex gap-3 flex-wrap">
            <a href="ajout-article.php" class="btn" style="background:#2E4369; color:white; border-radius:8px;">
                <i class="fa fa-plus"></i> Nouvel article
            </a>
            <a href="liste-articles.php" class="btn" style="background:#C62828; color:white; border-radius:8px;">
                <i class="fa fa-list"></i> Voir les articles
            </a>
            <a href="gestion-membres.php" class="btn" style="background:#28a745; color:white; border-radius:8px;">
                <i class="fa fa-users"></i> Gérer les membres
            </a>
            <a href="gestion-dons.php" class="btn" style="background:#fd7e14; color:white; border-radius:8px;">
                <i class="fa fa-hand-holding-heart"></i> Voir les dons
            </a>
        </div>
    </div>
</div>
 
</body>
</html>