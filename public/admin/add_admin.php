<?php
session_start();
include_once __DIR__ . "../../../partials/connectDB.php";
include_once __DIR__ . "../../../partials/header_admin.php";
?>
<?php
$id = $_GET['id'];
$name = $_GET['name'];
?>

<body>
    <div class="container body_content">
        <div class="row m-5">
            <div class="offset-md-2 col-lg-5 col-md-7 offset-lg-4 offset-md-3">
                <div class="panel border bg-white">

                    <div class="panel-heading">
                        <h3 class="pt-3 font-weight-bold text-center">Cập Nhật Quyền</h3>
                    </div>
                    <form class="form-horizontal" action="../src/add_admin_logic.php?id=<?php echo $id ?>" method="post">
                        <div class="form-group py-2">  
                            <label class="mx-3">Tên khách hàng: <?= htmlspecialchars($name) ?></label>             
                        </div>
                        <div class="form-group py-2">                   
                            <label class="mx-3">Quyền: </label>
                            <div class="input-field m-3">
                                <select class="form-control" aria-label=".form-select-lg example" name="isAdmin">
                                    <option value="0">User</option>
                                    <option value="1">Admin</option>
                                </select>
                            </div>
                        </div>
                        <button type="submit" class="btn my-btn d-block m-auto">Cập nhật</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
    <?php
    include_once __DIR__ . "../../../partials/footer_admin.php";
    ?>