<div class="news-form animate__animated animate__fadeIn">
    <h2>Thêm tin tức</h2>
    <form action="/public/index.php?route=news_create" method="POST" enctype="multipart/form-data">
        <label>Tiêu đề:</label>
        <input type="text" name="title" required>
        
        <label>Mô tả ngắn (SEO meta description):</label>
        <input type="text" name="meta_desc">

        <label>Nội dung (Trình soạn thảo WYSIWYG):</label>
        <textarea id="editor" name="content"></textarea>

        <label>Ảnh đại diện:</label>
        <input type="file" name="image" accept="image/*">

        <label>
            <input type="checkbox" name="status" value="1" checked> Hiển thị công khai
        </label>

        <button type="submit">Lưu tin tức</button>
    </form>
</div>

<!-- Tích hợp CKEditor (WYSIWYG) -->
<script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace('editor');
</script>
