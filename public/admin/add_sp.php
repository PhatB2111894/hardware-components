<?php
session_start();
include_once __DIR__ . "../../../partials/header_admin.php";
?>

<div class="container body_content">
    <div class="row m-5">
        <div class="offset-md-2 col-lg-5 col-md-7 offset-lg-4 offset-md-3">
            <div class="panel border bg-white">
                <div class="panel-heading">
                    <h3 class="pt-3 font-weight-bold text-center ">Thêm sản phẩm</h3>
                </div>
                <div class="panel-body p-3">
                    <form class="form-horizontal" action="../../src/add_sp_logic.php" method="post" enctype="multipart/form-data">
                        <div class="form-group py-2">
                            <label for="">Tên: </label>
                            <div class="input-field">
                                <input type="text" class="form-control" name="flowerName" placeholder="Nhập Tên ">
                            </div>
                        </div>
                        <div class="form-group py-2">
                            <label for="">Tên loại: </label>
                            <div class="input-field">
                                <input type="text" class="form-control" name="breed" placeholder="Nhập Tên loại">
                            </div>
                        </div>
                        <div class="form-group py-2">
                            <label for="">Màu Sắc: </label>
                            <div class="input-field">
                                <input type="text" class="form-control" name="color" placeholder="Nhập màu">
                            </div>
                        </div>
                        <div class="form-group py-2">
                            <label for="">Giá bán: </label>
                            <div class="input-field">
                                <input type="text" class="form-control" name="price" placeholder="Nhập giá bán">
                            </div>
                        </div>
                        <div class="form-group py-2">
                            <label for="">Giảm giá: </label>
                            <div class="input-field">
                                <input type="number" class="form-control" name="discount_percent" placeholder="Nhập % giảm giá">
                            </div>
                        </div>

                        <div class="form-group py-2">
                            <label for="">Link hình ảnh: </label>
                            <div class="input-field">
                                <input type="file" multiple name="photos[]">
                            </div>
                        </div>
                        <div class="form-group py-2">
                            <label for="">Kích cỡ: </label>
                            <div class="input-field">
                                <select class="form-control" aria-label=".form-select-lg example" name="size">
                                    <option selected>Chọn kích thước</option>
                                    <option value="Lớn">Lớn</option>
                                    <option value="Trung Bình">Trung Bình</option>
                                    <option value="Nhỏ">Nhỏ</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group py-2">
                            <label for="">Mô tả: </label>
                            <div class="input-field">
                                <textarea name="description" cols="57" rows="10"></textarea>
                            </div>
                        </div>
                        <div class="form-group py-2">
                            <label for="">Loại: </label>
                            <input type="radio" name="species" placeholder="Nhập loại sản phẩm" value="hoa" checked> Hoa
                            <input type="radio" name="species" placeholder="Nhập loại sản phẩm" value="hoacuoi"> Hoa Cưới
                            <input type="radio" name="species" placeholder="Nhập loại sản phẩm" value="hoachucmung"> Hoa Chúc Mừng
                        </div>

                        <?php
                            if (isset($_GET['error']) && $_GET['error'] == 'empty') {
                                echo "<p class='alert alert-danger'>Nhập đủ thông tin</p>";
                            } else if (isset($_GET['error']) && $_GET['error'] == 'avatarError') {
                                echo "<p class='alert alert-danger'>định dạng file không đúng!</p>";
                            }
                        ?>
                        <button type="submit"  class="btn my-btn w-100 add-sp">Thêm sản phẩm</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include_once __DIR__ . "../../../partials/footer_admin.php";
?>
