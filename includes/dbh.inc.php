<?php

$dsn = "mysql:host=localhost;dbname=sys";
$dbusername = "root";
$dbpassword = "ICY3egsp_GUP";

try {
    $pdo = new PDO($dsn, $dbusername, $dbpassword);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}