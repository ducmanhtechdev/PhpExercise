<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
$dateOFWeek =  date("w") ? "Thứ 6" : "";
$output = $dateOFWeek . ','.  " Ngày " . date("d") . " Tháng " . date('m') . " Năm " . "20" . date("y"); 
echo "Hôm nay là" . $output; 
    ?>
</body>

</html>