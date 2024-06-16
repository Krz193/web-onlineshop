<?php 
require_once 'Database.php';

class Product extends Database
{
    public function __construct()
    {
        parent::__construct();
    }

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

    public function getProductReviews($id) 
    {
        $sql  = "SELECT * FROM tb_product_review tr 
                INNER JOIN tb_user ts ON ts.user_id = tr.user_id
                WHERE tr.product_id = '$id'";
        return mysqli_fetch_all($this->runQuery($sql), MYSQLI_ASSOC);
    }

    public function deleteProduct($id) 
    {
        return $this->runQuery("DELETE FROM tb_product WHERE user_id = $id");
    }
}

$Product = new Product();