<?php
session_start();
ob_start();
include_once __DIR__ . "../../../partials/connectDB.php";
include_once __DIR__ . "../../../partials/header_admin.php";
$limit = 3;
$query = "SELECT COUNT(*) as total FROM order_details";
$stm = $pdo->prepare($query);
$stm->execute();
$result = $stm->fetch(PDO::FETCH_ASSOC);
$total_records = $result['total'];
$total_pages = ceil($total_records / $limit);
$page = isset($_GET['page']) ? $_GET['page'] : 1;
?>

<section class=" body_content">
    <h1 class="text-center mb-5"> Danh sách đơn hàng</h1>
    <div class="container">
        <div class="row w-100">
            <div class="col-lg-12 col-md-12 col-12">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th style="width:12%">Tên người dùng</th>
                            <th style="width:10%">Số điện thoại</th>
                            <th style="width:13%">Địa chỉ</th>
                            <th style="width:12%">Tên sản phẩm</th>
                            <th style="width:12%">Hình ảnh</th>
                            <th style="width:7%">Số lượng</th>
                            <th style="width:10%">Tổng tiền</th>
                            <th style="width:12%">Ngày tạo</th>
                            <th style="width:8%">Trạng thái</th>
                            <th style="width:16%">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                           $query = "SELECT order_details.*, users.userName, users.phone, users.address, flowers.flowerName, flowers.photoURLs
                           FROM order_details
                           JOIN users ON order_details.user_id = users.id
                           JOIN flowers ON order_details.flower_id = flowers.id
                           LIMIT :offset, :limit";
                 
            
                            $offset = ($page - 1) * $limit;
                            // $query = "SELECT * FROM users";
                            $stm = $pdo->prepare($query);
                            $stm->bindValue(':offset', $offset, PDO::PARAM_INT);
                            $stm->bindValue(':limit', $limit, PDO::PARAM_INT);
                            $stm->execute();
                            $orders = $stm->fetchAll();

                            foreach ($orders as $order) {
                                $dealDone = $order['status_order'] == 2 ? "Đã duyệt" : "Duyệt đơn";
                                $d_none = $order['status_order'] == 0 ? "d-none" : $dealDone;
                                $status = $order['status_order'] == 2 ? "Đã duyệt" : "Chờ xử lý";
                                echo "
                                    <tr>
                                        <td id='userName'>" . htmlspecialchars($order['userName']) . "</td>
                                        <td id='userId'>" . htmlspecialchars($order['phone'] ). "</td>
                                        <td id='address'>" . htmlspecialchars($order['address']) . "</td>
                                        <td id='flowerName'>" . htmlspecialchars($order['flowerName']) . "</td>
                                        
                                        <td id='flowerphoto'> <img class='img-fluid' src='" . htmlspecialchars($order['photo_order']) . "'/></td>
                                        <td id='num'>" . htmlspecialchars($order['num']) . "</td>
                                        <td id='total_price'>" . number_format(htmlspecialchars($order['total_price']), 0, ',', '.') . 'đ' . " </td>
                                        <td id='createAt'>" . htmlspecialchars($order['create_at']) . "</td>
                                        <td id='status'>" .htmlspecialchars($status) . "</td>
                                        <td class='actions' data-th=''>
                                            <div class='text-right'>
                                                <button class='btn btn-white  bg-danger btn-md mb-2 delete-bill'>
                                                    <a class='text-decoration-none text-white' href='admin_bill.php?action=delete&id=" . htmlspecialchars($order['flower_id']) . "&user_id=" . htmlspecialchars($order['user_id'] ). "'>
                                                        <i class='fas fa-trash'> </i> Huỷ   
                                                    </a>    
                                                </button>

                                                <button class='btn btn-white  bg-warning btn-md mb-2 " . htmlspecialchars($d_none ). "'>
                                                    <a class='text-decoration-none text-white' href='admin_bill.php?action=deal&id=" . htmlspecialchars($order['flower_id']) . "&user_id=" . htmlspecialchars($order['user_id']) . "'> 
                                                    " .htmlspecialchars( $d_none)."
                                                    </a>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                ";
                            }
                        ?>

                        <?php
                            if (isset($_GET['action']) && $_GET['action'] == 'delete') {
                        
                                $id_pro = $_GET['id'];
                                $id_user = $_GET['user_id'];
                                try {
                                    $query = "DELETE FROM order_details WHERE flower_id = ? AND user_id = ?";
                                    $stm = $pdo->prepare($query);
                                    $stm->execute([$id_pro, $id_user]);

                                    header("Location: ../admin/admin_bill.php?id=bill#");
                                } catch (PDOException $e) {
                                    echo "Query failed: " . $e->getMessage();
                                }
                            } else if (isset($_GET['action']) && $_GET['action'] == 'deal') {
                                $id_pro = $_GET['id'];
                                $id_user = $_GET['user_id'];
                                try {
                                    $query = "UPDATE order_details SET status_order = 2 WHERE flower_id = ? AND user_id = ?";
                                    $stmt = $pdo->prepare($query);
                                    $stmt->execute([$id_pro, $id_user]);

                                    header("Location: ../admin/admin_bill.php?id=bill#");
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
                                echo '<li class="page-item"><a class="page-link" aria-label="Previous"  href="admin_bill.php?page=' . ($page - 1) . '"><span aria-hidden="true">&laquo;</span>
                                <span class="sr-only">Previous</span></a></li>';
                            }

                            // Hiển thị nút phân trang
                            for ($i = 1; $i <= $total_pages; $i++) {
                                echo '<li class="page-item ' . ($i == $page ? 'active' : '') . '"><a class="page-link" href="admin_bill.php?id=bill&page=' . $i . '">' . $i . '</a></li>';
                            }

                            // Hiển thị nút Next
                            if ($page < $total_pages) {
                                echo '<li class="page-item"><a class="page-link"  aria-label="Next" href="admin_bill.php?page=' . ($page + 1) . '"><span aria-hidden="true">&raquo;</span>
                                <span class="sr-only">Next</span></a></li>';
                            }
                            ?>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>

<?php
include_once __DIR__ . "../../../partials/footer_admin.php";
?>
<script>
    $(document).ready(function() {
        $('.delete-bill').click(function() {
            return confirm("Bạn có chắc chắn muốn huỷ hoá đơn này không?");
        })
    })
</script>
