<?php 

$idP =  $_POST['idsp']; 
$message1 =  $_POST['message1']; 

$mysqli = new mysqli("localhost","root", '' ,"post");
$sql = "INSERT INTO comment (comment, idP)  VALUES ('$message1', $idP)"; 
$mysqli -> query($sql); 
echo 2; 
if ($mysqli -> connect_errno) {
    
  exit();
}