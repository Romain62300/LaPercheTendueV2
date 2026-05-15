<?php
require_once __DIR__ . '/../../database/database.php';
require_once __DIR__ . '/../Model/ParrainageModel.php';
require_once __DIR__ . '/../../includes/csrf.php';

$parrainageModel = new ParrainageModel($pdo);

function logError($message) {
    $logDir = __DIR__ . '/../../logs';
    if (!is_dir($logDir)) mkdir($logDir, 0755, true);
    file_put_contents($logDir . '/errors.log', '[' . date('Y-m-d H:i:s') . '] ' . $message . "\n", FILE_APPEND);
}

// Ajout d'un parrainage (POST)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !isset($_POST['delete_id'])) {
    csrf_verify();

    // Anti-spam honeypot
    if (!empty($_POST['honeypot'])) {
        header('Location: /LaPercheTendueV2/public/inscription-parrainage.php?error=Tentative+de+spam+détectée.');
        exit;
    }

    $nom     = trim($_POST['nom'] ?? '');
    $email   = trim($_POST['email'] ?? '');
    $message = trim($_POST['message'] ?? '');

    if (empty($nom) || empty($email)) {
        header('Location: /LaPercheTendueV2/public/inscription-parrainage.php?error=Veuillez+remplir+tous+les+champs+obligatoires.');
        exit;
    }
    if (strlen($nom) < 3) {
        header('Location: /LaPercheTendueV2/public/inscription-parrainage.php?error=Le+nom+doit+contenir+au+moins+3+caractères.');
        exit;
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header('Location: /LaPercheTendueV2/public/inscription-parrainage.php?error=Adresse+email+invalide.');
        exit;
    }
    if ($parrainageModel->emailExists($email)) {
        header('Location: /LaPercheTendueV2/public/inscription-parrainage.php?error=Cet+email+est+déjà+utilisé.');
        exit;
    }
    if (strlen($message) > 500) {
        header('Location: /LaPercheTendueV2/public/inscription-parrainage.php?error=Le+message+est+trop+long+(max+500+caractères).');
        exit;
    }

    if ($parrainageModel->addParrainage($nom, $email, $message)) {
        header('Location: /LaPercheTendueV2/public/liste-parrainages.php?success=Parrainage+ajouté+avec+succès.');
    } else {
        logError('Erreur lors de l\'ajout du parrainage pour l\'email: ' . $email);
        header('Location: /LaPercheTendueV2/public/inscription-parrainage.php?error=Erreur+lors+de+l\'inscription.');
    }
    exit;
}

// Suppression d'un parrainage (POST sécurisé)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_id'])) {
    csrf_verify();
    $id = (int)$_POST['delete_id'];
    if ($parrainageModel->deleteParrainage($id)) {
        header('Location: /LaPercheTendueV2/public/liste-parrainages.php?success=Parrainage+supprimé+avec+succès.');
    } else {
        logError('Erreur lors de la suppression du parrainage ID: ' . $id);
        header('Location: /LaPercheTendueV2/public/liste-parrainages.php?error=Erreur+lors+de+la+suppression.');
    }
    exit;
}

header('Location: /LaPercheTendueV2/public/liste-parrainages.php');
exit;
