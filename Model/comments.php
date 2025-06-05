<?php


class Comment {
    private ?int $id;
    private ?int $post_id;
    private ?string $content;
    private ?string $created_at;

    public function __construct(?int $id = null, ?int $post_id = null, ?string $content = null, ?string $created_at = null) {
        $this->id = $id;
        $this->post_id = $post_id;
        $this->content = $content;
        $this->created_at = $created_at;
    }

    // Getters and Setters
    public function getId(): ?int {
        return $this->id;
    }

    public function getPostId(): ?int {
        return $this->post_id;
    }

    public function getContent(): ?string {
        return $this->content;
    }

    public function getCreatedAt(): ?string {
        return $this->created_at;
    }

    public function setPostId(?int $post_id): void {
        $this->post_id = $post_id;
    }

    public function setContent(?string $content): void {
        $this->content = $content;
    }

    public function setCreatedAt(?string $created_at): void {
        $this->created_at = $created_at;
    }

    // Helper functions
    public function toArray(): array {
        return [
            'id' => $this->id,
            'post_id' => $this->post_id,
            'content' => $this->content,
            'created_at' => $this->created_at,
        ];
    }

    public static function fromArray(array $data): self {
        return new self(
            $data['id'] ?? null,
            $data['post_id'] ?? null,
            $data['content'] ?? null,
            $data['created_at'] ?? null
        );
    }
}

?>
