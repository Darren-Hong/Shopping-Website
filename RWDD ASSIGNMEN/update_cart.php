<?php
session_start();

if (isset($_POST['update'])) {
    foreach ($_POST['quantities'] as $key => $quantity) {
        $_SESSION['cart'][$key]['quantity'] = intval($quantity);
        $_SESSION['cart'][$key]['size'] = $_POST['sizes'][$key];
    }
} elseif (isset($_POST['remove'])) {
    unset($_SESSION['cart'][$_POST['remove']]);
    $_SESSION['cart'] = array_values($_SESSION['cart']); // Re-index array
}

header('Location: cart.php');
?>