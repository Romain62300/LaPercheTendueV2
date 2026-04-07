<?php
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: contact.php');
    exit;
}

$nom       = htmlspecialchars(trim($_POST['nom'] ?? ''));
$prenom    = htmlspecialchars(trim($_POST['prenom'] ?? ''));
$email     = filter_var(trim($_POST['email'] ?? ''), FILTER_SANITIZE_EMAIL);
$telephone = htmlspecialchars(trim($_POST['telephone'] ?? ''));
$message   = htmlspecialchars(trim($_POST['message'] ?? ''));
$rgpd      = isset($_POST['rgpd']) ? true : false;

if (empty($nom) || empty($prenom) || empty($email) || empty($message)) {
    header('Location: contact.php?erreur=champs_manquants');
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header('Location: contact.php?erreur=email_invalide');
    exit;
}

if (!$rgpd) {
    header('Location: contact.php?erreur=rgpd');
    exit;
}

require_once '../database/database.php';

try {
    $stmt = $pdo->prepare("
        INSERT INTO contacts (user_id, nom, prenom, email, telephone, message) 
        VALUES (NULL, :nom, :prenom, :email, :telephone, :message)
    ");
    $stmt->execute([
        ':nom'       => $nom,
        ':prenom'    => $prenom,
        ':email'     => $email,
        ':telephone' => $telephone ?: null,
        ':message'   => $message
    ]);
    header('Location: contact.php?succes=1');
    exit;
} catch (PDOException $e) {
    header('Location: contact.php?erreur=envoi_impossible');
    exit;
}
