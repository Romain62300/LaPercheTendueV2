<?php
session_start();
require_once '../includes/csrf.php';
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - Administration La Perche Tendue</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        body {
            background-color: #f0f2f5;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            margin: 0;
            font-family: 'Segoe UI', sans-serif;
        }
        .login-card {
            background: white;
            border-radius: 16px;
            box-shadow: 0 8px 32px rgba(0,0,0,0.12);
            padding: 40px;
            width: 100%;
            max-width: 420px;
        }
        .login-logo {
            text-align: center;
            margin-bottom: 30px;
        }
        .login-logo img {
            height: 80px;
            border-radius: 50%;
            border: 3px solid #C62828;
        }
        .login-logo h1 {
            font-size: 1.3rem;
            color: #2E4369;
            font-weight: 700;
            margin-top: 12px;
        }
        .login-logo p {
            color: #888;
            font-size: 0.9rem;
        }
        .form-label {
            font-weight: 600;
            color: #444;
        }
        .form-control {
            border-radius: 8px;
            padding: 12px;
            border: 1px solid #ddd;
        }
        .form-control:focus {
            border-color: #C62828;
            box-shadow: 0 0 0 0.2rem rgba(198,40,40,0.15);
        }
        .btn-login {
            background-color: #C62828;
            color: white;
            border: none;
            border-radius: 8px;
            padding: 12px;
            width: 100%;
            font-weight: 700;
            font-size: 1rem;
            transition: background 0.3s ease;
        }
        .btn-login:hover {
            background-color: #A31F1F;
            color: white;
        }
        .alert-error {
            background: #fdecea;
            border: 1px solid #C62828;
            color: #C62828;
            border-radius: 8px;
            padding: 12px;
            margin-bottom: 20px;
            font-size: 0.9rem;
        }
        .back-link {
            text-align: center;
            margin-top: 20px;
        }
        .back-link a {
            color: #2E4369;
            font-size: 0.9rem;
            text-decoration: none;
        }
        .back-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="login-card">
        <div class="login-logo">
            <img src="/LaPercheTendueV2/public/assets/images/logo.jpg" alt="Logo La Perche Tendue">
            <h1>Administration</h1>
            <p>La Perche Tendue</p>
        </div>

        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert-error">
                <i class="fa fa-exclamation-circle"></i>
                <?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
            </div>
        <?php endif; ?>

        <form action="" method="POST">
            <div class="mb-3">
                <label for="email" class="form-label">
                    <i class="fa fa-envelope"></i> Adresse email
                </label>
                <input type="email" class="form-control" id="email" name="email" 
                       placeholder="votre@email.com" required autofocus>
            </div>

            <div class="mb-4">
                <label for="password" class="form-label">
                    <i class="fa fa-lock"></i> Mot de passe
                </label>
                <input type="password" class="form-control" id="password" name="password" 
                       placeholder="••••••••" required>
            </div>

            <?= csrf_token_field() ?>
                <button type="submit" class="btn-login">
                <i class="fa fa-sign-in-alt"></i> Se connecter
            </button>
        </form>

        <div class="back-link">
            <a href="/LaPercheTendueV2/public/index.php">
                <i class="fa fa-arrow-left"></i> Retour au site
            </a>
        </div>
    </div>
</body>
</html>
