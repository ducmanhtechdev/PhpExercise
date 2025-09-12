<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<style>

    li {
        display: inline-block;
    }
</style>
    
<ul>
    <li><a href="index.php">HOME</a></li>
    <li><a href="contact.php">CONTACT</a></li>
    <?php  
    if (isset($_COOKIE['name'])) {
        $name = $_COOKIE['name']; 
        echo "Xin chào $name"; 
    }

    else {
    ?>
 <li><a href="login.php">LOGIN</a></li>
    <?php } ?> 
</ul>
</body>
</html>