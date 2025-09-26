<?php
include 'db.php';

if (!isset($_GET['id'])) {
    die("Không có sản phẩm!");
}
$id = intval($_GET['id']);
$sql = "SELECT p.*, c.name AS category_name 
        FROM products p 
        JOIN category c ON p.idcategory = c.id 
        WHERE p.id = $id";
$result = $conn->query($sql);
$product = $result->fetch_assoc();
if (!$product) {
    die("Sản phẩm không tồn tại!");
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Chi tiết sản phẩm</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container py-4">
    <div class="card">
        <div class="card-body">
                   <img src="dt1.webp" alt="" height="100px" >
            <h2 class="card-title"><?php echo $product['name']; ?></h2>
            <p class="card-text">Giá: <?php echo number_format($product['price']); ?> VND</p>
            <p class="card-text">Số lượng: <?php echo $product['quantity']; ?></p>
            <p class="card-text">Danh mục: <?php echo $product['category_name']; ?></p>
            <a href="index.php" class="btn btn-secondary">← Quay lại danh sách</a>
        </div>
    </div>
</body>
</html>