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
    <link rel="stylesheet" href="css/styles.css">
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

            <!-- Icons (Wishlist, Cart) -->
            <ul class="nav-icons">
                <li><a href="Aboutus.html" class="about-link">About Us</a></li>
                <li><a href="wishlist.php"><img src="wishlist.svg" alt="Wish List" class="icon"></a></li>
                <li><a href="cart.php"><img src="cart-regular-24.png" alt="Cart" class="icon"></a></li>
                <li><a href="delivery_info.php"><img src="img/66841.png" alt="Cart" class="icon"></a></li>
            </ul>
        </div>
    </header>
    <link rel="stylesheet" href="css/content.css">
    <h1>Women's Shirts</h1>
    <div id="items">
        <!-- Display female shirts -->
        <?php while ($row = $resultFemaleShirts->fetch_assoc()): ?>
            <div class="item">
                <img src="display_image.php?id=<?php echo $row['id']; ?>&type=female_shirt" alt="<?php echo htmlspecialchars($row['name']); ?>">
                <h2><?php echo htmlspecialchars($row['name']); ?></h2>
                <p>RM<?php echo number_format((float)$row['price'], 2); ?></p>
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
    </div>
</body>
</html>
