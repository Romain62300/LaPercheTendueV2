<?php
require_once '../../includes/config.php';
;

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        // Vérification et nettoyage des champs
        $nom = trim($_POST['nom'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $message = trim($_POST['message'] ?? '');

        if ($nom && $email && $message) {
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                exit("Adresse email invalide.");
            }

            // Insertion sécurisée
            $sql = "INSERT INTO contacts (nom, email, message) VALUES (:nom, :email, :message)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                ':nom' => htmlspecialchars($nom),
                ':email' => htmlspecialchars($email),
                ':message' => htmlspecialchars($message)
            ]);

            // Redirection
            header("Location: /la-perche-tendue/public/contact.php?success=1");
            exit;
        } else {
            exit("Veuillez remplir tous les champs.");
        }
    }
} catch (PDOException $e) {
    exit("Erreur de connexion à la base de données : " . $e->getMessage());
}
