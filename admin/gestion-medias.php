<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
require_once '../database/database.php';

$message = '';
$erreur = '';
$upload_dir = '../public/assets/images/';

// =====================
// UPLOAD nouvelle photo
// =====================
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['nouvelle_photo'])) {
    $fichier = $_FILES['nouvelle_photo'];
    $titre = trim($_POST['titre'] ?? '');

    if ($fichier['error'] !== UPLOAD_ERR_OK) {
        $erreur = "Erreur lors de l'upload.";
    } else {
        $ext = strtolower(pathinfo($fichier['name'], PATHINFO_EXTENSION));
        $autorise = ['jpg', 'jpeg', 'png', 'webp'];
        if (!in_array($ext, $autorise)) {
            $erreur = "Format non autorisé. Utilisez JPG, PNG ou WEBP.";
        } elseif ($fichier['size'] > 5 * 1024 * 1024) {
            $erreur = "Fichier trop lourd (max 5 Mo).";
        } else {
            $nom = uniqid('photo_') . '.' . $ext;
            if (move_uploaded_file($fichier['tmp_name'], $upload_dir . $nom)) {
                $stmt = $pdo->prepare("INSERT INTO medias (nom_fichier, titre) VALUES (?, ?)");
                $stmt->execute([$nom, $titre ?: $nom]);
                $message = "✅ Photo <strong>$nom</strong> uploadée avec succès !";
            } else {
                $erreur = "Impossible de sauvegarder le fichier.";
            }
        }
    }
}

// =====================
// SUPPRIMER une photo
// =====================
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['supprimer_photo'])) {
    $nom = basename($_POST['supprimer_photo']);
    // Ne pas supprimer les photos système
    $protegees = ['logo.jpg', 'contact-epicerie.jpg', 'google-maps.png'];
    if (in_array($nom, $protegees)) {
        $erreur = "Cette photo est protégée et ne peut pas être supprimée.";
    } else {
        // Retirer les associations
        $pdo->prepare("UPDATE pages_photos SET nom_fichier = 'actu1.jpg' WHERE nom_fichier = ?")->execute([$nom]);
        // Supprimer de la table médias
        $pdo->prepare("DELETE FROM medias WHERE nom_fichier = ?")->execute([$nom]);
        // Supprimer le fichier
        if (file_exists($upload_dir . $nom)) unlink($upload_dir . $nom);
        $message = "✅ Photo supprimée.";
    }
}

