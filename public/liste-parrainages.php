<?php
session_start();
$page_title = "Parrainages - La Perche Tendue";
$page_description = "Liste des parrainages en cours au sein de notre association.";
 
include '../includes/header.php';
require '../database/database.php';
require '../src/Model/ParrainageModel.php';
require_once '../includes/csrf.php';
 
$parrainageModel = new ParrainageModel($pdo);
$parrainages = $parrainageModel->getAllParrainages();
 
// Vérifier si admin connecté pour afficher les actions
$est_admin = isset($_SESSION['user_id']) && isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin';
?>
 
<div class="container mt-5">
    <h2 class="text-center">Liste des Parrainages</h2>
    <p class="text-center">Voici la liste des parrains inscrits.</p>
 
    <?php if (!empty($_GET['error'])): ?>
        <div class="alert alert-danger">
            <strong>Erreur :</strong> <?= htmlspecialchars($_GET['error']) ?>
        </div>
    <?php endif; ?>
 
    <?php if (!empty($_GET['success'])): ?>
        <div class="alert alert-success">
            <strong>Succès :</strong> <?= htmlspecialchars($_GET['success']) ?>
        </div>
    <?php endif; ?>
 
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Nom</th>
                <?php if ($est_admin): ?><th>Email</th><?php endif; ?>
                <th>Message</th>
                <th>Date d'inscription</th>
                <?php if ($est_admin): ?><th>Actions</th><?php endif; ?>
            </tr>
        </thead>
        <tbody>
            <?php if ($parrainages): ?>
                <?php foreach ($parrainages as $parrainage): ?>
                <tr>
                    <td><?= htmlspecialchars($parrainage['nom']) ?></td>
                    <?php if ($est_admin): ?>
                    <td><?= htmlspecialchars($parrainage['email']) ?></td>
                    <?php endif; ?>
                    <td><?= htmlspecialchars(substr($parrainage['message'], 0, 50)) ?>...</td>
                    <td><?= date("d/m/Y H:i", strtotime($parrainage['date_inscription'])) ?></td>
                    <?php if ($est_admin): ?>
                    <td>
                        <form method="POST" action="/LaPercheTendueV2/src/Controller/ParrainageController.php"
                              onsubmit="return confirm('Supprimer ce parrainage ?')">
                            <?= csrf_token_field() ?>
                            <input type="hidden" name="delete_id" value="<?= (int)$parrainage['id'] ?>">
                            <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                        </form>
                    </td>
                    <?php endif; ?>
                </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="5" class="text-center">Aucun parrainage enregistré.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
 
<?php include '../includes/footer.php'; ?>