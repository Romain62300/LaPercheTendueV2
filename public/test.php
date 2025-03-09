<?php
include '../includes/header.php';
require '../database/database.php';

echo "<div class='container mt-5'>";
echo "<h2 class='text-center'>Test de la connexion à la base de données</h2>";

try {
    $sql = "SELECT * FROM utilisateurs";
    $stmt = $pdo->query($sql);
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($users) {
        echo "<table class='table table-striped table-bordered'>";
        echo "<thead class='table-dark'><tr><th>ID</th><th>Nom</th><th>Email</th><th>Rôle</th></tr></thead>";
        echo "<tbody>";
        foreach ($users as $user) {
            echo "<tr><td>{$user['id']}</td><td>{$user['nom']}</td><td>{$user['email']}</td><td>{$user['role']}</td></tr>";
        }
        echo "</tbody>";
        echo "</table>";
    } else {
        echo "<div class='alert alert-warning'>Aucun utilisateur trouvé.</div>";
    }
} catch (PDOException $e) {
    echo "<div class='alert alert-danger'>Erreur SQL : " . $e->getMessage() . "</div>";
}

echo "</div>"; // Fermeture du container

include '../includes/footer.php';
?>
