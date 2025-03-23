<?php
class ParrainageModel {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // ✅ Récupérer tous les parrainages
    public function getAllParrainages() {
        $sql = "SELECT * FROM parrainages ORDER BY date_inscription DESC";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // ✅ Ajouter un parrainage avec gestion des erreurs
    public function addParrainage($nom, $email, $message) {
        try {
            $sql = "INSERT INTO parrainages (nom, email, message, date_inscription) VALUES (:nom, :email, :message, NOW())";
            $stmt = $this->pdo->prepare($sql);
            return $stmt->execute([
                ':nom' => htmlspecialchars(strip_tags($nom)), 
                ':email' => filter_var($email, FILTER_SANITIZE_EMAIL),
                ':message' => htmlspecialchars(strip_tags($message)) 
            ]);
        } catch (PDOException $e) {
            file_put_contents(__DIR__ . "/../../logs/errors.log", 
                "[" . date('Y-m-d H:i:s') . "] Erreur ajout parrainage : " . $e->getMessage() . "\n", 
                FILE_APPEND);
            return false;
        }
    }

    // ✅ Supprimer un parrainage avec gestion des erreurs
    public function deleteParrainage($id) {
        try {
            $sql = "DELETE FROM parrainages WHERE id = :id";
            $stmt = $this->pdo->prepare($sql);
            return $stmt->execute([':id' => (int)$id]);
        } catch (PDOException $e) {
            file_put_contents(__DIR__ . "/../../logs/errors.log", 
                "[" . date('Y-m-d H:i:s') . "] Erreur suppression parrainage ID $id : " . $e->getMessage() . "\n", 
                FILE_APPEND);
            return false;
        }
    }

    // ✅ Vérifier si un email existe déjà dans la BDD
    public function emailExists($email) {
        $query = "SELECT COUNT(*) FROM parrainages WHERE email = :email";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([':email' => trim(strtolower($email))]);
        return $stmt->fetchColumn() > 0;
    }

    // ✅ Récupérer un parrainage par ID
    public function getParrainageById($id) {
        $sql = "SELECT * FROM parrainages WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id' => (int)$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
