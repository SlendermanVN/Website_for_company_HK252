<?php
class ProductController {
    public function index() {
        // TODO Văn Phát: Hiển thị danh sách sản phẩm (có phân trang, lazy loading, carousel).
    }

    public function detail($id) {
        // TODO Văn Phát: Hiển thị chi tiết sản phẩm, review, thêm vào giỏ hàng.
    }

    public function create() {
        // TODO Văn Phát: Form thêm sản phẩm (drag & drop upload ảnh, validate, xử lý upload).
    }

    public function store() {
        // TODO Văn Phát: Lưu sản phẩm mới vào DB, kiểm tra dữ liệu, bảo mật.
    }

    public function edit($id) {
        // TODO Văn Phát: Form sửa sản phẩm, load dữ liệu cũ.
    }

    public function update($id) {
        // TODO Văn Phát: Cập nhật sản phẩm, xử lý upload ảnh mới nếu có.
    }

    public function delete($id) {
        // TODO Văn Phát: Xóa sản phẩm, xác nhận trước khi xóa.
    }
}
