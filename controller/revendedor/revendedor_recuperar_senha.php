<?php 
require_once $_SERVER['DOCUMENT_ROOT'].'/autoload/revendedor_autoload.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/lib/vendor/phpmailer/templates/templates_email.php';



if(isset($_POST['acao'])){

    if($_POST['acao'] == 'recuperar-senha-ps1'){

        if(!isset($_POST['revendedor_email']) OR empty($_POST['revendedor_email'])){
            die_error("Informe o seu email.");
        }

        if(isset($_COOKIE['revendedor_hash']) && !empty($_COOKIE['revendedor_hash'])){
            die_error("Você já está logado.");
        }
 
        $revendedor_email   = strip_tags(trim(addslashes(strtolower($_POST['revendedor_email']))));

        if(empty(get_servidor_smtp())){
            die_error("Serviço indisponível no momento.");
        }

        $res = get_revendedor_por_email($revendedor_email);
        
        if(empty($res)){
            die_error("O email não foi encontrado.");
        }

        $revendedor_hash_recuperar_senha = md5(md5_hash(md5(time().rand(1000,9999).$res['revendedor_email'].$res['revendedor_senha'])));
        $revendedor_hash_recuperar_senha_expiracao = date("Y-m-d H:i:s", strtotime("+ 1 days"));

        if(!atulizar_hash_recuperar_senha_revendedor($revendedor_hash_recuperar_senha, $revendedor_hash_recuperar_senha_expiracao, $res['revendedor_email'], $res['revendedor_id'])){
            die_error("Não foi possível verificar sua conta no momento.");
        }

        $mensagem_email = template_revendedor_recuperar_senha($res['revendedor_nome'],$revendedor_hash_recuperar_senha,$revendedor_hash_recuperar_senha_expiracao);

        if(!enviar_email($res['revendedor_email'], $res['revendedor_nome'], SITE_NOME . " Recuperação De Senha",$mensagem_email)){
            die_error("Serviço indisponível no momento.");
        }    
        die_success_redirect("Um email com as instruções foi enviado. Talvez seja necessário aguardar alguns instantes.", BASE_REVENDEDOR.'login');


    }

    if($_POST['acao'] == 'recuperar-senha-ps2'){
        
        if(!isset($_POST['revendedor_senha']) OR empty($_POST['revendedor_senha']) OR 
           !isset($_POST['revendedor_senha_confirma']) OR empty($_POST['revendedor_senha_confirma']) OR 
           !isset($_POST['revendedor_hash_recuperar_senha']) OR empty($_POST['revendedor_hash_recuperar_senha']) OR 
           !verifica_hash_md5($_POST['revendedor_hash_recuperar_senha'])){

            die_error("Informe e confirme a nova senha.");
        }

        if(isset($_COOKIE['revendedor_hash']) && !empty($_COOKIE['revendedor_hash'])){
            die_error("Você já está logado.");
        }

        if($_POST['revendedor_senha'] != $_POST['revendedor_senha_confirma']){
            die_error("As senhas não estão iguais.");
        }

        if(!valida_senha($_POST['revendedor_senha'])){
            die_error("A senha deve conter 6 ou mais caractéres.");
        }

        $revendedor_hash_recuperar_senha = $_POST['revendedor_hash_recuperar_senha'];

        $res = get_revendedor_por_hash_recuperar_senha($revendedor_hash_recuperar_senha);

        if(empty($res)){
            die_error_redirect("Token expirado. Acesse a página esqueci minha senha para receber um novo link.", BASE_REVENDEDOR.'recuperar-senha-ps-1');
        }
        
        $revendedor_senha   = md5(md5($_POST['revendedor_senha']));
        $revendedor_hash    = md5(md5(time().rand(1000,9999).md5($res['revendedor_email'].$revendedor_senha).uniqid()));
        $revendedor_hash    = md5(md5($revendedor_hash));

        if(!atualizar_senha_hash_recuperar($revendedor_senha, $revendedor_hash, $revendedor_hash_recuperar_senha, $res['revendedor_email'], $res['revendedor_id'])){
            die_error("Não foi possível alterar sua senha. Peça um novo link ou tente mais tarde.");
        }

        die_success_redirect_after_confirm("Sua senha foi alterada. Acesse a sua conta.", BASE_REVENDEDOR.'login');

    }

}    
