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
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Erreur :</strong> <?php echo htmlspecialchars($_GET['error']); ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Fermer">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php endif; ?>

    <?php if (!empty($_GET['success'])): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Succès :</strong> <?php echo htmlspecialchars($_GET['success']); ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Fermer">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
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
                            <td>" . htmlspecialchars(substr($parrainage['message'], 0, 50)) . "...</td>
                            <td>" . date("d/m/Y H:i", strtotime($parrainage['date_inscription'])) . "</td>
                            <td>
                                <a href='/la-perche-tendue/src/Controller/ParrainageController.php?delete=" . urlencode($parrainage['id']) . "' 
                                   class='btn btn-danger btn-sm' 
                                   onclick='return confirm(\"Voulez-vous vraiment supprimer ce parrainage ?\")'>
                                   Supprimer
                                </a>
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
