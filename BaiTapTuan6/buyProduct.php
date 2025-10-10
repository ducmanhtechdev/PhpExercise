<?php
session_start(); 
include 'db.php';

$id = 0; 
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
             Số lượng mua hàng: 
             <form action="shopping_cart.php" method="POST">
                <input type="hidden" name="idP" value=<?php echo $id?>> 
        <div class="input-group" style="width: 150px;">
        <button type="button" class="btn btn-outline-secondary" onclick="changeQuantity(-1)">−</button>
        <input type="number" id="quantity" name="quantity" value="1" min="1" class="form-control text-center">
        <button type="button" class="btn btn-outline-secondary" onclick="changeQuantity(1)">+</button>
    </div>
                 <input type="submit" class="btn btn-success" value="Mua Hàng">
             </form>
            
        </div>
    </div>

    <script>
function changeQuantity(change) {
    const quantityInput = document.getElementById('quantity');
    let current = parseInt(quantityInput.value) || 1;
    current += change;
    if (current < 1) current = 1; // không cho nhỏ hơn 1
    quantityInput.value = current;
}
</script>
</body>
</html>