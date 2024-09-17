<?php 
require_once $_SERVER['DOCUMENT_ROOT'].'/controller/user/user_controller.php';

setcookie("user_hash", "", -1 , "/");
setcookie("perfil_hash", "", -1 , "/");

die(header("Location:".BASE_USER.'login'));