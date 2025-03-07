<?php
session_start();

$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['id']) && isset($data['quantity'])) {
    // Assuming you store cart data in session, find the product by ID and update quantity
    foreach ($_SESSION['cart'] as &$item) {
        if ($item['id'] == $data['id']) {
            $item['quantity'] = $data['quantity'];
            echo json_encode(['success' => true]);
            exit;
        }
    }
}

echo json_encode(['success' => false]);
?>