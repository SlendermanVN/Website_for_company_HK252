<?php
class Review {
    private $db;

    public function __construct($pdo) {
        $this->db = $pdo;
    }

    public function getPending() {
        $stmt = $this->db->prepare("SELECT r.*, u.username, p.name as product_name FROM reviews r JOIN users u ON r.user_id = u.id JOIN products p ON r.product_id = p.id WHERE r.status = 'pending'");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateStatus($id, $status) {
        $stmt = $this->db->prepare("UPDATE reviews SET status = :status WHERE id = :id");
        return $stmt->execute(['status' => $status, 'id' => $id]);
    }
}
