<?php
include(__DIR__ . '/../Model/Post.php');
include_once(__DIR__ . '/../config.php');

class PostController {
    public function listPosts() {
        $sql = "SELECT * FROM posts";
        $db = config::getConnexion();
        try {
            return $db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            error_log($e->getMessage());
            return false;
        }
    }

    public function addPost($post) {
        $sql = "INSERT INTO posts (title, content, image_path) VALUES (:title, :content, :image_path)";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->bindValue(':title', $post->getTitle(), PDO::PARAM_STR);
            $query->bindValue(':content', $post->getContent(), PDO::PARAM_STR);
            $query->bindValue(':image_path', $post->getImagePath(), PDO::PARAM_STR); // إضافة الصورة
            $query->execute();
        } catch (Exception $e) {
            error_log($e->getMessage());
            return false;
        }
    }

    public function deletePost($id) {
        $db = config::getConnexion();
    
        try {
            // الخطوة 1: الحصول على مسار الصورة من قاعدة البيانات
            $sqlSelect = "SELECT image_path FROM posts WHERE id = :id";
            $querySelect = $db->prepare($sqlSelect);
            $querySelect->bindValue(':id', $id, PDO::PARAM_INT);
            $querySelect->execute();
            $result = $querySelect->fetch(PDO::FETCH_ASSOC);
    
            if ($result && !empty($result['image_path'])) {
                $imagePath = '../uploads/' . $result['image_path'];
    
                // الخطوة 2: حذف الصورة من الخادم إذا كانت موجودة
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }
    
            // الخطوة 3: حذف المنشور من قاعدة البيانات
            $sqlDelete = "DELETE FROM posts WHERE id = :id";
            $queryDelete = $db->prepare($sqlDelete);
            $queryDelete->bindValue(':id', $id, PDO::PARAM_INT);
            $queryDelete->execute();
    
            return true;
        } catch (Exception $e) {
            error_log($e->getMessage());
            return false;
        }
    }
    

    public function getPost($id) {
        $sql = "SELECT * FROM posts WHERE id = :id";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->bindValue(':id', $id, PDO::PARAM_INT);
            $query->execute();
            return $query->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            error_log($e->getMessage());
            return false;
        }
    }

    public function updatePost($post) {
        $sql = "UPDATE posts SET title = :title, content = :content, image_path = :image_path WHERE id = :id";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->bindValue(':title', $post->getTitle(), PDO::PARAM_STR);
            $query->bindValue(':content', $post->getContent(), PDO::PARAM_STR);
            $query->bindValue(':image_path', $post->getImagePath(), PDO::PARAM_STR); // تعديل الصورة
            $query->bindValue(':id', $post->getId(), PDO::PARAM_INT);
            $query->execute();
        } catch (Exception $e) {
            error_log($e->getMessage());
            return false;
        }
    }

    public function searchPosts($searchQuery) {
        $sql = "SELECT * FROM posts WHERE title LIKE :search OR content LIKE :search";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->bindValue(':search', '%' . $searchQuery . '%', PDO::PARAM_STR);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            error_log($e->getMessage());
            return false;
        }
    }

    
        
    public function increaseLikes($postId) {
            $db = config::getConnexion();
            $sql = "UPDATE posts SET likes = likes + 1 WHERE id = :id";
            try {
                $query = $db->prepare($sql);
                $query->bindValue(':id', $postId, PDO::PARAM_INT);
                $query->execute();
            } catch (Exception $e) {
                error_log($e->getMessage());
                return false;
            }
    }
    



}
?>

