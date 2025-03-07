<?php
session_start(); 


if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    // Redirect to the cart or homepage if no items are in the cart
    header("Location: Homepage.html");
    exit();
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $_SESSION['purchased_items'] = $_POST['cart_items'];

    
    $_SESSION['payment_details'] = [
        'card_number' => $_POST['card_number'],
        'expiry_date' => $_POST['expiry_date'],
        'cvv' => $_POST['cvv'],
        'email' => $_POST['email'],
        'address' => $_POST['address'],
    ];

    
    header("Location: delivery_info.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>
    <link rel="stylesheet" href="css/payment.css">
</head>
<body>
    <div class="container">
        <div class="center">
            <img src="img/VISAMASTER.png" alt="Credit Card Logo" width="150" height="auto">
            <hr style="border:1px solid #ccc; margin: 0 15px;">

            <div class="card-details">
                <form action="" method="POST"> 
                    <p>Card number</p>
                    <div class="c-number" id="c-number">
                        <input id="number" class="cc-number" name="card_number" placeholder="Card number" maxlength="19" required>
                        <i class="fa-solid fa-credit-card" style="margin: 0;"></i>
                    </div>

                    <div class="c-details">
                        <div>
                            <p>Expiry date</p>
                            <input id="e-date" class="cc-exp" name="expiry_date" placeholder="MM/YY" required maxlength="5">
                        </div>
                        <div>
                            <p>CVV</p>
                            <div class="cvv-box" id="cvv-box">
                                <input id="cvv" class="cc-cvv" name="cvv" placeholder="CVV" required maxlength="3">
                                <i class="fa-solid fa-circle-question" title="3 digits on the back of the card" style="cursor: pointer;"></i>
                            </div>
                        </div>
                    </div>
                    <div class="email">
                        <p>Email</p>
                        <input type="email" name="email" placeholder="example@email.com" id="email" required>
                    </div>

                    <div class="address" id="address-container">
                        <p>Delivery Address</p>
                        <input type="text" name="address" placeholder="No, Street, State" title="Please enter a valid address (at least 5 characters)" required>
                    </div>
                    
                    <!-- Hidden fields to store cart items -->
                    <?php foreach ($_SESSION['cart'] as $key => $item): ?>
                        <input type="hidden" name="cart_items[<?php echo $key; ?>][id]" value="<?php echo htmlspecialchars($item['id']); ?>">
                        <input type="hidden" name="cart_items[<?php echo $key; ?>][table]" value="<?php echo htmlspecialchars($item['table']); ?>">
						
                        <input type="hidden" name="cart_items[<?php echo $key; ?>][size]" value="<?php echo htmlspecialchars($item['size']); ?>">
                        <input type="hidden" name="cart_items[<?php echo $key; ?>][quantity]" value="<?php echo htmlspecialchars($item['quantity']); ?>">
                    <?php endforeach; ?>

                    <div class="button-container" style="display: flex; justify-content: space-between ; margin-top: 20px;">
                        <button type="submit">PAY NOW</button>
                        <button type="button" onclick="window.location.href='Homepage.html'">CANCEL</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="js/payment.js"></script>
</body>
</html>