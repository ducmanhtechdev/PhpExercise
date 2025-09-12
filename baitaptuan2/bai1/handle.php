<?php 

$name = $_POST['name'] ?? ""; 
$year = $_POST['ye1'] ?? "Khong ton tai"; 
$check = $_POST['namecheck'] ?? ""; 
$car = $_POST['cars']; 


echo "Tên của bạn là: $name "; 
echo "Năm sinh là: $year "; 

echo $check; 
echo $car; 
?>