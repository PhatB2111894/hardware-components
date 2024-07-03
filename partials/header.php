<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" href="./css/header.css">
<link rel="stylesheet" href="./css/index.css">

<link rel="icon" type="image/x-icon" href="./picture/logo1.jpg">
<title>Thời Số</title> 
<?php
if (isset($_SESSION['id'])) {
  try {
    require_once "../partials/connectDB.php";
    $query = "SELECT * FROM users WHERE id = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$_SESSION['id']]);
    $data = $stmt->fetch(PDO::FETCH_ASSOC);
  } catch (PDOException $e) {
    echo "Query failed: " . $e->getMessage();
  }
}
?>
<?php
$is_admin = isset($_SESSION['isAdmin']);
if (isset($_SESSION['id'])) {
  if ($_SESSION['isAdmin'] == 1) {
    echo "<style>
          .logined-admin {
            display: block;
          }
          .logined {
            display:none;
          }
          .notLogin {
            display:none;
          }
        </style>";
  } else {
    echo "<style>
          .logined {
            display: block;
          }
          .logined-admin {
            display:none;
          }
          .notLogin {
            display:none;
          }
        </style>";
  }
} else {
  echo "<style>
        .logined {
          display: none;
        }
        .logined-admin {
          display:none;
        }
        .notLogin {
          display:block;
        }
      </style>";
}

$id = $_REQUEST['id'];
?>

<header>
  <div class="container-fluid ">
    <div class=" d-flex align-items-center justify-content-between">
      <!-- <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-decoration-none">
        <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap">
          <use xlink:href="#bootstrap"></use>
        </svg>
      </a> -->

      <ul class="nav col-11 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
        <li><a href="./index.php?id=home"><img src="D:/NLCS_B2105633/Shop_Hoa/public/picture/logo.png" alt=""></a></li>
        <li class="d-flex align-items-center"><a href="./index.php?id=home#" id="home" class="px-2 text-header text-shadow fs-6 <?php if (isset($id) && $id == 'home') echo 'active' ?>">TRANG CHỦ</a></li>
        <li class="d-flex align-items-center"><a href="./hoa.php?id=hoa#" id="hoa" class="px-2 text-header text-shadow fs-6 <?php if (isset($id) && $id == 'hoa') echo 'active' ?>">THIẾT BỊ ĐIỆN TỬ</a></li>
        <li class="d-flex align-items-center"><a href="./hoacuoi.php?id=hoacuoi#" id="hoacuoi" class="px-2 text-header text-shadow fs-6 <?php if (isset($id) && $id == 'hoacuoi') echo 'active' ?>">LINH KIỆN ĐIỆN TỬ</a></li>
        <li class="d-flex align-items-center"><a href="./hoachucmung.php?id=hoachucmung#" id="hoachucmung" class="px-2 text-header text-shadow fs-6 <?php if (isset($id) && $id == 'hoachucmung') echo 'active' ?>">PHỤ KIỆN ĐIỆN TỬ</a></li>
        <li class="d-flex align-items-center"><a href="./gioithieu.php?id=info#" id="info" class="px-2 text-header text-shadow fs-6 <?php if (isset($id) && $id == 'info') echo 'active' ?>">GIỚI THIỆU</a></li>
      </ul>
      <div style="margin-right: 30px;" class="dropdown">
        <button class="btnl dropdown-toggle fs-6" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
           THƯƠNG HIỆU
        </button>
        <ul class="dropdown-menu text-header text-shadow dropdown" aria-labelledby="dropdownMenuButton">
          <li><a class="dropdown-item text-header text-shadow" href="./loaihoa.php?flowerName=apple">Apple</a></li>
          <li><a class="dropdown-item text-header text-shadow" href="./loaihoa.php?flowerName=xiaomi">Xiaomi</a></li>
          <li><a class="dropdown-item text-header text-shadow" href="./loaihoa.php?flowerName=samsung">SamSung</a></li>
          <li><a class="dropdown-item text-header text-shadow" href="./loaihoa.php?flowerName=acer">Acer</a></li>
          <li><a class="dropdown-item text-header text-shadow" href="./loaihoa.php?flowerName=dell">Dell</a></li>
          <li><a class="dropdown-item text-header text-shadow" href="./loaihoa.php?flowerName=hp">Hp</a></li>
          <!-- <li><a class="dropdown-item text-header text-shadow" href="./loaihoa.php?flowerName=cúc họa mi">Cúc Họa Mi</a></li> -->

          
        </ul>
      </div>

      <div class="search mt-4">
        <form id="search-form">
          <div class="p-1 bg-light rounded rounded-pill shadow-sm mb-4">
            <div class="input-group">
              <input type="search" id="keyword" placeholder="Nhập từ khóa tìm kiếm?" aria-describedby="button-addon1" class="form-control border-0 bg-light">
              <div class="input-group-append">
                <button id="button-addon1" type="submit" class="btn btn-link text-primary timkiem" value="Tìm kiếm"><i class="icon_search fa fa-search mt-1"></i></button>
              </div>
            </div>
          </div>
        </form>
      </div>
      <div class="">
        <a class="nav-link me-4 fs-5 border_cart" href="./cart.php"> <i class='icon_cart fa fa-shopping-cart' style='font-size: 20px;'></i> </a>

      </div>
      <div class="text-end notLogin">
        <button style="width: 120px; background-color: #063E9D" type="button" class="btn-login btn btn_modify "><a class="text-decoration-none text-light" href="./dangnhap.php">Đăng Nhập</a></button>
        <button style="width: 120px; background-color: #FFCA2C" type="button" class="btn-register btn btn_modify"><a class="text-decoration-none text-dark" href="./dangky.php">Đăng Ký</a></button>
      </div>
      <div class="logined">
        <div class=logined_modify>
          <a href="./profile.php">
            <img class="avatar" src="<?php echo htmlspecialchars($data['photoURL']) ?>" alt="Avatar">
          </a>

          <div class="dropdown">
            <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false"></button>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="./profile.php">Thông tin cá nhân</a></li>
              <li><a class="dropdown-item" href="./edit.php">Chỉnh sửa hồ sơ</a></li>
              <li><a class="dropdown-item" href="../src/logout.php">Đăng xuất</a></li>
            </ul>
          </div>
        </div>
      </div>
      <div class="logined-admin">
        <div class=logined_modify>
          <img class="avatar" src="<?php echo htmlspecialchars($data['photoURL']) ?>" alt="Avatar">

          <div class="dropdown">
            <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false"></button>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="./profile.php">Thông tin cá nhân</a></li>
              <li><a class="dropdown-item" href="./edit.php">Chỉnh sửa hồ sơ</a></li>
              <li><a class="dropdown-item" href="../admin/admin.php">Quản lý</a></li>
              <li><a class="dropdown-item" href="../src/logout.php">Đăng xuất</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</header>
<script src="js/timkiem.js"></script>