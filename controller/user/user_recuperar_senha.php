<?php 
require_once $_SERVER['DOCUMENT_ROOT'].'/autoload/user_autoload.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/lib/vendor/phpmailer/templates/templates_email.php'; 

if(isset($_POST['acao'])){

    if($_POST['acao'] == 'recuperar-senha-ps1'){

        if(!isset($_POST['user_email']) OR empty($_POST['user_email'])){
            die_error("Informe o seu email.");
        }

        if(isset($_COOKIE['user_hash']) && !empty($_COOKIE['user_hash'])){
            die_error("Você já está logado.");
        }
 
        $user_email   = strip_tags(trim(addslashes(strtolower($_POST['user_email']))));

        if(empty(get_servidor_smtp())){
            die_error("Serviço indisponível no momento.");
        }

        $res = get_user_por_email($user_email);
        
        if(empty($res)){
            die_error("O email não foi encontrado.");
        }

        $user_hash_recuperar_senha = md5(md5_hash(md5(time().rand(1000,9999).$res['user_email'].$res['user_senha'])));
        $user_hash_recuperar_senha_expiracao = date("Y-m-d H:i:s", strtotime("+ 1 days"));

        if(!atulizar_hash_recuperar_senha_user($user_hash_recuperar_senha, $user_hash_recuperar_senha_expiracao, $res['user_email'], $res['user_id'])){
            die_error("Não foi possível verificar sua conta no momento.");
        }

        $mensagem_email = template_user_recuperar_senha($res['user_nome'],$user_hash_recuperar_senha,$user_hash_recuperar_senha_expiracao);

        if(!enviar_email($res['user_email'], $res['user_nome'], SITE_NOME . " Recuperação De Senha",$mensagem_email)){
            die_error("Serviço indisponível no momento.");
        }    
        die_success_redirect("Um email com as instruções foi enviado. Talvez seja necessário aguardar alguns instantes.", BASE_USER.'login');


    }

    if($_POST['acao'] == 'recuperar-senha-ps2'){
        
        if(!isset($_POST['user_senha']) OR empty($_POST['user_senha']) OR 
           !isset($_POST['user_senha_confirma']) OR empty($_POST['user_senha_confirma']) OR 
           !isset($_POST['user_hash_recuperar_senha']) OR empty($_POST['user_hash_recuperar_senha']) OR 
           !verifica_hash_md5($_POST['user_hash_recuperar_senha'])){

            die_error("Informe e confirme a nova senha.");
        }

        if(isset($_COOKIE['user_hash']) && !empty($_COOKIE['user_hash'])){
            die_error("Você já está logado.");
        }

        if($_POST['user_senha'] != $_POST['user_senha_confirma']){
            die_error("As senhas não estão iguais.");
        }

        if(!valida_senha($_POST['user_senha'])){
            die_error("A senha deve conter 6 ou mais caractéres.");
        }

        $user_hash_recuperar_senha = $_POST['user_hash_recuperar_senha'];

        $res = get_user_por_hash_recuperar_senha($user_hash_recuperar_senha);

        if(empty($res)){
            die_error_redirect("Token expirado. Acesse a página esqueci minha senha para receber um novo link.", BASE_USER.'recuperar-senha-ps-1');
        }
        
        $user_senha   = md5(md5($_POST['user_senha']));
        $user_hash    = md5(md5(time().rand(1000,9999).md5($res['user_email'].$user_senha).uniqid()));
        $user_hash    = md5(md5($user_hash));

        if(!atualizar_senha_hash_recuperar($user_senha, $user_hash, $user_hash_recuperar_senha, $res['user_email'], $res['user_id'])){
            die_error("Não foi possível alterar sua senha. Peça um novo link ou tente mais tarde.");
        }

        die_success_redirect_after_confirm("Sua senha foi alterada. Acesse a sua conta.", BASE_USER.'login');

    }

}    
