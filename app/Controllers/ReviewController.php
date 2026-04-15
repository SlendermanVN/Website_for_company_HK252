<?php
require_once '../app/Models/Review.php';

class ReviewController {
    private $reviewModel;

    public function __construct($pdo) {
        $this->reviewModel = new Review($pdo);
    }

    public function index() {
        // Chỉ admin mới được duyệt
        if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
            die("Truy cập bị từ chối.");
        }

        $pendingReviews = $this->reviewModel->getPending();
        
        require_once '../templates/header.php';
        // Hiển thị view duyệt (sẽ tạo page review/index sau)
        echo "<h2>Quản lý duyệt đánh giá</h2>";
        foreach ($pendingReviews as $rev) {
            echo "<p>{$rev['product_name']} by {$rev['username']}: {$rev['content']} ";
            echo "<a href='/public/index.php?route=review_approve&id={$rev['id']}'>Duyệt</a> | ";
            echo "<a href='/public/index.php?route=review_reject&id={$rev['id']}'>Từ chối</a></p>";
        }
        require_once '../templates/footer.php';
    }

    public function approve($id) {
        if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') die("Từ chối.");
        $this->reviewModel->updateStatus($id, 'approved');
        header("Location: /public/index.php?route=reviews");
    }

    public function reject($id) {
        if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') die("Từ chối.");
        $this->reviewModel->updateStatus($id, 'rejected'); // Hoặc xóa hẳn
        header("Location: /public/index.php?route=reviews");
    }
}
