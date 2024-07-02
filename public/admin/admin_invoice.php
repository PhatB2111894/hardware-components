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


<?php

// Tính tổng số trang và lấy dữ liệu cho phân trang
$query = "SELECT COUNT(*) as total FROM order_details WHERE status_order = 2"; // Chỉ lấy đơn hàng đã duyệt
$stm = $pdo->prepare($query);
$stm->execute();
$result = $stm->fetch(PDO::FETCH_ASSOC);
$total_records = $result['total'];
$total_pages = ceil($total_records / $limit);
$offset = ($page - 1) * $limit;

// Lấy danh sách các đơn hàng đã duyệt
$query = "SELECT order_details.*, users.userName, users.phone, users.address, flowers.flowerName, flowers.photoURLs
           FROM order_details
           JOIN users ON order_details.user_id = users.id
           JOIN flowers ON order_details.flower_id = flowers.id
           WHERE order_details.status_order = 2
           LIMIT :offset, :limit";
$stm = $pdo->prepare($query);
$stm->bindValue(':offset', $offset, PDO::PARAM_INT);
$stm->bindValue(':limit', $limit, PDO::PARAM_INT);
$stm->execute();
$orders = $stm->fetchAll();
?>
   <?php
// Tính ngày bắt đầu và ngày kết thúc của tháng hiện tại
$firstDayOfMonth = date('Y-m-01');
$lastDayOfMonth = date('Y-m-t');

// Truy vấn SQL để lấy tổng doanh thu của các đơn hàng đã duyệt trong tháng
$query = "SELECT SUM(total_price) AS totalRevenue 
          FROM order_details 
          WHERE status_order = 2 
          AND create_at BETWEEN :firstDayOfMonth AND :lastDayOfMonth";
$stm = $pdo->prepare($query);
$stm->execute(['firstDayOfMonth' => $firstDayOfMonth, 'lastDayOfMonth' => $lastDayOfMonth]);
$result = $stm->fetch(PDO::FETCH_ASSOC);
$totalRevenue = $result['totalRevenue'];
?>

<section class="body_content">
    <div class="text-center mt-5">
    <h3>Tổng doanh thu trong tháng: <?php echo number_format($totalRevenue, 0, ',', '.') . 'đ'; ?></h3>
