<?php 
require_once $_SERVER['DOCUMENT_ROOT'].'/config/config.php';

if(!isset($_SESSION['admin_hash']) OR 
   empty($_SESSION['admin_hash'])){
   $_SESSION['admin_hash'] = null;
   unset($_SESSION['admin_hash']); 
   if(isset($_GET['ajax'])){
      die(json_encode(array("status" => "login")));
   }else{
      die(header("Location:".BASE_ADMIN.'login'));
   }
}

if(!preg_match("/^[a-fA-F0-9]*$/", $_SESSION['admin_hash']) OR strlen($_SESSION['admin_hash']) != 32){
   $_SESSION['admin_hash'] = null;
   unset($_SESSION['admin_hash']); 
   if(isset($_GET['ajax'])){
      die(json_encode(array("status" => "login")));
   }else{
      die(header("Location:".BASE_ADMIN.'login'));
   }
} 
 

require_once $_SERVER['DOCUMENT_ROOT'].'/autoload/admin_autoload.php';

if(empty(get_admin_por_hash($_SESSION['admin_hash']))){
   $_SESSION['admin_hash'] = null;
   unset($_SESSION['admin_hash']); 
   if(isset($_GET['ajax'])){
      die("login");
   }else{
      die(header("Location:".BASE_ADMIN.'login'));
   }
}  

$arr_admin           = get_admin_por_hash($_SESSION['admin_hash']);

$admin_email         = $arr_admin['admin_email'];
$admin_id            = $arr_admin['admin_id']; 

$admin_nome          = $arr_admin['admin_nome'];

$admin_primeiro_nome = count(explode(" ", $arr_admin['admin_nome'])) > 1 ? explode(" ", $arr_admin['admin_nome'])[0] : $arr_admin['admin_nome'] ;

$admin_avatar        = $arr_admin['admin_avatar'];

$admin_celular       = $arr_admin['admin_celular'];
$admin_whatsapp      = $arr_admin['admin_whatsapp'];
$admin_online        = $arr_admin['admin_online'];
$admin_permissao     = !empty($arr_admin['admin_permissao']) ? explode(",", $arr_admin['admin_permissao']) : array();