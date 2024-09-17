<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/controller/admin/admin_controller.php';


/*
    ======================= ADMIN PERFIL ==============================
*/

if(isset($_POST['acao'])){
    
    //EDITAR INFORMAÇÕES PESSOAIS
    if($_POST['acao'] == 'admin-editar-perfil'){
           if(!isset($_POST['admin_nome']) OR empty($_POST['admin_nome'])){
               die_error("O nome é obrigatório.");
           }

           if(isset($_POST['admin_celular']) && !empty($_POST['admin_celular'])){
               if(!valida_celular($_POST['admin_celular'])){
                    die_error("O celular é inválido");
               }
               $admin_celular = $_POST['admin_celular'];
            }else{
                $admin_celular = NULL; 
            }

            if(isset($_POST['admin_telefone']) && !empty($_POST['admin_telefone'])){
                if(!valida_telefone($_POST['admin_telefone'])){
                     die_error("O telefone é inválido");
                }
                $admin_telefone = $_POST['admin_telefone'];
             }else{
                 $admin_telefone = NULL; 
             }

             if(isset($_POST['admin_whatsapp']) && !empty($_POST['admin_whatsapp'])){
                if(!valida_whatsapp($_POST['admin_whatsapp'])){
                     die_error("O whatsapp é inválido");
                }
                $admin_whatsapp = $_POST['admin_whatsapp'];
             }else{
                 $admin_whatsapp = NULL; 
             }
             $admin_nome_atual = trim(addslashes(ucwords($admin_nome))); 
             $admin_nome       = trim(addslashes(ucwords($_POST['admin_nome'])));
             $admin_avatar_atual = $admin_avatar;

           

             if(isset($_FILES['admin_avatar']['tmp_name']['0']) && !empty($_FILES['admin_avatar']['tmp_name']['0'])){
            
                $res = upload_imagem($_FILES['admin_avatar']);
                $admin_avatar = $res['name']; 
                $img_tmp      = $res['tmp_name'];
         
             }

             if(!admin_editar_informacoes_pessoais($admin_nome, $admin_celular, $admin_telefone, 
                                                   $admin_whatsapp, $admin_avatar, $admin_id, $admin_email)){
                die_error("Não foi possível salvar.");
             }

            if($admin_avatar_atual != $admin_avatar){
                $caminho = BASE_IMAGES_AVATARS_PATCH.$admin_avatar;
                move_uploaded_file($img_tmp,$caminho);
                if($admin_avatar_atual != SITE_AVATAR && $admin_avatar_atual != 'avatar.png'){
                    $caminho_excluir = BASE_IMAGES_AVATARS_PATCH.$admin_avatar_atual;
                    if(file_exists($caminho_excluir)){
                        @unlink($caminho_excluir);
                    }
                } 
            }
            atualizar_nome_admin_responsavel($admin_nome, $admin_nome_atual);
            die_success_reload("Informações salvas."); 

    }
 
    
    //ALTERAR SENHA
    if($_POST['acao'] == 'admin-alterar-senha'){
        if(!isset($_POST['senha_atual']) OR empty($_POST['senha_atual']) OR
           !isset($_POST['senha_nova']) OR empty($_POST['senha_nova']) OR 
           !isset($_POST['senha_confirma']) OR empty($_POST['senha_confirma'])){
           die_error("Preencha todos os campos.");    
        }

        if(!valida_senha($_POST['senha_nova'])){
            die_error("A nova senha deve conter 6 ou mais caractéres.");
        }

        if($_POST['senha_nova'] != $_POST['senha_confirma']){
            die_error("As senhas não estão iguais.");
        }

        $admin_senha_atual = md5_hash($_POST['senha_atual']);
        $admin_senha_nova  = md5_hash($_POST['senha_nova']);

        if(get_senha_admin_verificar($admin_id, $admin_email, $admin_senha_atual) < 1){
            die_error("A senha atual está incorreta.");
        } 

        if($_POST['senha_atual'] == $_POST['senha_nova']){
            die_error("A nova senha dever ser diferente da senha atual.");
        }

        if(!atualizar_senha_admin($admin_id, $admin_email, $admin_senha_nova)){
            die_error("Não foi possível salvar.");
        }
        unset($_SESSION['admin_hash']);
        session_destroy();
        die_success_redirect("Sua senha foi alterada. Acesse sua conta novamente.",BASE_ADMIN.'login'); 

    } 

}