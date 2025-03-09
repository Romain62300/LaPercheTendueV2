<?php
require '../../database/database.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $montant = filter_var($_POST['montant'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Adresse email invalide.");
    }

    if ($montant <= 0 || $montant > 10000) {
        die("Montant du don invalide.");
    }

    try {
        $stmt = $pdo->prepare("INSERT INTO dons (utilisateur_id, montant, date_don) VALUES (?, ?, NOW())");

        // Récupération de l'utilisateur si existant
        $stmt_user = $pdo->prepare("SELECT id FROM utilisateurs WHERE email = ?");
        $stmt_user->execute([$email]);
        $user = $stmt_user->fetch();

        if ($user) {
            $user_id = $user['id'];
        } else {
            // Créer un nouvel utilisateur anonyme
            $stmt_insert = $pdo->prepare("INSERT INTO utilisateurs (nom, email, mot_de_passe) VALUES ('Donateur Anonyme', ?, '')");
            $stmt_insert->execute([$email]);
            $user_id = $pdo->lastInsertId();
        }

        $stmt->execute([$user_id, $montant]);

        echo "Don enregistré avec succès !";
        header("Location: /la-perche-tendue/public/dons.php?success=1");
        exit;
    } catch (PDOException $e) {
        die("Erreur lors de l'enregistrement du don: " . $e->getMessage());
    }
} else {
    die("Accès non autorisé");
}
