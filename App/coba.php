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

// insert ke tb_purchase
$Purchase->addPurchase($total_price);

// insert ke tb_purchase_detail
$purchase_id = $Purchase->getPurchaseId();

foreach ($products as $product) {
    $Purchase->addPurchaseDetail($purchase_id, $product["id"], $product["qty"], $product["price"]);
}