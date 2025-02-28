<?php
$host = 'localhost'; // ou '127.0.0.1'
$dbname = 'la_perche_tendue'; // ⚠️ Mets exactement le nom de ta base de données
$user = 'root'; // Par défaut sous WAMP
$password = ''; // Par défaut, pas de mot de passe sous WAMP

try {
    $pdo = new PDO("mysql:host=$host;dbname=la_perche_tendue;charset=utf8", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    exit("Erreur de connexion à la base de données : " . $e->getMessage());
}
?>