</div>
    <h1 class="text-center mb-5">Danh sách đơn hàng đã duyệt</h1>
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
                        foreach ($orders as $order) {
                            // Các thông tin đơn hàng
                            $orderId = $order['id'];
                            $userName = htmlspecialchars($order['userName']);
                            $phone = htmlspecialchars($order['phone']);
                            $address = htmlspecialchars($order['address']);
                            $flowerName = htmlspecialchars($order['flowerName']);
                            $num = htmlspecialchars($order['num']);
                            $total_price = number_format(htmlspecialchars($order['total_price']), 0, ',', '.') . 'đ';
                            $create_at = htmlspecialchars($order['create_at']);
                            $status = $order['status_order'] == 2 ? "Đã duyệt" : "Chờ xử lý";

                            // Hiển thị thông tin đơn hàng và nút "Xem hóa đơn" nếu đơn hàng đã duyệt
                            if ($order['status_order'] == 2) {
                                echo "
                                    <tr>
                                        <!-- Các cột thông tin của đơn hàng -->
                                        <td id='userName'>$userName</td>
                                        <td id='userId'>$phone</td>
                                        <td id='address'>$address</td>
                                        <td id='flowerName'>$flowerName</td>
                                        <td id='flowerphoto'>
                                            <img class='img-fluid' src='" . $order['photo_order'] . "' />
                                        </td>
                                        <td id='num'>$num</td>
                                        <td id='total_price'>$total_price</td>
                                        <td id='createAt'>$create_at</td>
                                        <td id='status'>$status</td>
                                        <td class='actions' data-th=''>
                                            <div class='text-right'>
                                                <!-- Nút Xem hóa đơn -->
                                                <button class='btn btn-white bg-info btn-md mb-2 view-invoice' data-toggle='modal' data-target='#orderModal_$orderId'>Xem hóa đơn</button>
                                                <!-- Nút Xem tình trạng vận chuyển -->
                                                <button class='btn btn-white bg-info btn-md mb-2 view-status' data-toggle='modal' data-target='#statusModal_$orderId'>Xem tình trạng vận chuyển</button>
                                            </div>
                                        </td>
                                    </tr>";

                                // Modal cho từng đơn hàng
                                echo "
                                    <div class='modal fade' id='orderModal_$orderId' tabindex='-1' role='dialog' aria-labelledby='orderModalLabel_$orderId' aria-hidden='true'>
                                        <div class='modal-dialog modal-lg' role='document'>
                                            <div class='modal-content'>
                                                <div class='modal-header'>
                                                    <h5 class='modal-title' id='orderModalLabel_$orderId'>Chi tiết đơn hàng</h5>
                                                    <button type='button' class='close close-modal' data-dismiss='modal' aria-label='Close'>
                                                        <span aria-hidden='true'>&times;</span>
                                                    </button>
                                                </div>
                                                <div class='modal-body'>
                                                    <p>Tên người dùng: $userName</p>
                                                    <p>Số điện thoại: $phone</p>
                                                    <p>Địa chỉ: $address</p>
                                                    <p>Tên sản phẩm: $flowerName</p>
                                                    <p>Số lượng: $num</p>
                                                    <p>Tổng tiền: $total_price</p>
                                                    <p>Ngày tạo: $create_at</p>
                                                    <p>Trạng thái: $status</p>
                                                    <p><strong>Hình ảnh sản phẩm:</strong></p>
                                                    <div class='text-center'>
                                                        <img src='" . htmlspecialchars($order['photo_order']) . "' alt='Hình ảnh sản phẩm' class='img-fluid w-25'>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>";

                                // Modal cho tình trạng vận chuyển
                                echo "
                                    <div class='modal fade' id='statusModal_$orderId' tabindex='-1' role='dialog' aria-labelledby='statusModalLabel_$orderId' aria-hidden='true'>
        <div class='modal-dialog' role='document'>
            <div class='modal-content'>
                <div class='modal-header'>
                    <h5 class='modal-title' id='statusModalLabel_$orderId'>Tình trạng đơn hàng</h5>
                    <button type='button' class='close close-modal' data-dismiss='modal' aria-label='Close'>
                        <span aria-hidden='true'>&times;</span>
                    </button>
                </div>
                <div class='modal-body'>
                    <p><strong>Tình trạng hiện tại:</strong> $status</p>
                    <form class='update-status-form' id='updateStatusForm_$orderId' method='post' action='" . htmlspecialchars($_SERVER['PHP_SELF']) . "'>
                        <div class='form-group'>
                            <label for='new_status'>Tình trạng mới:</label>
                            <select class='form-control' name='new_status' id='new_status_$orderId'>
                                <option value='1'>Đang chuẩn bị hàng</option>
                                <option value='2'>Đã được giao cho đơn vị vận chuyển bạn sẽ sớm nhận được đơn hàng</option>
                                <option value='3'>Đơn hàng được giao thành công</option>
                            </select>
                        </div>
                        <input type='hidden' name='order_id' value='$orderId'>
                        <button type='submit' class='btn btn-primary'>Lưu thay đổi</button>
                    </form>
                </div>
            </div>
        </div>
    </div>";
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
                                echo '<li class="page-item"><a class="page-link" aria-label="Previous"  href="admin_invoice.php?page=' . ($page - 1) . '"><span aria-hidden="true">&laquo;</span>
                                <span class="sr-only">Previous</span></a></li>';
                            }

                            // Hiển thị nút phân trang
                            for ($i = 1; $i <= $total_pages; $i++) {
                                echo '<li class="page-item ' . ($i == $page ? 'active' : '') . '"><a class="page-link" href="admin_invoice.php?page=' . $i . '">' . $i . '</a></li>';
                            }

                            // Hiển thị nút Next
                            if ($page < $total_pages) {
                                echo '<li class="page-item"><a class="page-link"  aria-label="Next" href="admin_invoice.php?page=' . ($page + 1) . '"><span aria-hidden="true">&raquo;</span>
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
    $(document).ready(function() {
        // Kích hoạt modal khi nút "Xem hóa đơn" được nhấn
        $('.view-invoice').click(function() {
            var targetModal = $(this).data('target');
            $(targetModal).modal('show');
        });

        // Kích hoạt modal khi nút "Xem tình trạng vận chuyển" được nhấn
        $('.view-status').click(function() {
            var targetModal = $(this).data('target');
            $(targetModal).modal('show');
        });

        // Đóng modal khi nút đóng được nhấn
        $('.close-modal').click(function() {
            var targetModal = $(this).closest('.modal'); // Tìm modal gần nhất
            targetModal.modal('hide'); // Đóng modal
        });

        // Xử lý khi form cập nhật trạng thái vận chuyển được submit
        $('form.update-status-form').submit(function(event) {
            event.preventDefault(); // Ngăn chặn form gửi đi mặc định
            var formData = $(this).serialize(); // Thu thập dữ liệu từ form
            var url = '<?php echo $_SERVER['PHP_SELF']; ?>'; // Đường dẫn đến trang hiện tại

            // Lấy id của đơn hàng từ form
            var orderId = $(this).find('[name="order_id"]').val();

            // Gửi yêu cầu AJAX để cập nhật trạng thái vận chuyển
            $.ajax({
                type: 'POST',
                url: url,
                data: formData,
                success: function(response) {
                    alert(response); // Hiển thị thông báo thành công
                    $('#statusModal_' + orderId).modal('hide'); // Đóng modal sau khi cập nhật
                    // Cập nhật trạng thái hiển thị trên trang nếu cần
                },
                error: function(xhr, status, error) {
                    console.error(error); // Hiển thị lỗi nếu có
                }
            });
        });
    });
</script>
