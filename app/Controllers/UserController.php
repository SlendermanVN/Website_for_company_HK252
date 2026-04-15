<?php
class UserController {
    public function index() {
        // TODO Gia Phúc: (Admin) Hiển thị danh sách Users.
    }

    public function resetPassword($id) {
        // TODO Gia Phúc: Cho phép admin (hoặc user) Reset mật khẩu. (Nhớ dùng password_hash).
    }

    public function banUser($id) {
        // TODO Gia Phúc: (Admin) Ban tài khoản / Khóa tài khoản -> Đổi cột status = 0.
    }
    
    public function unbanUser($id) {
        // TODO Gia Phúc: (Admin) Mở khóa tài khoản -> Đổi cột status = 1.
    }
}
