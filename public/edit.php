<?php
session_start();
include_once __DIR__ . "/../partials/header.php";
$sessionId = $_SESSION['id'];
try {
    $query = "SELECT * FROM users WHERE id=?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$sessionId]);

    $data = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo $e->getMessage();
}
?>
<link rel="stylesheet" href="./css/dangnhap.css">
<div class="container mt-5">
    <div class="row p-5">
        <div class="offset-md-2 col-lg-5 col-md-7 offset-lg-4 offset-md-3">
            <div class="panel border bg-white">
                <div class="panel-heading">
                    <h3 class="pt-3 font-weight-bold text-center">Cập nhật thông tin</h3>
                </div>
                <div class="panel-body p-3">
                    <form class="form-horizontal" action="./src/update_logic.php" method="post" enctype="multipart/form-data">
                        <div class="form-group py-2">
                            <div class="input-field justify-content-center border-0">
                                <img id="pimg" src="<?php echo htmlspecialchars($data['photoURL']); ?>" class="img-fluid rounded-circle" alt="Avatar">
                                <i class="fas fa-pen pimgedit "></i>
                                <input class="p-2" onchange="document.getElementById('pimg').src = window.URL.createObjectURL(this.files[0])" id="pimgi" style="display: none;" type="file" name="photoURL">
                            </div>
                        </div>

                        <div class="form-group py-2">
                            <div class="input-field"> <span class="fa-solid fa-user p-2"></span><input type="text" class="form-control" name="username" placeholder="Tên đăng nhập" value="<?= htmlspecialchars($data['userName']) ?>"> </div>
                        </div>

                        <div class="form-group py-2">
                            <div class="input-field"> <span class="fa-solid fa-phone  p-2"></span> <input type="number" class="form-control" name="phone" placeholder="Số Điện Thoại" value="<?= htmlspecialchars($data['phone']) ?>"> </div>
                        </div>

                        <div class="form-group py-2">
                            <div class="input-field"> <span class="fa-solid fa-location-dot p-2"></span> <input type="text" class="form-control" name="diachi" placeholder="Địa chỉ" value="<?= htmlspecialchars($data['address']) ?>"> </div>
                        </div>

                        <div class="form-group py-1 pb-2">
                            <div class="input-field"> <span class="fas fa-lock px-2"></span> <input id="pwd" type="password" class="form-control" name="oldPassword" placeholder="Nhập mật khẩu"> <span class="btn bg-white text-muted"> <span id="showPass" class="far fa-eye-slash"></span> </span> </div>
                        </div>
                        <div class="form-group py-1 pb-2">
                            <div class="input-field"> <span class="fas fa-lock px-2"></span> <input id="pwd2" type="password" class="form-control" name="newPassword" placeholder="Nhập mật khẩu mới"> <span class="btn bg-white text-muted"> <span id="showNewPass" class="far fa-eye-slash"></span> </span> </div>
                        </div>
                        <p>Nhập lại mật khẩu cũ nếu không muốn đổi!!</p>
                        <?php
                        if (isset($_GET['errorMissing'])) {
                            echo "<div class='alert alert-danger mt-2' role='alert'>
                            Vui lòng nhập đủ thông tin.
                        </div>";
                        }
                        if (isset($_GET['errorPhone'])) {
                            echo "<div class='alert alert-danger mt-2' role='alert'>
                           Số điện thoại phải đủ 10 số.
                        </div>";
                        }

                        if (isset($_GET['errorPassword'])) {
                            echo "<div class='alert alert-danger mt-2' role='alert'>
                          Mật khẩu không đúng
                        </div>";
                        }
                        if (isset($_GET['avatarError'])) {
                            echo "<div class='alert alert-danger mt-2' role='alert'>
                            Vui lòng đảm bảo tệp này là jpg, png hoặc jpeg.
                        </div>";
                        }
                        ?>
                        <button type="submit" class="btn my-btn w-100 ">Cập Nhật</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include_once __DIR__ . "/../partials/footer.php";
?>
<script>
    $(document).ready(function() {
        $("#pimg").on("click", function() {
            $("#pimgi").click();
        });
        $(".pimgedit").on("click", function() {
            $("#pimgi").click();
        });
    });
</script>

<script>
    const fileInput = document.getElementById('pimgi');

    fileInput.addEventListener('change', function() {
        const file = this.files[0];
        console.log(file.type);
    });
</script>

<script src="js/showpass.js"></script>
