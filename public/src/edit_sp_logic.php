<?php

require_once "../../partials/connectDB.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_GET['id'];
    $flowerName = $_POST['flowerName'];
    $breed = $_POST['breed'];
    $color = $_POST['color'];
    $price = $_POST['price'];
    $discount_percent = $_POST['discount_percent'];
    $size = $_POST['size'];
    $description = $_POST['description'];
    $species = $_POST['species'];
    $photo1 = $_FILES['photo1']['name'];
    $photo2 = $_FILES['photo2']['name'];
    $photo3 = $_FILES['photo3']['name'];
    $photo4 = $_FILES['photo4']['name'];

    $category = $species === 'hoa' ? 1 : ($species === 'hoacuoi' ? 0 : 2);
    





    if (!empty($flowerName) && !empty($breed) && !empty($color) && !empty($price) && $discount_percent >=0 && !empty($size) && !empty($description) && !empty($species)) {
        if (empty($photo1) && empty($photo2) && empty($photo3) && empty($photo4)) {
            try {
                $query = "UPDATE flowers SET flowerName=?, breed=?, color=?, price=?, discount_percent=?, size=?, description=?, category=? WHERE id=?";
                $stm = $pdo->prepare($query);
                $stm->execute([
                    $flowerName,
                    $breed,
                    $color,
                    $price,
                    $discount_percent,
                    $size,
                    $description,
                    $category,
                    $id
                ]);

                header("location: ../admin/admin_sp.php?id=product");
            } catch (PDOException $e) {
                echo "Query failed: " . $e->getMessage();
            }
        } else {
            $allowedTypes = array('image/jpeg', 'image/jpg', 'image/png');

            $photos = [$photo1, $photo2, $photo3, $photo4];

            $uploads_dir = '../picture';
            
            foreach ($photos as $key => $name) {
                // tham số cần kiểm tra , allowedTypes mảng cần kiểm tra
                if (in_array($_FILES['photo' . ($key + 1)]['type'], $allowedTypes) !== false) {
                $photo_names = $_FILES['photo' . ($key + 1)]['name'];
                $photo_tmp_names = $_FILES['photo' . ($key + 1)]['tmp_name'];

                $filename = basename($photo_names);
                $temp_name = $photo_tmp_names;

                move_uploaded_file($temp_name, "$uploads_dir/$filename");
                $file_paths[] = "$uploads_dir/$filename";
                } else {
                    header("location: ../admin/edit_sp.php?id=$id&error=avatarError");
                    die();
                }
            }
            $photoJson = [];

            foreach ($file_paths as $key => $path) {
                $photoJson['photo' . ($key + 1)] = $path;
            }

            $photoJson = json_encode($photoJson);
            // Tính toán giá đã giảm (promotional_price)
$promotional_price = $price - ($price * $discount_percent / 100);

try {
    $query = "UPDATE flowers 
              SET flowerName=?, breed=?, color=?, price=?, discount_percent=?, size=?, description=?, category=?, photoURLs=?, promotional_price=? 
              WHERE id=?";
    $stm = $pdo->prepare($query);
    $stm->execute([
        $flowerName,
        $breed,
        $color,
        $price,
        $discount_percent,
        $size,
        $description,
        $category,
        $photoJson,
        $promotional_price, // Thêm giá đã giảm vào câu lệnh UPDATE
        $id
    ]);
} catch (PDOException $e) {
    echo "Query failed: " . $e->getMessage();
}


            // try {
            //     $query = "UPDATE flowers SET flowerName=?, breed=?, color=?, price=?, $discount_percent=?, size=?, description=?, category=?, photoURLs=? WHERE id=?";
            //     $stm = $pdo->prepare($query);
            //     $stm->execute([
            //         $flowerName,
            //         $breed,
            //         $color,
            //         $price,
            //         $discount_percent,
            //         $size,
            //         $description,
            //         $category,
            //         $photoJson,
            //         $id
            //     ]);

            //     header("location: ../admin/admin_sp.php");
            //} catch (PDOException $e) {
            //     echo "Query failed: " . $e->getMessage();
            // }
        }
    }
}