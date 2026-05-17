<?php
session_start();
require_once '../includes/auth.php';
require_once '../includes/csrf.php';
require_admin();
require_once '../database/database.php';

$id = (int)($_GET['id'] ?? 0);
if (!$id) { header("Location: liste-articles.php"); exit(); }

$article = $pdo->prepare("SELECT * FROM articles WHERE id = ?");
$article->execute([$id]);
$article = $article->fetch(PDO::FETCH_ASSOC);
if (!$article) { header("Location: liste-articles.php"); exit(); }

$succes = '';
$erreur = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    csrf_verify();
    $titre   = trim($_POST['titre'] ?? '');
    $contenu = trim($_POST['contenu'] ?? '');
    $image   = $article['image'];

    if (empty($titre) || empty($contenu)) {
        $erreur = "Le titre et le contenu sont obligatoires.";
    } else {
        if (!empty($_FILES['image']['name'])) {
            $ext     = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
            $exts_ok = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
            $mimes_ok = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
            $finfo   = finfo_open(FILEINFO_MIME_TYPE);
            $mime    = finfo_file($finfo, $_FILES['image']['tmp_name']);
            finfo_close($finfo);
            if (!in_array($ext, $exts_ok) || !in_array($mime, $mimes_ok)) {
                $erreur = "Format d'image non autorisé.";
            } elseif (!getimagesize($_FILES['image']['tmp_name'])) {
                $erreur = "Le fichier uploadé n'est pas une image valide.";
            } elseif ($_FILES['image']['size'] > 5 * 1024 * 1024) {
                $erreur = "Image trop lourde (max 5 Mo).";
            } else {
                $ancien = $article['image'];
                $nom_fichier = uniqid('article_') . '.' . $ext;
                $destination = '../public/assets/images/' . $nom_fichier;
                if (move_uploaded_file($_FILES['image']['tmp_name'], $destination)) {
                    $image = $nom_fichier;
                    // Supprimer l'ancienne image
                    if ($ancien && file_exists('../public/assets/images/' . $ancien)) {
                        unlink('../public/assets/images/' . $ancien);
                    }
                }
            }
        }
        if (empty($erreur)) {
            $stmt = $pdo->prepare("UPDATE articles SET titre = :titre, contenu = :contenu, image = :image WHERE id = :id");
            $stmt->execute([':titre' => $titre, ':contenu' => $contenu, ':image' => $image, ':id' => $id]);
            $succes = "Article modifié avec succès !";
            $article['titre']   = $titre;
            $article['contenu'] = $contenu;
            $article['image']   = $image;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un article - Admin</title>
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
        .card-form { background:white; border-radius:12px; padding:30px; box-shadow:0 2px 12px rgba(0,0,0,0.06); }
        .form-label { font-weight:600; color:#444; }
        .form-control:focus { border-color:#C62828; box-shadow:0 0 0 0.2rem rgba(198,40,40,0.15); }
        .btn-sauvegarder { background:#C62828; color:white; border:none; border-radius:8px; padding:12px 30px; font-weight:700; }
        .btn-sauvegarder:hover { background:#A31F1F; color:white; }
        .img-actuelle { max-width:200px; border-radius:8px; margin-bottom:10px; }
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
        <h1><i class="fa fa-edit"></i> Modifier l'article</h1>
        <a href="liste-articles.php" class="btn" style="background:#2E4369;color:white;border-radius:8px;">
            <i class="fa fa-arrow-left"></i> Retour aux articles
        </a>
    </div>
    <?php if ($succes): ?>
        <div style="background:#d4edda;border:1px solid #28a745;color:#155724;border-radius:8px;padding:15px;margin-bottom:20px;">✅ <?= htmlspecialchars($succes) ?></div>
    <?php endif; ?>
    <?php if ($erreur): ?>
        <div style="background:#fdecea;border:1px solid #C62828;color:#C62828;border-radius:8px;padding:15px;margin-bottom:20px;">⚠️ <?= htmlspecialchars($erreur) ?></div>
    <?php endif; ?>
    <div class="card-form">
        <form action="" method="POST" enctype="multipart/form-data">
            <?= csrf_token_field() ?>
            <div class="mb-4">
                <label class="form-label"><i class="fa fa-heading"></i> Titre *</label>
                <input type="text" name="titre" class="form-control" required value="<?= htmlspecialchars($article['titre']) ?>">
            </div>
            <div class="mb-4">
                <label class="form-label"><i class="fa fa-align-left"></i> Contenu *</label>
                <textarea name="contenu" class="form-control" rows="10" required><?= htmlspecialchars($article['contenu']) ?></textarea>
            </div>
            <div class="mb-4">
                <label class="form-label"><i class="fa fa-image"></i> Image</label>
                <?php if ($article['image']): ?>
                    <div>
                        <p style="color:#888;font-size:0.9rem;">Image actuelle :</p>
                        <img src="/LaPercheTendueV2/public/assets/images/<?= htmlspecialchars($article['image']) ?>" class="img-actuelle" alt="">
                    </div>
                <?php endif; ?>
                <input type="file" name="image" class="form-control" accept="image/*">
                <small style="color:#888;">Laissez vide pour conserver l'image actuelle — max 5 Mo</small>
            </div>
            <div style="display:flex;gap:12px;">
                <button type="submit" class="btn-sauvegarder"><i class="fa fa-save"></i> Sauvegarder</button>
                <a href="liste-articles.php" class="btn" style="border:1px solid #ddd;border-radius:8px;padding:12px 20px;color:#666;">Annuler</a>
            </div>
        </form>
    </div>
</div>
</body>
</html>
