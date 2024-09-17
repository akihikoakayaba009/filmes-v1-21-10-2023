<?php 
require_once $_SERVER['DOCUMENT_ROOT'].'/autoload/admin_autoload.php';

if(isset($_POST['acao'])){
      
    if(!isset($_POST['email']) OR empty($_POST['email']) OR 
       !isset($_POST['senha']) OR empty($_POST['senha'])){
        die_error("Preencha todos os campos.");
    }
    if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
        die_error("Email inválido.");
    }
    if(!valida_senha($_POST['senha'])){
        die_error("Senha Incorreta.");
    } 
    $email = strtolower(trim(addslashes($_POST['email'])));
    $senha = md5_hash($_POST['senha']);

    if(empty(admin_login($email,$senha))){
        die_error("Email ou senha incorretos.");
    } 
    $res  = admin_login($email, $senha);
    $hash = gerar_hash_sessao();  

    if($res['admin_email_confirmado'] != 'sim'){
        $mensagem_email = template_administrador_confirmar_email($res['admin_email'], $_POST['senha'],$res['admin_nome'],$res['admin_responsavel'],$res['admin_hash_confirmacao_email']); 
        if(!enviar_email($res['admin_email'], $res['admin_nome'], SITE_NOME . " Cadastro administrador",$mensagem_email)){
            die_error("Você ainda não confirmou o seu email. Não conseguimos enviar um link de confirmação no momento.");
        }
        die_error("Você ainda não confirmou o seu email. Um novo email com o link de confirmação foi enviado.");
    }

    if(!atualiza_sessao_admin($res['admin_email'],$res['admin_id'],$hash)){
        die_error("Tente novamente mais tarde.");
    }
    $_SESSION['admin_hash'] = $hash;
    die_url(BASE_ADMIN);

}