<?php
session_start();
include_once __DIR__ . "/../partials/connectDB.php";
include_once __DIR__ . "/../partials/header.php";
$id_user = $_SESSION['id'] ?? '';


if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Kiểm tra xem có dữ liệu tìm kiếm được gửi lên không
    if (isset($_GET['keyword'])) {
        $keyword = $_GET['keyword'];

        // Thực hiện truy vấn tìm kiếm và lấy dữ liệu kết quả từ cơ sở dữ liệu
        $query = "SELECT * FROM flowers WHERE flowerName LIKE '%$keyword%'";
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        $flowers = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Phân trang
        $limit = 8;
        $total_records = count($flowers);
        $total_pages = ceil($total_records / $limit);
        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        $start = ($page - 1) * $limit;
        $flowers = array_slice($flowers, $start, $limit);
    }
    ?>
    <div class='container p-5'>
        <h1 class="title-comm "><span class="title-holder"></i>TÌM KIẾM</i></span></h1>
        <div class="alert alert-success">Kết quả tìm kiếm cho từ khóa '
            <?php echo $keyword; ?>' là:
        </div>
        <div class='row product-list'>
            <?php if (count($flowers) > 0) {
                foreach ($flowers as $pet) {
                    $photos = json_decode($pet['photoURLs'], true);
                        echo "
                        <div class='col-md-3 my-4'>
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
                                        <input type='hidden' name='id_user' value=" . htmlspecialchars($id_user) . ">  
                                    </div>  
                                </form>                       
                            </section>
                        </div>  
                    ";   
                }
            } else {
                echo "
                     <div class='alert alert-danger' role='alert'>
                        Rất tiếc, chúng tôi không tìm thấy kết quả phù hợp với từ khóa tìm kiếm.
                    </div>
                ";
            }
}
?>
    </div>
    <div class="pagination d-flex justify-content-center">
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <?php
                // Hiển thị nút Previous
                if ($page > 1) {
                    echo '<li class="page-item"><a class="page-link" aria-label="Previous" href="timkiem.php?page=' . ($page - 1) . '&keyword=' . urlencode($keyword) . '"><span aria-hidden="true">&laquo;</span><span class="sr-only">Previous</span></a></li>';
                }

                // Hiển thị nút phân trang
                for ($i = 1; $i <= $total_pages; $i++) {
                    echo '<li class="page-item ' . ($i == $page ? 'active' : '') . '"><a class="page-link" href="timkiem.php?page=' . $i . '&keyword=' . urlencode($keyword) . '">' . $i . '</a></li>';
                }

                // Hiển thị nút Next
                if ($page < $total_pages) {
                    echo '<li class="page-item"><a class="page-link" aria-label="Next" href="timkiem.php?page=' . ($page + 1) . '&keyword=' . urlencode($keyword) . '"><span aria-hidden="true">&raquo;</span><span class="sr-only">Next</span></a></li>';
                }
                ?>
            </ul>
        </nav>
    </div>

</div>
</div>
<?php
include_once "../partials/footer.php";
?>