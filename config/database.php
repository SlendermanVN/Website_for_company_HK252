<?php
class Database {
    private $host = 'localhost';
    private $db   = 'sportzone';
    private $user = 'root';
    private $pass = '';
    private $charset = 'utf8mb4';
    public $pdo;

    public function __construct() {
        // TODO Văn Phát: Khởi tạo kết nối PDO, xử lý ngoại lệ (try-catch), cấu hình chống SQL Injection.
    }
}
