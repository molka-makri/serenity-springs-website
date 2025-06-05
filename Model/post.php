<?php
class Post {
    private ?int $id;
    private ?string $title;
    private ?string $content;
    private ?string $image_path;
    private ?string $created_at;
    private ?int $likes; 

    public function __construct(?int $id = null, ?string $title = null, ?string $content = null, ?string $image_path = null, ?string $created_at = null, ?int $likes = 0) {
        $this->id = $id;
        $this->title = $title;
        $this->content = $content;
        $this->image_path = $image_path;
        $this->created_at = $created_at;
        $this->likes = $likes; 
    }

    // Getters and Setters
    public function getId(): ?int {
        return $this->id;
    }

    public function getTitle(): ?string {
        return $this->title;
    }

    public function getContent(): ?string {
        return $this->content;
    }

    public function getImagePath(): ?string {
        return $this->image_path;
    }

    public function getCreatedAt(): ?string {
        return $this->created_at;
    }

    public function getLikes(): ?int { 
        return $this->likes;
    }

    public function setTitle(?string $title): void {
        $this->title = $title;
    }

    public function setContent(?string $content): void {
        $this->content = $content;
    }

    public function setImagePath(?string $image_path): void {
        $this->image_path = $image_path;
    }

    public function setCreatedAt(?string $created_at): void {
        $this->created_at = $created_at;
    }

    public function setLikes(?int $likes): void { 
        $this->likes = $likes;
    }

    // Helper functions
    public function toArray(): array {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'content' => $this->content,
            'image_path' => $this->image_path,
            'created_at' => $this->created_at,
            'likes' => $this->likes, 
        ];
    }

    public static function fromArray(array $data): self {
        return new self(
            $data['id'] ?? null,
            $data['title'] ?? null,
            $data['content'] ?? null,
            $data['image_path'] ?? null,
            $data['created_at'] ?? null,
            $data['likes'] ?? 0 
        );
    }
}

?>
