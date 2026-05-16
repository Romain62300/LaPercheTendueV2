<?php
session_start();
require_once '../includes/auth.php';
require_admin();
require_once '../database/database.php';
 
$succes = '';
$erreur = '';
 
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titre   = htmlspecialchars(trim($_POST['titre'] ?? ''));
    $contenu = htmlspecialchars(trim($_POST['contenu'] ?? ''));
    $image   = '';
 
    if (empty($titre) || empty($contenu)) {
        $erreur = "Le titre et le contenu sont obligatoires.";
    } else {
        // Upload image
        if (!empty($_FILES['image']['name'])) {
            $ext      = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
            $exts_ok  = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
            if (!in_array($ext, $exts_ok)) {
                $erreur = "Format d'image non autorisé (jpg, png, gif, webp uniquement).";
            } else {
                $nom_fichier = uniqid('article_') . '.' . $ext;
                $destination = '../public/assets/images/' . $nom_fichier;
                if (move_uploaded_file($_FILES['image']['tmp_name'], $destination)) {
                    $image = $nom_fichier;
                } else {
                    $erreur = "Erreur lors de l'upload de l'image.";
                }
            }
        }
 
        if (empty($erreur)) {
            $stmt = $pdo->prepare("INSERT INTO articles (titre, contenu, image, auteur_id) VALUES (:titre, :contenu, :image, :auteur_id)");
            $stmt->execute([
                ':titre'     => $titre,
                ':contenu'   => $contenu,
                ':image'     => $image ?: null,
                ':auteur_id' => $_SESSION['user_id']
            ]);
            $succes = "Article publié avec succès !";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un article - Admin</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        body { background:#f0f2f5; font-family:'Segoe UI',sans-serif; }
        .sidebar { background:#2E4369; min-height:100vh; width:250px; position:fixed; top:0; left:0; padding:20px 0; color:white; }
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
        .btn-publier { background:#C62828; color:white; border:none; border-radius:8px; padding:12px 30px; font-weight:700; }
        .btn-publier:hover { background:#A31F1F; color:white; }
        .preview-img { max-width:200px; border-radius:8px; margin-top:10px; display:none; }
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
        <a href="ajout-article.php" class="active"><i class="fa fa-plus"></i> Ajouter un article</a>
        <a href="gestion-membres.php"><i class="fa fa-users"></i> Membres</a>
        <a href="gestion-dons.php"><i class="fa fa-hand-holding-heart"></i> Dons</a>
        <a href="/LaPercheTendueV2/public/index.php" target="_blank"><i class="fa fa-globe"></i> Voir le site</a>
        <a href="logout.php" style="margin-top:20px;color:#ff6b6b;"><i class="fa fa-sign-out-alt"></i> Se déconnecter</a>
    </div>
</div>
 
<div class="main-content">
    <div class="topbar">
        <h1><i class="fa fa-plus"></i> Ajouter un article</h1>
        <a href="liste-articles.php" class="btn" style="background:#2E4369;color:white;border-radius:8px;">
            <i class="fa fa-list"></i> Voir les articles
        </a>
    </div>
 
    <?php if ($succes): ?>
        <div class="alert" style="background:#d4edda;border:1px solid #28a745;color:#155724;border-radius:8px;padding:15px;margin-bottom:20px;">
            ✅ <?= $succes ?>
            <a href="liste-articles.php" style="margin-left:10px;color:#155724;font-weight:bold;">Voir les articles →</a>
        </div>
    <?php endif; ?>
 
    <?php if ($erreur): ?>
        <div class="alert" style="background:#fdecea;border:1px solid #C62828;color:#C62828;border-radius:8px;padding:15px;margin-bottom:20px;">
            ⚠️ <?= $erreur ?>
        </div>
    <?php endif; ?>
 
    <div class="card-form">
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="mb-4">
                <label class="form-label"><i class="fa fa-heading"></i> Titre de l'article *</label>
                <input type="text" name="titre" class="form-control" placeholder="Ex: Journée solidaire du 15 avril" required value="<?= $_POST['titre'] ?? '' ?>">
            </div>
 
            <div class="mb-4">
                <label class="form-label"><i class="fa fa-align-left"></i> Contenu de l'article *</label>
                <textarea name="contenu" class="form-control" rows="10" placeholder="Rédigez votre article ici..." required><?= $_POST['contenu'] ?? '' ?></textarea>
            </div>
 
            <div class="mb-4">
                <label class="form-label"><i class="fa fa-image"></i> Image (optionnelle)</label>
                <input type="file" name="image" class="form-control" accept="image/*" onchange="previewImage(this)">
                <img id="preview" class="preview-img" src="" alt="Aperçu">
                <small style="color:#888;">Formats acceptés : jpg, png, gif, webp</small>
            </div>
 
            <div style="display:flex;gap:12px;">
                <button type="submit" class="btn-publier">
                    <i class="fa fa-paper-plane"></i> Publier l'article
                </button>
                <a href="liste-articles.php" class="btn" style="border:1px solid #ddd;border-radius:8px;padding:12px 20px;color:#666;">
                    Annuler
                </a>
            </div>
        </form>
    </div>
</div>
 
<script>
function previewImage(input) {
    const preview = document.getElementById('preview');
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => {
            preview.src = e.target.result;
            preview.style.display = 'block';
        };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
</body>
</html>
 
