<?php
session_start(); // Start the session to manage cart and wishlist

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "clothes";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

// Fetch products from all tables
$resultFemaleShirts = $conn->query("SELECT * FROM female_shirt");
$resultFemalePants = $conn->query("SELECT * FROM female_pants");
$resultMaleShirts = $conn->query("SELECT * FROM male_shirt");
$resultMalePants = $conn->query("SELECT * FROM male_pants");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Area</title>
    <style>
        /* Add some basic styling */
        #items {
            display: flex;
            flex-wrap: wrap;
            gap: 20px; /* Space between items */
        }
        .item {
            border: 1px solid #ccc; /* Border for items */
            padding: 10px; /* Padding inside items */
            text-align: center; /* Center text */
            width: 150px; /* Fixed width for items */
            border-radius: 5px; /* Rounded corners */
            background-color: #fff; /* White background */
        }
        .item img {
            max-width: 100%; /* Responsive image */
            height: auto; /* Maintain aspect ratio */
        }
    </style>
</head>
<body>
    <h1>Shop Items</h1>
    <div id="items">
        <!-- Display female shirts -->
        <h2>Women's Shirts</h2>
        <?php while ($row = $resultFemaleShirts->fetch_assoc()): ?>
            <div class="item">
                <img src="display_image.php?id=<?php echo $row['id']; ?>&type=female_shirt" alt="<?php echo htmlspecialchars($row['name']); ?>">
                <h2><?php echo htmlspecialchars($row['name']); ?></h2>
                <p>$<?php echo number_format((float)$row['price'], 2); ?></p>
                <p><?php echo htmlspecialchars($row['description']); ?></p>
                
                <!-- Add to Cart Form -->
                <form action="add_to_cart.php" method="POST">
                    <input type="hidden" name="product_id" value="<?php echo $row['id']; ?>">
                    <input type="hidden" name="table" value="female_shirt">
                    <label for="size">Size:</label>
                    <select name="size" required>
                        <option value="S">S</option>
                        <option value="M">M</option>
                        <option value="L">L</option>
                        <option value="XL">XL</option>
                    </select>
                    <button type="submit">Add to Cart</button>
                </form>

                <!-- Add to Wishlist Form -->
                <form action="add_to_wishlist.php" method="POST">
                    <input type="hidden" name="product_id" value="<?php echo $row['id']; ?>">
                    <input type="hidden" name="table" value="female_shirt">
                    <button type="submit">Add to Wishlist</button>
                </form>
            </div>
        <?php endwhile; ?>

        <!-- Display female pants -->
        <h2>Women's Pants</h2>
        <?php while ($row = $resultFemalePants->fetch_assoc()): ?>
            <div class="item">
                <img src="display_image.php?id=<?php echo $row['id']; ?>&type=female_pants" alt="<?php echo htmlspecialchars($row['name']); ?>">
                <h2><?php echo htmlspecialchars($row['name']); ?></h2>
                <p>$<?php echo number_format((float)$row['price'], 2); ?></p>
                <p><?php echo htmlspecialchars($row['description']); ?></p>
                
                <!-- Add to Cart Form -->
                <form action="add_to_cart.php" method="POST">
                    <input type="hidden" name="product_id" value="<?php echo $row['id']; ?>">
                    <input type="hidden" name="table" value="female_pants">
                    <label for="size">Size:</label>
                    <select name="size" required>
                        <option value=" S">S</option>
                        <option value="M">M</option>
                        <option value="L">L</option>
                        <option value="XL">XL</option>
                    </select>
                    <button type="submit">Add to Cart</button>
                </form>

                <!-- Add to Wishlist Form -->
                <form action="add_to_wishlist.php" method="POST">
                    <input type="hidden" name="product_id" value="<?php echo $row['id']; ?>">
                    <input type="hidden" name="table" value="female_pants">
                    <button type="submit">Add to Wishlist</button>
                </form>
            </div>
        <?php endwhile; ?>

        <!-- Display male shirts -->
        <h2>Men's Shirts</h2>
        <?php while ($row = $resultMaleShirts->fetch_assoc()): ?>
            <div class="item">
                <img src="display_image.php?id=<?php echo $row['id']; ?>&type=male_shirt" alt="<?php echo htmlspecialchars($row['name']); ?>">
                <h2><?php echo htmlspecialchars($row['name']); ?></h2>
                <p>$<?php echo number_format((float)$row['price'], 2); ?></p>
                <p><?php echo htmlspecialchars($row['description']); ?></p>
                
                <!-- Add to Cart Form -->
                <form action="add_to_cart.php" method="POST">
                    <input type="hidden" name="product_id" value="<?php echo $row['id']; ?>">
                    <input type="hidden" name="table" value="male_shirt">
                    <label for="size">Size:</label>
                    <select name="size" required>
                        <option value="S">S</option>
                        <option value="M">M</option>
                        <option value="L">L</option>
                        <option value="XL">XL</option>
                    </select>
                    <button type="submit">Add to Cart</button>
                </form>

                <!-- Add to Wishlist Form -->
                <form action="add_to_wishlist.php" method="POST">
                    <input type="hidden" name="product_id" value="<?php echo $row['id']; ?>">
                    <input type="hidden" name="table" value="male_shirt">
                    <button type="submit">Add to Wishlist</button>
                </form>
            </div>
        <?php endwhile; ?>

        <!-- Display male pants -->
        <h2>Men's Pants</h2>
        <?php while ($row = $resultMalePants->fetch_assoc()): ?>
            <div class="item">
                <img src="display_image.php?id=<?php echo $row['id']; ?>&type=male_pants" alt="<?php echo htmlspecialchars($row['name']); ?>">
                <h2><?php echo htmlspecialchars($row['name']); ?></h2>
                <p>$<?php echo number_format((float)$row['price'], 2); ?></p>
                <p><?php echo htmlspecialchars($row['description']); ?></p>
                
                <!-- Add to Cart Form -->
                <form action="add_to_cart.php" method="POST">
                    <input type="hidden" name="product_id" value="<?php echo $row['id']; ?>">
                    <input type="hidden" name="table" value="male_pants">
                    <label for="size">Size:</label>
                    <select name="size" required>
                        <option value="S">S</option>
                        <option value="M">M</option>
                        <option value="L">L</option>
                        <option value="XL">XL</option>
                    </select>
                    <button type="submit">Add to Cart</button>
                </form>

                <!-- Add to Wishlist Form -->
                <form action="add_to_wishlist.php" method="POST">
                    <input type="hidden" name="product_id" value="<?php echo $row['id']; ?>">
                    <input type="hidden" name="table" value="male_pants">
                    <button type="submit">Add to Wishlist</button>
                </form>
            </div>
        <?php endwhile; ?>
    </div>
    <a href="cart.php">Go to Cart</a>
</body>
</html>

<?php $conn->close(); ?>