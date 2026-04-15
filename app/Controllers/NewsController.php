<?php
require_once '../app/Models/News.php';

class NewsController {
    private $newsModel;

    public function __construct($pdo) {
        $this->newsModel = new News($pdo);
    }

    public function index() {
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $limit = 5;
        $offset = ($page - 1) * $limit;
        
        $newsList = $this->newsModel->getAll($limit, $offset);
        
        require_once '../templates/header.php';
        require_once '../app/Views/news/index.php';
        require_once '../templates/footer.php';
    }

    public function detail($id) {
        $news = $this->newsModel->getById($id);
        if (!$news) {
            echo "Tin tức không tồn tại!";
            return;
        }
        
        require_once '../templates/header.php';
        require_once '../app/Views/news/detail.php';
        require_once '../templates/footer.php';
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = htmlspecialchars($_POST['title']);
            $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $title)));
            // Nội dung được phép chứa HTML nhưng phải sanitize nếu cần. Ở đây mock basic XSS handling in view.
            $content = $_POST['content']; 
            $meta_desc = htmlspecialchars($_POST['meta_desc']);
            $status = isset($_POST['status']) ? 1 : 0;
            
            $image = '';
            if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
                // TODO Văn Phát: Phần này sẽ dùng lại code của Upload Image sau. Giờ code base:
                $image = time() . '_' . $_FILES['image']['name'];
                move_uploaded_file($_FILES['image']['tmp_name'], '../uploads/' . $image);
            }

            $this->newsModel->create($title, $slug, $content, $image, $status, $meta_desc);
            header("Location: /public/index.php?route=news");
            exit;
        } else {
            require_once '../templates/header.php';
            require_once '../app/Views/news/create.php'; // Giao diện WYSIWYG
            require_once '../templates/footer.php';
        }
    }

    public function edit($id) {
        $news = $this->newsModel->getById($id);
        if (!$news) {
            echo "Tin tức không tồn tại!";
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = htmlspecialchars($_POST['title']);
            $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $title)));
            $content = $_POST['content'];
            $meta_desc = htmlspecialchars($_POST['meta_desc']);
            $status = isset($_POST['status']) ? 1 : 0;
            
            $image = null;
            if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
                $image = time() . '_' . $_FILES['image']['name'];
                move_uploaded_file($_FILES['image']['tmp_name'], '../uploads/' . $image);
            }

            $this->newsModel->update($id, $title, $slug, $content, $image, $status, $meta_desc);
            header("Location: /public/index.php?route=news");
            exit;
        } else {
            require_once '../templates/header.php';
            require_once '../app/Views/news/edit.php';
            require_once '../templates/footer.php';
        }
    }

    public function delete($id) {
        $this->newsModel->delete($id);
        header("Location: /public/index.php?route=news");
        exit;
    }
}
