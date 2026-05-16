<?php
function require_admin() {
    if (!isset($_SESSION['user_id']) || !isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
        header("Location: login.php");
        exit();
    }
}
?>
