<?php 
require_once $_SERVER['DOCUMENT_ROOT'].'/autoload/revendedor_autoload.php';

if(isset($_POST['acao'])){

    if(!isset($_POST['revendedor_email']) OR empty($_POST['revendedor_email']) OR
       !isset($_POST['revendedor_senha']) OR empty($_POST['revendedor_senha'])){
        die_error("Preencha todos os campos.");
    }

    if(isset($_COOKIE['revendedor_hash']) && !empty($_COOKIE['revendedor_hash'])){
        die_error("Você já está logado.");
    }

    if(!valida_senha($_POST['revendedor_senha'])){
        die_error("Email ou senha incorretos.");
    }

    $revendedor_email   = strip_tags(trim(addslashes(strtolower($_POST['revendedor_email']))));
    $revendedor_senha   = md5(md5($_POST['revendedor_senha']));

    if(verificar_login_revendedor($revendedor_email, $revendedor_senha) < 1){
        die_error("Email ou senha incorretos.");
    } 

    $res = get_revendedor_por_email_e_senha($revendedor_email, $revendedor_senha);
    
    if(empty($res)){ 
        die_error("Não foi possível iniciar sessão no momento.");
    } 

    $revendedor_hash = $res['revendedor_hash'];

    setcookie("revendedor_hash", $revendedor_hash, strtotime("+ 1 year"), "/");

    die_url(BASE_REVENDEDOR);

}    
