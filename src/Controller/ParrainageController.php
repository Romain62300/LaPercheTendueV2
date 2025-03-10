<?php
require_once '../database/database.php'; // Connexion à la BDD

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = trim($_POST["nom"] ?? '');
    $email = trim($_POST["email"] ?? '');
    $message = trim($_POST["message"] ?? '');
    $honeypot = trim($_POST["honeypot"] ?? ''); // Champ anti-bot

    if (!empty($honeypot)) {
        die("Erreur de validation !");
    }

    if (empty($nom) || empty($email)) {
        header("Location: /la-perche-tendue/public/inscription-parrainage.php?error=Veuillez remplir tous les champs obligatoires.");
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: /la-perche-tendue/public/inscription-parrainage.php?error=Email invalide.");
        exit;
    }

    try {
        $stmt = $pdo->prepare("INSERT INTO parrainages (nom, email, message, date_inscription) VALUES (:nom, :email, :message, NOW())");
        $stmt->bindParam(":nom", $nom);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":message", $message);
        $stmt->execute();

        header("Location: /la-perche-tendue/public/inscription-parrainage.php?success=Inscription réussie !");
        exit;
    } catch (PDOException $e) {
        header("Location: /la-perche-tendue/public/inscription-parrainage.php?error=Erreur serveur.");
        exit;
    }
} else {
    header("Location: /la-perche-tendue/public/inscription-parrainage.php");
    exit;
}
