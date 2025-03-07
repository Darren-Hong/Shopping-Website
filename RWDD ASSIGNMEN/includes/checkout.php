<?php
session_start();

// Check if the cart items are set
if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    echo "<script>alert('No items in cart. Please add items to your cart.'); window.location.href='index.php';</script>";
    exit;
}

// Proceed with displaying the payment form
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>
    <!-- <link rel="stylesheet" href="css/payment.css"> -->
</head>
<body>
    <div class="container">
        <h1>Checkout</h1>
        <div class="cart-items">
            <h2>Your Cart:</h2>
            <ul>
                <?php foreach ($_SESSION['cart'] as $item): ?>
                    <li>
                        Product ID: <?php echo htmlspecialchars($item['id']); ?>, 
                        Table: <?php echo htmlspecialchars($item['table']); ?>, 
                        Size: <?php echo htmlspecialchars($item['size']); ?>, 
                        Quantity: <?php echo htmlspecialchars($item['quantity']); ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
        <form action="payment.php" method="POST">
            <!-- Payment fields here -->
            <button type="submit">Proceed to Payment</button>
        </form>
    </div>
</body>
</html>