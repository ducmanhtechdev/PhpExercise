<?php
session_start();
include 'db.php';

// ✅ Nếu người dùng vừa bấm "Mua hàng" từ trang chi tiết
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['idP']);
    $quantity = intval($_POST['quantity']);

    // Nếu chưa có giỏ hàng thì khởi tạo
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    // Nếu sản phẩm đã có trong giỏ thì cộng dồn, chưa có thì thêm mới
    if (isset($_SESSION['cart'][$id])) {
        $_SESSION['cart'][$id] += $quantity;
    } else {
        $_SESSION['cart'][$id] = $quantity;
    }

    // ✅ Redirect lại chính trang giỏ hàng để tránh bị gửi lại form
    header("Location: shopping_cart.php");
    exit;
}

// ✅ Từ đây trở xuống là phần hiển thị giỏ hàng
if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    echo "
    <div class='container text-center mt-5'>
        <h3>😢 Giỏ hàng của bạn đang trống</h3>
        <a href='index.php' class='btn btn-success mt-3'>Tiếp tục mua hàng</a>
    </div>";
    exit;
}

// Lấy danh sách id trong giỏ hàng
$ids = array_keys($_SESSION['cart']);

// Nếu không có id hợp lệ
if (empty($ids)) {
    echo "
    <div class='container text-center mt-5'>
        <h3>Không có sản phẩm hợp lệ trong giỏ hàng 😢</h3>
        <a href='index.php' class='btn btn-success mt-3'>Quay lại mua sắm</a>
    </div>";
    exit;
}

// Ép các id về số nguyên để tránh lỗi SQL injection
$ids = array_map('intval', $ids);
$idList = implode(',', $ids);

// Truy vấn sản phẩm
$sql = "SELECT * FROM products WHERE id IN ($idList)";
$result = $conn->query($sql);

// Nếu truy vấn lỗi → in lỗi ra cho debug
if (!$result) {
    die("⚠️ Lỗi truy vấn SQL: " . $conn->error . "<br><b>Câu lệnh:</b> $sql");
}

$total = 0;
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Giỏ hàng</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light py-4">
<div class="container">
    <h1 class="mb-4 text-center">🛍 Giỏ hàng của bạn</h1>

    <table class="table table-bordered align-middle bg-white shadow-sm">
        <thead class="table-success">
            <tr>
                <th>Ảnh</th>
                <th>Tên sản phẩm</th>
                <th>Giá</th>
                <th>Số lượng</th>
                <th>Thành tiền</th>
                <th>Xóa</th>
            </tr>
        </thead>
        <tbody>
        <?php while ($row = $result->fetch_assoc()): 
            $id = $row['id'];
            $quan = $_SESSION['cart'][$id];
            $thanhtien = $row['price'] * $quan;
            echo $thanhtien; 
            $total += $thanhtien;
        ?>
            <tr>
                <td><img src="<?= $row['image'] ?? 'dt1.webp' ?>" height="60"></td>
                <td><?= htmlspecialchars($row['name']) ?></td>
                <td><?= number_format($row['price']) ?>đ</td>
                <td>
                    <div class="input-group" style="width:120px;">
                        <!-- <button type="button" class="btn btn-outline-secondary btn-sm" onclick="changeQuantity(<?= $id ?>,-1)">−</button> -->
                        <input type="number" id="qty_<?= $id ?>" value="<?= $quan ?>" class="form-control text-center" min="1">
                        <!-- <button type="button" class="btn btn-outline-secondary btn-sm" onclick="changeQuantity(<?= $id ?>,1)">+</button> -->
                    </div>
                </td>
                <td><?= number_format($thanhtien) ?>đ</td>
                <td>
                    <a href="remove_item.php?id=<?= $id ?>" class="btn btn-danger btn-sm">🗑</a>
                </td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>

    <div class="d-flex justify-content-between align-items-center mt-4">
        <h4>Tổng cộng: <span class="text-danger"><?= number_format($total) ?>đ</span></h4>
    </div>
</div>

<script>
function changeQuantity(id, change) {
    const input = document.getElementById('qty_' + id);
    let val = parseInt(input.value) + change;
    if (val < 1) val = 1;
    input.value = val;
    // ông có thể gắn AJAX hoặc reload update_cart.php ở đây nếu muốn
}
</script>
</body>
</html>
