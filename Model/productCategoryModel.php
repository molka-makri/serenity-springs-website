<?php

class ProductCategory {

  private ?int $category_id;
  private ?string $category;
  private ?string $category_img;



public function __construct(?int $category_id , ?string $category , ?string $category_img){
  $this->category_id = $category_id;
  $this->category = $category;
  $this->category_img = $category_img;
}


  // getters and setters ;


  public function getCategoryId (): ?int {
    return $this->category_id;
  }


  public function setCategoryId (?int $id) : void {
    $this->category_id = $id;

  }


  public function getCategory(): ?string {
    return $this->category;
  }

  public function setCategory(?string $category): void {
    $this->category = $category;
  }


  public function getCategoryImg(): ?string {
    return $this->category_img;
  }

  public function setCategoryImg(?string $category_img): void {
    $this->category_img = $category_img;
  }


}


?>