// =====================
// ASSIGNER photo à une section
// =====================
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['assigner'])) {
    $page_slug = $_POST['page_slug'];
    $section_slug = $_POST['section_slug'];
    $nom_fichier = $_POST['nom_fichier'];
    $stmt = $pdo->prepare("INSERT INTO pages_photos (page_slug, section_slug, nom_fichier) 
                           VALUES (?, ?, ?) 
                           ON DUPLICATE KEY UPDATE nom_fichier = ?");
    $stmt->execute([$page_slug, $section_slug, $nom_fichier, $nom_fichier]);
    $message = "✅ Photo assignée avec succès !";
}

// Récupérer toutes les photos disponibles (système + uploadées)
$photos_systeme = array_filter(scandir($upload_dir), function($f) {
    return in_array(strtolower(pathinfo($f, PATHINFO_EXTENSION)), ['jpg','jpeg','png','webp']);
});

// Récupérer les associations actuelles
$associations = $pdo->query("SELECT * FROM pages_photos ORDER BY page_slug, section_slug")->fetchAll(PDO::FETCH_ASSOC);

// Définir les sections disponibles par page
$pages_sections = [
    'accueil' => [
        'service1' => 'Service 1 (Nos activités)',
        'service2' => 'Service 2 (Nos événements)',
        'service3' => 'Service 3 (Épicerie)',
        'actu1' => 'Actualité 1',
        'actu2' => 'Actualité 2 (Festival)',
        'actu3' => 'Actualité 3 (Parade)',
        'perche1' => 'Perche 1',
        'perche2' => 'Perche 2',
        'perche3' => 'Perche 3',
    ],
    'qui-sommes-nous' => [
        'valeurs' => 'Nos valeurs',
        'equipe' => 'Notre équipe',
        'engagement' => 'Notre engagement',
    ],
    'epicerie' => [
        'produits' => 'Nos produits',
        'acces' => 'Qui peut en bénéficier',
        'epiceries' => 'Nos épiceries',
    ],
    'nos-activites' => [
        'alimentaire' => 'Aide alimentaire',
        'social' => 'Accompagnement social',
        'lien' => 'Création de lien social',
        'parrainage' => 'Parrainage solidaire',
        'culture' => 'Activités culturelles',
        'benevolat' => 'Bénévolat',
    ],
    'international' => [
        'niger' => 'Actions au Niger',
        'cameroun' => 'Soutien au Cameroun',
        'echanges' => 'Échanges culturels',
    ],
    'europalia' => [
        'festival' => 'Le festival',
        'participation' => 'Notre participation',
        'culture' => 'Culture et solidarité',
    ],
    'contact' => ['hero' => 'Photo principale'],
    'dons' => [
        'carte' => 'Don par carte',
        'virement' => 'Don par virement',
        'especes' => 'Don en espèces',
    ],
];

// Indexer les associations par page/section
$assoc_index = [];
foreach ($associations as $a) {
    $assoc_index[$a['page_slug']][$a['section_slug']] = $a['nom_fichier'];
}

// Onglet actif
$page_active = $_GET['page'] ?? array_key_first($pages_sections);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des médias - Admin La Perche Tendue</title>
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
        .btn-logout { background:#C62828; color:white; border:none; border-radius:8px; padding:8px 16px; text-decoration:none; font-size:0.9rem; font-weight:600; }
        .btn-logout:hover { background:#A31F1F; color:white; }
        .card-section { background:white; border-radius:12px; padding:24px; box-shadow:0 2px 12px rgba(0,0,0,0.06); margin-bottom:24px; }
        .nav-tabs .nav-link { color:#2E4369; font-weight:600; }
        .nav-tabs .nav-link.active { color:#C62828; border-bottom:3px solid #C62828; }
        .photo-thumb { width:80px; height:60px; object-fit:cover; border-radius:6px; border:2px solid #eee; cursor:pointer; transition:border 0.2s; }
        .photo-thumb:hover, .photo-thumb.selected { border:2px solid #C62828; }
        .photo-grid { display:flex; flex-wrap:wrap; gap:10px; margin:10px 0; }
        .photo-item { text-align:center; }
        .photo-item span { display:block; font-size:0.7rem; color:#888; margin-top:4px; max-width:80px; word-break:break-all; }
        .section-card { background:#f8f9fa; border-radius:10px; padding:16px; margin-bottom:16px; border-left:4px solid #2E4369; }
        .section-card h4 { font-size:0.95rem; font-weight:700; color:#2E4369; margin-bottom:12px; }
        .current-photo { display:flex; align-items:center; gap:12px; margin-bottom:10px; }
        .current-photo img { width:60px; height:45px; object-fit:cover; border-radius:6px; border:2px solid #2E4369; }
        .btn-save { background:#2E4369; color:white; border:none; border-radius:8px; padding:8px 20px; font-size:0.9rem; font-weight:600; cursor:pointer; }
        .btn-save:hover { background:#C62828; }
        .btn-danger-sm { background:#C62828; color:white; border:none; border-radius:6px; padding:4px 10px; font-size:0.8rem; cursor:pointer; }
        .upload-zone { border:2px dashed #2E4369; border-radius:10px; padding:20px; text-align:center; background:#f8f9fa; }
        .alert-success { background:#d4edda; color:#155724; border:1px solid #c3e6cb; border-radius:8px; padding:12px 20px; margin-bottom:20px; }
        .alert-danger { background:#f8d7da; color:#721c24; border:1px solid #f5c6cb; border-radius:8px; padding:12px 20px; margin-bottom:20px; }
        .library-photo { position:relative; display:inline-block; }
        .library-photo .delete-btn { position:absolute; top:-5px; right:-5px; background:#C62828; color:white; border:none; border-radius:50%; width:20px; height:20px; font-size:0.7rem; cursor:pointer; display:flex; align-items:center; justify-content:center; }
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
        <a href="gestion-medias.php" class="active"><i class="fa fa-images"></i> Médias & Photos</a>
        <a href="/LaPercheTendueV2/public/index.php" target="_blank"><i class="fa fa-globe"></i> Voir le site</a>
        <a href="logout.php" style="margin-top:20px;color:#ff6b6b;"><i class="fa fa-sign-out-alt"></i> Se déconnecter</a>
    </div>
</div>

<div class="main-content">
    <div class="topbar">
        <h1><i class="fa fa-images"></i> Gestion des médias & photos</h1>
        <a href="logout.php" class="btn-logout"><i class="fa fa-sign-out-alt"></i> Déconnexion</a>
    </div>

    <?php if ($message): ?><div class="alert-success"><?= $message ?></div><?php endif; ?>
    <?php if ($erreur): ?><div class="alert-danger"><i class="fa fa-exclamation-triangle"></i> <?= $erreur ?></div><?php endif; ?>

    <!-- UPLOAD NOUVELLE PHOTO -->
    <div class="card-section">
        <h3 style="color:#2E4369;margin-bottom:16px;"><i class="fa fa-upload"></i> Ajouter une nouvelle photo</h3>
        <form method="POST" enctype="multipart/form-data">
            <div class="upload-zone">
                <i class="fa fa-cloud-upload-alt fa-2x" style="color:#2E4369;margin-bottom:10px;"></i>
                <p style="margin:0;color:#666;">Choisissez une photo à ajouter à la bibliothèque</p>
                <p style="font-size:0.8rem;color:#aaa;">JPG, PNG, WEBP — max 5 Mo</p>
                <div style="display:flex;gap:10px;justify-content:center;margin-top:12px;flex-wrap:wrap;">
                    <input type="text" name="titre" placeholder="Nom de la photo (optionnel)" style="border:1px solid #ddd;border-radius:8px;padding:8px 12px;font-size:0.9rem;">
                    <input type="file" name="nouvelle_photo" accept=".jpg,.jpeg,.png,.webp" required style="border:1px solid #ddd;border-radius:8px;padding:8px;">
                    <button type="submit" class="btn-save"><i class="fa fa-upload"></i> Uploader</button>
                </div>
            </div>
        </form>
    </div>

    <!-- BIBLIOTHÈQUE DE PHOTOS -->
    <div class="card-section">
        <h3 style="color:#2E4369;margin-bottom:16px;"><i class="fa fa-photo-video"></i> Bibliothèque de photos</h3>
        <p style="color:#888;font-size:0.9rem;">Cliquez sur la croix rouge pour supprimer une photo. Les photos protégées (logo, contact) ne peuvent pas être supprimées.</p>
        <div class="photo-grid">
            <?php foreach ($photos_systeme as $photo): ?>
                <?php if ($photo === '.' || $photo === '..') continue; ?>
                <div class="library-photo photo-item">
                    <img src="/LaPercheTendueV2/public/assets/images/<?= htmlspecialchars($photo) ?>?v=<?= time() ?>"
                         class="photo-thumb" alt="<?= htmlspecialchars($photo) ?>"
                         title="<?= htmlspecialchars($photo) ?>">
                    <?php $protegees = ['logo.jpg','contact-epicerie.jpg','google-maps.png']; ?>
                    <?php if (!in_array($photo, $protegees)): ?>
                    <form method="POST" style="display:inline;" onsubmit="return confirm('Supprimer <?= htmlspecialchars($photo) ?> ?')">
                        <input type="hidden" name="supprimer_photo" value="<?= htmlspecialchars($photo) ?>">
                        <button type="submit" class="delete-btn" title="Supprimer">✕</button>
                    </form>
                    <?php endif; ?>
                    <span><?= htmlspecialchars($photo) ?></span>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- ASSIGNATION PAR PAGE -->
    <div class="card-section">
        <h3 style="color:#2E4369;margin-bottom:16px;"><i class="fa fa-link"></i> Assigner les photos par page</h3>
        <p style="color:#888;font-size:0.9rem;margin-bottom:20px;">Choisissez quelle photo s'affiche sur chaque section de chaque page.</p>

        <!-- Onglets pages -->
        <ul class="nav nav-tabs mb-4">
            <?php foreach (array_keys($pages_sections) as $page): ?>
                <li class="nav-item">
                    <a class="nav-link <?= $page_active === $page ? 'active' : '' ?>"
                       href="?page=<?= urlencode($page) ?>">
                        <?= ucfirst(str_replace('-', ' ', $page)) ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>

        <!-- Sections de la page active -->
        <?php if (isset($pages_sections[$page_active])): ?>
            <?php foreach ($pages_sections[$page_active] as $section => $label): ?>
                <?php $photo_actuelle = $assoc_index[$page_active][$section] ?? 'actu1.jpg'; ?>
                <div class="section-card">
                    <h4><i class="fa fa-image" style="color:#C62828;"></i> <?= htmlspecialchars($label) ?></h4>
                    <div class="current-photo">
                        <img src="/LaPercheTendueV2/public/assets/images/<?= htmlspecialchars($photo_actuelle) ?>?v=<?= time() ?>"
                             alt="Photo actuelle" id="preview-<?= $section ?>">
                        <div>
                            <small style="color:#888;">Photo actuelle :</small><br>
                            <strong style="font-size:0.9rem;"><?= htmlspecialchars($photo_actuelle) ?></strong>
                        </div>
                    </div>
                    <form method="POST">
                        <input type="hidden" name="assigner" value="1">
                        <input type="hidden" name="page_slug" value="<?= htmlspecialchars($page_active) ?>">
                        <input type="hidden" name="section_slug" value="<?= htmlspecialchars($section) ?>">
                        <div style="margin-bottom:10px;">
                            <select name="nom_fichier" style="border:1px solid #ddd;border-radius:8px;padding:8px 12px;font-size:0.9rem;width:100%;max-width:400px;"
                                    onchange="document.getElementById('preview-<?= $section ?>').src='/LaPercheTendueV2/public/assets/images/'+this.value+'?v=<?= time() ?>'">
                                <?php foreach ($photos_systeme as $photo): ?>
                                    <?php if ($photo === '.' || $photo === '..') continue; ?>
                                    <option value="<?= htmlspecialchars($photo) ?>"
                                        <?= $photo === $photo_actuelle ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($photo) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <button type="submit" class="btn-save">
                            <i class="fa fa-save"></i> Enregistrer
                        </button>
                    </form>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>

</body>
</html>
