<?php
session_start();
require_once '../database/database.php';
require_once '../src/Controller/AdminController.php';

$adminController = new AdminController($pdo);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $adminController->login($email, $password);
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion - Admin</title>
</head>
<body>
    <h2>Connexion à l'administration</h2>

    <?php if (isset($_SESSION['error'])): ?>
        <p style="color:red"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></p>
    <?php endif; ?>

    <form action="" method="POST">
        <label>Email : </label>
        <input type="email" name="email" required>

        <label>Mot de passe : </label>
        <input type="password" name="password" required>

        <button type="submit">Se connecter</button>
    </form>
</body>
</html>
