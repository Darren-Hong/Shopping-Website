<?php
session_start();

$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['id'])) {
    // Remove item by ID
    foreach ($_SESSION['cart'] as $key => $item) {
        if ($item['id'] == $data['id']) {
            unset($_SESSION['cart'][$key]);
            echo json_encode(['success' => true]);
            exit;
        }
    }
}

echo json_encode(['success' => false]);
?>