<?php 
require_once $_SERVER['DOCUMENT_ROOT'].'/controller/admin/admin_controller.php';

if(isset($_POST['acao'])){

    // adicionar usuario
    if($_POST['acao'] == 'adicionar-usuario'){

        if(!isset($_POST['user_nome']) OR empty($_POST['user_nome']) OR 
           !isset($_POST['user_email']) OR empty($_POST['user_email']) OR 
           !isset($_POST['plano_premium']) OR !is_numeric($_POST['plano_premium']) OR 
           !isset($_POST['user_senha']) OR empty($_POST['user_senha']) OR 
           !isset($_POST['user_confirmar_senha']) OR empty($_POST['user_confirmar_senha'])){
              die_error("Preencha todos os campos.");
        }

        if(!valida_nome($_POST['user_nome'])){
            die_error("O nome é inválido.");
        }

        if(!filter_var($_POST['user_email'], FILTER_VALIDATE_EMAIL)){
            die_error("O email é inválido.");
        }

        if(strlen($_POST['user_senha']) < 6){
            die_error("A senha deve conter 6 ou mais caractéres.");
        }

        if($_POST['user_senha'] != $_POST['user_confirmar_senha']){
            die_error("As senhas não estão iguais.");
        }

        if(verificar_email_existe($_POST['user_email']) > 0){
            die_error("O email já está cadastrado.");
        }

        if($_POST['plano_premium'] != 0 && intval($_POST['plano_premium'])){
            if(empty(premium_free_listar_planos($_POST['plano_premium']))){
                die_error("O plano premium não foi econtrado.");
            }
            $adicionar_premium = true;
        }else{
            $adicionar_premium = false;
        }

        $user_nome    = trim(ucwords($_POST['user_nome']));
        $user_email   = trim(strtolower($_POST['user_email']));
        $user_senha   = md5(md5($_POST['user_senha']));
        $user_avatar  = SITE_AVATAR;
        $user_premium = date("Y-m-d H:i:s");
        $user_hash    = gerar_hash_sessao();
        $user_online  = date("Y-m-d H:i:s", strtotime("- 2 minutes"));


        if(!adicionar_usuario($user_nome, $user_email, $user_senha, $user_avatar, $user_premium, $user_hash, $user_online)){
            die_error("Não foi possível adicionar.");
        }

        if($adicionar_premium){
          
            $last_id  = $pdo->lastInsertId();

            $res = get_user($last_id, $user_email);
            $user_id = $res['user_id'];
            $user_premium = date("Y-m-d H:i:s", strtotime($res['user_premium']));

            $plano_premium = premium_free_listar_planos($_POST['plano_premium']);
            $premium_data  = premium_free_gerar_data($user_premium, $plano_premium['premium_dias_acesso']);                        
            premium_free_ativar_premium($user_id, $user_email, $premium_data, $plano_premium['premium_id']);
            premium_free_gerar_telas($user_id, $user_email, $plano_premium['premium_telas']);

        }
        die_success_redirect_after_confirm("O usuário foi adicionado.", BASE_ADMIN.'usuarios/listar');
    
    }

    //RENOVAR PREMIUM
    if($_POST['acao'] == 'renovar-premium'){
        if(!isset($_POST['user_id']) OR !intval($_POST['user_id']) OR 
           !isset($_POST['plano_premium'])){
            die_error("Preencha todos os campos.");
        }

        if(empty(get_user_por_id($_POST['user_id']))){
            die_error("O usuário não foi encontrado.");
        }

        $user                  = get_user_por_id($_POST['user_id']);
        $user_id               = $user['user_id'];
        $user_email            = $user['user_email'];
        $user_premium          = date("Y-m-d H:i:s", strtotime($user['user_premium']));
        $user_premium_plano_id = $user['user_premium_plano_id'];

        if($_POST['plano_premium'] == 0){
            $total_perfis = premium_free_contar_perfis($user_id, $user_email);
            premium_free_ativar_premium($user_id, $user_email, date("Y-m-d H:i:s") ,0);
            premium_free_excluir_perfil($user_id, $user_email, $total_perfis); 
            die_success_reload("O premium foi renavado.");
        }

        if(!empty($_POST['plano_premium'])){
            if(empty(get_plano_premium_por_id($_POST['plano_premium']))){
                die_error("O plano não foi encontrado.");
            }
            $plano_premium = get_plano_premium_por_id($_POST['plano_premium']);
            $premium_data  = premium_free_gerar_data($user_premium, $plano_premium['premium_dias_acesso']); 
            premium_free_ativar_premium($user['user_id'], $user['user_email'], $premium_data, $plano_premium['premium_id']);
            premium_free_gerar_telas($user['user_id'], $user['user_email'], $plano_premium['premium_telas']); 
            die_success_reload("O premium foi renavado.");
        }

    }  

    //ALTERAR SENHA
    if($_POST['acao'] == 'alterar-senha'){
        if(!isset($_POST['user_id']) OR !intval($_POST['user_id']) OR
           !isset($_POST['senha_nova']) OR empty($_POST['senha_nova']) OR 
           !isset($_POST['senha_confirma']) OR empty($_POST['senha_confirma'])){
            die_error("Preencha todos os campos.");
        }

        if(empty(get_user_por_id($_POST['user_id']))){
            die_error("O usuário não foi encontrado.");
        }

        if(strlen($_POST['senha_nova']) < 6){
            die_error("A senha deve conter 6 ou mais caractéres.");
        }

        if($_POST['senha_nova'] != $_POST['senha_confirma']){
            die_error("As senhas não estão iguais.");
        }

        $user                  = get_user_por_id($_POST['user_id']);
        $user_id               = $user['user_id'];
        $user_email            = $user['user_email'];
        $user_senha            = md5(md5($_POST['senha_nova']));
        $user_hash             = gerar_hash_sessao();
        

        if(!alterar_senha_user($user_senha, $user_hash, $user_id, $user_email)){
            die_error("Não foi possível alterar. Tente novamente.");
        }

        foreach(premium_free_listar_perfis($user_id, $user_email) as $item){
            premium_free_renovar_hash_perfil(gerar_hash_perfil(), $item['perfil_id'], $user_id, $user_email);
        }

        die_success_reload("A senha do usuário foi alterada.");


        
    }

    //EXCLUIR USUARIO
    if($_POST['acao'] == 'excluir-usuario'){
        if(!isset($_POST['user_id']) OR !intval($_POST['user_id'])){
            die_error("O usuário não foi encontrado.");
        }
        
        if(empty(get_user_por_id($_POST['user_id']))){
            die_error("O usuário não foi encontrado.");
        }

        $res = get_user_por_id($_POST['user_id']);

        $user_id    = $res['user_id'];
        $user_email = $res['user_email'];

        if(!excluir_usuario($user_id, $user_email)){
            die_error("Não foi possível excluir.");
        }

        premium_free_excluir_perfil($user_id, $user_email, 0); 

        die_reload();

    }

}