<?php
session_start();
require_once "../../partials/connectDB.php";

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST["username"];
    $pwd = $_POST["pwd"];
    try{
        $query = "SELECT * FROM users WHERE userName = ?";

        $stmt = $pdo->prepare($query);
        $stmt->execute([$username]);

        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if(password_verify($pwd, $data["password"])) {
            $_SESSION['id'] = $data['id'];
            $_SESSION['isAdmin'] = $data['isAdmin'];
            if($data['isAdmin'] == 1) {
                header("location: ../admin/admin.php?id=" . $data['id']);
            } else {
                header("location: ../index.php?id=home");
            }
        } else {
            header("location: ../dangnhap.php?errorPass");
        }

    } catch(PDOException $e) {
        echo "Query failed: " . $e->getMessage();
    }
}