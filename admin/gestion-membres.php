<?php
session_start();
if (!isset($_SESSION['user_id'])) { header("Location: login.php"); exit(); }
require_once '../database/database.php';
require_once '../includes/csrf.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['supprimer_id'])) {
    csrf_verify();
    $id = (int)$_POST['supprimer_id'];
    if ($id !== (int)$_SESSION['user_id']) {
        $pdo->prepare("DELETE FROM utilisateurs WHERE id = ?")->execute([$id]);
    }
    header("Location: gestion-membres.php?succes=1");
    exit();
}

$membres = $pdo->query("SELECT * FROM utilisateurs ORDER BY date_creation DESC")->fetchAll(PDO::FETCH_ASSOC);

$succes_ajout = '';
$erreur_ajout = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    csrf_verify();
    $nom      = htmlspecialchars(trim($_POST['nom'] ?? ''));
    $email    = filter_var(trim($_POST['email'] ?? ''), FILTER_SANITIZE_EMAIL);
    $mdp      = $_POST['mot_de_passe'] ?? '';
    $role     = $_POST['role'] ?? 'user';
    if (empty($nom) || empty($email) || empty($mdp)) {
        $erreur_ajout = "Tous les champs sont obligatoires.";
    } else {
        $existe = $pdo->prepare("SELECT id FROM utilisateurs WHERE email = ?");
        $existe->execute([$email]);
        if ($existe->fetch()) {
            $erreur_ajout = "Cet email existe déjà.";
        } else {
            $hash = password_hash($mdp, PASSWORD_DEFAULT);
            $pdo->prepare("INSERT INTO utilisateurs (nom, email, mot_de_passe, role) VALUES (?,?,?,?)")->execute([$nom, $email, $hash, $role]);
            $succes_ajout = "Membre ajouté avec succès !";
            $membres = $pdo->query("SELECT * FROM utilisateurs ORDER BY date_creation DESC")->fetchAll(PDO::FETCH_ASSOC);
        }
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Membres - Admin</title>
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
        .card-section{background:white;border-radius:12px;padding:24px;box-shadow:0 2px 12px rgba(0,0,0,0.06);margin-bottom:24px;}
        .card-section h2{font-size:1.1rem;color:#2E4369;font-weight:700;margin-bottom:20px;padding-bottom:12px;border-bottom:2px solid #f0f2f5;}
        .table th{color:#2E4369;font-weight:600;font-size:0.9rem;}
        .table td{font-size:0.9rem;vertical-align:middle;}
        .badge-admin{background:#C62828;color:white;padding:3px 10px;border-radius:20px;font-size:0.8rem;}
        .badge-user{background:#2E4369;color:white;padding:3px 10px;border-radius:20px;font-size:0.8rem;}
        .btn-delete{background:#C62828;color:white;border:none;border-radius:6px;padding:5px 12px;font-size:0.85rem;cursor:pointer;}
        .form-control:focus{border-color:#C62828;box-shadow:0 0 0 0.2rem rgba(198,40,40,0.15);}
        .btn-ajouter{background:#2E4369;color:white;border:none;border-radius:8px;padding:10px 24px;font-weight:700;}
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
        <a href="gestion-membres.php" class="active"><i class="fa fa-users"></i> Membres</a>
        <a href="gestion-dons.php"><i class="fa fa-hand-holding-heart"></i> Dons</a>
        <a href="/LaPercheTendueV2/public/index.php" target="_blank"><i class="fa fa-globe"></i> Voir le site</a>
        <a href="logout.php" style="margin-top:20px;color:#ff6b6b;"><i class="fa fa-sign-out-alt"></i> Se déconnecter</a>
    </div>
</div>
<div class="main-content">
    <div class="topbar">
        <h1><i class="fa fa-users"></i> Gestion des membres</h1>
    </div>

    <div class="card-section">
        <h2><i class="fa fa-user-plus"></i> Ajouter un membre</h2>
        <?php if ($succes_ajout): ?>
            <div style="background:#d4edda;border:1px solid #28a745;color:#155724;border-radius:8px;padding:12px;margin-bottom:16px;">✅ <?= $succes_ajout ?></div>
        <?php endif; ?>
        <?php if ($erreur_ajout): ?>
            <div style="background:#fdecea;border:1px solid #C62828;color:#C62828;border-radius:8px;padding:12px;margin-bottom:16px;">⚠️ <?= $erreur_ajout ?></div>
        <?php endif; ?>
        <form method="POST">
            <?= csrf_token_field() ?>
            <div class="row g-3">
                <div class="col-md-3">
                    <label class="form-label fw-bold">Nom</label>
                    <input type="text" name="nom" class="form-control" placeholder="Nom complet" required>
                </div>
                <div class="col-md-3">
                    <label class="form-label fw-bold">Email</label>
                    <input type="email" name="email" class="form-control" placeholder="email@exemple.fr" required>
                </div>
                <div class="col-md-3">
                    <label class="form-label fw-bold">Mot de passe</label>
                    <input type="password" name="mot_de_passe" class="form-control" placeholder="••••••••" required>
                </div>
                <div class="col-md-2">
                    <label class="form-label fw-bold">Rôle</label>
                    <select name="role" class="form-control">
                        <option value="user">Membre</option>
                        <option value="admin">Administrateur</option>
                    </select>
                </div>
                <div class="col-md-1 d-flex align-items-end">
                    <button type="submit" class="btn-ajouter w-100"><i class="fa fa-plus"></i></button>
                </div>
            </div>
        </form>
    </div>

    <div class="card-section">
        <h2><i class="fa fa-list"></i> Liste des membres (<?= count($membres) ?>)</h2>
        <?php if (isset($_GET['succes'])): ?>
            <div style="background:#d4edda;border:1px solid #28a745;color:#155724;border-radius:8px;padding:12px;margin-bottom:16px;">✅ Membre supprimé.</div>
        <?php endif; ?>
        <table class="table table-hover">
            <thead>
                <tr><th>Nom</th><th>Email</th><th>Rôle</th><th>Date création</th><th>Action</th></tr>
            </thead>
            <tbody>
                <?php foreach ($membres as $m): ?>
                <tr>
                    <td><?= htmlspecialchars($m['nom']) ?></td>
                    <td><?= htmlspecialchars($m['email']) ?></td>
                    <td><span class="<?= $m['role'] === 'admin' ? 'badge-admin' : 'badge-user' ?>"><?= $m['role'] === 'admin' ? 'Administrateur' : 'Membre' ?></span></td>
                    <td><?= date('d/m/Y', strtotime($m['date_creation'])) ?></td>
                    <td>
                        <?php if ($m['id'] !== (int)$_SESSION['user_id']): ?>
                        <form method="POST" style="display:inline;" onsubmit="return confirm('Supprimer ce membre ?')">
                            <?= csrf_token_field() ?>
                            <input type="hidden" name="supprimer_id" value="<?= $m['id'] ?>">
                            <button type="submit" class="btn-delete"><i class="fa fa-trash"></i></button>
                        </form>
                        <?php else: ?>
                        <span style="color:#aaa;font-size:0.85rem;">Vous</span>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>
