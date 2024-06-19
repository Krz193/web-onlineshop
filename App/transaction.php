<?php 

require_once "Purchase.php";

$data = file_get_contents( "php://input" );
$data = json_decode($data, true);
$data["products"] = json_decode($data["products"], true);
var_dump($data);

$products = $data["products"];

// hitung total price
$total_price = 0;
foreach($products as $product) {
    $total_price += $product["qty"]*$product["price"];
}

session_start();
$_SESSION["user_id"] = 1;

$data["payment_status"] = ($data["payment_amount"] <= 0) ? 'unpaid' : (($data["payment_amount"] < $total_price) ? 'partly paid' : 'paid');

// insert ke tb_purchase
$Purchase->addPurchase($total_price);
$purchase_id = $Purchase->getPurchaseId();


// insert ke tb_payment
$Purchase->addPayment($purchase_id, $data['payment_amount'], $data['payment_method'], $data['payment_status']);

// insert ke tb_purchase_detail
foreach ($products as $product) {
    $Purchase->addPurchaseDetail($purchase_id, $product["id"], $product["qty"], $product["price"]);
}