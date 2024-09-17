<?php 
require_once $_SERVER['DOCUMENT_ROOT'].'/controller/revendedor/revendedor_controller.php';

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
        $revendedor_senha_atual = md5(md5($_POST['senha_atual']));
        $revendedor_senha_nova  = md5(md5($_POST['senha_nova']));
        if(empty(get_revendedor_por_email_e_senha($revendedor_email, $revendedor_senha_atual))){
            die_error("A senha atual está incorreta.");
        }   

        if(!atualizar_senha_revendedor($revendedor_senha_atual, $revendedor_senha_nova, $revendedor_email, $revendedor_id)){
            die_error("Não foi possível alterar sua senha. Tente novamente.");
        }
        setcookie("revendedor_hash", "", -1 , "/");
        die_success_redirect_after_confirm("Sua senha foi alterada. Faça login novamente.", BASE_REVENDEDOR.'login');

    }


    if($_POST['acao'] == 'editar-perfil'){
        if(!isset($_POST['revendedor_nome']) OR !isset($_POST['revendedor_whatsapp']) OR
           !isset($_POST['revendedor_telegram']) OR !isset($_POST['revendedor_instagram'])){
            die_error("Informações incompletas. Tente novamente.");
        }

        if(empty($_POST['revendedor_nome'])){
            die_error("O nome é obrigatório.");
        }

        if(!valida_nome($_POST['revendedor_nome'])){
            die_error("O nome é inválido.");
        }

        $revendedor_nome         = ucwords($_POST['revendedor_nome']);
        $revendedor_whatsapp     = NULL;
        $revendedor_telegram     = NULL;
        $revendedor_instagram    = NULL;
        $revendedor_avatar_atual = $revendedor_avatar;

        if(!empty($_POST['revendedor_whatsapp'])){
            if(!valida_whatsapp($_POST['revendedor_whatsapp'])){
                die_error("O whatsapp é inválido.");
            }
            $revendedor_whatsapp = $_POST['revendedor_whatsapp'];
        }

        if(!empty($_POST['revendedor_telegram'])){
            if(!valida_whatsapp($_POST['revendedor_telegram'])){
                die_error("O telegram é inválido.");
            }
            $revendedor_telegram = $_POST['revendedor_telegram'];
        }

        if(!empty($_POST['revendedor_instagram'])){
            if(!filter_var($_POST['revendedor_instagram'], FILTER_VALIDATE_URL)){
                die_error("Informe a url do seu instagram.");
            }
            $revendedor_instagram = $_POST['revendedor_instagram'];
        }

        if(isset($_FILES['avatar']['tmp_name']) && !empty($_FILES['avatar']['tmp_name'])){
            
            $img               = upload_imagem($_FILES['avatar']);
            $revendedor_avatar = $img['name'];
            $tmp               = $img['tmp_name'];

            $caminho = BASE_IMAGES_AVATARS_PATCH.$revendedor_avatar;
            $caminho_excluir = BASE_IMAGES_AVATARS_PATCH.$revendedor_avatar_atual;
        }

        if(!editar_perfil_revendedor($revendedor_nome, $revendedor_whatsapp,
                                     $revendedor_telegram, $revendedor_instagram, $revendedor_avatar,
                                     $revendedor_email, $revendedor_id)){
            die_error("Não foi possível editar. Tente novamente.");
        }

        if($revendedor_avatar != $revendedor_avatar_atual){
            if(isset($caminho)){
                mover_imagem_upload($caminho, $tmp);
                if(file_exists($caminho_excluir) && $revendedor_avatar_atual != SITE_AVATAR){
                    excluir_imagem($caminho_excluir);
                }
            }
        }

        die_success_reload("Seu perfil foi editado.");
        
    }


}