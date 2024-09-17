<?php

use FontLib\Table\Type\head;

require_once $_SERVER['DOCUMENT_ROOT'].'/autoload/user_autoload.php';

if(isset($_POST['acao'])){

    if(!isset($_POST['user_email']) OR empty($_POST['user_email']) OR
       !isset($_POST['user_senha']) OR empty($_POST['user_senha'])){
        die_error("Preencha todos os campos.");
    }

    if(isset($_COOKIE['user_hash']) && !empty($_COOKIE['user_hash'])){
        die_error("Você já está logado.");
    }

    if(!valida_senha($_POST['user_senha'])){
        die_error("Email ou senha incorretos.");
    }

    $user_email   = strip_tags(trim(addslashes(strtolower($_POST['user_email']))));
    $user_senha   = md5(md5($_POST['user_senha']));

    if(verificar_login_user($user_email, $user_senha) < 1){
        die_error("Email ou senha incorretos.");
    } 

    $res = get_user_por_email_e_senha($user_email, $user_senha);
    
    if(empty($res)){
        die_error("Não foi possível iniciar sessão no momento.");
    }

    $user_hash = $res['user_hash'];

    $perfil_user_id       = $res['user_id'];
    $perfil_user_email    = $res['user_email'];
    $perfil_hash          = gerar_hash_perfil();
    $avatar_perfil_select = avatars_perfis_tela()[rand(0,9)];  

    setcookie("user_hash", $user_hash, strtotime("+ 1 year"), "/"); 

    if(premium_free_contar_perfis($perfil_user_id, $perfil_user_email) < 1){
        premium_free_gerar_perfil("Perfil 1", $avatar_perfil_select, $perfil_user_id, $perfil_user_email, $perfil_hash);
    }

    die_url(BASE_USER.'perfil-select');

}    
