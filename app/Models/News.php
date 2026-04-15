<?php
class News {
    private $db;

    public function __construct($pdo) {
        $this->db = $pdo;
    }

    public function getAll($limit = 10, $offset = 0) {
        $stmt = $this->db->prepare("SELECT * FROM news ORDER BY id DESC LIMIT :limit OFFSET :offset");
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id) {
        $stmt = $this->db->prepare("SELECT * FROM news WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($title, $slug, $content, $image, $status, $meta_desc) {
        $stmt = $this->db->prepare("INSERT INTO news (title, slug, content, image, status, meta_desc) VALUES (:title, :slug, :content, :image, :status, :meta_desc)");
        return $stmt->execute([
            'title' => $title, 'slug' => $slug, 'content' => $content, 
            'image' => $image, 'status' => $status, 'meta_desc' => $meta_desc
        ]);
    }
    
    public function update($id, $title, $slug, $content, $image, $status, $meta_desc) {
        $query = "UPDATE news SET title = :title, slug = :slug, content = :content, status = :status, meta_desc = :meta_desc";
        $params = ['title' => $title, 'slug' => $slug, 'content' => $content, 'status' => $status, 'meta_desc' => $meta_desc, 'id' => $id];
        
        if ($image) {
            $query .= ", image = :image";
            $params['image'] = $image;
        }
        $query .= " WHERE id = :id";
        
        $stmt = $this->db->prepare($query);
        return $stmt->execute($params);
    }

    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM news WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }
}
