<?php 

require_once "../../partials/connectDB.php";

$id_pro = $_GET['id'] ?? '';
$id_user = $_GET['user_id'] ?? '';

if(isset($_GET['action']) && $_GET['action'] == 'order') {
    try {
        $query = "UPDATE order_details SET status_order = 1 WHERE flower_id = ? AND user_id = ?";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$id_pro, $id_user]);

        header("location: ../cart.php");
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
} else if(isset($_GET['action']) && $_GET['action'] == 'cancelOrder')  {
    try {
        $query = "UPDATE order_details SET status_order = 0 WHERE flower_id = ? AND user_id = ?";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$id_pro, $id_user]);

        header("location: ../cart.php");
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
} else if(isset($_GET['action']) && $_GET['action'] == 'orderAll')  {
    try {
        $query = "UPDATE order_details SET status_order = 1 WHERE user_id = ? AND status_order = 0";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$id_user]);

        header("location: ../cart.php");
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
} else if(isset($_GET['action']) && $_GET['action'] == 'deleteAll')  {
    try {
        $query = "DELETE FROM order_details WHERE user_id = ? AND NOT status_order = 2";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$id_user]);

        header("location: ../cart.php");
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}
else {
    header("location: ../index.php");
}
