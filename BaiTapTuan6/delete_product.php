<?php
include 'db.php';

// Kiểm tra nếu có ID sản phẩm trong URL
if (isset($_GET['id'])) {
    $productId = intval($_GET['id']);

    // Lấy thông tin sản phẩm từ cơ sở dữ liệu
    $productQuery = $conn->query("DELETE FROM products WHERE id = $productId");
     if ($productQuery) {
        echo "<div class='alert alert-success'>Cập nhật thành công! 2s để chuyển hướng</div>";
        header("Refresh:2; url=index.php");
    } else {
        echo "<div class='alert alert-danger'>Lỗi: " . $conn->error . "</div>";
    }
}
