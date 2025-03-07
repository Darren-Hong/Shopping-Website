<?php
session_start();


$product_id = $_POST['product_id'];
$table = $_POST['table'];
$size = $_POST['size'];


if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}


$item = [
    'id' => $product_id,
    'table' => $table,
    'size' => $size,
    'quantity' => 1
];
$_SESSION['cart'][] = $item;


header('Location: Homepage.html');
exit;
?>