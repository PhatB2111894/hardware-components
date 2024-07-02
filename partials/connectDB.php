<?php 

$dns = "mysql:host=localhost;dbname=hard_ware";
$dbusername="root";
$dbpassword="";

try {
    $pdo = new PDO($dns, $dbusername, $dbpassword);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
   echo "connection failed: " . $e->getMessage();
}