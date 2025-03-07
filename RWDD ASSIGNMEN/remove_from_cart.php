<?php
session_start();

$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['id'])) {
    // Remove item from cart
    unset($_SESSION['cart'][$data['id']]);
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false]);
}
?>