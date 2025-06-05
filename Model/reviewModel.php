<?php
class Review {
    private ?int $review_id;
    private ?int $product_id;
    private ?int $rating;
    private ?string $review_text;
    private ?string $created_at;

    // Constructor
    public function __construct(?int $review_id, ?int $product_id, ?int $rating, ?string $review_text, ?string $created_at) {
        $this->review_id = $review_id;
        $this->product_id = $product_id;
        $this->rating = $rating;
        $this->review_text = $review_text;
        $this->created_at = $created_at;
    }

    // Getters and Setters
    public function getReview_id(): ?int {
        return $this->review_id;
    }

    public function setReview_id(?int $review_id): void {
        $this->review_id = $review_id;
    }

    public function getProduct_id(): ?int {
        return $this->product_id;
    }

    public function setProduct_id(?int $product_id): void {
        $this->product_id = $product_id;
    }

    public function getRating(): ?int {
        return $this->rating;
    }

    public function setRating(?int $rating): void {
        $this->rating = $rating;
    }

    public function getReview_text(): ?string {
        return $this->review_text;
    }

    public function setReview_text(?string $review_text): void {
        $this->review_text = $review_text;
    }

    public function getCreated_at(): ?string {
        return $this->created_at;
    }

    public function setCreated_at(?string $created_at): void {
        $this->created_at = $created_at;
    }
}
?>