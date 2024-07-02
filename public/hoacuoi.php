<?php
session_start();
require_once "../partials/connectDB.php";
include_once __DIR__ . "/../partials/header.php";
$id_user = $_SESSION['id'] ?? '';
$limit = 8;
$query = "SELECT COUNT(*) as total FROM flowers$flowers WHERE category = 0";
$stm = $pdo->prepare($query);
$stm->execute();
$result = $stm->fetch(PDO::FETCH_ASSOC);
$total_records = $result['total'];
$total_pages = ceil($total_records / $limit);
$page = isset($_GET['page']) && !empty($_GET['page']) ? $_GET['page'] : 1;
?>
<div class='container body_content'>
    <h1 class="title-comm p-3"><span class="title-holder"> HOA CƯỚI</span></h1>
    <div class='row product-list'>
        <?php
        try {
            $query = "SELECT * FROM flowers WHERE category = 0 LIMIT :offset, :limit";
            $offset = ($page - 1) * $limit;
            $stmt = $pdo->prepare($query);
            $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
            $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);

            $stmt->execute();

            $flowers = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Query failed: " . $e->getMessage() . "";
        }
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
                                    <a href='./chitietdonhang.php?id=" . htmlspecialchars($pet['id']) . "' class='pro-title line-clamp-1'>" . htmlspecialchars($pet['flowerName']) . "</a>
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
    <div class="pagination d-flex justify-content-center m-4">
        <nav aria-label="Page navigation example  ">
            <ul class="pagination ">
                <?php
                // Hiển thị nút Previous
                if ($page > 1) {
                    echo '<li class="page-item"><a class="page-link" aria-label="Previous"  href="hoacuoi.php?page=' . ($page - 1) . '"><span aria-hidden="true">&laquo;</span>
                                <span class="sr-only">Previous</span></a></li>';
                }

                // Hiển thị nút phân trang
                for ($i = 1; $i <= $total_pages; $i++) {
                    echo '<li class="page-item ' . ($i == $page ? 'active' : '') . '"><a class="page-link" href="hoacuoi.php?page=' . $i . '">' . $i . '</a></li>';
                }

                // Hiển thị nút Next
                if ($page < $total_pages) {
                    echo '<li class="page-item"><a class="page-link"  aria-label="Next" href="hoacuoi.php?page=' . ($page + 1) . '"><span aria-hidden="true">&raquo;</span>
                                <span class="sr-only">Next</span></a></li>';
                }
                ?>
            </ul>
        </nav>
    </div>
</div>
<?php
include_once __DIR__ . "/../partials/footer.php";
?>