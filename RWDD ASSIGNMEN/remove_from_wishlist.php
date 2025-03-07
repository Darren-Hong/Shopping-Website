<?php
session_start(); 


if (isset($_POST['product_id']) && isset($_POST['table'])) {
    $productId = $_POST['product_id'];
    $table = $_POST['table'];

    
    if (isset($_SESSION['wishlist'])) {
        foreach ($_SESSION['wishlist'] as $key => $item) {
            if ($item['id'] == $productId && $item['table'] == $table) {
                unset($_SESSION['wishlist'][$key]);
                break;
            }
        }
    }

   
    header("Location: wishlist.php?message=Item removed from wishlist");
    exit;
} else {
    // Redirect back with an error message
    header("Location: wishlist.php?error=Failed to remove item from wishlist");
    exit;
}
?>