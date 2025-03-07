<?php
session_start(); 

if (!isset($_SESSION['cart']) || !is_array($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "clothes";


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
    <link rel="stylesheet" href="css/cart.css"> 
</head>
<body>
<header>
    <link rel="stylesheet" href="css/header.css">
        <!-- Navigation Bar -->
        <div class="navbar">
            <!-- Logo -->
            <div class="logo">
                <a href="Homepage.html"><img src="img/logo.png" alt=""></a>
            </div>

            <!-- Navigation Links -->
            <ul class="Menu">
                <li class="dropdown">
                    <a href="#" class="button">Men</a>
                    <div class="dropdown-content">
                        <a href="ms.php">T-Shirts</a>
                        <a href="mp.php">Pants</a>
                    </div>
                </li>
                <li class="dropdown">
                    <a href="#" class="button">Women</a>
                    <div class="dropdown-content">
                        <a href="fs.php">T-Shirts</a>
                        <a href="fp.php">Pants</a>
                    </div>                
                </li>
            </ul>

            
            <ul class="nav-icons">
                <li><a href="Aboutus.html" class="about-link">About Us</a></li>
                <li><a href="wishlist.php"><img src="wishlist.svg" alt="Wish List" class="icon"></a></li>
                <li><a href="cart.php"><img src="cart-regular-24.png" alt="Cart" class="icon"></a></li>
                <li><a href="delivery_info.php"><img src="img/66841.png" alt="Cart" class="icon"></a></li>
            </ul>
        </div>
    </header>
    <link rel="stylesheet" href="css/content.css">
    <h1>Your Cart</h1>
    <?php 
    $total = 0; 
    foreach ($_SESSION['cart'] as $item) {
        $productId = $item['id'];

        
        if (!isset($item['table'])) {
            continue; 
        }
        
        $tableName = $item['table']; 
        $quantity = $item['quantity'];

        // Adjust the query to select from the correct table
        $result = $conn->query("SELECT * FROM `$tableName` WHERE id = '$productId'");
        if ($product = $result->fetch_assoc()) {
            $price = (float) $product['price'];
            $total += $price * $quantity;
        }
    }
    
    
    if (empty($_SESSION['cart']) || $total == 0): ?>
        <div class="empty-cart-message">
            <p>Sorry, you have no items in your cart.</p>
            <a href="Homepage.html" class="btn">Continue Shopping</a>
        </div>
    <?php else: ?>
        <form action="update_cart.php" method="POST">
            <table>
                <tr>
                    <th>Item</th>
                    <th>Size</th>
                    <th>Quantity</th>
                    <th> Price</th>
                    <th>Action</th>
                </tr>
                <?php foreach ($_SESSION['cart'] as $key => $item): 
                    $productId = $item['id'];

                    
                    if (!isset($item['table'])) {
                        continue; 
                    }
                    
                    $tableName = $item['table']; // Get the table name
                    $size = isset($item['size']) ? $item['size'] : 'N/A';
                    $quantity = $item['quantity'];

                    
                    $result = $conn->query("SELECT * FROM `$tableName` WHERE id = '$productId'");
                    if ($product = $result->fetch_assoc()) {
                        $price = (float) $product['price'];
                    } else {
                        continue; 
                    }
                ?>
                <tr>
                    <td>
                        <img src="display_image.php?id=<?php echo $product['id']; ?>&type=<?php echo htmlspecialchars($item['table']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>" style="width:100px;height:100px;">
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
                    <td id="price-<?php echo $key; ?>" data-price="<?php echo $price; ?>">RM<?php echo number_format($price * $quantity, 2); ?></td>
                    <td>
                        <button type="submit" name="remove" value="<?php echo $key; ?>">Remove</button>
                    </td>
                </tr>
                <?php endforeach; ?>
            </table>
            <div class="total-amount">
                <p>Total: <span id="overall-total">RM<?php echo number_format($total, 2); ?></span></p>
            </div>
            <a href="Homepage.html" class="btn">Continue Shopping</a>
            <a href="payment.php" class="btn">Proceed to Checkout</a>
        </form>
    <?php endif; ?>
</body>
<script src="js/cart.js"></script>
</html>

<?php $conn->close(); ?>