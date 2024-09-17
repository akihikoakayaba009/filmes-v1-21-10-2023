<?php 
require_once $_SERVER['DOCUMENT_ROOT'].'/controller/revendedor/revendedor_controller.php';

setcookie("revendedor_hash", "", -1 , "/");

die(header("Location:".BASE_REVENDEDOR.'login'));