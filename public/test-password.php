<?php
$mot_de_passe_saisi = "TonMotDePasseIci"; // Remplace par ce que tu as tapé
$mot_de_passe_hash = '$2y$10$...'; // Copie le hash depuis phpMyAdmin

if (password_verify($mot_de_passe_saisi, $mot_de_passe_hash)) {
    echo "✅ Le mot de passe est correct.";
} else {
    echo "❌ Le mot de passe est incorrect.";
}
?>
