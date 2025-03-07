<?php
session_start(); // Start the session at the very beginning

// Ensure cart session variable is set
if (!isset($_SESSION['cart']) || !is_array($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "clothes";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Cart</title>
    <link rel="stylesheet" href="cart.css"> 
    <style>
        .total-amount {
            border: 2px solid #007BFF; /* Blue border */
            padding: 10px;
            margin: 20px 0; /* Margin for spacing */
            background-color: #f9f9f9; /* Light background */
            text-align: center; /* Center text */
            font-size: 1.5em; /* Larger font size */
        }
        .product-image {
            width: 100px; /* Set a fixed width for the images */
            height: 100px; /* Set a fixed height for the images */
            margin-right: 10px; /* Space between image and text */
        }
    </style>
    <script>
        function updatePrice(key) {
            const quantitySelect = document.querySelector(`select[name="quantities[${key}]"]`);
            const quantity = parseInt(quantitySelect.value);
            const priceCell = document.querySelector(`#price-${key}`);
            const price = parseFloat(priceCell.getAttribute('data-price'));
            const newTotal = (price * quantity).toFixed(2);
            priceCell.textContent = `$${newTotal}`;
            updateOverallTotal();
        }

        function updateOverallTotal() {
            let overallTotal = 0;
            const priceCells = document.querySelectorAll('[id^="price-"]');
            priceCells.forEach(cell => {
                overallTotal += parseFloat(cell.textContent.replace('$', ''));
            });
            document.querySelector('#overall-total').textContent = `$${overallTotal.toFixed(2)}`;
        }
    </script>
</head>
<body>
    <h1>Your Cart</h1>
    <?php if (count($_SESSION['cart']) === 0): ?>
        <p>You have no items in the cart.</p>
        <a href="index.php">Continue Shopping</a>
    <?php else: ?>
        <form action="update_cart.php" method="POST">
            <table>
                <tr>
                    <th>Item</th>
                    <th>Size</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Action</th>
                </tr>
                <?php
                $total = 0;
                foreach ($_SESSION['cart'] as $key => $item):
                    $productId = $item['id'];
                    $size = isset($item['size']) ? $item['size'] : 'N/A';
                    $quantity = $item['quantity'];

                    $result = $conn->query("SELECT * FROM products WHERE id = $productId");
                    if ($product = $result->fetch_assoc()) {
                        $price = (float) $product['price'];
                        $total += $price * $quantity;
                    } else {
                        continue;
                    }
                ?>
                <tr>
                    <td>
                        <img src="display_image.php?id=<?php echo $product['id']; ?>" alt="<?php echo htmlspecialchars($product['name']); ?>" style="width:100px;height:100px;">
                        <?php echo htmlspecialchars($product['name']); ?>
                    </td>
                    <td>
                        <select name="sizes[<?php echo $key; ?>]">
                            <option value="S" <?php echo ($size == 'S') ? 'selected' : ''; ?>>S</option>
                            <option value="M" <?php echo ($size == 'M') ? 'selected' : ''; ?>>M</option>
                            <option value="L" <?php echo ($size == 'L') ? 'selected' : ''; ?>>L</option>
                            <option value="XL" <?php echo ($size == 'XL') ? 'selected' : ''; ?>>XL</option>
                        </select>
                    </td>
                    <td>
                        <select name="quantities[<?php echo $key; ?>]" onchange="updatePrice(<?php echo $key; ?>)">
                            <?php for ($i = 1; $i <= 10; $i++): ?>
                                <option value="<?php echo $i; ?>" <?php echo ($quantity == $i) ? 'selected' : ''; ?>><?php echo $i; ?></option>
                            <?php endfor; ?>
                        </select>
                    </td>
                    <td id="price-<?php echo $key; ?>" data-price="<?php echo $price; ?>">$<?php echo number_format($price * $quantity, 2); ?></td>
                    <td>
                        <button type="submit" name="remove" value="<?php echo $key; ?>">Remove</button>
                    </td>
                </tr>
                <?php endforeach; ?>
            </table>
            <div class="total-amount">
                <p>Total: <span id="overall-total">$<?php echo number_format($total, 2); ?></span></p>
            </div>
            <a href="index.php" class="btn">Continue Shopping</a>
            <a href="payment.php" class="btn">Proceed to Checkout</a>
        </form>
    <?php endif; ?>
</body>
</html>

<?php $conn->close(); ?>