<?php 
require_once $_SERVER['DOCUMENT_ROOT'].'/controller/user/user_controller.php';

if(isset($_POST['acao'])){

    //ALTERAR SENHA
    if($_POST['acao'] == 'alterar-senha'){
        if(!isset($_POST['senha_atual']) OR empty($_POST['senha_atual']) OR
           !isset($_POST['senha_nova']) OR empty($_POST['senha_nova']) OR
           !isset($_POST['senha_confirma']) OR empty($_POST['senha_confirma'])){
            die_error("Preencha todos os campos.");
        }

        if($_POST['senha_nova'] != $_POST['senha_confirma']){
            die_error("As senhas não estão iguais.");
        }

        if(!valida_senha($_POST['senha_nova'])){
            die_error("A nova senha deve conter 6 ou mais caractéres.");
        }
        $user_senha_atual = md5(md5($_POST['senha_atual']));
        $user_senha_nova  = md5(md5($_POST['senha_nova']));

        $user_hash    = md5(md5(time().rand(1000,9999).md5($user_email.$user_senha_nova).uniqid()));
        $user_hash    = md5(md5($user_hash));

        if(empty(get_user_por_email_e_senha($user_email, $user_senha_atual))){
            die_error("A senha atual está incorreta."); 
        }   

        if(!atualizar_senha_user($user_senha_atual, $user_senha_nova, $user_hash, $user_email, $user_id)){
            die_error("Não foi possível alterar sua senha. Tente novamente.");
        }

        foreach(premium_free_listar_perfis($user_id, $user_email) as $item){
            premium_free_renovar_hash_perfil(gerar_hash_perfil(), $item['perfil_id'], $user_id, $user_email);
        }
        
        setcookie("user_hash", '', -1 , "/");
        die_success_redirect_after_confirm("Sua senha foi alterada. Faça login novamente.", BASE_USER.'login');


    }


}    