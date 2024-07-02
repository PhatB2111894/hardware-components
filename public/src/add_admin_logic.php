<?php

session_start();
//kiem tra phuong thuc gui bieu mau
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $isAdmin = $_POST['isAdmin'];
    $id = $_REQUEST['id'];

    try {
        require_once "../../partials/connectDB.php";
        $query = "UPDATE users SET isAdmin = :isAdmin WHERE id = :id";
        $stm = $pdo->prepare($query);
        $stm->bindParam(':isAdmin', $isAdmin);
        $stm->bindParam(':id', $id);
        $stm->execute();

        header('location: ../admin/admin_user.php');
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    header('location: ../admin/admin_user.php');
}
