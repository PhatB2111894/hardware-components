<?php
session_start();
ob_start();
include_once __DIR__ . "../../../partials/connectDB.php";
include_once __DIR__ . "../../../partials/header_admin.php";
$limit = 3;
$query = "SELECT COUNT(*) as total FROM users WHERE isAdmin = 0";
$stm = $pdo->prepare($query);
$stm->execute();
$result = $stm->fetch(PDO::FETCH_ASSOC);
$total_records = $result['total'];
$total_pages = ceil($total_records / $limit);
$page = isset($_GET['page']) ? $_GET['page'] : 1;
?>

<section class="pb-5 body_content">
    <h1 class="text-center m-5"> Danh sách khách hàng</h1>
    <div class="container">
        <div class="row w-100">
            <div class="col-lg-12 col-md-12 col-12">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th style="width:10%">Tên khách hàng</th>
                            <th style="width:12%">Số điện thoại</th>
                            <th style="width:20%">Địa chỉ</th>
                            <th style="width:10%">Quyền</th>
                            <th style="width:16%">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = "SELECT * FROM users WHERE isAdmin = 0 LIMIT :offset,:limit";
                        $offset = ($page - 1) * $limit;
                        // $query = "SELECT * FROM users";
                        $stm = $pdo->prepare($query);
                        $stm->bindValue(':offset', $offset, PDO::PARAM_INT);
                        $stm->bindValue(':limit', $limit, PDO::PARAM_INT);
                        $stm->execute();
                        $users = $stm->fetchAll();

                        foreach ($users as $user) {
                            $isAdmin = $user['isAdmin'] == 0 ? "người dùng" : "Quản lý";
                            echo "
                                <tr>
                                    <td id='userName'>" . htmlspecialchars($user['userName']) . "</td>
                                    <td id='phone'>" . htmlspecialchars($user['phone']) . "</td>
                                    <td id='address'>" . htmlspecialchars($user['address']) . "</td>
                                    <td id='isAdmin'>" . htmlspecialchars($isAdmin) . "</td>
                                   
                                    <td class='actions' data-th=''>
                                        <div class='text-right'>
                                            <button class='btn btn-white bg-danger btn-md mb-2 delete-user'>
                                                <a class='text-decoration-none text-white ' href='admin_user.php?action=delete&id=" . htmlspecialchars($user['id']) . "'>
                                                    <i class='fas fa-trash'></i> Xoá    
                                                </a>    
                                            </button>
                                            <button class='btn btn-white bg-warning btn-md mb-2'>
                                                <a class='text-decoration-none text-white' href='./add_admin.php?id=" .htmlspecialchars($user['id'])  . "&name=" . htmlspecialchars($user['userName'] ) . "" . "'>
                                                    <i class='fa-solid fa-pen-to-square'></i> Sửa
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
                                try {                            
                                    $id = $_GET['id'];
                                    $query = "DELETE FROM users WHERE id = $id";
                                    $stm = $pdo->prepare($query);
                                    $stm->execute();

                                    header("Location: ../admin/admin_user.php");
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
                                echo '<li class="page-item"><a class="page-link" aria-label="Previous"  href="admin_user.php?page=' . ($page - 1) . '"><span aria-hidden="true">&laquo;</span>
                                <span class="sr-only">Previous</span></a></li>';
                            }

                            // Hiển thị nút phân trang
                            for ($i = 1; $i <= $total_pages; $i++) {
                                echo '<li class="page-item ' . ($i == $page ? 'active' : '') . '"><a class="page-link" href="admin_user.php?page=' . $i . '">' . $i . '</a></li>';
                            }

                            // Hiển thị nút Next
                            if ($page < $total_pages) {
                                echo '<li class="page-item"><a class="page-link"  aria-label="Next" href="admin_user.php?page=' . ($page + 1) . '"><span aria-hidden="true">&raquo;</span>
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
        $('.delete-user').click(function () {
            return confirm("Bạn có chắc chắn muốn xóa khách hàng này không?");
        })
    })
</script>