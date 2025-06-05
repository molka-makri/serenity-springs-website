<?php
include(__DIR__ . '/../Model/Comments.php');
include_once(__DIR__ . '/../config.php');

class CommentController {
    public function listComments() {
        $sql = "SELECT * FROM comments";
        $db = config::getConnexion();
        try {
            return $db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            error_log($e->getMessage());
            return false;
        }
    }

   
    public function getAllComments() {
        $sql = "SELECT * FROM comments";
        $db = config::getConnexion();
        try {
            return $db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            error_log($e->getMessage());
            return false;
        }
    }
    
    
    public function addComment($comment) {
        $sql = "INSERT INTO comments (post_id, content) VALUES (:post_id, :content)";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->bindValue(':post_id', $comment->getPostId(), PDO::PARAM_INT);
            $query->bindValue(':content', $comment->getContent(), PDO::PARAM_STR);
            $query->execute();
        } catch (Exception $e) {
            error_log($e->getMessage());
            return false;
        }
    }

    public function deleteComment($id) {
        $sql = "DELETE FROM comments WHERE id = :id";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->bindValue(':id', $id, PDO::PARAM_INT);
            $query->execute();
        } catch (Exception $e) {
            error_log($e->getMessage());
            return false;
        }
    }
    public function getComment($id) {
        $sql = "SELECT * FROM comments WHERE id = :id";
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
    
    public function updateComment($comment) {
        $sql = "UPDATE comments SET content = :content WHERE id = :id";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->bindValue(':content', $comment->getContent(), PDO::PARAM_STR);
            $query->bindValue(':id', $comment->getId(), PDO::PARAM_INT);
            $query->execute();
        } catch (Exception $e) {
            error_log($e->getMessage());
            return false;
        }
    }

    public function getCommentsByPostId($postId) {
        $sql = "SELECT * FROM comments WHERE post_id = :post_id";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->bindValue(':post_id', $postId, PDO::PARAM_INT);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            error_log($e->getMessage());
            return false;
        }
    }
    
    
    
    
    
    
    
}
?>
