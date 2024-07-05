<?php
session_start();
ob_start();
include_once __DIR__ . "../../../partials/connectDB.php";
include_once __DIR__ . "../../../partials/header_admin.php";

$selectedMonth = isset($_POST['month']) ? $_POST['month'] : date('m');
$firstDayOfMonth = date('Y-' . $selectedMonth . '-01');
$lastDayOfMonth = date('Y-' . $selectedMonth . '-t');

$totalRevenue = 0;
$results = [];
try {
    $queryProducts = "
        SELECT 
            f.flowerName,
            SUM(od.num) AS totalQuantity,
            SUM(od.total_price) AS totalSales
        FROM 
            order_details od
        INNER JOIN 
            flowers f ON od.flower_id = f.id
        WHERE 
            DATE_FORMAT(od.create_at, '%Y-%m') = :selectedMonth
            AND od.ship_status = 3
        GROUP BY 
            od.flower_id, f.flowerName
    ";

    $stmProducts = $pdo->prepare($queryProducts);
    $stmProducts->bindValue(':selectedMonth', date('Y-m', strtotime($firstDayOfMonth)));
    $stmProducts->execute();
    $results = $stmProducts->fetchAll(PDO::FETCH_ASSOC);
    // Calculate total revenue for the month
    $queryTotalRevenue = "
        SELECT 
            SUM(od.total_price) AS totalRevenue,
            SUM(od.total_price) AS totalnumbers
        FROM 
            order_details od
        WHERE 
            DATE_FORMAT(od.create_at, '%Y-%m') = :selectedMonth
            AND od.ship_status = 3
    ";

    $stmTotalRevenue = $pdo->prepare($queryTotalRevenue);
    $stmTotalRevenue->bindValue(':selectedMonth', date('Y-m', strtotime($firstDayOfMonth)));
    $stmTotalRevenue->execute();
    $totalRevenueResult = $stmTotalRevenue->fetch(PDO::FETCH_ASSOC);
    $totalRevenue = isset($totalRevenueResult['totalRevenue']) ? $totalRevenueResult['totalRevenue'] : 0;
} catch (PDOException $e) {
    // Handle database errors
    echo "Error: " . $e->getMessage();
}
?>

<div class="container body_content">
    <div class="row m-5">
        <div class="offset-md-2 col-lg-5 col-md-7 offset-lg-4 offset-md-3">
            <h1>Thống kê doanh thu</h1>
        </div>
        <div class="mb-3">
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <label for="month">Chọn tháng:</label>
            <select id="month" name="month">
                <?php
                $monthNames = [
                    1 => 'Tháng 01', 2 => 'Tháng 02', 3 => 'Tháng 03', 4 => 'Tháng 04',
                    5 => 'Tháng 05', 6 => 'Tháng 06', 7 => 'Tháng 07', 8 => 'Tháng 08',
                    9 => 'Tháng 09', 10 => 'Tháng 10', 11 => 'Tháng 11', 12 => 'Tháng 12'
                ];

                foreach ($monthNames as $monthNumber => $monthName) {
                    $selected = ($monthNumber == $selectedMonth) ? 'selected' : '';
                    echo "<option value='$monthNumber' $selected>$monthName</option>";
                }
                ?>
            </select>
            <button type="submit" class="btn btn-primary">Xem thống kê</button>
        </form>

        </div>
        <div class="row w-100">
            <div class="col-lg-12 col-md-12 col-12">
                <h3>Doanh thu trong tháng <?php echo date('m/Y', strtotime($firstDayOfMonth)); ?>:</h3>
                <p><strong>Tổng doanh thu: </strong><?php echo number_format($totalRevenue, 0, ',', '.') . ' VNĐ'; ?></p>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th style="width:50%">Sản phẩm</th>
                            <th style="width:25%">Số lượng bán được</th>
                            <th style="width:25%">Doanh thu (VNĐ)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($results as $row) : ?>
                            <tr>
                                <td id='flowerphoto'>
                                    <?php echo $row['flowerName']; ?>
                                </td>
                                <td><?php echo $row['totalQuantity']; ?></td>
                                <td><?php echo number_format($row['totalSales'], 0, ',', '.') . ' VNĐ'; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php
include_once __DIR__ . "../../../partials/footer_admin.php";
?>