<?php
include_once(__DIR__ . '/../config.php');
include(__DIR__ . '/../Model/productModel.php');

class productController {
    public function getProducts() {
                $sql = " SELECT 
                products.Product_id,
                products.Product_img, 
                products.Product_name, 
                products.Product_description, 
                products.Product_price, 
                products_categories.category AS Product_categorie 
            FROM 
                products 
            INNER JOIN 
                products_categories 
            ON 
                products.Product_categorie = products_categories.category_id
            ";
        $db = config::getConnexion();

        try {
            $list = $db->query($sql);
            return $list;
        } catch(Exception $err) {
            echo $err->getMessage();
        }
    }


    
        public function getAllProducts() {
                    $sql = " SELECT * FROM products";
            $db = config::getConnexion();
    
            try {
                $list = $db->query($sql);
                return $list;
            } catch(Exception $err) {
                echo $err->getMessage();
            }
        }

    public function addProduct($Product) {
        $sql = "INSERT INTO products VALUES (NULL, :Product_name, :Product_description, :Product_price, :Product_categorie, :Product_img)";
        $db = config::getConnexion();

        try {
            $query = $db->prepare($sql);
            $query->execute([
                'Product_name' => $Product->getProduct_name(),
                'Product_description' => $Product->getProduct_description(),
                'Product_price' =>$Product->getProduct_price(),
                'Product_categorie' => $Product->getProduct_categorie(),
                'Product_img' => $Product->getProduct_img(),
                
            ]);
        } catch(Exception $err) {
            echo $err->getMessage();
        }
    }

    public function deleteProduct($Product_id) {
        $sql = "DELETE FROM products WHERE Product_id = :Product_id";
        $db = config::getConnexion();

        $query = $db->prepare($sql);
        $query->bindValue(':Product_id', $Product_id);

        try {
            $query->execute();
        } catch(Exception $e) {
            echo $e->getMessage();
        }
    }

    public function getProduct($Product_id) {
        $sql = "SELECT * FROM products WHERE Product_id = $Product_id";
        $db = config::getConnexion();
        $query = $db->prepare($sql);

        try {
            $query->execute();
            $Product = $query->fetch();
            return $Product;
        } catch(Exception $e) {
            echo $e->getMessage();
        }
    }

    public function updateProduct($product) {
      // Get current product data from the database
      $sql = "SELECT * FROM products WHERE Product_id = :Product_id";
      $db = config::getConnexion();
      
      // Fetch the current product data
      $query = $db->prepare($sql);
      $query->execute(['Product_id' => $product->getProduct_id()]);
      $currentProduct = $query->fetch();

      // Prepare the update SQL query
      $sql = "UPDATE products SET 
              Product_name = COALESCE(:Product_name, :current_Product_name),
              Product_description = COALESCE(:Product_description, :current_Product_description),
              Product_price = COALESCE(:Product_price, :current_Product_price),
              Product_categorie = COALESCE(:Product_categorie, :current_Product_categorie),
              Product_img = COALESCE(:Product_img, :current_Product_img)
              WHERE Product_id = :Product_id";

      try {
          $query = $db->prepare($sql);
          $query->execute([
              'Product_name' => $product->getProduct_name() ?: $currentProduct['Product_name'],
              'Product_description' => $product->getProduct_description() ?: $currentProduct['Product_description'],
              'Product_price' => $product->getProduct_price() ?: $currentProduct['Product_price'],
              'Product_categorie' => $product->getProduct_categorie() ?: $currentProduct['Product_categorie'],
              'Product_img' => $product->getProduct_img() ?: $currentProduct['Product_img'],
              'Product_id' => $product->getProduct_id(),
              
              // Use current product values as fallback if not updated
              'current_Product_name' => $currentProduct['Product_name'],
              'current_Product_description' => $currentProduct['Product_description'],
              'current_Product_price' => $currentProduct['Product_price'],
              'current_Product_categorie' => $currentProduct['Product_categorie'],
              'current_Product_img' => $currentProduct['Product_img']
          ]);
      } catch (Exception $err) {
          echo $err->getMessage();
      }
  }
}
?>