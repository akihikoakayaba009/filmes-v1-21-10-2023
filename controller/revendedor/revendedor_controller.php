<?php 
require_once $_SERVER['DOCUMENT_ROOT'].'/autoload/revendedor_autoload.php';

if(!isset($_COOKIE['revendedor_hash']) OR !verifica_hash_md5($_COOKIE['revendedor_hash']) OR empty(get_revendedor_por_hash($_COOKIE['revendedor_hash']))){
    
    setCookie("revendedor_hash", '', -1 , '/');
    if(isset($_GET['ajax'])){
       die(json_encode(array("status" => "login")));
    }
    die(header("Location:".BASE_REVENDEDOR.'login'));
} 

$rev = get_revendedor_por_hash($_COOKIE['revendedor_hash']);

$revendedor_id             = $rev['revendedor_id'];
$revendedor_email          = $rev['revendedor_email'];
$revendedor_nome           = $rev['revendedor_nome'];
$revendedor_primeiro_nome  = explode(" ", $rev['revendedor_nome'])[0];
$revendedor_avatar         = $rev['revendedor_avatar'];
$revendedor_hash           = $rev['revendedor_hash'];
$revendedor_cadastro       = date("d/m/Y H:i", strtotime($rev['revendedor_cadastro']));

$revendedor_whatsapp       = $rev['revendedor_whatsapp'];
$revendedor_instagram      = $rev['revendedor_instagram'];
$revendedor_telegram       = $rev['revendedor_telegram'];

$revendedor_creditos       = $rev['revendedor_creditos'];
