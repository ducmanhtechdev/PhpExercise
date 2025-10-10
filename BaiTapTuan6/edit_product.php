<?php
include 'db.php';

// Kiểm tra nếu có ID sản phẩm trong URL
if (isset($_GET['id'])) {
    $productId = intval($_GET['id']);

    // Lấy thông tin sản phẩm từ cơ sở dữ liệu
    $productQuery = $conn->query("SELECT * FROM products WHERE id = $productId");
    $product = $productQuery->fetch_assoc();

    if (!$product) {
        die("Sản phẩm không tồn tại.");
    }
} else {
    die("Không có sản phẩm để sửa.");
}

// Lấy danh mục sản phẩm
$cats = $conn->query("SELECT * FROM category");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $price = intval($_POST['price']);
    $quantity = intval($_POST['quantity']);
    $idcategory = intval($_POST['idcategory']);

    // Cập nhật sản phẩm
    $sql = "UPDATE products SET name='$name', price=$price, quantity=$quantity, idcategory=$idcategory WHERE id=$productId";
    
    if ($conn->query($sql)) {
        echo "<div class='alert alert-success'>Cập nhật thành công! 2s để chuyển hướng</div>";
        header("Refresh:2; url=index.php");
    } else {
        echo "<div class='alert alert-danger'>Lỗi: " . $conn->error . "</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Sửa sản phẩm</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container py-4">
    <h1 class="mb-4">Sửa sản phẩm</h1>
    <form method="post">
        <div class="mb-3">
            <label class="form-label">Tên sản phẩm</label>
            <input type="text" name="name" class="form-control" value="<?php echo $product['name']; ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Giá</label>
            <input type="number" name="price" class="form-control" value="<?php echo $product['price']; ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Số lượng</label>
            <input type="number" name="quantity" class="form-control" value="<?php echo $product['quantity']; ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Danh mục</label>
            <select name="idcategory" class="form-select">
                <?php while ($c = $cats->fetch_assoc()) { ?>
                    <option value="<?php echo $c['id']; ?>" <?php echo $c['id'] == $product['idcategory'] ? 'selected' : ''; ?>>
                        <?php echo $c['name']; ?>
                    </option>
                <?php } ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Cập nhật</button>
        <a href="index.php" class="btn btn-secondary">Quay lại</a>
    </form>
</body>
</html>
