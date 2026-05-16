<?php
require_once '../src/Model/UserModel.php';

class AdminController {
    private $userModel;

    public function __construct($pdo) {
        $this->userModel = new UserModel($pdo);
    }

    public function login($email, $mot_de_passe) {
        $user = $this->userModel->getUserByEmail($email);

        if (!$user) {
            $_SESSION['error'] = "Email ou mot de passe incorrect.";
            header("Location: login.php");
            exit();
        }

        if (password_verify($mot_de_passe, $user['mot_de_passe'])) {
            // Régénérer l'ID de session pour éviter la fixation de session
            session_regenerate_id(true);
            $_SESSION['user_id']   = $user['id'];
            $_SESSION['user_nom']  = $user['nom'];
            $_SESSION['user_role'] = $user['role'];
            header("Location: dashboard.php");
            exit();
        } else {
            $_SESSION['error'] = "Email ou mot de passe incorrect.";
            header("Location: login.php");
            exit();
        }
    }

    public function logout() {
        session_destroy();
        header("Location: login.php");
        exit();
    }
}
?>
