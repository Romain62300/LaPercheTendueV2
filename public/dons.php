<?php
include '../includes/header.php';
require '../database/database.php';
?>

<div class="container mt-5">
    <h2 class="text-center">Liste des dons</h2>
    <p class="text-center">Merci à tous nos donateurs pour leur générosité !</p>

    <?php
    // Requête SQL pour récupérer les dons
    $sql_dons = "SELECT id, montant, date_don FROM dons ORDER BY date_don DESC";
    $stmt_dons = $pdo->query($sql_dons);
    $dons = $stmt_dons->fetchAll(PDO::FETCH_ASSOC);
    ?>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID Don</th>
                <th>Montant</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($dons) {
                foreach ($dons as $don) {
                    echo "<tr>
                            <td>{$don['id']}</td>
                            <td>{$don['montant']} €</td>
                            <td>" . date("d/m/Y H:i", strtotime($don['date_don'])) . "</td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='3'>Aucun don reçu pour le moment.</td></tr>";
            } ?>
        </tbody>
    </table>

    <div class="text-center mt-4">
        <a href="faire-un-don.php" class="btn btn-primary">Faire un don</a>
    </div>
</div>

<?php include '../includes/footer.php'; ?>
