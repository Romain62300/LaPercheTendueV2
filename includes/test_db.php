<?php
require_once '../database/database.php';
 
try {
    $query = $pdo->query("SELECT 1");
    echo "✅ Connexion réussie à la base de données !";
} catch (PDOException $e) {
    echo "❌ Erreur de connexion : " . $e->getMessage();
}
