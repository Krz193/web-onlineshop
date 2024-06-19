<?php 
require_once "Database.php";

Class Purchase extends Database
{
    public function __construct()
    {
        parent::__construct();
    }

    // Insert table purchase
    public function addPurchase($total_price)
    {
        $user_id        = $_SESSION['user_id'];
        $purchase_date  = $this->date->format('Y-m-d H:i:s');
        $total_price    = $total_price;
        $sql = "INSERT INTO tb_purchase(user_id, purchase_date, total_price) VALUES (
                    $user_id,
                    '$purchase_date',
                    $total_price
                )";
        $this->runQuery($sql);
    }

    public function getPurchaseId()
    {
        $sql = "SELECT purchase_id FROM tb_purchase ORDER BY purchase_date DESC LIMIT 1";
        return mysqli_fetch_assoc($this->runQuery($sql))["purchase_id"];
    }

    // Insert table purchase_detail
    public function addPurchaseDetail($purchase_id, $product_id, $quantity, $price)
    {
        $sql = "INSERT INTO tb_purchase_detail(purchase_id, product_id, quantity, price) VALUES (
                    $purchase_id,
                    $product_id,
                    $quantity,
                    $price
                )";
        return $this->runQuery($sql);
    }

    // insert table payment
    public function addPayment($purchase_id, $payment_amount, $payment_method, $payment_status)
    {
        $payment_date = $this->date->format('Y-m-d H:i:s');
        $sql = "INSERT INTO tb_payment(purchase_id, payment_date, payment_amount, payment_method, payment_status)
                VALUES ($purchase_id, '$payment_date', $payment_amount, '$payment_method', '$payment_status')";
        return $this->runQuery($sql);
    }

    public function getAllPurchase()
    {
        return mysqli_fetch_all($this->runQuery("SELECT * FROM tb_purchase ORDER BY purchase_id DESC"), MYSQLI_ASSOC);
    }
}

$Purchase = new Purchase();