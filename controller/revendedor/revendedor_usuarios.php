<?php 
require_once $_SERVER['DOCUMENT_ROOT'].'/controller/revendedor/revendedor_controller.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/lib/vendor/phpmailer/templates/templates_email.php'; 

if(isset($_POST['acao'])){

    if($_POST['acao'] == 'adicionar-usuario'){
        if(!isset($_POST['user_nome']) OR empty($_POST['user_nome']) OR
           !isset($_POST['user_email']) OR empty($_POST['user_email']) OR
           !isset($_POST['user_senha']) OR empty($_POST['user_senha']) OR
           !isset($_POST['user_confirmar_senha']) OR empty($_POST['user_confirmar_senha']) OR
           !isset($_POST['plano_premium']) OR !intval($_POST['plano_premium'])){
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

        $user_nome    = trim(ucwords($_POST['user_nome']));
        $user_email   = trim(strtolower($_POST['user_email']));
        $user_senha   = md5(md5($_POST['user_senha']));
        $user_avatar  = SITE_AVATAR; 
        $user_premium = date("Y-m-d H:i:s");
        $user_hash    = gerar_hash_sessao();
        $user_online  = date("Y-m-d H:i:s", strtotime("- 2 minutes"));

        if(empty(get_plano_premium_por_id($_POST['plano_premium']))){
            die_error("O plano não existe.");
        }

        $plano_premium = get_plano_premium_por_id($_POST['plano_premium']);
        $premium_data  = premium_free_gerar_data($user_premium, $plano_premium['premium_dias_acesso']); 
        
        if($revendedor_creditos < $plano_premium['premium_consumo_creditos_revendedor']){
            die_error("Créditos insuficientes.");
        }
        
        if(!adicionar_usuario($user_nome, $user_email, $user_senha, $user_avatar, $user_premium, $user_hash, $user_online, $revendedor_id)){
            die_error("Não foi possível adicionar o usuário.");
        }

        $last_id  = $pdo->lastInsertId();
        $res = get_user($last_id, $user_email);

        premium_free_ativar_premium($res['user_id'], $res['user_email'], $premium_data, $plano_premium['premium_id']);
        premium_free_gerar_telas($res['user_id'], $res['user_email'], $plano_premium['premium_telas']);

        $revendedor_creditos = $revendedor_creditos - $plano_premium['premium_consumo_creditos_revendedor'];        
        remover_creditos_revendedor($revendedor_id, $revendedor_email, $revendedor_creditos);    

        $msg_premium    = $plano_premium['premium_telas'] == 1 ?  $plano_premium['premium_titulo'] . ' ' .$plano_premium['premium_telas'] . ' Tela' : $plano_premium['premium_titulo'] . ' ' .$plano_premium['premium_telas'] . ' Telas';
        $mensagem_email = template_revendedor_adicionar_user($user_nome, $user_email, $_POST['user_senha'], $msg_premium, $revendedor_nome);

        if(!enviar_email($res['user_email'], $res['user_nome'], SITE_NOME . " Criação de conta. ",$mensagem_email)){
            die_success_redirect_after_confirm("O usuário foi adicionado. Mais não foi possível enviar as informações de login por email.", BASE_REVENDEDOR);
        }    
        
        die_success_redirect_after_confirm("O usuário foi adicionado. Um email com as informações de acesso foi enviado.", BASE_REVENDEDOR);
    
    }


    //RENOVAR PREMIUM
    if($_POST['acao'] == 'renovar-premium'){
        if(!isset($_POST['user_id']) OR !intval($_POST['user_id']) OR 
           !isset($_POST['user_email']) OR empty($_POST['user_email']) OR 
           !isset($_POST['plano_premium']) OR !intval($_POST['plano_premium'])){
            die_error("Plano ou usuário não encontrados.");
        }

        if(empty(get_plano_premium_por_id($_POST['plano_premium']))){
            die_error("O plano não existe.");
        }

        if(empty(get_user($_POST['user_id'], $_POST['user_email']))){
            die_error("Usuário não encontrado.");
        }

        $res           = get_user($_POST['user_id'], $_POST['user_email']);
        $telas_atual   = premium_free_contar_perfis($res['user_id'], $res['user_email']);
        $plano_premium = get_plano_premium_por_id($_POST['plano_premium']);
        $premium_data  = premium_free_gerar_data($res['user_premium'], $plano_premium['premium_dias_acesso'], $telas_atual , $plano_premium['premium_telas']);
        
        if($revendedor_creditos < $plano_premium['premium_consumo_creditos_revendedor']){
            die_error("Créditos insuficientes.");
        }

        premium_free_ativar_premium($res['user_id'], $res['user_email'], $premium_data, $plano_premium['premium_id']);
        premium_free_gerar_telas($res['user_id'], $res['user_email'], $plano_premium['premium_telas']);

        $revendedor_creditos = $revendedor_creditos - $plano_premium['premium_consumo_creditos_revendedor'];        
        remover_creditos_revendedor($revendedor_id, $revendedor_email, $revendedor_creditos);    
        
        die_success_redirect_after_confirm("O plano premium foi renovado.", BASE_REVENDEDOR);        


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
} 