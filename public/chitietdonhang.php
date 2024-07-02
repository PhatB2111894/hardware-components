<?php
session_start();
require_once __DIR__ . "/../partials/connectDB.php";
include_once __DIR__ . "/../partials/header.php";
?>
<link rel="stylesheet" href="./css/chitietdonhang.css">
<div class="body_content">
    <h1 class="title-comm pt-3 "><span class="title-holder"></i> CHI TIẾT SẢN PHẨM </i></span></h1>
    <?php
    $id = 0;
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
    }
    try {
        $query = "SELECT * FROM flowers WHERE id= :id";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        $datas = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($datas as $data) {
            $status = $data['status'] == 1 ? "Còn Hàng" : "Hết Hàng";
            $photos = json_decode($data['photoURLs'], true);
            echo "
                <div class='container mt-2 mb-5 body_content'>
                    <div class='card'>
                        <div class='row g-0'>
                            <div class='col-md-6 border-end'>
                                <div class='d-flex flex-column justify-content-center'>
                                    <div class='main_image'> <img src=" . htmlspecialchars($photos['photo1']) . " id='main_product_image' width='350'> </div>
                                    <div class='thumbnail_images mb-3'>
                                        <ul id='thumbnail'>
                                            <li class='active'><img onclick='changeImage(this)' src='" . htmlspecialchars($photos['photo1']) . "' width='70'></li>
                                            <li><img onclick='changeImage(this)' src='" . htmlspecialchars($photos['photo2']) . "' width='70'></li>
                                            <li><img onclick='changeImage(this)' src='" . htmlspecialchars($photos['photo3']) . "' width='70'></li>
                                            <li><img onclick='changeImage(this)' src='" . htmlspecialchars($photos['photo4']) . "' width='70'></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        <div class='col-md-6'>
                        <form action='";
                            if (isset($_SESSION['id']) && isset($_SESSION['isAdmin'])) {
                                echo './cart.php';
                            } else {
                                echo "./dangnhap.php";
                            }
                            echo "'method = 'POST'>                                  
                            <div class='p-3 right-side'>
                                <div class='d-flex justify-content-between align-items-center'>
                                    <h3 class='fs-3'>" . htmlspecialchars($data['flowerName']) . "</h3> 
                                </div>
                                <div class='mt-2 pr-3 ps-2 content'>
                                    <p class='fs-6'>Thương hiệu: " . htmlspecialchars($data['breed']) . "</p>
                                </div>
                                <div class='mt-2 pr-3 ps-2 content'>
                                    <p  class='fs-6' >Màu: " . htmlspecialchars($data['color']) . "</p>
                                </div>
                                <div class='mt-2 pr-3 ps-2 content'>
                                    <p class='fs-6'>Kích Thước: " . htmlspecialchars($data['size']) . "</p>
                                </div>
                                <div class='mt-2 pr-3 ps-2 content'>
                                    <p class='fs-6'>Tình trạng: " . htmlspecialchars($status) . " </p>
                                </div>
                                <h3 class='fs-5 ps-2'>Giá bán: " . number_format(htmlspecialchars($data['price']) - htmlspecialchars($data['price']) * htmlspecialchars($data['discount_percent'] / 100), 0, ',', '.') . 'đ' . "</h3>
                                <span>  
                                    <h5 class='fs-5 p-2 content'>Số Lượng:  
                                    <input class='w-10 text-center' type='number' size='3' name='soluong' value='0' min = '1'>
                                    </h5>
                                    <span class='d-flex justify-content-center'>
                                        <button class=' btn my-btn my-3 w-75 text-uppercase' type='submit' name='addcart'value='Thêm vào giỏ hàng'>Thêm giỏ hàng</button>
                                    </span>
                                </span>  
                                <input type='hidden' name='id' value=" . htmlspecialchars($data['id']) . ">
                                <input type='hidden' name='gia' value=" . htmlspecialchars($data['price']) . ">
                                <input type='hidden' name='id_user' value=" . htmlspecialchars($_SESSION['id']?? "") . ">    
                                
                            </div>
                        </form>
                        </div>                          
                    </div> 
                </div>
                    <div class='mt-4 card p-4'>
                        <h2 class='bg-secondary-subtle px-3 py-2 opacity-75'>Mô tả sản phẩm</h2> 
                        <p class=' p-3'>" . htmlspecialchars($data['description']) . "</p>               
                    </div>                      
            </div>
            ";
        }
    } catch (PDOException $e) {
        echo "Query failed: " . $e->getMessage();
    }

    ?>
    <div class='container mb-4'>
        <div class='row product-list '>
            <h2 class="text-center text-uppercase">Sản phẩm gợi ý</h2>
            <?php
            $id_user = $_SESSION['id'] ?? '';
            //  Truy vấn dữ liệu từ flowers
            $query = "SELECT * FROM flowers  order by  RAND() limit 4";
            $stm = $pdo->prepare($query);
            $stm->execute();
            $flowers = $stm->fetchAll(PDO::FETCH_ASSOC);

            foreach ($flowers as $pet) {
                $photos = json_decode($pet['photoURLs'], true);
                echo "
                <div class='col-md-3 my-2'>
                    <section class='panel'>
                        <form action='"; 
                if (isset($_SESSION['id']) && isset($_SESSION['isAdmin'])) {
                    echo './cart.php';
                } else {
                    echo "./dangnhap.php";
                }
                echo "'method = 'POST'>
                            <div class='pro-img-box'>
                                <a href='./chitietdonhang.php?id=" . htmlspecialchars($pet['id']) . "'> 
                                    <img src='" . htmlspecialchars($photos['photo1']) . "' alt='' /> 
                                </a>
                            </div>
                            <div class='panel-body text-center'>
                                <h4> 
                                    <a href='./chitietdonhang.php?id=" . htmlspecialchars($pet['id']) . "' class='pro-title'>" . htmlspecialchars($pet['flowerName']) . "</a>
                                </h4>
                                <p class='price'>
                                    <a href='./chitietdonhang.php?id=" . $pet['id'] . "'>Giá : " . number_format($pet['price'], 0, ',', '.') . 'đ' . " </a>   
                                </p> 
                                <span>  
                                    <h5 class='fs-5'>Số Lượng:  
                                    <input class='w-25 text-center' type='number' size='3' name='soluong' value='0' min = '1'>
                                    </h5>
                                    <button class='btn my-btn my-3' type='submit' name='addcart'value='Thêm vào giỏ hàng'>Thêm giỏ hàng</button>        
                                </span>   

                                 <input type='hidden' name='id' value=" . htmlspecialchars($pet['id']) . ">
                                <input type='hidden' name='gia' value=" . htmlspecialchars($pet['price']) . "> 
                                <input type='hidden' name='discount_percent' value=" . $pet['discount_percent'] . ">    
                                <input type='hidden' name='id_user' value=" . htmlspecialchars($id_user) . ">
                                  <input type='hidden' name='photo_order' value=" . htmlspecialchars($photos['photo1']) . "> 
                                 

                            </div>  
                        </form>                       
                    </section>
                </div>  
            ";
            }
            ?>
        </div>
    </div>
</div>

<?php include_once __DIR__ . "/../partials/footer.php"; ?>
<script src="./js/chitietdonhang.js"></script>
<script>
    $activeImgs = document.querySelectorAll(".thumbnail_images ul li");
    $activeImgs.forEach(function(img) {
        img.addEventListener("click", function() {
            $activeImgs.forEach(function(img) {
                img.classList.remove("active");
            })

            this.classList.add("active");
            console.log(123);
        });
    });
</script>