<?php
session_start();
require_once "../../partials/connectDB.php";

$sessionId = $_SESSION['id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $phone = $_POST['phone'];
    $diachi = $_POST['diachi'];
    $oldPassword = $_POST['oldPassword'];
    $newPassword = $_POST['newPassword'];
    $image = $_FILES['photoURL']['name'];
    $tmp_image = $_FILES['photoURL']['tmp_name'];
 
    $query = "SELECT * FROM users WHERE id=:id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':id', $sessionId);
    $stmt->execute();
    $data = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($data) {
        $_password = $data['password'];
        $photoURL = $data['photoURL'];
        $photoURLName = ''; 
        if ($_FILES['photoURL']['name'] !== "") {
            $allowedTypes = array('image/jpeg', 'image/jpg', 'image/png');
            if (in_array($_FILES['photoURL']['type'], $allowedTypes) !== false) {
                $target_dir = "../picture/";
                $target_file = $target_dir . basename($image);
                move_uploaded_file($tmp_image, $target_file);
                $query = "UPDATE users SET photoURL=:photoURL WHERE id=:id";
                $stmt = $pdo->prepare($query);     
                $stmt->bindParam(":photoURL",$target_file );
                $stmt->bindParam(":id",$sessionId );            
                $state = $stmt->execute();
                header("location: ../profile.php");
                return;
            } else {
                header("location: ../edit.php?avatarError");
                return;
            }
        } else {
            $photoURLName = $photoURL;
        }

        if (strlen($phone) != 10) {
            header('location: ../edit.php?errorPhone');
            exit();
        }

        if (!password_verify($oldPassword, $data['password'])) {
            header('location: ../edit.php?errorPassword');
            exit();
        }

        try {
            $hashPassword = password_hash($newPassword, PASSWORD_BCRYPT);
            $updateQuery = "UPDATE users SET userName=?, password=?, phone=?, address=?, photoURL=? WHERE id=?";

            $stmt = $pdo->prepare($updateQuery);
            $stmt->execute([
                $username,
                $hashPassword,
                $phone,
                $diachi,
                $photoURLName,
                $sessionId
            ]);

            header("location: ../profile.php");
        } catch (PDOException $e) {
            echo "Query failed: " . $e->getMessage();
        }
    }
}
