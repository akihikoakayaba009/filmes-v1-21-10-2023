<?php 
require_once $_SERVER['DOCUMENT_ROOT'].'/autoload/user_autoload.php';


if(!isset($_COOKIE['user_hash']) OR !verifica_hash_md5($_COOKIE['user_hash']) OR empty(get_user_por_hash($_COOKIE['user_hash']))){
    
    setcookie("user_hash", '', -1, "/");
    if(isset($_GET['ajax'])){
       die(json_encode(array("status" => "login")));
    }
    die(header("Location:".BASE_USER.'login'));
} 

if(!isset($_COOKIE['perfil_hash']) OR !verifica_hash_md5($_COOKIE['perfil_hash']) OR empty(premium_free_get_perfil_por_hash($_COOKIE['perfil_hash']))){

    setcookie("perfil_hash", '', -1, "/");
    if(isset($_GET['ajax'])){
       die(json_encode(array("status" => "perfil-select")));
    } 
    if(isset($_GET['dir']) && $_GET['dir'] != 'perfil_select'){ 
        die(header("Location:".BASE_USER.'perfil-select'));
    }
} 

$res = get_user_por_hash($_COOKIE['user_hash']);

$user_id             = $res['user_id'];
$user_email          = $res['user_email'];
$user_nome           = $res['user_nome'];
$user_primeiro_nome  = explode(" ", $res['user_nome'])[0];
$user_avatar         = $res['user_avatar'];
$user_hash           = $res['user_hash'];
$user_cadastro       = date("d/m/Y H:i", strtotime($res['user_cadastro']));
$user_premium_data   = $res['user_premium'];
$user_premium        = false;
$user_online         = $res['user_online'];


if(date("Y-m-d H:i:s") < date("Y-m-d H:i:s", strtotime($res['user_premium']))){
    $user_premium = true;
}

$user_logado         = true;

if(isset($_COOKIE['perfil_hash']) && !empty($_COOKIE['perfil_hash']) && !empty(premium_free_get_perfil_por_hash($_COOKIE['perfil_hash']))){

    $perfil              = premium_free_get_perfil_por_hash($_COOKIE['perfil_hash']);
    $perfil_avatar       = $perfil['perfil_avatar'];
    $perfil_apelido      = $perfil['perfil_apelido']; 
    $perfil_hash         = $perfil['perfil_hash']; 
    $perfil_user_id      = $perfil['perfil_user_id'];
    $perfil_user_email   = $perfil['perfil_user_email'];
    $perfil_id           = $perfil['perfil_id']; 

}