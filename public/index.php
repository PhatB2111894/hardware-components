<?php
session_start();
include_once __DIR__ . "/../partials/connectDB.php";
include_once __DIR__ . "/../partials/header.php";
$id_user = $_SESSION['id'] ?? '';
?>
<div class="container body_content">
    <div id="carouselExampleIndicators" class="carousel slide">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>

        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="./picture/bangchuyen3.jpg" class="d-block w-100 h-75 m-3 rounded" alt="...">
            </div>
            <div class="carousel-item">
                <img src="./picture/home-bg.jpg" class="d-block w-100 h-75 m-3 rounded" alt="...">
            </div>
            <div class="carousel-item">
                <img src="./picture/bangchuyen2.jpg" class="d-block w-100 h-75 m-3 rounded" alt="...">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    <h1 class="title-comm"><span class="title-holder">
            SẢN PHẨM MỚI </span></h1>
    <?php
    //  Truy vấn dữ liệu từ flowers
    $query = "SELECT * FROM flowers where 1 order by id desc limit 0,8";
    $stm = $pdo->prepare($query);
    $stm->execute();
    $flowers = $stm->fetchAll(PDO::FETCH_ASSOC);

    echo "
        <div class='container'>
            <div class='row product-list'>
    ";
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
                            </p> ";

        if ($pet['discount_percent'] > 0) {
            echo "<p class='discount_percent'>
                                <a href='./chitietdonhang.php?id=" . $pet['id'] . "'>Giảm còn : " . number_format($pet['price'] - ($pet['price'] * $pet['discount_percent'] / 100), 0, ',', '.') . 'đ' . " </a>   
                            </p>";
        } else {
            echo "<p class='discount_percent'><br/></p>"; 
        }

        echo " <span>  
                                <h5 class='fs-10'>Số Lượng:  
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
    echo "
            </div>
        </div>
    ";
    ?>

    <h1 class="title-comm"><span class="title-holder">
            SẢN PHẨM NỔI BẬT </span></h1>
    </h1>
    <?php
    //  Truy vấn dữ liệu từ flowers
    $query = "SELECT * FROM flowers  order by  RAND() limit 8";
    $stm = $pdo->prepare($query);
    $stm->execute();
    $flowers = $stm->fetchAll(PDO::FETCH_ASSOC);

    echo "
        <div class='container'>
            <div class='row product-list'>
    ";
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
                        <a href='./chitietdonhang.php?id=" . $pet['id'] . "'> <img src='" . $photos['photo1'] . "' alt='' /> </a>
                    </div>
                    <div class='panel-body text-center'>
                        <h4> <a href='./chitietdonhang.php?id=" . $pet['id'] . "' class='pro-title'>" . $pet['flowerName'] . "</a></h4>
                        <p class='price'>
                            <a href='./chitietdonhang.php?id=" . $pet['id'] . "'>Giá : " . number_format($pet['price'], 0, ',', '.') . 'đ' . " </a>   
                        </p> 
                            <span>  
                                <h5 class='fs-5'>Số Lượng:  
                                <input class='w-25 text-center number-input' type='number' size='3' name='soluong' value='0' min = '1'>
                                </h5>
                                <button class='btn my-3 my-btn' type='submit' name='addcart'value='Thêm vào giỏ hàng'>Thêm giỏ hàng</button>        
                            </span>   
                          
                            <input type='hidden' name='id' value=" . $pet['id'] . ">
                            <input type='hidden' name='gia' value=" . $pet['price'] . ">    
                            <input type='hidden' name='id_user' value=" . $id_user . ">    
                            <input type='hidden' name='discount_percent' value=" . $pet['discount_percent'] . ">    
                     </form>
                    </div>  
                </section>
            </div>    
        ";
    }
    echo "
     </div>
    </div>";
    ?>
    <hr>
    <div class="banner">
        <img src="./picture/banner.png" class="d-block w-100 h-75 m-3" alt="...">
    </div>
    <div class="row">
        <h1 class="title-comm"><span class="title-holder"></i> LIÊN HỆ</span></h1>
        <div class="d-flex justify-content-center">
            <div class="col-lg-7 me-4 d-flex align-items-center shadow">
                <iframe src="https://www.google.com/maps/embed?pb=!1m17!1m12!1m3!1d3928.900611964295!2d105.76045507503157!3d10.025059990081623!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m2!1m1!2zMTDCsDAxJzMwLjIiTiAxMDXCsDQ1JzQ2LjkiRQ!5e0!3m2!1svi!2s!4v1719922136813!5m2!1svi!2s" class="w-100" height="400" allowfullscreen="" loading="lazy"></iframe>
            </div>
            <div class="thoitiet p-4 rounded text-center fs-3">
                <div class="searchtiet form-group" style="display:flex;margin-bottom:20px;">
                    <input type="text" class="search-bar form-control" id="otiet" placeholder="Tìm kiếm địa điểm">
                    <button id="timtiet" class="btn my-btn">Tìm</button>
                </div>
                <div class="weather loading">
                    <div class="city"></div>
                    <div class="temp"></div>
                    <img class="may" src="https://ssl.gstatic.com/onebox/weather/64/partly_cloudy.png" alt="" />
                    <div class="description"></div>
                    <div><span class="humidity"></span></div>
                    <div><span class="wind"></span></div>
                </div>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-around my-5">
        <div class="">
            <form action="">
                <h2>Liên hệ với chúng tôi</h2>
                <div class="d-flex my-2">
                    <input class="w-50 rounded border-0 p-2 me-2" type="text" placeholder="Nhập vào họ">
                    <input class="w-50 rounded border-0 p-2" type="text" placeholder="Nhập vào tên">
                </div>
                <div class="d-flex my-2">
                    <input class="w-50 rounded border-0 p-2 me-2" type="email" placeholder="Nhập vào emal">
                    <input class="w-50 rounded border-0 p-2" type="phone" placeholder="Nhập vào số điện thoại">
                </div>
                <div class="w-100">
                    <textarea class="p-2 rounded border-0" name="" id="" cols="60" rows="5" placeholder="Lời nhắn của bạn"></textarea>
                </div>
                <button class="btn my-btn mt-3 float-end">Gửi</button>
            </form>
        </div>


        <div class="">
            <div>
                <h2> Quyền lợi khách hàng của Thời Số</h2>
                <p class="ms-3"><i class="icon_benefit pe-3 fa-solid fa-file-signature"></i> Hợp đồng mua bán rõ ràng</p>
                <p class="ms-3"><i class="icon_benefit pe-3 fa-solid fa-truck-arrow-right"></i> Miễn phí giao hàng khắp 64 tỉnh thành</p>
                <p class="ms-3"><i class="icon_benefit pe-3 fa-solid fa-book-open-reader"></i> Chính sách đổi trả và bảo hành</p>
                <!-- <p class="ms-3"><i class="icon_benefit pe-3 fa-solid fa-syringe"></i> Cam kết Hoa Tươi</p> -->
            </div>
        </div>
    </div>
</div>

<?php

include_once __DIR__ . "/../partials/footer.php";
?>
<script src="js/thoitiet.js"></script>