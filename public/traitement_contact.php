<?php
session_start();
require_once '../includes/csrf.php';
 
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: contact.php');
    exit;
}
 
// Vérification CSRF
csrf_verify();
 
// Rate limiting - max 3 messages par heure par IP
$ip = $_SERVER['REMOTE_ADDR'];
$cle = 'contact_' . md5($ip);
if (!isset($_SESSION[$cle])) {
    $_SESSION[$cle] = ['count' => 0, 'time' => time()];
}
if (time() - $_SESSION[$cle]['time'] > 3600) {
    $_SESSION[$cle] = ['count' => 0, 'time' => time()];
}
if ($_SESSION[$cle]['count'] >= 3) {
    header('Location: contact.php?erreur=trop_de_messages');
    exit;
}
 
// Anti-spam honeypot
if (!empty($_POST['honeypot'])) {
    header('Location: contact.php?succes=1');
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
 
    // Incrémenter le compteur
    $_SESSION[$cle]['count']++;
 
    header('Location: contact.php?succes=1');
    exit;
} catch (PDOException $e) {
    error_log("Erreur contact : " . $e->getMessage());
    header('Location: contact.php?erreur=envoi_impossible');
    exit;
    }
