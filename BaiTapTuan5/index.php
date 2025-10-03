<?php
include 'db.php';

$productsPerPage = 5; 

$currentPage = isset($_GET['page']) ? $_GET['page'] : 1; 
$offset = ($currentPage - 1) * $productsPerPage; 




$keyword = "";
if (isset($_GET['search'])) {
    $keyword = $_GET['search'];
    $sql = "SELECT * FROM products WHERE name LIKE '%$keyword%' LIMIT $productsPerPage OFFSET $offset";
    $countSql = "SELECT COUNT(*) AS total FROM products WHERE name LIKE '%$keyword%'";
} else {
    // $sql = "SELECT * FROM products";
    $sql = "SELECT * FROM products"; 
    $countSql = "SELECT COUNT(*) AS total FROM products";

}
$result = $conn->query($sql);
$countResult = $conn->query($countSql);
$totalProducts = $countResult->fetch_assoc()['total'];
$totalPages = ceil($totalProducts / $productsPerPage);

?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Danh sách sản phẩm</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container py-4">
    <h1 class="mb-4">Danh sách sản phẩm</h1>
    <form class="d-flex mb-3" method="get" action="">
        <input class="form-control me-2" type="text" name="search" placeholder="Tìm kiếm..." value="<?php echo $keyword; ?>">
        <button class="btn btn-primary" type="submit">Tìm</button>
    </form>
    <a href="add_product.php" class="btn btn-success mb-3">+ Thêm sản phẩm mới</a>
    <div class="row">
      <?php  if ( $result -> num_rows ==  0) {
            echo "<h2>Không tồn tại sản phẩm</h2>"; 
            }?>
        <?php while ($row = $result->fetch_assoc()) { ?>
            <div class="col-md-3">
                <div class="card mb-4">
                    <div class="card-body">
                        <img src="dt1.webp" alt="" height="100px" >
                        <h5 class="card-title"><?php echo $row['name']; ?></h5>                        
                        <p class="card-text">Giá: <?php echo number_format($row['price']); ?> VND</p>
                        <p class="card-text">Số lượng: <?php echo $row['quantity']; ?></p>
                        <a href="product.php?id=<?php echo $row['id']; ?>" class="btn btn-info btn-sm">Xem chi tiết</a>
                        <a href="edit_product.php?id=<?php echo $row['id']; ?>" class="btn btn-warning">Sửa sản phẩm</a>
                        <a href="delete_product.php?id=<?php echo $row['id']; ?>" class="btn btn-danger">Xóa sản phẩm</a>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>


<nav aria-label="Page navigation">
  <ul class="pagination">
    <?php if ($currentPage > 1): ?>
      <li class="page-item">
        <a class="page-link" href="?search=<?php echo $keyword; ?>&page=<?php echo $page - 1; ?>">Previous</a>
      </li>
    <?php endif; ?>

    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
      <li class="page-item <?php echo ($i == $page) ? 'active' : ''; ?>">
        <a class="page-link" href="?search=<?php echo $keyword; ?>&page=<?php echo $i; ?>"><?php echo $i; ?></a>
      </li>
    <?php endfor; ?>

    <?php if ($currentPage < $totalPages): ?>
      <li class="page-item">
        <a class="page-link" href="?search=<?php echo $keyword; ?>&page=<?php echo $page + 1; ?>">Next</a>
      </li>
    <?php endif; ?>
  </ul>
</nav>

</body>
</html>