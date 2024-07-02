<?php
session_start();
ob_start();
include_once __DIR__ . "../../../partials/connectDB.php";
include_once __DIR__ . "../../../partials/header_admin.php";
?>
<section class="pt-2 body_content">
    <div class="container my-5">
        <div class="row w-100">
            <div class="col-lg-12 col-md-12 col-12">
                <h3 class="display-5 mb-5 text-center">Xin chào Admin</h3>
            </div>
        </div>
    </div>
</section>
<?php
include_once __DIR__ . "../../../partials/footer_admin.php";
?>
