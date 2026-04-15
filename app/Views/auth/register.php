<div class="auth-container">
    <h2>Đăng ký</h2>
    <form action="/public/index.php?route=register" method="POST">
        <label>Tên hiển thị:</label>
        <input type="text" name="username" required>
        <label>Email:</label>
        <input type="email" name="email" required>
        <label>Mật khẩu:</label>
        <input type="password" name="password" required>
        <button type="submit">Đăng ký</button>
    </form>
</div>
