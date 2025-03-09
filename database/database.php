<?php
$host = 'localhost';
$dbname = 'la_perche_tendue';
$username = 'root'; // Change si nécessaire
$password = ''; // Laisse vide si tu es en local avec XAMPP

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}
?>
