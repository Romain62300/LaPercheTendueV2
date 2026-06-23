<?php
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

require_once '../database/database.php';

$message = '';
$erreur = '';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $ancien = $_POST['ancien_mot_de_passe'] ?? '';
    $nouveau = $_POST['nouveau_mot_de_passe'] ?? '';
    $confirmation = $_POST['confirmation_mot_de_passe'] ?? '';

    if ($nouveau !== $confirmation) {
        $erreur = "Les deux nouveaux mots de passe ne correspondent pas.";
    } elseif (strlen($nouveau) < 8) {
        $erreur = "Le nouveau mot de passe doit contenir au moins 8 caractères.";
    } else {
        $stmt = $pdo->prepare("SELECT mot_de_passe FROM utilisateurs WHERE id = ?");
        $stmt->execute([$_SESSION['user_id']]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$user || !password_verify($ancien, $user['mot_de_passe'])) {
            $erreur = "Ancien mot de passe incorrect.";
        } else {
            $hash = password_hash($nouveau, PASSWORD_DEFAULT);

            $update = $pdo->prepare("UPDATE utilisateurs SET mot_de_passe = ? WHERE id = ?");
            $update->execute([$hash, $_SESSION['user_id']]);

            $message = "Mot de passe modifié avec succès.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Changer mon mot de passe</title>
    <link rel="stylesheet" href="assets/admin.css">
</head>
<body>

<h1>Changer mon mot de passe</h1>

<?php if ($message): ?>
    <p style="color: green;"><?= htmlspecialchars($message) ?></p>
<?php endif; ?>

<?php if ($erreur): ?>
    <p style="color: red;"><?= htmlspecialchars($erreur) ?></p>
<?php endif; ?>

<form method="POST">
    <label>Ancien mot de passe</label><br>
    <input type="password" name="ancien_mot_de_passe" required><br><br>

    <label>Nouveau mot de passe</label><br>
    <input type="password" name="nouveau_mot_de_passe" required><br><br>

    <label>Confirmer le nouveau mot de passe</label><br>
    <input type="password" name="confirmation_mot_de_passe" required><br><br>

    <button type="submit">Modifier le mot de passe</button>
</form>

<br>
<a href="dashboard.php">Retour au tableau de bord</a>

</body>
</html>