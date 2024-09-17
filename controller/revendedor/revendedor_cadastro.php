<?php 
require_once $_SERVER['DOCUMENT_ROOT'].'/autoload/revendedor_autoload.php';

if(isset($_POST['acao'])){

    if(!isset($_POST['revendedor_nome']) OR empty($_POST['revendedor_nome']) OR 
       !isset($_POST['revendedor_email']) OR empty($_POST['revendedor_email']) OR
       !isset($_POST['revendedor_senha']) OR empty($_POST['revendedor_senha']) OR 
       !isset($_POST['revendedor_senha_confirma']) OR empty($_POST['revendedor_senha_confirma'])){
        die_error("Preencha todos os campos.");
    }

    if(isset($_COOKIE['revendedor_hash']) && !empty($_COOKIE['revendedor_hash'])){
        die_error("Você já está logado.");
    }

    $revendedor_nome    = strip_tags(addslashes(ucwords($_POST['revendedor_nome'])));
    $revendedor_email   = strip_tags(trim(addslashes(strtolower($_POST['revendedor_email']))));
    $revendedor_senha   = md5(md5($_POST['revendedor_senha']));
    $revendedor_avatar  = SITE_AVATAR;
    $revendedor_hash    = gerar_hash_sessao();

    if(!valida_nome($revendedor_nome)){
        die_error("Informe um nome válido.");
    }

    if(!filter_var($revendedor_email, FILTER_VALIDATE_EMAIL)){
        die_error("Informe um email válido.");
    }

    if($_POST['revendedor_senha'] != $_POST['revendedor_senha_confirma']){
        die_error("As senhas não estão iguais.");
    }

    if(!valida_senha($_POST['revendedor_senha'])){
        die_error("A senha deve conter 6 ou mais caractéres.");
    }

    if(verificar_email_existe($revendedor_email) > 0){
        die_error("O email já está cadastrado.");
    }
    
    if(!revendedor_cadastrar($revendedor_nome, $revendedor_email, $revendedor_senha, $revendedor_avatar, $revendedor_hash)){
        die_error("Não foi possível criar sua conta no momento.");
    }
    
    setcookie("revendedor_hash", $revendedor_hash, strtotime("+ 1 year"), "/");

    die_success_redirect_after_confirm("Sua conta foi criada.", BASE_REVENDEDOR);

}