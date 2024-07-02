<?php
session_start(); 
include_once __DIR__ . "../../../partials/header_admin.php"; 

    $id = $_GET['id'];
    try {
        require_once "../../partials/connectDB.php";
        $query = "SELECT * FROM flowers WHERE id = ?";
        $stm = $pdo->prepare($query);
        $stm->execute([$id]);
        $pet = $stm->fetch(PDO::FETCH_ASSOC);
        $photos = json_decode($pet['photoURLs'], true);
    } catch (PDOException $e) {
        echo "Query failed: " . $e->getMessage();
    }
?>

<div class="container body_content">
    <div class="row m-5">
        <div class="offset-md-2 col-lg-5 col-md-7 offset-lg-4 offset-md-3">
            <div class="panel border bg-white">
                <div class="panel-heading">
                    <h3 class="pt-3 font-weight-bold text-center">Cập nhật sản phẩm</h3>
                </div>
                <div class="panel-body p-3">
                    <form class="form-horizontal" action="../src/edit_sp_logic.php?id=<?php echo htmlspecialchars($pet['id']); ?>" method="post" enctype="multipart/form-data">
                        <div class="form-group py-2">
                            <label for="">Tên sản phẩm: </label>
                            <div class="input-field">
                                <input type="text" class="form-control" name="flowerName" placeholder="Nhập Tên " value="<?php echo htmlspecialchars($pet['flowerName']); ?>">
                            </div>
                        </div>
                        <div class="form-group py-2">
                            <label for="">Tên giống: </label>
                            <div class="input-field">
                                <input type="text" class="form-control" name="breed" placeholder="Nhập Loại" value="<?php echo htmlspecialchars($pet['breed']); ?>">
                            </div>
                        </div>
        
                        <div class="form-group py-2">
                            <label for="">Màu Sắc: </label>
                            <div class="input-field">
                                <input type="text" class="form-control" name="color" placeholder="Nhập màu " value="<?php echo htmlspecialchars($pet['color']); ?>">
                            </div>
                        </div>
                        <div class="form-group py-2">
                            <label for="">Giá bán: </label>
                            <div class="input-field">
                                <input type="text" class="form-control" name="price" placeholder="Nhập giá bán" value="<?php echo htmlspecialchars($pet['price']); ?>">
                            </div>
                        </div>
                        <div class="form-group py-2">
                            <label for="">Giảm giá: </label>
                            <div class="input-field">
                                <input type="text" class="form-control" name="discount_percent" placeholder="Nhập % giảm" value="<?php echo htmlspecialchars($pet['discount_percent']); ?>">
                            </div>
                        </div>
                        <div class="form-group py-2">
                            <p>Hình ảnh: </p>
                            <div class="input-field d-flex flex-wrap">                         
                                <input
                                    onchange="document.getElementById('pimg1').src = window.URL.createObjectURL(this.files[0])"
                                    id="id1" style="display: none;" type="file" name="photo1">
                                <input
                                    onchange="document.getElementById('pimg2').src = window.URL.createObjectURL(this.files[0])"
                                    id="id2" style="display: none;" type="file" name="photo2">
                                <input
                                    onchange="document.getElementById('pimg3').src = window.URL.createObjectURL(this.files[0])"
                                    id="id3" style="display: none;" type="file" name="photo3">
                                <input
                                    onchange="document.getElementById('pimg4').src = window.URL.createObjectURL(this.files[0])"
                                    id="id4" style="display: none;" type="file" name="photo4">
                                    <label for="id1" class="w-50"><img id="pimg1" class="p-1 img-fluid" src="../<?php echo htmlspecialchars($photos['photo1']); ?>" alt="image"></label>
                                    <label for="id2" class="w-50"><img id="pimg2" class="p-1 img-fluid" src="../<?php echo htmlspecialchars($photos['photo2']); ?>" alt="image"></label>
                                    <label for="id3" class="w-50"><img id="pimg3" class="p-1 img-fluid" src="../<?php echo htmlspecialchars($photos['photo3']); ?>" alt="image"></label>
                                    <label for="id4" class="w-50"><img id="pimg4" class="p-1 img-fluid" src="../<?php echo htmlspecialchars($photos['photo4']); ?>" alt="image"></label>
                            </div>
                        </div>
                        <div class="form-group py-2">
                            <label for="">Kích cỡ: </label>
                            <div class="input-field">
                                <select class="form-control" aria-label=".form-select-lg example" name="size">
                                    <option selected>Chọn kích thước</option>
                                    <option value="Lớn" <?php if($pet['size'] === 'Lớn') {echo 'selected';} ?> >Lớn</option>
                                    <option value="Trung Bình" <?php if($pet['size'] === 'Trung Bình') {echo 'selected';} ?> >Trung Bình</option>
                                    <option value="Nhỏ" <?php if($pet['size'] === 'Nhỏ') {echo 'selected';} ?>>Nhỏ</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group py-2">
                            <label for="">Mô tả: </label>
                            <div class="input-field">
                                <textarea name="description" cols="57" rows="10"><?php echo htmlspecialchars($pet['description']); ?></textarea>
                            </div>
                        </div>
                        <div class="form-group py-2">
                            <label for="">Loại: </label>
                            <input type="radio" name="species" placeholder="Nhập Tên" value="hoa" <?php if(htmlspecialchars($pet['category']) == 1) echo 'checked'; ?> > Hoa
                            <input type="radio" name="species" placeholder="Nhập Tên" value="hoacuoi" <?php if(htmlspecialchars($pet['category']) == 0) echo 'checked'; ?> > Hoa Cưới
                            <input type="radio" name="species" placeholder="Nhập Tên" value="hoachucmung" <?php if(htmlspecialchars($pet['category']) == 2) echo 'checked'; ?> > Hoa Chúc Mừng
                        </div>

                        <?php
                        if (isset($_GET['error']) && $_GET['error'] == 'empty') {
                            echo "<p class='alert alert-danger'>Nhập đủ thông tin</p>";
                        } else if (isset($_GET['error']) && $_GET['error'] == 'avatarError') {
                            echo "<p class='alert alert-danger'>Định dạng file không đúng!</p>";
                        }
                        ?>
                        <button type="submit" class="btn my-btn w-100 edit-sp">Cập nhật</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include_once __DIR__ . "../../../partials/footer_admin.php";
?>