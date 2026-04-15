<div class="news-list">
    <h2>Tin tức</h2>
    <a href="/public/index.php?route=news_create">Thêm tin mới</a>
    <ul>
        <?php foreach ($newsList as $news): ?>
            <li>
                <a href="/public/index.php?route=news_detail&id=<?= $news['id'] ?>">
                    <h3><?= htmlspecialchars($news['title']) ?></h3>
                </a>
                <p><?= htmlspecialchars($news['meta_desc']) ?></p>
            </li>
        <?php endforeach; ?>
    </ul>
    <!-- Phân trang Pagination TODO -->
    <div class="pagination">
        <a href="?route=news&page=1">Trang 1</a>
        <a href="?route=news&page=2">Trang 2</a>
    </div>
</div>
