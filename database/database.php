<?php
$host = 'localhost'; // Adresse du serveur MySQL
$dbname = 'la_perche_tendue'; // Nom de la base de données
$user = 'root'; // Nom d'utilisateur (par défaut sous WAMP/XAMPP)
$password = ''; // Mot de passe (souvent vide en local)

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}
?>
