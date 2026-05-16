<?php
session_start();
require_once __DIR__ . '/../../includes/auth.php';

// Vérification session admin obligatoire
if (!isset($_SESSION['user_id']) || !isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
    http_response_code(403);
    die("Accès non autorisé.");
}
 
require_once __DIR__ . '/../../database/database.php';
require_once __DIR__ . '/../../includes/csrf.php';
 
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
    // Vérification CSRF
    csrf_verify();
 
    $email = filter_var($_POST['email'] ?? '', FILTER_SANITIZE_EMAIL);
    $montant = filter_var($_POST['montant'] ?? 0, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
 
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: /LaPercheTendueV2/admin/gestion-dons.php?erreur=email_invalide");
        exit;
    }
 
    if ($montant <= 0 || $montant > 10000) {
        header("Location: /LaPercheTendueV2/admin/gestion-dons.php?erreur=montant_invalide");
        exit;
    }
 
    try {
        // Récupération de l'utilisateur si existant
        $stmt_user = $pdo->prepare("SELECT id FROM utilisateurs WHERE email = ?");
        $stmt_user->execute([$email]);
        $user = $stmt_user->fetch();
 
        if ($user) {
            $user_id = $user['id'];
        } else {
            $stmt_insert = $pdo->prepare("INSERT INTO utilisateurs (nom, email, mot_de_passe, role) VALUES ('Donateur', ?, ?, 'user')");
            $stmt_insert->execute([$email, password_hash(bin2hex(random_bytes(16)), PASSWORD_DEFAULT)]);
            $user_id = $pdo->lastInsertId();
        }
 
        $stmt = $pdo->prepare("INSERT INTO dons (utilisateur_id, montant, date_don) VALUES (?, ?, NOW())");
        $stmt->execute([$user_id, $montant]);
 
        header("Location: /LaPercheTendueV2/admin/gestion-dons.php?succes=1");
        exit;
 
    } catch (PDOException $e) {
        // Ne jamais afficher l'erreur en production
        error_log("Erreur don : " . $e->getMessage());
        header("Location: /LaPercheTendueV2/admin/gestion-dons.php?erreur=serveur");
        exit;
    }
 
} else {
    http_response_code(405);
    die("Méthode non autorisée.");
}