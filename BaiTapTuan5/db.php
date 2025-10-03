<?php
$host = "localhost";
$user = "root";   // user của MySQL
$pass = "";       // mật khẩu
$db   = "shop";   // tên database

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}
$conn->set_charset("utf8"); // hỗ trợ tiếng Việt
?>