<?php 
if(isset($_COOKIE['user_hash']) && !empty($_COOKIE['user_hash'])){

    require_once $_SERVER['DOCUMENT_ROOT'].'/controller/user/user_controller.php';
    
}else{

    $user_logado = false;
    $user_premium = false;
}