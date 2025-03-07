<?php
include('config.php');
session_start();

// Sample data (replace this with your actual session or database data)
$cart = [
    // ['id' => 1, 'name' => 'Shirt', 'price' => 59.50, 'quantity' => 1],
    // ['id' => 2, 'name' => 'Pants', 'price' => 89.00, 'quantity' => 2]
];

// Check if the cart is empty
if (empty($cart)) {
    echo "<tr><td colspan='5' style='text-align: center;'>Your shopping cart is empty. Please continue to shop.</td></tr>";
    echo "<tr><td colspan='5' style='text-align: center;'>
            <a href='homepage.html' class='continue-btn'>Continue Shopping</a>
          </td></tr>";
} else {
    // Display cart items
    foreach ($cart as $index => $item) {
        echo "<tr>";
        echo "<td>" . ($index + 1) . "</td>";
        echo "<td>" . $item['name'] . "</td>";
        echo "<td>RM" . number_format($item['price'], 2) . "</td>";
        echo "<td><input type='number' class='spinner' value='" . $item['quantity'] . "' min='1' data-id='" . $item['id'] . "'></td>";
        echo "<td><button class='remove-btn' data-id='" . $item['id'] . "'>X</button></td>";
        echo "</tr>";
    }
}
?>