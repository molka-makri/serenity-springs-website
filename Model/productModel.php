<?php

class Product {
    private ?int $Product_id;
    private ?string $Product_name;
    private ?string $Product_description;
    private ?int $Product_price;
    private ?int $Product_categorie;
    private ?string $Product_img;
   

    // Constructor
    public function __construct(?int $Product_id, ?string $Product_name, ?string $Product_description, ?int $Product_price, ?int $Product_categorie, ?string $Product_img) {
        $this->Product_id = $Product_id;
        $this->Product_name = $Product_name;
        $this->Product_description = $Product_description;
        $this->Product_price = $Product_price;
        $this->Product_categorie = $Product_categorie;
        $this->Product_img = $Product_img;
       
    }

    // Getters and Setters

    public function getProduct_id(): ?int {
        return $this->Product_id;
    }

    public function setProduct_id(?int $Product_id): void {
        $this->Product_id = $Product_id;
    }

    public function getProduct_name(): ?string {
        return $this->Product_name;
    }

    public function setProduct_name(?string $Product_name): void {
        $this->Product_name = $Product_name;
    }

    public function getProduct_description(): ?string {
        return $this->Product_description;
    }

    public function setProduct_description(?string $Product_description): void {
        $this->Product_description = $Product_description;
    }

    public function getProduct_price(): ?int {
        return $this->Product_price;
    }

    public function setProduct_price(?int $Product_price): void {
        $this->Product_price = $Product_price;
    }

    public function getProduct_categorie(): ?int {
        return $this->Product_categorie;
    }

    public function setProduct_categorie(?int $Product_categorie): void {
        $this->Product_categorie = $Product_categorie;
    }

    public function getProduct_img(): ?string {
        return $this->Product_img;
    }

    public function setProduct_img(string $Product_img): void {
        $this->Product_img = $Product_img;
    }

   
}

?>