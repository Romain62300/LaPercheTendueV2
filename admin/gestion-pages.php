<?php
session_start();
require_once '../includes/auth.php';
require_once '../includes/csrf.php';
require_admin();
require_once '../database/database.php';

$message = '';
$erreur = '';

// Sauvegarde du contenu
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['sauvegarder'])) {
    csrf_verify();
    foreach ($_POST['contenu'] as $slug => $texte) {
        $stmt = $pdo->prepare("UPDATE pages_contenu SET contenu = ? WHERE page_slug = ?");
        $stmt->execute([trim($texte), $slug]);
    }
    $message = "✅ Les modifications ont été enregistrées avec succès !";
}

// Récupérer tout le contenu
$contenus = $pdo->query("SELECT * FROM pages_contenu ORDER BY page_titre, bloc")->fetchAll(PDO::FETCH_ASSOC);

// Grouper par page
$pages = [];
foreach ($contenus as $c) {
    $pages[$c['page_titre']][$c['page_slug']] = $c;
}

// Page active (onglet)
$page_active = $_GET['page'] ?? array_key_first($pages);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des pages - Admin La Perche Tendue</title>
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
        .sidebar-logo img { height: 60px; border-radius: 50%; border: 2px solid #C62828; }
        .sidebar-logo h2 { font-size: 0.95rem; margin-top: 10px; color: white; }
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
        .main-content { margin-left: 250px; padding: 30px; }
        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }
        .topbar h1 { font-size: 1.5rem; color: #2E4369; font-weight: 700; margin: 0; }
        .btn-logout {
            background: #C62828; color: white; border: none;
            border-radius: 8px; padding: 8px 16px;
            text-decoration: none; font-size: 0.9rem; font-weight: 600;
        }
        .btn-logout:hover { background: #A31F1F; color: white; }
        .card-section {
            background: white;
            border-radius: 12px;
            padding: 24px;
            box-shadow: 0 2px 12px rgba(0,0,0,0.06);
        }
        .nav-tabs .nav-link { color: #2E4369; font-weight: 600; }
        .nav-tabs .nav-link.active { color: #C62828; border-bottom: 3px solid #C62828; }
        .bloc-label {
            font-weight: 600;
            color: #2E4369;
            margin-bottom: 6px;
            font-size: 0.95rem;
        }
        .bloc-label i { color: #C62828; margin-right: 6px; }
        textarea {
            border-radius: 8px;
            border: 1px solid #ddd;
            padding: 12px;
            width: 100%;
            font-size: 0.95rem;
            resize: vertical;
            min-height: 120px;
        }
        textarea:focus { border-color: #2E4369; outline: none; box-shadow: 0 0 0 2px rgba(46,67,105,0.15); }
        .btn-save {
            background: #2E4369; color: white; border: none;
            border-radius: 8px; padding: 12px 30px;
            font-size: 1rem; font-weight: 600; cursor: pointer;
            transition: background 0.2s;
        }
        .btn-save:hover { background: #C62828; }
        .alert-success {
            background: #d4edda; color: #155724;
            border: 1px solid #c3e6cb;
            border-radius: 8px; padding: 12px 20px;
            margin-bottom: 20px;
        }
        .bloc-card {
            background: #f8f9fa;
            border-radius: 10px;
            padding: 16px;
            margin-bottom: 16px;
            border-left: 4px solid #2E4369;
        }
    </style>
</head>
<body>

<!-- Sidebar -->
<div class="sidebar">
    <div class="sidebar-logo">
        <img src="/LaPercheTendueV2/public/assets/images/logo.jpg" alt="Logo">
        <h2>Administration</h2>
    </div>
    <div class="sidebar-menu">
        <a href="dashboard.php"><i class="fa fa-home"></i> Tableau de bord</a>
        <a href="liste-articles.php"><i class="fa fa-newspaper"></i> Articles</a>
        <a href="ajout-article.php"><i class="fa fa-plus"></i> Ajouter un article</a>
        <a href="gestion-membres.php"><i class="fa fa-users"></i> Membres</a>
        <a href="gestion-messages.php"><i class="fa fa-envelope"></i> Messages</a>
        <a href="gestion-dons.php"><i class="fa fa-hand-holding-heart"></i> Dons</a>
        <a href="gestion-pages.php" class="active"><i class="fa fa-file-alt"></i> Pages du site</a>
        <a href="gestion-medias.php"><i class="fa fa-images"></i> Photos</a>
        <a href="/LaPercheTendueV2/public/index.php" target="_blank"><i class="fa fa-globe"></i> Voir le site</a>
        <a href="logout.php" style="margin-top: 20px; color: #ff6b6b;"><i class="fa fa-sign-out-alt"></i> Se déconnecter</a>
    </div>
</div>

<!-- Contenu principal -->
<div class="main-content">
    <div class="topbar">
        <h1><i class="fa fa-file-alt"></i> Gestion des pages du site</h1>
        <a href="logout.php" class="btn-logout"><i class="fa fa-sign-out-alt"></i> Déconnexion</a>
    </div>

    <?php if ($message): ?>
        <div class="alert-success"><?= $message ?></div>
    <?php endif; ?>

    <div class="card-section">
        <p style="color:#888; margin-bottom:20px;">
            <i class="fa fa-info-circle" style="color:#2E4369;"></i>
            Modifiez les textes des pages du site. Cliquez sur <strong>Enregistrer</strong> pour sauvegarder.
        </p>

        <!-- Onglets par page -->
        <ul class="nav nav-tabs mb-4" id="pageTabs">
            <?php foreach (array_keys($pages) as $titre): ?>
                <li class="nav-item">
                    <a class="nav-link <?= $page_active === $titre ? 'active' : '' ?>"
                       href="?page=<?= urlencode($titre) ?>">
                        <?= htmlspecialchars($titre) ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>

        <!-- Formulaire de modification -->
        <form method="POST">
            <?= csrf_token_field() ?>
            <?php if (isset($pages[$page_active])): ?>
                <?php foreach ($pages[$page_active] as $slug => $bloc): ?>
                    <div class="bloc-card">
                        <div class="bloc-label">
                            <i class="fa fa-pen"></i>
                            <?= ucfirst(str_replace('-', ' ', $bloc['bloc'])) ?>
                        </div>
                        <textarea name="contenu[<?= htmlspecialchars($slug) ?>]"><?= htmlspecialchars($bloc['contenu']) ?></textarea>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>

            <div style="text-align:right; margin-top:20px;">
                <button type="submit" name="sauvegarder" class="btn-save">
                    <i class="fa fa-save"></i> Enregistrer les modifications
                </button>
            </div>
        </form>
    </div>
</div>

</body>
</html>
