<?php
session_start();
require_once "../../partials/connectDB.php";

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $phone = $_POST['phone'];
    $diachi = $_POST['diachi'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if(strlen($phone) != 10) {
        header('location: ../dangky.php?errorPhone');
        exit();
    }

    if($password != $confirm_password) {
        header('location: ../dangky.php?errorConfirmPass');
        exit();
    }

    if($username && $phone && $diachi && $password && $confirm_password) {
        try {
            $passHash = password_hash($password, PASSWORD_BCRYPT);
            $query = "INSERT INTO users(userName, password, phone, address) VALUES (?,?,?,?)";
            $stmt = $pdo->prepare($query);
            $stmt->execute([$username, $passHash, $phone, $diachi]);

            header("Location: ../dangnhap.php");
        } catch (PDOException $e) {
            echo "<script>alert('Tên đăng nhập này đã có người sử dụng')
            window.location.href = './dangky.php';
            </script>";
        }
    } else {
        header('location: ../dangky.php?errorMissing');
        exit();
    }
}