<?php
session_start(); 

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "clothes";


$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}


if (isset($_POST['product_id']) && isset($_POST['table'])) {
    $productId = $_POST['product_id'];
    $table = $_POST['table'];

    
    $query = "SELECT name FROM $table WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $productId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $product = $result->fetch_assoc();
        $productName = $product['name'];

        
        $wishlistItem = [
            'id' => $productId,
            'table' => $table,
            'name' => $productName, 
        ];

        
        if (!isset($_SESSION['wishlist'])) {
            $_SESSION['wishlist'] = [];
        }

        
        $_SESSION['wishlist'][] = $wishlistItem;

        
        header("Location: Homepage.html?message=Item added to wishlist");
        exit;
    } else {
        
        header("Location: Homepage.html?error=Product not found");
        exit;
    }
} else {
    
    header("Location: Homepage.html?error=Failed to add item to wishlist");
    exit;
}

$conn->close(); 
?>