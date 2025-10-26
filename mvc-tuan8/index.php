<?php
// entry point cho mọi dự án
define("ROOT", __DIR__);
include("./controllers/PostController.php");
$PostController = new PostController(); 
$PostController -> show(); 