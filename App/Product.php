<?php 
require_once 'Database.php';

class Product extends Database
{
    public function __construct()
    {
        parent::__construct();
    }

    // CRUD table product
    public function getAllProducts()
    {
        $sql  = "SELECT * FROM tb_product tp 
                INNER JOIN tb_category tc ON tc.category_id = tp.category_id";
        return mysqli_fetch_all($this->runQuery($sql), MYSQLI_ASSOC);
    }
    
    public function getProduct($id) 
    {
        $sql  = "SELECT * FROM tb_product tp 
                INNER JOIN tb_category tc ON tc.category_id = tp.category_id
                WHERE product_id = '$id' LIMIT 1";
        return mysqli_fetch_assoc($this->runQuery($sql));
    }

    public function deleteProduct($id) 
    {
        return $this->runQuery("DELETE FROM tb_product WHERE user_id = $id");
    }

    // CRUD table review
    public function getProductReviews($id) 
    {
        $sql  = "SELECT * FROM tb_product_review tr 
                INNER JOIN tb_user ts ON ts.user_id = tr.user_id
                WHERE tr.product_id = '$id'";
        return mysqli_fetch_all($this->runQuery($sql), MYSQLI_ASSOC);
    }

    // CRUD table category
    public function getAllCategories()
    {
        $sql = "SELECT tc.*, tp.product_name, COUNT(product_name) AS product_count FROM tb_category tc 
                LEFT JOIN tb_product tp ON tp.category_id=tc.category_id GROUP BY tc.category_id";
                
        return mysqli_fetch_all($this->runQuery($sql), MYSQLI_ASSOC);
    }

    public function getCategory($id) 
    {
        return mysqli_fetch_assoc($this->runQuery("SELECT * FROM tb_category WHERE category_id='$id'"));
    }

    public function addCategory(array $data)
    {
        $cat_name   = $data['category_name'];
        return $this->runQuery("INSERT INTO tb_category(category_name) VALUES ('$cat_name')");
    }

    public function updateCategory(array $data)
    {
        $id         = $data['category_id'];
        $cat_name   = $data['category_name'];

        return $this->runQuery("UPDATE tb_category SET category_name='$cat_name' WHERE category_id='$id'");
    }

    public function deleteCategory($id) 
    {
        return $this->runQuery("DELETE FROM tb_category WHERE category_id=$id");
    }
}

$Product = new Product();