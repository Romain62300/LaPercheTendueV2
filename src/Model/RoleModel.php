<?php
class RoleModel {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Récupérer tous les rôles
    public function getAllRoles() {
        $sql = "SELECT * FROM roles ORDER BY id ASC";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Vérifier si un rôle existe déjà
    public function roleExists($roleName) {
        $sql = "SELECT COUNT(*) FROM roles WHERE nom = :nom";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':nom' => $roleName]);
        return $stmt->fetchColumn() > 0;
    }

    // Ajouter un rôle (en évitant les doublons)
    public function addRole($roleName) {
        if ($this->roleExists($roleName)) {
            return false; // Empêcher l'ajout d'un doublon
        }
        
        $sql = "INSERT INTO roles (nom) VALUES (:nom)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([':nom' => htmlspecialchars($roleName)]);
    }

    // Vérifier si un rôle est utilisé par des utilisateurs
    public function isRoleAssigned($id) {
        $sql = "SELECT COUNT(*) FROM utilisateurs WHERE role_id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetchColumn() > 0;
    }

    // Supprimer un rôle (seulement s'il n'est pas utilisé)
    public function deleteRole($id) {
        if ($this->isRoleAssigned($id)) {
            return false; // Empêcher la suppression d'un rôle utilisé
        }

        $sql = "DELETE FROM roles WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }
}
?>
