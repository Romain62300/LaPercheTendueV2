<?php
class ParrainageModel {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getAllParrainages() {
        $sql = "SELECT * FROM parrainages ORDER BY date_inscription DESC";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addParrainage($nom, $email, $message) {
        $sql = "INSERT INTO parrainages (nom, email, message, date_inscription) VALUES (:nom, :email, :message, NOW())";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            ':nom' => htmlspecialchars($nom),
            ':email' => filter_var($email, FILTER_SANITIZE_EMAIL),
            ':message' => htmlspecialchars($message)
        ]);
    }

    public function deleteParrainage($id) {
        $sql = "DELETE FROM parrainages WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }

    // 🟢 Correction : emailExists() doit être dans la classe
    public function emailExists($email) {
        $query = "SELECT COUNT(*) FROM parrainages WHERE email = :email";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute(['email' => $email]);
        return $stmt->fetchColumn() > 0;
    }
} // Fin de la classe ✅

?>
