<?php
include('config.php');

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];

    $sql = "SELECT * FROM login WHERE Username='$username'";
    $result = $conn->query($sql);

    // Check if the username exists
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo "<h3>User Information</h3>";
        echo "Username: " . $row['Username'] . "<br>";
        echo "Email: " . $row['Email'] . "<br>";
        echo "Password: " . $row['Password']. ".<br>";
    } else {
        echo "<script>alert('No user found with this username!');</script>";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
    <a href="../Login.html" class="Lbutton">Back</a>
</body>
</html>