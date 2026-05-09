
<?php
 
class UserModel {
    private $pdo;
 
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }
 
    public function getUserByEmail($email) {
        $stmt = $this->pdo->prepare("SELECT * FROM utilisateurs WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
 
    public function createUser($nom, $email, $mot_de_passe, $role = 'user') {
        $hashedPassword = password_hash($mot_de_passe, PASSWORD_DEFAULT);
        $stmt = $this->pdo->prepare("INSERT INTO utilisateurs (nom, email, mot_de_passe, role) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$nom, $email, $hashedPassword, $role]);
    }
 
    public function getAllUsers() {
        return $this->pdo->query("SELECT id, nom, email, role, date_creation FROM utilisateurs ORDER BY date_creation DESC")->fetchAll(PDO::FETCH_ASSOC);
    }
}
 