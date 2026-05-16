<?php
session_start();
require_once '../includes/auth.php';
require_admin();
require_once '../database/database.php';
 
// Suppression
// Suppression via POST sécurisée
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['supprimer_id'])) {
    require_once '../includes/csrf.php';
    csrf_verify();
    $id = (int)$_POST['supprimer_id'];
    $pdo->prepare("DELETE FROM articles WHERE id = ?")->execute([$id]);
    header("Location: liste-articles.php?succes=supprime");
    exit();
}
 
$articles = $pdo->query("SELECT a.*, u.nom as auteur_nom FROM articles a LEFT JOIN utilisateurs u ON a.auteur_id = u.id ORDER BY a.date_publication DESC")->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des articles - Admin</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        body { background:#f0f2f5; font-family:'Segoe UI',sans-serif; }
        .sidebar { background:#2E4369; min-height:100vh; width:250px; position:fixed; top:0; left:0; padding:20px 0; }
        .sidebar-logo { text-align:center; padding:20px; border-bottom:1px solid rgba(255,255,255,0.1); margin-bottom:20px; }
        .sidebar-logo img { height:60px; border-radius:50%; border:2px solid #C62828; }
        .sidebar-logo h2 { font-size:0.95rem; margin-top:10px; color:white; }
        .sidebar-menu a { display:flex; align-items:center; gap:10px; padding:12px 24px; color:rgba(255,255,255,0.8); text-decoration:none; transition:all 0.2s; font-size:0.95rem; }
        .sidebar-menu a:hover, .sidebar-menu a.active { background:rgba(255,255,255,0.1); color:white; border-left:3px solid #C62828; }
        .sidebar-menu a i { width:20px; }
        .main-content { margin-left:250px; padding:30px; }
        .topbar { display:flex; justify-content:space-between; align-items:center; margin-bottom:30px; }
        .topbar h1 { font-size:1.5rem; color:#2E4369; font-weight:700; margin:0; }
        .card-section { background:white; border-radius:12px; padding:24px; box-shadow:0 2px 12px rgba(0,0,0,0.06); }
        .table th { color:#2E4369; font-weight:600; font-size:0.9rem; }
        .table td { font-size:0.9rem; vertical-align:middle; }
        .article-img { width:60px; height:50px; object-fit:cover; border-radius:6px; }
        .btn-edit { background:#2E4369; color:white; border:none; border-radius:6px; padding:5px 12px; font-size:0.85rem; text-decoration:none; }
        .btn-delete { background:#C62828; color:white; border:none; border-radius:6px; padding:5px 12px; font-size:0.85rem; cursor:pointer; }
        .btn-edit:hover { background:#1e2f4a; color:white; }
        .btn-delete:hover { background:#A31F1F; }
    </style>
</head>
<body>
<div class="sidebar">
    <div class="sidebar-logo">
        <img src="/LaPercheTendueV2/public/assets/images/logo.jpg" alt="Logo">
        <h2 style="color:white;">Administration</h2>
    </div>
    <div class="sidebar-menu">
        <a href="dashboard.php"><i class="fa fa-home"></i> Tableau de bord</a>
        <a href="liste-articles.php" class="active"><i class="fa fa-newspaper"></i> Articles</a>
        <a href="ajout-article.php"><i class="fa fa-plus"></i> Ajouter un article</a>
        <a href="gestion-membres.php"><i class="fa fa-users"></i> Membres</a>
        <a href="gestion-dons.php"><i class="fa fa-hand-holding-heart"></i> Dons</a>
        <a href="/LaPercheTendueV2/public/index.php" target="_blank"><i class="fa fa-globe"></i> Voir le site</a>
        <a href="logout.php" style="margin-top:20px;color:#ff6b6b;"><i class="fa fa-sign-out-alt"></i> Se déconnecter</a>
    </div>
</div>
 
<div class="main-content">
    <div class="topbar">
        <h1><i class="fa fa-newspaper"></i> Articles publiés</h1>
        <a href="ajout-article.php" class="btn" style="background:#C62828;color:white;border-radius:8px;">
            <i class="fa fa-plus"></i> Nouvel article
        </a>
    </div>
 
    <?php if (isset($_GET['succes'])): ?>
        <div style="background:#d4edda;border:1px solid #28a745;color:#155724;border-radius:8px;padding:12px;margin-bottom:20px;">
            ✅ Article supprimé avec succès.
        </div>
    <?php endif; ?>
 
    <div class="card-section">
        <?php if (empty($articles)): ?>
            <p style="text-align:center;color:#888;padding:40px;">
                Aucun article publié pour le moment.
                <a href="ajout-article.php" style="color:#C62828;font-weight:bold;">Créer le premier article →</a>
            </p>
        <?php else: ?>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Titre</th>
                        <th>Auteur</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($articles as $article): ?>
                        <tr>
                            <td>
                                <?php if ($article['image']): ?>
                                    <img src="/LaPercheTendueV2/public/assets/images/<?= htmlspecialchars($article['image']) ?>" class="article-img" alt="">
                                <?php else: ?>
                                    <div style="width:60px;height:50px;background:#f0f2f5;border-radius:6px;display:flex;align-items:center;justify-content:center;">
                                        <i class="fa fa-image" style="color:#ccc;"></i>
                                    </div>
                                <?php endif; ?>
                            </td>
                            <td>
                                <strong><?= htmlspecialchars($article['titre']) ?></strong>
                                <br>
                                <small style="color:#888;"><?= htmlspecialchars(substr($article['contenu'], 0, 60)) ?>...</small>
                            </td>
                            <td><?= htmlspecialchars($article['auteur_nom'] ?? 'Admin') ?></td>
                            <td><?= date('d/m/Y', strtotime($article['date_publication'])) ?></td>
                            <td>
                                <div style="display:flex;gap:8px;">
                                    <a href="modifier-article.php?id=<?= $article['id'] ?>" class="btn-edit">
                                        <i class="fa fa-edit"></i> Modifier
                                    </a>
                                    <form method="POST" style="display:inline;" onsubmit="return confirm('Supprimer cet article ?')">
                                        <?php require_once '../includes/csrf.php'; echo csrf_token_field(); ?>
                                        <input type="hidden" name="supprimer_id" value="<?= $article['id'] ?>">
                                        <button type="submit" class="btn-delete">
                                            <i class="fa fa-trash"></i> Supprimer
                                        </button>
                                    </form>
                                </div>
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
