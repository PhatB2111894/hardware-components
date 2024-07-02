
        $(document).ready(function() {
            // Gửi yêu cầu tìm kiếm khi người dùng nhấn Enter trên trang header.php
            $("#search-form").on("submit", function(e) {
                e.preventDefault();
                var keyword = $("#keyword").val();
                window.location.href = "timkiem.php?keyword=" + encodeURIComponent(keyword);
            });
        });
   
        