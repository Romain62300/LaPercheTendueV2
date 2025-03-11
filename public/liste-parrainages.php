<?php
include '../includes/header.php';
require '../database/database.php';
require '../src/Model/ParrainageModel.php';
$parrainageModel = new ParrainageModel($pdo);
$parrainages = $parrainageModel->getAllParrainages();
?>
<div class="container mt-5">
    <h2 class="text-center">Liste des Parrainages</h2>
    <p class="text-center">Voici la liste des parrains et des bénéficiaires inscrits.</p>

    <!-- Affichage des messages -->
    <?php if (!empty($_GET['error'])): ?>
        <div class="alert alert-danger"><?php echo htmlspecialchars($_GET['error']); ?></div>
    <?php endif; ?>

    <?php if (!empty($_GET['success'])): ?>
        <div class="alert alert-success"><?php echo htmlspecialchars($_GET['success']); ?></div>
    <?php endif; ?>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Email</th>
                <th>Message</th>
                <th>Date d'inscription</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($parrainages) {
                foreach ($parrainages as $parrainage) {
                    echo "<tr>
                            <td>{$parrainage['id']}</td>
                            <td>{$parrainage['nom']}</td>
                            <td>{$parrainage['email']}</td>
                            <td>{$parrainage['message']}</td>
                            <td>" . date("d/m/Y H:i", strtotime($parrainage['date_inscription'])) . "</td>
                            <td>
                                <a href='/la-perche-tendue/src/Controller/ParrainageController.php?delete=" . urlencode($parrainage['id']) . "' class='btn btn-danger btn-sm'>Supprimer</a>
                            </td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='6' class='text-center'>Aucun parrainage enregistré.</td></tr>";
            } ?>
        </tbody>
    </table>
</div>
<?php include '../includes/footer.php'; ?>