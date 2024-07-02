<?php
session_start();
ob_start();
require_once __DIR__ . "/../partials/connectDB.php";
include_once __DIR__ . "/../partials/header.php";

$cur_user_id = $_SESSION['id'] ?? '';
function tonTaiOrder($pdo, $flower_id, $userId)
{
    $sql = "SELECT * FROM order_details WHERE flower_id = ? AND user_id = ? AND status_order = 0";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$flower_id, $userId]);
    $result = $stmt->fetch();
    if ($result) {
        return true;
    } else {
        return false;
    }
}

//lay du lieu tu form
if (isset($_POST['addcart']) && ($_POST['addcart'])) {
    $id = $_POST['id'];
    $photo = $_POST['photo_order'];
    $gia = $_POST['gia'];
    $soluong = $_POST['soluong'];
    $discount_percent = $_POST['discount_percent'];

    $price = $gia - ($gia * $discount_percent / 100);

    $tong = $soluong * $price;

    if (!tonTaiOrder($pdo, $id, $_SESSION['id'])) {
        try {
            $set_order = "INSERT INTO order_details (flower_id, pice, num, photo_order,total_price, user_id) VALUES (?,?,?,?,?,?)";
            $stmt = $pdo->prepare($set_order);
            $stmt->execute([
                $id,
                $price,
                $soluong,
                $photo,
                $tong,
                $_SESSION['id']
            ]);

            header("Location: ./cart.php");
        } catch (PDOException $e) {
            echo $e->getMessage();
            exit();
        }
    } else {
        $query = "UPDATE order_details SET num = num + ?, total_price = total_price + ? WHERE flower_id = ? AND user_id = ?";
        $stmt = $pdo->prepare($query);
        $stmt->execute([
            $soluong,
            $tong,
            $id,
            $_SESSION['id']
        ]);
        header("Location: ./cart.php");
    }
}

// Phí vận chuyển
$shipping_fee = 50000;

?>
<section class=" mt-5 body_content">
    <div class="container">
        <div class="row w-100">
            <div class="col-lg-12 col-md-12 col-12">
                <h1 class="title-comm"><span class="title-holder"> GIỎ HÀNG </span></h1>
                <table id="shoppingCart" class="table table-condensed table-responsive">
                    <thead>
                        <tr>
                            <th style="width:40%">Sản phẩm</th>
                            <th style="width:10%">Giá</th>
                            <th style="width:10%">Số lượng</th>
                            <th style="width:10%">Tổng tiền</th>
                            <th style="width:18%">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        try {
                            $query = "SELECT * FROM order_details JOIN flowers ON order_details.flower_id = flowers.id WHERE user_id = ?";
                            $stmt = $pdo->prepare($query);
                            $stmt->execute([$cur_user_id]);
                            $results = $stmt->fetchAll();
                            $tong = 0;
                            if ($results) {
                                foreach ($results as $result) {
                                    $photos = json_decode($result['photoURLs'], true);
                                    $tong = $tong + $result['total_price'];
                                    echo '
                                       <tr>
                                            <td data-th="Product">
                                                <div class="row">
                                                    <div class="col-md-3 text-left">
                                                        <a href="./chitietdonhang.php?id=' . htmlspecialchars($result['id']) . '"> <img class="w-100" src="' . $photos['photo1'] . '" alt=" class="img-fluid d-none d-md-block rounded mb-2 shadow "></a>
                                                    </div>  
                                                    <div class="col-md-9 text-left mt-sm-2">
                                                        <h4 >' . htmlspecialchars($result['flowerName']) . '</h4>
                                                        <p class="font-weight-light">Tên: ' . htmlspecialchars($result['breed']) . '</p>
                                                        <p class="font-weight-light">Màu: ' . htmlspecialchars($result['color']) . '</p>
                                                        <p class="font-weight-light">Size: ' . htmlspecialchars($result['size']) . '</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td data-th="Price" id="price">
                                                ' . number_format(htmlspecialchars($result['price']  - ($result['discount_percent'] / 100 * $result['price'])), 0, ',', '.') . 'đ' . '
                                            </td>
                                                   
                                            <td data-th="Quantity">
                                                ' . htmlspecialchars($result['num']) . '
                                            </td>
                                            <td data-th="totalPrice" id="totalPrice">                  
                                                ' . number_format(htmlspecialchars($result['total_price']), 0, ',', '.') . 'đ' . '              
                                            </td>                       
                                            <td class="actions" data-th=">
                                                <div class="text-right">';
                                    if ($result['status_order'] == 0) {
                                        echo '  
                                                                <button class="btn bg-primary btn-md mb-2 me-1">
                                                                    <a class="text-decoration-none"style="color: #fff;" href="./src/order_pro.php?action=order&id=' . htmlspecialchars($result['flower_id']) . '&user_id=' . htmlspecialchars($result['user_id']) . '">Đặt hàng</a>
                                                                </button>
                                                                <button class="btn btn-white btn-md mb-2 remove-product bg-danger" >
                                                                    <a  class="text-decoration-none"style="color: #fff;" href="cart.php?action=delete&id=' . htmlspecialchars($result['flower_id']) . '"></i> Xoá</a>
                                                                </button>
                                                            ';
                                    } elseif ($result['status_order'] == 1) {
                                        echo '  
                                                                <p class="btn btn-primary btn-md mb-2 me-2" >
                                                                        Chờ Duyệt Đơn
                                                                </p>
                                                                <button class="btn btn-danger btn-md mb-2" >
                                                                    <a class="text-decoration-none"style="color: #fff;" href="./src/order_pro.php?action=cancelOrder&id=' . htmlspecialchars($result['flower_id']) . '&user_id=' . htmlspecialchars($result['user_id']) . '">Huỷ Đặt hàng</a>
                                                                </button>
                                                            ';
                                    } elseif ($result['status_order'] == 2) {
                                        echo '  
                                                            <p class="btn btn-primary btn-md mb-2" >
                                                                Đơn đã duyệt
                                                            </p>
                                                            <button class="btn btn-info btn-md mb-2 view-invoice" data-toggle="modal" data-target="#orderModal_' . htmlspecialchars($result['id']) . '">Xem hóa đơn</button>
                                                            ';
                                    }
                                    echo '</div>
                                            </td>
                                           
                                        </tr> 
                                       
                                    ';
                                }
                            }
                        } catch (PDOException $e) {
                            echo $e->getMessage();
                        }
                        ?>

                        <?php
                        if (isset($_GET['action']) && $_GET['action'] == 'delete') {
                            try {
                                $flower_id = $_GET['id'];
                                $query = "DELETE FROM order_details WHERE flower_id = ? and user_id = ?";
                                $stmt = $pdo->prepare($query);
                                $stmt->execute([$flower_id, $cur_user_id]);
                                header("Location: ./cart.php");
                            } catch (PDOException $e) {
                                echo $e->getMessage();
                            }
                        }
                        ?>
                    </tbody>

                </table>
            </div>
        </div>
        <div class="row mt-4 d-flex align-items-center">
            <div class="col-sm-6 order-md-2 text-end">
                <div class="">
                   
                    <?php
                    $tong_hang_chua_duyet = 0;
                    foreach ($results as $result) {
                        if ($result['status_order'] != 2) {
                            $tong_hang_chua_duyet += $result['total_price'];
                        }
                    }
                    $tong_thanh_toan = $tong_hang_chua_duyet
                    ?>
                    <h2 class="me-4"> Tổng Thanh Toán
                    </h2>
                    <h2 class="me-4"><?php echo number_format(htmlspecialchars($tong_thanh_toan), 0, ',', '.') . 'đ' ?></h2>


                </div>


                <a href="./src/order_pro.php?action=orderAll&user_id=<?= htmlspecialchars($cur_user_id) ?>" class="btn btn-primary mb-4 btn-lg pl-5">Đặt hàng</a>
                <a href="./src/order_pro.php?action=deleteAll&user_id=<?= htmlspecialchars($cur_user_id) ?>" class="btn btn-danger mb-4 btn-lg pl-5 me-4">Xoá giỏ hàng</a>
            </div>
            <div class="col-sm-6 mb-3 mb-m-1 order-md-1 text-md-left ">
                <a class=" fs-4" href="index.php?id=home#">
                    <i class="fas fa-arrow-left mr-2 fs-4"></i> Tiếp tục mua sắm</a>
            </div>
        </div>
    </div>
