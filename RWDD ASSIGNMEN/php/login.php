<?php
include('config.php');

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $sql = "SELECT * FROM login WHERE Username='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        if ($password == $row['Password']) {
            $_SESSION['username'] = $username;
            
            echo "<script>
                    alert('Welcome, $username!');
                    window.location.href = '../Homepage.html';
                  </script>";
            exit();
        } else {
            echo "<script>
                alert('Invalid password! Please try again.');
                window.location.href = '../login.html';
                </script>";
        }
    } else {
        echo "<script>
                alert('No user found with this username!');
                window.location.href = '../Login.html';
                </script>";
    }
}

$conn->close();
?>
