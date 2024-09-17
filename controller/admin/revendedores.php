<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/controller/admin/admin_controller.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/lib/vendor/phpmailer/templates/templates_email.php'; 

if(isset($_POST['acao'])){

    // ADICIONAR
    if($_POST['acao'] == 'adicionar-revendedor'){


        if(!isset($_POST['revendedor_nome']) OR empty($_POST['revendedor_nome']) OR 
           !isset($_POST['revendedor_email']) OR empty($_POST['revendedor_email']) OR 
           !isset($_POST['revendedor_senha']) OR empty($_POST['revendedor_senha']) OR 
           !isset($_POST['revendedor_confirma_senha']) OR empty($_POST['revendedor_confirma_senha']) OR
           !isset($_FILES['revendedor_avatar']) OR !isset($_POST['revendedor_whatsapp']) OR
           !isset($_POST['revendedor_telegram']) OR !isset($_POST['revendedor_instagram']) OR 
           !isset($_POST['revendedor_creditos'])){
            die_error("Preencha todos os campos.");
        } 

        $revendedor_nome      = trim(ucwords($_POST['revendedor_nome']));
        $revendedor_email     = strtolower(trim($_POST['revendedor_email']));
        $revendedor_senha     = md5(md5($_POST['revendedor_senha']));
        $revendedor_avatar    = SITE_AVATAR;
        $revendedor_whatsapp  = NULL;
        $revendedor_telegram  = NULL;
        $revendedor_instagram = NULL;
        $revendedor_creditos  = $_POST['revendedor_creditos'];
        $revendedor_online    = NULL;
        $revendedor_hash      = gerar_hash_sessao();

        if(!valida_nome($revendedor_nome)){
            die_error("O nome é inválido.");
        }
        
        if(!filter_var($revendedor_email, FILTER_VALIDATE_EMAIL)){
            die_error("O email é inválido.");
        }

        if($_POST['revendedor_senha'] != $_POST['revendedor_confirma_senha']){
            die_error("As senhas não estão iguais.");
        }
            
        if(!valida_senha($_POST['revendedor_senha'])){
            die_error("A senha deve conter 6 ou mais caractéres.");
        }

        if(!empty($_FILES['revendedor_avatar']['tmp_name'])){
            $img               = upload_imagem($_FILES['revendedor_avatar']);
            $revendedor_avatar = $img['name'];
            $tmp               = $img['tmp_name'];
            $caminho           = BASE_IMAGES_AVATARS_PATCH.$revendedor_avatar;

        }

        if(verificar_email_existe($revendedor_email) > 0){
            die_error("O email já está em uso."); 
        }

        if(!empty($_POST['revendedor_whatsapp'])){
            if(!valida_whatsapp($_POST['revendedor_whatsapp'])){
                die_error("O whatsapp é inválido");
            }
            $revendedor_whatsapp = $_POST['revendedor_whatsapp'];
        }

        if(!empty($_POST['revendedor_telegram'])){
            if(!valida_whatsapp($_POST['revendedor_telegram'])){
                die_error("O telegram é inválido");
            }
            $revendedor_telegram = $_POST['revendedor_telegram'];
        }

        if(!empty($_POST['revendedor_instagram'])){
            if(!filter_var($_POST['revendedor_instagram'], FILTER_VALIDATE_URL)){
                die_error("A url do instagram é inválida.");
            }
            $revendedor_instagram = $_POST['revendedor_instagram'];
        }

        if(!is_numeric($revendedor_creditos) OR $revendedor_creditos < 0){
            die_error("A quantidade de créditos deve ser maior ou igual a zero.");
        }

        if(!admin_cadastrar_revendedor($revendedor_nome, $revendedor_email, $revendedor_senha, $revendedor_avatar, 
                                       $revendedor_whatsapp, $revendedor_telegram, $revendedor_instagram, 
                                       $revendedor_creditos, $revendedor_online,$revendedor_hash)){
            die_error("Não foi possível adicionar.");                        
        }

        $mensagem_email  = template_revendedor_criacao_conta($revendedor_nome,$revendedor_email,$_POST['revendedor_senha']);

        if(!enviar_email($revendedor_email, $revendedor_nome, SITE_NOME . " Criação de conta revendedor ",$mensagem_email)){
           die_success_redirect_after_confirm("O revendedor foi adicionado. Mais não foi possível enviar um email com as informações de login.", BASE_ADMIN.'revendedores/listar');
        }
        if($revendedor_avatar != SITE_AVATAR && isset($caminho)){ 
            move_uploaded_file($tmp, $caminho);
        } 

        die_success_redirect_after_confirm("O revendedor foi adicionado. Um email com as informações de login foi enviado.", BASE_ADMIN.'revendedores/listar');


    }

    // ADICIONAR
    if($_POST['acao'] == 'editar-creditos'){
        if(!isset($_POST['revendedor_id']) OR !intval($_POST['revendedor_id']) OR 
           !isset($_POST['revendedor_creditos'])){
            die_error("Preencha todos os campos.");
        }

        $res = admin_get_revendedor_por_id($_POST['revendedor_id']);
        
        if(empty($res)){
            die_error("Revendedor não encontrado.");
        } 

        if(!is_numeric($_POST['revendedor_creditos']) OR $_POST['revendedor_creditos'] < 0){
            die_error("A quantidade de créditos deve ser maior ou igual a zero.");
        } 

        $revendedor_id       = $_POST['revendedor_id']; 
        $revendedor_email    = $res['revendedor_email'];
        $revendedor_creditos = $_POST['revendedor_creditos'];

        if(!admin_editar_creditos_revendedor($revendedor_creditos, $revendedor_email, $revendedor_id)){
            die_error("Não foi possível editar.");
        }

        die_success_redirect_after_confirm("Informações Salvas.", BASE_ADMIN.'revendedores/perfil/'.$revendedor_id);
 
    } 


    // ADICIONAR
    if($_POST['acao'] == 'excluir-revendedor'){
        if(!isset($_POST['revendedor_id']) OR !intval($_POST['revendedor_id'])){
            die_error("Revendedor não encontrado.");
        }

        $res = admin_get_revendedor_por_id($_POST['revendedor_id']);
        
        if(empty($res)){
            die_error("Revendedor não encontrado.");
        } 

        $revendedor_id = $_POST['revendedor_id']; 
        $revendedor_email = $res['revendedor_email'];
        $revendedor_avatar = $res['revendedor_avatar'];
        
        $caminho = BASE_IMAGES_AVATARS_PATCH.$revendedor_avatar;

        if(!admin_excluir_revendedor($revendedor_id, $revendedor_email)){
            die_error("Não foi possível excluir.");
        }

        if($revendedor_avatar != SITE_AVATAR){
            excluir_imagem($caminho);
        }

        die_reload();

    }




}