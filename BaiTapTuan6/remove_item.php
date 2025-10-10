<?php
session_start();

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    if (isset($_SESSION['cart'][$id])) {
        unset($_SESSION['cart'][$id]);
    }
}

// Sau khi xoá → quay về giỏ hàng
header("Location: shopping_cart.php");
exit;
