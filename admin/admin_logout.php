<?php 
require_once $_SERVER['DOCUMENT_ROOT'].'/controller/admin/admin_controller.php';

if(isset($_SESSION['admin_hash']) && !empty($_SESSION['admin_hash'])){
    unset($_SESSION['admin_hash']);
}
session_destroy();

die(header("Location:".BASE_ADMIN.'login'));