<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<link rel="stylesheet" href="../css/header.css">
<link rel="icon" type="image/x-icon" href="../../picture/icon.jpg" >
<title>
Queen Shop</title>
<?php
if (isset($_SESSION['id'])) {
  try {
    require_once "../../partials/connectDB.php";
    $query = "SELECT * FROM users WHERE id = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$_SESSION['id']]);
    $data = $stmt->fetch(PDO::FETCH_ASSOC);
  } catch (PDOException $e) {
    echo "Query failed: " . $e->getMessage();
  }
}

$id = $_REQUEST['id'];
?>
<header>
  <div class="container ">
    <div class=" d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
      <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
        <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap">
          <use xlink:href="#bootstrap"></use>
        </svg>
      </a>
      <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
        <li><a href="#"><img src="D:/NLCS_B2105633/Shop_Hoa/public/picture/logo.png" alt="" class="w-50"></a></li>
        <li class="d-flex align-items-center "><a href="../index.php?id=home" class="px-2 text-header text-shadow fs-5">Trang chủ</a></li>
        <li class=" d-flex align-items-center"><a href="../admin/admin_user.php?id=user#" class="px-2 text-header text-shadow fs-5 <?php if(isset($id) && $id == 'user') echo 'active' ?>">Quản lý khách hàng</a></li>
        <li class=" d-flex align-items-center"><a href="../admin/admin_sp.php?id=product#" class="px-2 text-header text-shadow fs-5 <?php if(isset($id) && $id == 'product') echo 'active' ?>">Quản lý sản phẩm</a></li>
        <li class="d-flex align-items-center "><a href="../admin/admin_bill.php?id=bill#" class="px-2 text-header text-shadow fs-5 <?php if(isset($id) && $id == 'bill') echo 'active' ?>">Quản lý đơn hàng</a></li>
        <li class="d-flex align-items-center "><a href="../admin/admin_invoice.php?id=invoice#" class="px-2 text-header text-shadow fs-5 <?php if(isset($id) && $id == 'invoice') echo 'active' ?>">Quản lý hoá đơn</a></li>
      </ul>
      <div class="text-end notLogin">
        <div class="logined">
          <div class=logined_modify>
            <img class="avatar" src="../<?php echo $data['photoURL'] ?>" alt="Avatar">

            <div class="dropdown">
              <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false"></button>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="../profile.php">Thông tin cá nhân</a></li>
                <li><a class="dropdown-item" href="../edit.php">Chỉnh sửa hồ sơ</a></li>
                <li><a class="dropdown-item" href="../admin/admin.php">Quản lý</a></li>
                <li><a class="dropdown-item" href="../src/logout.php">Đăng xuất</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
</header>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="../../js/backtop.js"></script>