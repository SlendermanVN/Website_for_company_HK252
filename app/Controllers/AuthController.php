<?php
require_once '../app/Models/User.php';

class AuthController {
    private $userModel;

    public function __construct($pdo) {
        $this->userModel = new User($pdo);
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Validate & prevent XSS/CSRF
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            $password = $_POST['password'];

            $user = $this->userModel->findByEmail($email);
            if ($user && password_verify($password, $user['password'])) {
                if ($user['status'] == 0) {
                    echo "Tài khoản của bạn đã bị khóa!";
                    return;
                }
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['role'] = $user['role'];
                
                header("Location: /public/index.php");
                exit;
            } else {
                echo "Sai email hoặc mật khẩu!";
            }
        } else {
            require_once '../templates/header.php';
            require_once '../app/Views/auth/login.php';
            require_once '../templates/footer.php';
        }
    }

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = htmlspecialchars($_POST['username']);
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            $password = $_POST['password'];
            
            // Basic validation
            if (empty($username) || empty($email) || empty($password)) {
                echo "Vui lòng nhập đầy đủ thông tin.";
                return;
            }

            if ($this->userModel->findByEmail($email)) {
                echo "Email đã tồn tại.";
                return;
            }

            if ($this->userModel->create($username, $password, $email)) {
                header("Location: /public/index.php?route=login");
                exit;
            } else {
                echo "Có lỗi xảy ra khi đăng ký.";
            }
        } else {
            require_once '../templates/header.php';
            require_once '../app/Views/auth/register.php';
            require_once '../templates/footer.php';
        }
    }

    public function logout() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        session_destroy();
        header("Location: /public/index.php");
        exit;
    }
}
