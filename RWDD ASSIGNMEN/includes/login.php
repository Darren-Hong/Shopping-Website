<?php
// Include the database connection file
include('config.php');

// Start the session
session_start();

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the form data
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepare SQL to check for the user
    $sql = "SELECT * FROM login WHERE Username='$username'";
    $result = $conn->query($sql);

    // Check if user exists
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Now compare the password directly since your database passwords are not hashed
        if ($password == $row['Password']) {
            // Password is correct, create session
            $_SESSION['username'] = $username;
            
            // Redirect to the dashboard or homepage
            header("Location: Homepage.html");
            exit(); // Stop further execution after redirection
        } else {
            echo "Invalid password!";
        }
    } else {
        echo "No user found with this username!";
    }
}

// Close the connection
$conn->close();
?>
