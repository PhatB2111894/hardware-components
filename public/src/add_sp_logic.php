<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $flowerName = $_POST['flowerName'];
    $breed = $_POST['breed'];
    $color = $_POST['color'];
    $price = $_POST['price'];
    $discount_percent = $_POST['discount_percent'];
    $size = $_POST['size'];
    $description = $_POST['description'];
    $species = $_POST['species'];
    $images = $_FILES['photos']['name'];

    if ($flowerName && $breed && $color && $price && $discount_percent >=0 && $size && $description && $species && $images ) {

        $allowedTypes = array('image/jpeg', 'image/jpg', 'image/png');
        // xu ly upload nhieu anh
        $uploads_dir = '../picture';

        for ($i = 0; $i < count($_FILES['photos']['name']); $i++) {
            if(in_array($_FILES['photos']['type'][$i], $allowedTypes) !== false) {
                $temp_name = $_FILES['photos']['tmp_name'][$i];
                $filename = basename($_FILES['photos']['name'][$i]);
    
                move_uploaded_file($temp_name, "$uploads_dir/$filename");
    
                // Lưu lại đường dẫn file đã upload
                $file_paths[] = "$uploads_dir/$filename";
            } else {
                header("location: ../admin/add_sp.php?error=avatarError");
                die();
            }
        }
        // đưa dữ liệu thành key:value
        $photoJson = [];

        foreach ($file_paths as $key => $path) {
            $photoJson['photo' . ($key + 1)] = $path;
        }

        $photoJson = json_encode($photoJson);
        $category = $species === 'hoa' ? 1 : ($species === 'hoacuoi' ? 0 : 2);

        try {
            require_once "../../partials/connectDB.php";
            $query = "INSERT INTO flowers (flowerName, breed, color, price, discount_percent, size, description, category, photoURLs)
                VALUES (?,?,?,?,?,?,?,?,?)";
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
                $photoJson
            ]);
            header("location: ../admin/admin_sp.php?id=product");
        } catch (PDOException $e) {
            echo "Query failed: " . $e->getMessage();
            die();
        }
    } else {
        header("location: ../admin/add_sp.php?error=empty");
    }
}
