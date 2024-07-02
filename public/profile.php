<?php
session_start();
include_once __DIR__ . "/../partials/connectDB.php";
include_once __DIR__ . "/../partials/header.php";
$sessionId = $_SESSION['id']
?>
<link rel="stylesheet" href="./css/profile.css">


<section class="main mt-5">
    <div class="container p-5">
        <?php
        $query = "SELECT * FROM users WHERE id= ?;";

        $stmt = $pdo->prepare($query);
        $stmt->execute([$sessionId]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        ?>

        <div class="userProfile">
            <div class="main_form myProfile">
                <form action="edit.php">
                    <div class="main_form_title myProfile_title text-center">
                        Thông tin cá nhân
                    </div>
                    <div class="form-row text-center">
                        <div class="col col-12 text-center pb-3">
                            <img src="../<?php echo htmlspecialchars($data['photoURL']); ?>" class="img-fluid rounded-circle" alt="Avatar">
                        </div>
                        <div class="col col-12">
                            <h4>
                                <b>
                                    Tên đăng nhập:
                                </b>
                                <?php printf("%s", htmlspecialchars($data['userName'])); ?>
                            </h4>
                        </div>

                        <div class="col col-12">
                            <h4>
                                <b>
                                    Số điện thoại:
                                </b>
                                <?php printf("%s", htmlspecialchars($data['phone'])); ?>
                            </h4>
                        </div>

                        <div class="col col-12">
                            <h4>
                                <b>
                                    Địa chỉ:
                                </b>
                                <?php printf("%s", htmlspecialchars($data['address'])); ?>
                            </h4>
                        </div>
                        <div class="col col-12">
                            <input type="submit" class="btn my-btn w-100 " value="Cập nhật thông tin" >
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<?php
include_once __DIR__ . "/../partials/footer.php";
?>