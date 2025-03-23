<?php
session_start();

// Redirection si l'utilisateur n'est pas connecté
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Tableau de bord</title>
</head>
<body>
    <h2>Bienvenue sur le tableau de bord</h2>

    <p>ID utilisateur : <?php echo $_SESSION['user_id']; ?></p>
    <p>Rôle : <?php echo ($_SESSION['user_role'] == 1) ? "Admin" : "Membre"; ?></p>

    <a href="logout.php">Se déconnecter</a>
</body>
</html>
