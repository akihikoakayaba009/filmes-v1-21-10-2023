<?php 
require_once $_SERVER['DOCUMENT_ROOT'].'/autoload/public_autoload.php';

if(!isset($_GET['premium_id']) OR !intval($_GET['premium_id']) OR empty(get_plano_premium_por_id($_GET['premium_id']))){
    die(header("Location:".BASE_PUBLIC.'/premium'));
}

if(!$user_logado){
    die(header("Location:".BASE_USER.'login'));
}


$res     = get_plano_premium_por_id($_GET['premium_id']);
$url_mp  = processar_pagamento_mp($res['premium_preco'], $res['premium_id'], "Plano Premium", $res['premium_titulo'], $user_nome, $user_email, $user_id);

die(header("Location:".$url_mp));