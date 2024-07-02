<?php
session_start();
ob_start();
include_once __DIR__ . "../../../partials/connectDB.php";
include_once __DIR__ . "../../../partials/header_admin.php";
$limit = 5;
$query = "SELECT COUNT(*) as total FROM flowers";
$stm = $pdo->prepare($query);
$stm->execute();
$result = $stm->fetch(PDO::FETCH_ASSOC);
$total_records = $result['total'];
$total_pages = ceil($total_records / $limit);
$page = isset($_GET['page']) ? $_GET['page'] : 1;
?>
<section class="pb-5 body_content">
    <div class="container">
        <h1 class="text-center mt-5">Danh sách sản phẩm</h1>
        <div class="row w-100">
            <div class="col-lg-12 col-md-12 col-12">
                <a href="../admin/add_sp.php?id=product" class="btn my-btn mb-3 ">
                    <i class="fa fa-plus"></i> Thêm sản phẩm
                </a>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th style="width:12%">Hình mô tả</th>
                            <th style="width:10%">Tên </th>
                            <th style="width:8%">Loại hoa</th>
                            <th style="width:7%">Màu Sắc</th>
                            <th style="width:5%">Kích Thước</th>
                            <th style="width:5%">Giá bán</th>
                            <th style="width:5%"> Giam gia</th>

                            <th style="width:15%">Mô tả</th>
                            <th style="width:3%">Phân Loại</th>
                            <th style="width:12%"> Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = "SELECT * FROM flowers LIMIT :offset,:limit";
                        $offset = ($page - 1) * $limit;

                        $stm = $pdo->prepare($query);
                        $stm->bindValue(':offset', $offset, PDO::PARAM_INT);
                        $stm->bindValue(':limit', $limit, PDO::PARAM_INT);
                        $stm->execute();
                        $flowers = $stm->fetchAll();


                        foreach ($flowers as $pet) {
                            $description = $pet['description'];
                            $max_length = 200;
                            if (strlen($description) > $max_length) {
                                $offset = ($max_length - 3) - strlen($description);
                                $description = substr($description, 0, strrpos($description, ' ', $offset)) . '...';
                            }

                            $photos = json_decode($pet['photoURLs'], true);
                            // $category = $pet['category'] == 1 ? "Hoa" : "Hoa Cưới";
                            $category = $pet['category'] == 1 ? "Hoa" : ($pet['category'] == 0 ? "Hoa Cưới" : ($pet['category'] == 2 ? "Hoa Chúc Mừng" : "Không xác định"));

                            echo "
                            <tr>
                                <td data-th='Product'>
                                    <div class='row'>
                                        <div class='text-left'>
                                         <img src='../" . htmlspecialchars($photos['photo1']) . "' alt='' class='img-fluid d-none d-md-block rounded mb-2 shadow '>
                                        </div>
                                        <div class='col-md-9 text-left mt-sm-2'>
                                            <h4></h4>
                                            <p class='font-weight-light'></p>
                                        </div>
                                    </div>
                                </td>
                                <td id='flowerName'>" . htmlspecialchars($pet['flowerName']) . "</td>
                                <td id='breed'>" . htmlspecialchars($pet['breed']) . "</td>
                                <td id='color'>" . htmlspecialchars($pet['color']) . "</td>
                                <td id='color'>" . htmlspecialchars($pet['size']) . "</td>
                                <td id='price'>" . htmlspecialchars($pet['price']) . "</td>
                                <td id='discount_percent'>" . htmlspecialchars($pet['discount_percent']) . "</td>
                                <td id='description'>" . htmlspecialchars($description) . "...</td> 
                                <td id='category'>" . htmlspecialchars($category) . "</td>
                                <td class='actions' data-th=''>
                                    <div class='text-right'>
                                        <button class='btn btn-white  bg-danger btn-md mb-2 delete-sp'>
                                            <a class='text-decoration-none'style='color: #fff;' href='admin_sp.php?action=delete&id=" . htmlspecialchars($pet['id']) . "'>
                                                <i class='fas fa-trash'></i> Xoá 
                                            </a>
                                        </button>
                                        <button class='btn btn-white  bg-warning btn-md mb-2'>
                                            <a class='text-decoration-none'style='color: #fff;' href='./edit_sp.php?id=" . htmlspecialchars($pet['id']) . "'>
                                               <i class='fa-solid fa-pen-to-square'></i> Sửa
                                            </a>
                                        </button>
                                            
                                    </div>
                                </td>
                            </tr>";
                        }
                        ?>
                        <?php
                            if (isset($_GET['action']) && $_GET['action'] == 'delete') {
                                try {
                                    $id = $_GET['id'];
                                    $query = "DELETE FROM flowers WHERE id = $id";
                                    $stm = $pdo->prepare($query);
                                    $stm->execute();

                                    header("Location: ../admin/admin_sp.php?id=product");
                                } catch (PDOException $e) {
                                    echo "Query failed: " . $e->getMessage();
                                }
                            }
                        ?>
                    </tbody>
                </table>
                <div class="pagination d-flex justify-content-center">
                    <nav aria-label="Page navigation example  ">
                        <ul class="pagination ">
                            <?php
                            // Hiển thị nút Previous
                            if ($page > 1) {
                                echo '<li class="page-item"><a class="page-link" aria-label="Previous"  href="admin_sp.php?page=' . ($page - 1) . '"><span aria-hidden="true">&laquo;</span>
                                <span class="sr-only">Previous</span></a></li>';
                            }

                            // Hiển thị nút phân trang
                            for ($i = 1; $i <= $total_pages; $i++) {
                                echo '<li class="page-item ' . ($i == $page ? 'active' : '') . '"><a class="page-link" href="admin_sp.php?id=product&page=' . $i . '">' . $i . '</a></li>';
                            }

                            // Hiển thị nút Next
                            if ($page < $total_pages) {
                                echo '<li class="page-item"><a class="page-link"  aria-label="Next" href="admin_sp.php?page=' . ($page + 1) . '"><span aria-hidden="true">&raquo;</span>
                                <span class="sr-only">Next</span></a></li>';
                            }
                            ?>
                        </ul>
                    </nav>
                </div>

            </div>
        </div>
    </div>
</section>
<?php
include_once __DIR__ . "../../../partials/footer_admin.php";
?>
<script>
    $(document).ready(function () {
        $('.delete-sp').click(function () {
            return confirm("Bạn có chắc chắn muốn xóa sản phẩm này không?");
        })
    })
</script>