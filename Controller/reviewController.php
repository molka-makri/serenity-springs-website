<?php
// Include configuration and model files
include_once(__DIR__ . '/../config.php');
include(__DIR__ . '/../Model/reviewModel.php');

class ReviewController {

    // Fetch all reviews for a specific product
    public function getReviews($productId) {
        $sql = "SELECT * FROM reviews WHERE product_id = :product_id ORDER BY created_at DESC";
        $db = config::getConnexion();

        try {
            $query = $db->prepare($sql);
            $query->bindParam(':product_id', $productId, PDO::PARAM_INT);
            $query->execute();
            $reviews = $query->fetchAll(PDO::FETCH_ASSOC);
            return $reviews;
        } catch (Exception $err) {
            echo $err->getMessage();
        }
    }

    // Add a new review for a product
    public function addReview($productId, $rating, $reviewText) {
        $sql = "INSERT INTO reviews (product_id, rating, review_text) VALUES (:product_id, :rating, :review_text)";
        $db = config::getConnexion();

        try {
            $query = $db->prepare($sql);
            $query->execute([
                'product_id' => $productId,
                'rating' => $rating,
                'review_text' => $reviewText
            ]);
        } catch (Exception $err) {
            echo $err->getMessage();
        }
    }

    // Delete a specific review by its ID
    public function deleteReview($reviewId) {
        $sql = "DELETE FROM reviews WHERE review_id = :review_id";
        $db = config::getConnexion();

        try {
            $query = $db->prepare($sql);
            $query->bindParam(':review_id', $reviewId, PDO::PARAM_INT);
            $query->execute();
        } catch (Exception $err) {
            echo $err->getMessage();
        }
    }

    // Update a specific review by its ID
    public function updateReview($reviewId, $rating, $reviewText) {
        $sql = "UPDATE reviews SET rating = :rating, review_text = :review_text WHERE review_id = :review_id";
        $db = config::getConnexion();

        try {
            $query = $db->prepare($sql);
            $query->execute([
                'review_id' => $reviewId,
                'rating' => $rating,
                'review_text' => $reviewText
            ]);
        } catch (Exception $err) {
            echo $err->getMessage();
        }
    }
}
?>