</section>

<?php
include_once __DIR__ . "/../partials/footer.php";
?>

<?php foreach ($results as $result) : ?>
    <?php if ($result['status_order'] == 2) : ?>
        <!-- Modal -->
        <div class="modal fade" id="orderModal_<?php echo htmlspecialchars($result['id']); ?>" tabindex="-1" role="dialog" aria-labelledby="orderModalLabel_<?php echo htmlspecialchars($result['id']); ?>" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="orderModalLabel_<?php echo htmlspecialchars($result['id']); ?>">Chi tiết đơn hàng</h5>
                        <button type="button" class="close close-modal" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- Hiển thị thông tin chi tiết của đơn hàng -->
                        <p>Tên sản phẩm: <?php echo htmlspecialchars($result['flowerName']); ?></p>
                        <p>Giá: <?php echo number_format(htmlspecialchars($result['price']  - ($result['discount_percent'] / 100 * $result['price'])), 0, ',', '.') . 'đ'; ?></p>
                        <p>Số lượng: <?php echo htmlspecialchars($result['num']); ?></p>
                        <p>Tổng tiền: <?php echo number_format(htmlspecialchars($result['total_price']), 0, ',', '.') . 'đ'; ?></p>
                        <p>Ngày đặt: <?php echo htmlspecialchars($result['create_at']); ?></p>
                        <p>Trạng thái: <?php echo htmlspecialchars($result['status_order'] == 2 ? "Đã Duyệt" : "Chờ xử lý "); ?></p>
                        <p>Mã đơn hàng: <?php echo htmlspecialchars($result['id']); ?></p>
                        <!-- Thêm các thông tin khác của đơn hàng vào đây -->
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
<?php endforeach; ?>


<script>
    $(document).ready(function() {
        // Kích hoạt modal khi nút "Xem đơn hàng" được nhấn
        $('.view-invoice').click(function() {
            var targetModal = $(this).data('target');
            $(targetModal).modal('show');
        });
    });
</script>
<script>
    $('.close-modal').click(function() {
        var targetModal = $(this).closest('.modal'); // Tìm modal gần nhất
        targetModal.modal('hide'); // Đóng modal
    });
</script>