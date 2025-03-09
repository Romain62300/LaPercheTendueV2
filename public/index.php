<?php include '../includes/header.php'; ?>
<?php require '../database/database.php'; ?>

<div class="container mt-5">
    <h2 class="text-center">Bienvenue sur <strong>La Perche Tendue</strong></h2>
    <p class="text-center">Une association d'entraide et de solidarité.</p>

    <div class="text-center my-3">
        <a href="dons.php" class="btn btn-primary">Faire un don</a>
        <a href="parrainage.php" class="btn btn-secondary">Devenir parrain</a>
    </div>

    <!-- Dernières actualités -->
    <h3>Dernières actualités</h3>
    <?php
    $sql_actualites = "SELECT * FROM articles ORDER BY date_publication DESC LIMIT 3";
    $stmt_actualites = $pdo->query($sql_actualites);
    $actualites = $stmt_actualites->fetchAll(PDO::FETCH_ASSOC);

    if ($actualites) {
        echo "<ul class='list-group'>";
        foreach ($actualites as $article) {
          setlocale(LC_TIME, "fr_FR.UTF-8"); // Définir la localisation en français
echo "<li class='list-group-item'>
        <a href='actualites.php?id={$article['id']}'>{$article['titre']}</a> - " 
        (new DateTime($article['date_publication']))->format('d F Y').

     "</li>";

        }
        echo "</ul>";
    } else {
        echo "<p>Aucune actualité pour le moment.</p>";
    }
    ?>

    <a href="actualites.php" class="btn btn-outline-primary mt-2">Voir toutes les actualités</a>

    <!-- Derniers dons reçus -->
    <h3 class="mt-5">Derniers dons reçus</h3>
    <?php
    $sql_dons = "SELECT dons.id, utilisateurs.nom, dons.montant, dons.date_don FROM dons 
                 JOIN utilisateurs ON dons.utilisateur_id = utilisateurs.id 
                 ORDER BY dons.date_don DESC LIMIT 5";
    $stmt_dons = $pdo->query($sql_dons);
    $dons = $stmt_dons->fetchAll(PDO::FETCH_ASSOC);
    ?>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID Don</th>
                <th>Nom Donateur</th>
                <th>Montant</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($dons) {
                foreach ($dons as $don) {
                    echo "<tr>
                            <td>{$don['id']}</td>
                            <td>{$don['nom']}</td>
                            <td>{$don['montant']} €</td>
                            <td>" . date("d/m/Y H:i", strtotime($don['date_don'])) . "</td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='4'>Aucun don reçu pour le moment.</td></tr>";
            } ?>
        </tbody>
    </table>

    <a href="dons.php" class="btn btn-outline-primary mt-2">Voir tous les dons</a>
</div>

<?php include '../includes/footer.php'; ?>
