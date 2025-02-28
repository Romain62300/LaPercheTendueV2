<?php 
require_once '../../includes/config.php'; // Connexion à la base de données

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nom = trim($_POST['nom']);
    $email = trim($_POST['email']);
    $message = trim($_POST['message']);

    if (empty($nom) || empty($email) || empty($message)) {
        die("Tous les champs sont obligatoires.");
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Email invalide.");
    }

    try {
        // Utilisation des variables au lieu des constantes
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $pdo->prepare("INSERT INTO parrainages (nom, email, message) VALUES (:nom, :email, :message)");
        $stmt->execute([
            ':nom' => $nom,
            ':email' => $email,
            ':message' => $message
        ]);

        header("Location: /la-perche-tendue/public/inscription-parrainage.php?success=1");
        exit;
    } catch (PDOException $e) {
        die("Erreur lors de l'inscription : " . $e->getMessage());
    }
}
?>

