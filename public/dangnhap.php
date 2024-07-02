<?php
session_start();
include_once __DIR__ . "/../partials/header.php";
?>
<link rel="stylesheet" href="./css/dangnhap.css">
<div class="container body_content">
    <div class="row pb-5">
        <div class="offset-md-2 col-lg-5 col-md-7 offset-lg-4 offset-md-3">
            <div class="panel border bg-white">
                <div class="panel-heading">
                    <h3 class="pt-3 font-weight-bold text-center">Đăng Nhập</h3>
                </div>
                <div class="panel-body p-3">
                    <form action="./src/login_logic.php" method="POST">
                        <div class="form-group py-2">
                            <div class="input-field"> <span class="fa-solid fa-user p-2"></span> <input class="form-control" type="text" name='username' placeholder="Tên đăng nhập"> </div>
                        </div>
                        <div class="form-group py-1 pb-2">
                            <div class="input-field"> <span class="fas fa-lock px-2"></span> <input class="form-control" id="pwd" type="password" name="pwd" placeholder="Nhập mật khẩu"> <div class="btn bg-white text-muted"> <span id="showPass" class="far fa-eye-slash"></span> </div> </div>
                        </div>
                        <div class="mt-2 form-inline d-flex justify-content-between"> <input type="checkbox" name="remember" id="remember"> <label for="remember" class="text-muted">Nhớ tôi</label> <a href="#" id="forgot" class="font-weight-bold text-end text-color">Quên mật khẩu?</a> </div>
                        <?php
                        if (isset($_GET['errorPass'])) {
                            echo "<div class='alert alert-danger mt-3' role='alert'>
                                         Nhập mật khẩu không chính xác.
                                 </div>
                            ";
                        }
                        ?>
                        <button type="submit" class="btn my-btn btn-block mt-3 w-100">Đăng Nhập</button>
                        <div class="text-center pt-4 text-muted">Bạn chưa có tài khoản? <a class="text-color" href="./dangky.php"> Đăng ký</a> </div>
                    </form>
                </div>
                <div class="mx-3 my-2 py-2 bordert">
                    <div class="text-center py-3"> <a href="https://wwww.facebook.com" target="_blank" class="px-2"> <img class="picture" src="https://www.dpreview.com/files/p/articles/4698742202/facebook.jpeg" alt=""> </a> <a href="https://www.google.com" target="_blank" class="px-2"> <img class="picture" src="https://www.freepnglogos.com/uploads/google-logo-png/google-logo-png-suite-everything-you-need-know-about-google-newest-0.png" alt=""> </a> <a href="https://www.github.com" target="_blank" class="px-2"> <img class="picture" src="https://www.freepnglogos.com/uploads/512x512-logo-png/512x512-logo-github-icon-35.png" alt=""> </a> </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include_once __DIR__ . "/../partials/footer.php";
?>

<script src="js/showpass.js"></script>