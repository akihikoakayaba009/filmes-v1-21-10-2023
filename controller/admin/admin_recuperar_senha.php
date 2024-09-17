<?php 
require_once $_SERVER['DOCUMENT_ROOT'].'/autoload/admin_autoload.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/lib/vendor/phpmailer/templates/templates_email.php';

if(isset($_POST['acao'])){
    
    //RECUPERAR SENHA
    if($_POST['acao'] == 'recuperar-senha-ps1'){
        
        if(!isset($_POST['email']) OR empty($_POST['email'])){
             die_error("Informe o email.");
        }

        if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
            die_error("Email inválido.");
        }
        
        $admin_email = trim(addslashes($_POST['email']));

        $res = get_admin_por_email($admin_email);  

        if(empty($res)){
            die("Email não encontrado.");
        }

        if($res['admin_email_confirmado'] != 'sim'){
            die_error("Seu email não foi confirmado.");
        }

        if(empty(get_servidor_smtp())){
            die_error("Serviço indisponível no momento.");
        }

        $admin_hash_recuperar_senha = md5_hash(md5(time().rand(1000,9999).$res['admin_email']));
        $admin_hash_recuperar_senha_expiracao = date("Y-m-d H:i:s", strtotime("+ 1 days"));

        if(!atulizar_hash_recuperar_senha_admin($admin_hash_recuperar_senha, $admin_hash_recuperar_senha_expiracao, $res['admin_email'], $res['admin_id'])){
            die_error("Não foi possível verificar sua conta no momento.");
        }

        $mensagem_email = template_administrador_recuperar_senha($res['admin_nome'],$admin_hash_recuperar_senha,$admin_hash_recuperar_senha_expiracao);

        if(!enviar_email($admin_email, $res['admin_nome'], SITE_NOME . " Recuperação De Senha",$mensagem_email)){
            die_error("Serviço indisponível no momento.");
        }    
        die_success_redirect("Um email com as instruções foi enviado. Talvez seja necessário aguardar alguns instantes.", BASE_ADMIN);

    }

    //RECUPERAR SENHA
    if($_POST['acao'] == 'recuperar-senha-ps2'){
        if(!isset($_POST['nova_senha']) OR empty($_POST['nova_senha']) OR 
           !isset($_POST['confirma_nova_senha']) OR empty($_POST['confirma_nova_senha']) OR 
           !isset($_POST['admin_hash_recuperar_senha']) OR empty($_POST['admin_hash_recuperar_senha']) OR 
           !isset($_POST['email']) OR empty($_POST['email'])){
           die_error("Preencha todos os campos.");
        }

        if(!verifica_hash_md5($_POST['admin_hash_recuperar_senha']) OR !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
            die_url(BASE_ADMIN);
        }

        if(!valida_senha($_POST['nova_senha'])){
            die_error("A senha deve conter pelo menos 6 caractéres.");
        }

        if($_POST['nova_senha'] != $_POST['confirma_nova_senha']){
            die_error("As senhas não estão iguais.");
        }

        $nova_senha                  = md5_hash($_POST['nova_senha']);
        $email                       = trim(addslashes($_POST['email']));
        $admin_hash_recuperar_senha  = $_POST['admin_hash_recuperar_senha'];

        $res = get_administrador_por_hash_recuperar_senha($admin_hash_recuperar_senha);

        if(empty($res)){
            die_url(BASE_ADMIN);
        }

        if(!alterar_senha_por_recuperacao_administrador($nova_senha, $admin_hash_recuperar_senha, $res['admin_email'], $res['admin_id'])){
            die_error("Não foi possível alterar a sua senha.");
        }

        die_success_redirect("Sua senha foi alterada. Acesse a sua conta.", BASE_ADMIN); 

    } 



}