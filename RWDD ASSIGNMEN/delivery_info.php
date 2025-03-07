<?php
session_start(); 


$purchasedItems = isset($_SESSION['purchased_items']) ? $_SESSION['purchased_items'] : [];


function getPrice($itemId, $itemTable) {
    
    return 10.00; 
}


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_item'])) {
    $itemIdToDelete = $_POST['item_id'];
    $itemTableToDelete = $_POST['item_table'];

    
    foreach ($purchasedItems as $key => $item) {
        if ($item['id'] == $itemIdToDelete && $item['table'] == $itemTableToDelete) {
            unset($purchasedItems[$key]);
            break;
        }
    }

    // Update the session
    $_SESSION['purchased_items'] = array_values($purchasedItems); 
    header("Location: delivery_info.php"); 
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delivery Information</title>
    <link rel="stylesheet" href="css/delivery_info.css"> 

</head>
<body>
<header>
    <link rel="stylesheet" href="css/header.css">
        
        <div class="navbar">
            
            <div class="logo">
                <a href="Homepage.html"><img src="img/logo.png" alt=""></a>
            </div>

            
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
    <h1>Delivery Information</h1>

    <?php if (empty($purchasedItems)): ?>
        <p>No items were purchased.</p>
    <?php else: ?>
        <h2>Items Purchased:</h2>
        <table>
            <tr>
                <th>Items</th>
                <th>Size</th>
                <th>Quantity</th>
                <th></th>
                <th>Action</th>
            </tr>
            <?php 
            $totalPrice = 0; 
            foreach ($purchasedItems as $item): 
                $price = getPrice($item['id'], $item['table']); 
                $totalPrice += $price * $item['quantity']; 
            ?>
                <tr>
                    <td>
                        <img src="display_image.php?id=<?php echo htmlspecialchars($item['id']); ?>&type=<?php echo htmlspecialchars($item['table']); ?>" alt="" style="max-width:100px; max-height:100px;">
                        
                    </td>
                    <td><?php echo isset($item['size']) ? htmlspecialchars($item['size']) : 'N/A'; ?></td>
                    <td><?php echo htmlspecialchars($item['quantity']); ?></td>
                    <td>

                    </td>
                    <td>
                        <form method="post" style="display:inline;">
                            <input type="hidden" name="item_id" value="<?php echo $item['id']; ?>">
                            <input type="hidden" name="item_table" value="<?php echo $item['table']; ?>">
                            <button type="submit" name="delete_item" class="btn">Received </button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
         
        </table>
    <?php endif; ?>



    <a href="Homepage.html" class="btn">Continue Shopping</a>
</body>
</html>