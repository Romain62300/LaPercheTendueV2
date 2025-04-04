<?php
require_once __DIR__ . '/../../database/database.php';
require_once __DIR__ . '/../Model/ParrainageModel.php';

ini_set('display_errors', 1);
error_reporting(E_ALL);




$parrainageModel = new ParrainageModel($pdo);

// Fonction pour logger les erreurs
function logError($message) {
    file_put_contents(__DIR__ . "/../../logs/errors.log", "[" . date('Y-m-d H:i:s') . "] " . $message . "\n", FILE_APPEND);
}

// Vérification de l'ajout d'un parrainage
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST['honeypot'])) {
        header("Location: /la-perche-tendue/public/inscription-parrainage.php?error=Tentative de spam détectée.");
        exit;
    }

    // Récupérer et sécuriser les données
    $nom = trim($_POST['nom']);
    $email = trim($_POST['email']);
    $message = trim($_POST['message']);

    // Vérifier que les champs obligatoires ne sont pas vides
    if (empty($nom) || empty($email)) {
        header("Location: /la-perche-tendue/public/inscription-parrainage.php?error=Veuillez remplir tous les champs obligatoires.&nom=$nom&email=$email&message=$message");
        exit;
    }

    // Vérifier la longueur du nom
    if (strlen($nom) < 3) {
        header("Location: /la-perche-tendue/public/inscription-parrainage.php?error=Le nom doit contenir au moins 3 caractères.&nom=$nom&email=$email&message=$message");
        exit;
    }

    // Vérifier la validité de l'email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL) || !preg_match('/^[^@]+@[^@]+\.[a-zA-Z]{2,}$/', $email)) {
        header("Location: /la-perche-tendue/public/inscription-parrainage.php?error=Adresse email invalide.&nom=$nom&email=$email&message=$message");
        exit;
    }
    

    // Vérifier si l'email est déjà enregistré
    if ($parrainageModel->emailExists($email)) {
        header("Location: /la-perche-tendue/public/inscription-parrainage.php?error=Cet email est déjà utilisé.&nom=$nom&email=$email&message=$message");
        exit;
    }

    // Vérifier la longueur du message pour éviter les abus
    if (strlen($message) > 500) {
        header("Location: /la-perche-tendue/public/inscription-parrainage.php?error=Le message est trop long (max 500 caractères).&nom=$nom&email=$email&message=$message");
        exit;
    }

    // Ajouter le parrainage en base de données
    if ($parrainageModel->addParrainage($nom, $email, $message)) {
        header("Location: /la-perche-tendue/public/liste-parrainages.php?success=Parrainage ajouté avec succès.");
        exit;
    } else {
        logError("Erreur lors de l'ajout du parrainage pour l'email: " . $email);
        header("Location: /la-perche-tendue/public/inscription-parrainage.php?error=Erreur lors de l'inscription.&nom=$nom&email=$email&message=$message");
        exit;
    }
}

// Vérification de la suppression d'un parrainage
if (isset($_GET['delete']) && !empty($_GET['delete'])) {
    $id = intval($_GET['delete']);
    if ($parrainageModel->deleteParrainage($id)) {
        header("Location: /la-perche-tendue/public/liste-parrainages.php?success=Parrainage supprimé avec succès.");
    } else {
        logError("Erreur lors de la suppression du parrainage ID: " . $id);
        header("Location: /la-perche-tendue/public/liste-parrainages.php?error=Erreur lors de la suppression.");
    }
    exit;
}

// Redirection par défaut si accès direct
header("Location: /la-perche-tendue/public/liste-parrainages.php");
exit;
