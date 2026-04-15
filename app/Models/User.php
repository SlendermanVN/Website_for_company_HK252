<?php
class User {
    private $db;

    public function __construct($pdo) {
        $this->db = $pdo;
    }

    public function findByEmail($email) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE email = :email LIMIT 1");
        $stmt->execute(['email' => $email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($username, $password, $email, $role = 'member') {
        $hash = password_hash($password, PASSWORD_BCRYPT);
        $stmt = $this->db->prepare("INSERT INTO users (username, password, email, role, status) VALUES (:username, :password, :email, :role, 1)");
        return $stmt->execute([
            'username' => $username,
            'password' => $hash,
            'email' => $email,
            'role' => $role
        ]);
    }
}
