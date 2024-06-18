<?php 
require_once "Database.php";

Class Purchase extends Database
{
    public function __construct()
    {
        parent::__construct();
    }

    // Insert table purchase
    public function addPurchase(array $data)
    {
        $user_id        = $_SESSION['user_id'];
        $purchase_date  = $data['purchase_date'];
        $total_price    = $data['total_price'];
        $sql = "INSERT INTO tb_purchase(user_id, purchase_date, total_price) VALUES (
                    $user_id,
                    '$purchase_date',
                    $total_price
                )";
        $this->runQuery($sql);
    }

    // Insert table purchase_detail
    public function addPurchaseDetail(array $data)
    {
        $purchase_id    = $data['purchase_id'];
        $product_id     = $data['product_id'];
        $quantity       = $data['quantity'];
        $price          = $data['price'];
        $sql = "INSERT INTO tb_purchase_detail(purchase_id, product_id, quantity, price) VALUES (
                    $purchase_id,
                    $product_id,
                    $quantity,
                    $price
                )";
        $this->runQuery($sql);
    }
}