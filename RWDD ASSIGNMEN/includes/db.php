<?php
    $dsn = "mysql:host=localhost;dbname=shop";
    $dbusername = "root";
    $dbpassword = "";

    try {
        $pbo = new PDO($dsn, $dbusername, $dbpassword);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOEXPECTION $e) {
        echo "Connection Failed: " . $e->getMessage();
    }
?>