<?php 
require_once $_SERVER['DOCUMENT_ROOT'].'/autoload/user_autoload.php';

if(isset($_POST['acao'])){

    if(!isset($_POST['user_nome']) OR empty($_POST['user_nome']) OR 
       !isset($_POST['user_email']) OR empty($_POST['user_email']) OR
       !isset($_POST['user_senha']) OR empty($_POST['user_senha']) OR 
       !isset($_POST['user_senha_confirma']) OR empty($_POST['user_senha_confirma'])){
        die_error("Preencha todos os campos.");
    }

    if(isset($_COOKIE['user_hash']) && !empty($_COOKIE['user_hash'])){
        die_error("Você já está logado.");
    }

    $user_nome    = strip_tags(addslashes(ucwords($_POST['user_nome'])));
    $user_email   = strip_tags(trim(addslashes(strtolower($_POST['user_email']))));
    $user_senha   = md5(md5($_POST['user_senha']));
    $user_avatar  = SITE_AVATAR;
    $user_hash    = md5(md5(time().rand(1000,9999).md5($user_email.$user_senha).uniqid()));
    $user_hash    = md5(md5($user_hash));

    if(!valida_nome($user_nome)){
        die_error("Informe um nome válido.");
    }

    if(!filter_var($user_email, FILTER_VALIDATE_EMAIL)){
        die_error("Informe um email válido.");
    }

    if($_POST['user_senha'] != $_POST['user_senha_confirma']){
        die_error("As senhas não estão iguais.");
    }

    if(!valida_senha($_POST['user_senha'])){
        die_error("A senha deve conter 6 ou mais caractéres.");
    }

    if(verificar_email_existe($user_email) > 0){
        die_error("O email já está cadastrado.");
    }
    
    if(!user_cadastrar($user_nome, $user_email, $user_senha, $user_avatar, $user_hash)){
        die_error("Não foi possível criar sua conta no momento.");
    }

    $perfil_user_id       = $pdo->lastInsertId();
    $perfil_user_email    = $user_email;
    $perfil_hash          = gerar_hash_perfil();
    $avatar_perfil_select = avatars_perfis_tela()[rand(0,9)];  

    setcookie("user_hash", $user_hash, strtotime("+ 1 year"), "/"); 

    premium_free_gerar_perfil("Perfil 1", $avatar_perfil_select, $perfil_user_id, $perfil_user_email, $perfil_hash);

    die_success_redirect_after_confirm("Sua conta foi criada. Aproveite o nosso site!", BASE_USER.'perfil-select');

}