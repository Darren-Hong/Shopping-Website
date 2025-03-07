<?php
session_start(); 


$wishlistItems = isset($_SESSION['wishlist']) ? $_SESSION['wishlist'] : [];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Wishlist</title>
    <link rel="stylesheet" href="css/wishlist.css"> 
 
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
    <h1>Your Wishlist</h1>
    <div id="wishlist">
        <?php if (empty($wishlistItems)): ?>
            <div class="empty-wishlist-message">
                <p>Your wishlist is empty. Please add items to your wishlist.</p>
                <a href="Homepage.html" class="btn">Continue Shopping</a>
            </div>
        <?php else: ?>
            <table>
                <tr>
                    <th>Item</th>
                    <th>Action</th>
                </tr>
                <?php foreach ($wishlistItems as $item): ?>
                    <tr>
                        <td>
                            <img class="item-image" src="display_image.php?id=<?php echo htmlspecialchars($item['id']); ?>&type=<?php echo htmlspecialchars($item['table']); ?>" alt="<?php echo htmlspecialchars($item['name']); ?>">
                            <?php echo htmlspecialchars($item['name']); ?>
                        </td>
                        <td>
                            <form action="add_to_cart.php" method="POST" style="display:inline;">
                                <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($item['id']); ?>">
                                <input type="hidden" name="table" value="<?php echo htmlspecialchars($item['table']); ?>">
                                <button type="submit" class="btn">Add to Cart</button>
                            </form>
                            <form action="remove_from_wishlist.php" method="POST" style="display:inline;">
                                <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($item['id']); ?>">
                                <input type="hidden" name="table" value="<?php echo htmlspecialchars($item['table']); ?>">
                                <button type="submit" class="btn">Remove from Wishlist</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
            <a href="Homepage.html" class="btn">Continue Shopping</a>
        <?php endif; ?>
    </div>
</body>
</html>