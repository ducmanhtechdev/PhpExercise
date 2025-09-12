<?php session_start()?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<div class="header">  
    <?php include('menu.php') ?> 
</div>

<?php 
$error = ""; $errorPass = ""; $success = false;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'] ?? ""; 
    $pass = $_POST['pass'] ?? ""; 
    echo $pass; 

    if ($name == "") {
        global $error; 
        $error = "<p style='color:red'>Bạn chưa nhập tên.</p>"; 
    }
    
    if ($pass == "") {
        global $errorPass; 
        $errorPass = "<p style='color:red'>Bạn chưa nhập mật khẩu, vui lòng nhập lại.</p>";
    }

    if (!preg_match('/^[a-zA-Z]+[ ]?[a-zA-Z]+$/', $name)) {
        global $error; 
        $error = "<p style='color:red'>tên phải chứa ký tự chữ cái từ a - z, 0 - 9 ký tự đặc biệt</p>"; 
    }

    if ($pass == "123") {
        $success = true; 
    }
    else {
        global $errorPass; 
        $errorPass = "<p style='color:red'>Mật khẩu sai.</p>"; 
    }


}

?>

<?php if ($success == true)  {
echo "Đăng nhập thành công"; 
setcookie("name", $name, time() + 600);  
header("location: index.php"); 

}
 else {?>


    <h3>Login</h3>
    <form action="login.php" novalidate method="post">
Tên:  <input type="text" name="name" id=""> <br>
<?php echo $error ?> <br>
       Mật Khẩu: <input type="text" name="pass" id=""> <br> 
    <?php echo $errorPass ?> <br> 
       <input type="submit">
    </form>

<?php } ?>

</body>
</html>