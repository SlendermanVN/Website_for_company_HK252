<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SportZone Vietnam</title>
    <!-- Phải tích hợp CSS, Animations -->
    <link rel="stylesheet" href="/assets/css/style.css">
    <!-- Thư viện cần thiết (Carousel, Animation) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
</head>
<body>
    <header class="animate__animated animate__fadeInDown">
        <div class="logo">SportZone</div>
        <nav>
            <ul>
                <li><a href="/public/index.php">Trang Chủ</a></li>
                <li><a href="/public/index.php?route=news">Tin tức</a></li>
                <li><a href="/public/index.php?route=products">Sản phẩm</a></li>
                <li><a href="/public/index.php?route=faqs">Hỏi đáp</a></li>
                
                <?php if (isset($_SESSION['user_id'])): ?>
                    <li>Chào, <?= htmlspecialchars($_SESSION['username']) ?></li>
                    <li><a href="/public/index.php?route=logout">Đăng xuất</a></li>
                <?php else: ?>
                    <li><a href="/public/index.php?route=login">Đăng nhập</a></li>
                    <li><a href="/public/index.php?route=register">Đăng ký</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>
    <main>
