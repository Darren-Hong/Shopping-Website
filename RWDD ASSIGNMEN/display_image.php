<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "clothes";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}


$id = isset($_GET['id']) ? $_GET['id'] : null;
$type = isset($_GET['type']) ? $_GET['type'] : null;

if ($id && $type) {
    
    $result = $conn->query("SELECT image FROM `$type` WHERE id = '$id'");

    if ($result && $row = $result->fetch_assoc()) {
        header("Content-Type: image/jpeg");
        echo $row['image']; 
    } else {
        
        header("Content-Type: image/jpeg");
        readfile("path/to/default/image.jpg"); 
    }
} else {
    // Invalid request
    header("Content-Type: image/jpeg");
    readfile("path/to/default/image.jpg"); 
}

$conn->close();
?>