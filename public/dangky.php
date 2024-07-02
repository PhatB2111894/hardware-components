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
					<h3 class="pt-3 font-weight-bold text-center">Đăng Ký</h3>
				</div>
				<div class="panel-body p-3">
					<form class="form-horizontal" action="./src/signup_logic.php" method="post">

						<div class="form-group py-2">
							<div class="input-field"> <span class="fa-solid fa-user p-2"></span><input type="text" class="form-control" name="username" placeholder="Tên đăng nhập"> </div>
						</div>

						<div class="form-group py-2">
							<div class="input-field"> <span class="fa-solid fa-phone  p-2"></span> <input type="number" class="form-control" name="phone" placeholder="Số Điện Thoại"> </div>
						</div>

						<div class="form-group py-2">
							<div class="input-field"> <span class="fa-solid fa-location-dot p-2"></span> <input type="text" class="form-control" name="diachi" placeholder="Địa chỉ"> </div>
						</div>

						<div class="form-group py-1 pb-2">
							<div class="input-field"> <span class="fas fa-lock px-2"></span> <input id="pwd" type="password" class="form-control" name="password" placeholder="Nhập mật khẩu"> <span class="btn bg-white text-muted"> <span id="showPass" class="far fa-eye-slash"></span> </span> </div>
						</div>
						<div class="form-group py-1 pb-2">
							<div class="input-field"> <span class="fas fa-lock px-2"></span> <input id="pwd2" type="password" class="form-control" name="confirm_password" placeholder="Nhập lại mật khẩu"> <span class="btn bg-white text-muted"> <span id="showNewPass" class="far fa-eye-slash"></span> </span> </div>
						</div>
						<?php
						if (isset($_GET['errorConfirmPass'])) {
							echo "<div class='alert alert-danger mt-2' role='alert'>
								Mật khẩu không khớp.
							</div>";
						}

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
						?>
						<button type="submit" class="btn my-btn w-100 mt-3">Đăng Ký</button>
						<div class="text-center pt-4 text-muted">Hoặc bạn đã có tài khoản? <a class="text-color" href="./dangnhap.php"> Đăng Nhập</a> </div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<?php
include_once __DIR__ . "/../partials/footer.php";
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script src="js/showpass.js"></script>
