<?php
include 'db.php';

// Lấy danh mục
$cats = $conn->query("SELECT * FROM category");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $price = intval($_POST['price']);
    $quantity = intval($_POST['quantity']);
    $idcategory = intval($_POST['idcategory']);

    $sql = "INSERT INTO products(name, price, quantity, idcategory)
            VALUES ('$name', $price, $quantity, $idcategory)";
    if ($conn->query($sql)) {
        echo "<div class='alert alert-success'>Thêm thành công! 2s để chuyển hướng</div>";
        header("Refresh:2;  url=index.php"); 
    } else {
        echo "<div class='alert alert-danger'>Lỗi: " . $conn->error . "</div>";
    }
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Thêm sản phẩm</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container py-4">
    <h1 class="mb-4">Thêm sản phẩm mới</h1>
    <form method="post">
        <div class="mb-3">
            <label class="form-label">Tên sản phẩm</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Giá</label>
            <input type="number" name="price" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Số lượng</label>
            <input type="number" name="quantity" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Danh mục</label>
            <select name="idcategory" class="form-select">
                <?php while ($c = $cats->fetch_assoc()) { ?>
                    <option value="<?php echo $c['id']; ?>"><?php echo $c['name']; ?></option>
                <?php } ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Thêm</button>
        <a href="index.php" class="btn btn-secondary">Quay lại</a>
    </form>
</body>
</html>