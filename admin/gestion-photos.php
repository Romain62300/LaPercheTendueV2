<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$message = '';
$erreur = '';

$photos = [
    'epicerie'   => ['label' => 'Épicerie solidaire',    'fichier' => 'epicerie.jpg'],
    'equipe'     => ['label' => 'Notre équipe',           'fichier' => 'equipe.jpg'],
    'valeurs'    => ['label' => 'Nos valeurs',            'fichier' => 'valeurs.jpg'],
    'engagement' => ['label' => 'Notre engagement',       'fichier' => 'engagement.jpg'],
    'parrainage' => ['label' => 'Parrainage',             'fichier' => 'parrainage.jpg'],
    'logo'       => ['label' => 'Logo de l\'association', 'fichier' => 'logo.jpg'],
];

$upload_dir = '../public/assets/images/';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['photo'])) {
    $cle = $_POST['cle'] ?? '';
    $fichier = $_FILES['photo'];

    if (!isset($photos[$cle])) {
        $erreur = "Photo inconnue.";
    } elseif ($fichier['error'] !== UPLOAD_ERR_OK) {
        $erreur = "Erreur lors de l'upload.";
    } else {
        $ext = strtolower(pathinfo($fichier['name'], PATHINFO_EXTENSION));
        $autorise = ['jpg', 'jpeg', 'png', 'webp'];

        if (!in_array($ext, $autorise)) {
            $erreur = "Format non autorisé. Utilisez JPG, PNG ou WEBP.";
        } elseif ($fichier['size'] > 5 * 1024 * 1024) {
            $erreur = "Le fichier est trop lourd (max 5 Mo).";
        } else {
            $nom_final = $photos[$cle]['fichier'];
            // Garder l'extension originale si différente de jpg
            if ($ext !== 'jpg' && $ext !== 'jpeg') {
                $nom_final = pathinfo($nom_final, PATHINFO_FILENAME) . '.' . $ext;
            }
            $destination = $upload_dir . $nom_final;
            if (move_uploaded_file($fichier['tmp_name'], $destination)) {
                $message = "✅ La photo <strong>" . $photos[$cle]['label'] . "</strong> a été mise à jour !";
            } else {
                $erreur = "Impossible de sauvegarder le fichier. Vérifiez les permissions du dossier.";
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des photos - Admin La Perche Tendue</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        body { background: #f0f2f5; font-family: 'Segoe UI', sans-serif; }
        .sidebar {
            background: #2E4369; min-height: 100vh; width: 250px;
            position: fixed; top: 0; left: 0; padding: 20px 0; color: white;
        }
        .sidebar-logo { text-align: center; padding: 20px; border-bottom: 1px solid rgba(255,255,255,0.1); margin-bottom: 20px; }
        .sidebar-logo img { height: 60px; border-radius: 50%; border: 2px solid #C62828; }
        .sidebar-logo h2 { font-size: 0.95rem; margin-top: 10px; color: white; }
        .sidebar-menu a {
            display: flex; align-items: center; gap: 10px;
            padding: 12px 24px; color: rgba(255,255,255,0.8);
            text-decoration: none; transition: all 0.2s; font-size: 0.95rem;
        }
        .sidebar-menu a:hover, .sidebar-menu a.active {
            background: rgba(255,255,255,0.1); color: white; border-left: 3px solid #C62828;
        }
        .sidebar-menu a i { width: 20px; }
        .main-content { margin-left: 250px; padding: 30px; }
        .topbar { display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; }
        .topbar h1 { font-size: 1.5rem; color: #2E4369; font-weight: 700; margin: 0; }
        .btn-logout { background: #C62828; color: white; border: none; border-radius: 8px; padding: 8px 16px; text-decoration: none; font-size: 0.9rem; font-weight: 600; }
        .btn-logout:hover { background: #A31F1F; color: white; }
        .photo-card {
            background: white; border-radius: 12px;
            padding: 20px; box-shadow: 0 2px 12px rgba(0,0,0,0.06);
            display: flex; align-items: center; gap: 20px; margin-bottom: 16px;
        }
        .photo-card img { width: 120px; height: 90px; object-fit: cover; border-radius: 8px; border: 2px solid #eee; }
        .photo-card img.no-image { background: #f0f0f0; display: flex; align-items: center; justify-content: center; }
        .photo-info { flex: 1; }
        .photo-info h3 { font-size: 1rem; font-weight: 700; color: #2E4369; margin-bottom: 4px; }
        .photo-info p { font-size: 0.85rem; color: #888; margin: 0; }
        .upload-form { display: flex; align-items: center; gap: 10px; margin-top: 10px; flex-wrap: wrap; }
        .btn-upload { background: #2E4369; color: white; border: none; border-radius: 8px; padding: 8px 16px; font-size: 0.9rem; font-weight: 600; cursor: pointer; transition: background 0.2s; }
        .btn-upload:hover { background: #C62828; }
        input[type="file"] { border: 1px solid #ddd; border-radius: 8px; padding: 6px 10px; font-size: 0.9rem; }
        .alert-success { background: #d4edda; color: #155724; border: 1px solid #c3e6cb; border-radius: 8px; padding: 12px 20px; margin-bottom: 20px; }
        .alert-danger { background: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; border-radius: 8px; padding: 12px 20px; margin-bottom: 20px; }
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
        <a href="gestion-membres.php"><i class="fa fa-users"></i> Membres</a>
        <a href="gestion-messages.php"><i class="fa fa-envelope"></i> Messages</a>
        <a href="gestion-dons.php"><i class="fa fa-hand-holding-heart"></i> Dons</a>
        <a href="gestion-pages.php"><i class="fa fa-file-alt"></i> Pages du site</a>
        <a href="gestion-photos.php" class="active"><i class="fa fa-images"></i> Photos</a>
        <a href="/LaPercheTendueV2/public/index.php" target="_blank"><i class="fa fa-globe"></i> Voir le site</a>
        <a href="logout.php" style="margin-top: 20px; color: #ff6b6b;"><i class="fa fa-sign-out-alt"></i> Se déconnecter</a>
    </div>
</div>

<div class="main-content">
    <div class="topbar">
        <h1><i class="fa fa-images"></i> Gestion des photos</h1>
        <a href="logout.php" class="btn-logout"><i class="fa fa-sign-out-alt"></i> Déconnexion</a>
    </div>

    <?php if ($message): ?>
        <div class="alert-success"><?= $message ?></div>
    <?php endif; ?>
    <?php if ($erreur): ?>
        <div class="alert-danger"><i class="fa fa-exclamation-triangle"></i> <?= $erreur ?></div>
    <?php endif; ?>

    <p style="color:#888; margin-bottom:24px;">
        <i class="fa fa-info-circle" style="color:#2E4369;"></i>
        Cliquez sur <strong>Choisir un fichier</strong> puis <strong>Mettre à jour</strong> pour remplacer une photo. Formats acceptés : JPG, PNG, WEBP (max 5 Mo).
    </p>

    <?php foreach ($photos as $cle => $info): ?>
        <?php $chemin = '/LaPercheTendueV2/public/assets/images/' . $info['fichier']; ?>
        <div class="photo-card">
            <img src="<?= $chemin ?>?v=<?= time() ?>" alt="<?= $info['label'] ?>"
                 onerror="this.src='data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 width=%22120%22 height=%2290%22><rect fill=%22%23f0f0f0%22 width=%22120%22 height=%2290%22/><text x=%2260%22 y=%2250%22 text-anchor=%22middle%22 fill=%22%23aaa%22 font-size=%2212%22>Aucune photo</text></svg>'">
            <div class="photo-info">
                <h3><?= $info['label'] ?></h3>
                <p>Fichier : <?= $info['fichier'] ?></p>
                <form method="POST" enctype="multipart/form-data" class="upload-form">
                    <input type="hidden" name="cle" value="<?= $cle ?>">
                    <input type="file" name="photo" accept=".jpg,.jpeg,.png,.webp" required>
                    <button type="submit" class="btn-upload">
                        <i class="fa fa-upload"></i> Mettre à jour
                    </button>
                </form>
            </div>
        </div>
    <?php endforeach; ?>
</div>

</body>
</html>
