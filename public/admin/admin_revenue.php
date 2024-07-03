<?php
session_start();
include_once __DIR__ . "../../../partials/header_admin.php";
?>

<div class="container body_content">
    <div class="row m-5">
        <div class="offset-md-2 col-lg-5 col-md-7 offset-lg-4 offset-md-3">
            <h1>Thống kê doanh thu</h1>
        </div>
        <div class="mb-3">
            <label for=" cars">Thống kê theo:</label>
                <select id="time">
                    <option value="volvo">Tháng</option>
                    <option value="saab">Quý</option>
                    <option value="opel">Năm</option>
            </select>
        </div>
        <div class="row w-100">
            <div class="col-lg-12 col-md-12 col-12">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th style="width:15%">Mã hàng</th>
                            <th style="width:20%">tên hàng</th>
                            <th style="width:9%">Đơn vị tính</th>
                            <th style="width:9%">Số lượng</th>
                            <th style="width:14%">Đơn giá</th>
                            <th style="width:18%">Thành tiền (VND)</th>
                            <th style="width:15%">Ghi chú</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="width:15%">#111124 </td>
                            <td style="width:20%">iPhone 15 Pro Max </td>
                            <td style="width:9%">Chiếc </td>
                            <td style="width:9%">5 </td>
                            <td style="width:14%">29.290.000 đ </td>
                            <td style="width:18%">146,450,000 VND </td>
                            <td style="width:15%"> </td>
                        </tr>
                        <tr>
                            <td style="width:15%">#111128 </td>
                            <td style="width:20%">SamSung s24 Ultra </td>
                            <td style="width:9%">Chiếc </td>
                            <td style="width:9%">8 </td>
                            <td style="width:14%">23.990.000 đ </td>
                            <td style="width:18%">191,920,000 VND </td>
                            <td style="width:15%"> </td>
                        </tr>
                        <tr>
                            <td style="width:15%">#111129 </td>
                            <td style="width:20%">Xiaomi Redmi Note 13 Pro 5G</td>
                            <td style="width:9%">Chiếc </td>
                            <td style="width:9%">25 </td>
                            <td style="width:14%">8.890.000 đ </td>
                            <td style="width:18%">222,250,000 VND </td>
                            <td style="width:15%"> </td>
                        </tr>
                        <tr>
                            <td style="width:15%">#1111210 </td>
                            <td style="width:20%">macBook Pro 16 inch M3 Max </td>
                            <td style="width:9%">Chiếc </td>
                            <td style="width:9%">10 </td>
                            <td style="width:14%">109.990.000 đ </td>
                            <td style="width:18%">1.099.900.000 VND </td>
                            <td style="width:15%"> </td>
                        </tr>
                        <tr>
                            <td style="width:15%">#1111232 </td>
                            <td style="width:20%">Ram Kingston 8gb DDR5 4800MHz </td>
                            <td style="width:9%">Chiếc </td>
                            <td style="width:9%">30 </td>
                            <td style="width:14%">999.000 đ </td>
                            <td style="width:18%">49,950,000 VND </td>
                            <td style="width:15%"> </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php
include_once __DIR__ . "../../../partials/footer_admin.php";
?>
