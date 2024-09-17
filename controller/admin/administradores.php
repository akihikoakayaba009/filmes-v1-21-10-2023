<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/controller/admin/admin_controller.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/lib/vendor/phpmailer/templates/templates_email.php'; 
/* 
  EMAIL TEMPLATES 
*/
if (isset($_POST['acao'])) {
    
   /*
    ======================= ADICIONAR ADMINISTRADOR ==============================
   */
   if($_POST['acao'] == 'adicionar-admin'){
          
       if(!isset($_POST['admin_nome_add']) OR empty($_POST['admin_nome_add']) OR 
          !isset($_POST['admin_email_add']) OR empty($_POST['admin_email_add']) OR
          !isset($_POST['admin_senha_add']) OR empty($_POST['admin_senha_add']) OR
          !isset($_POST['admin_confirma_senha_add']) OR empty($_POST['admin_confirma_senha_add'])){
          die_error("Preencha todos os campos.");
       }

       $admin_nome_add                = trim(addslashes(ucwords($_POST['admin_nome_add'])));
       $admin_email_add               = strtolower(trim(addslashes($_POST['admin_email_add'])));
       $admin_senha_add               = md5_hash($_POST['admin_senha_add']); 
       $admin_avatar_add              = SITE_AVATAR;
       $admin_hash_confirmacao_email  = md5_hash(md5_hash($admin_email_add.$admin_senha_add.time().rand(1000,9999)));

       $admin_celular_add              = NULL;
       $admin_whatsapp_add             = NULL;

       if(!valida_nome($admin_nome_add)){
           die_error("O nome é inválido."); 
       } 
       
       if(!valida_senha($_POST['admin_senha_add'])){
            die_error("A senha deve conter 6 ou mais caractéres.");
       }

       if($_POST['admin_senha_add'] != $_POST['admin_confirma_senha_add']){
           die_error("As senhas não estão iguais.");
       }
       
       if(verificar_email_existe($admin_email_add) > 0){
           die_error("O email já está em uso."); 
       }

       if(isset($_POST['admin_celular_add']) && !empty($_POST['admin_celular_add'])){
           if(!valida_celular($_POST['admin_celular_add'])){
               die_error("O celular é inválido");
           }
           $admin_celular_add = $_POST['admin_celular_add'];
       }

       if(isset($_POST['admin_whatsapp_add']) && !empty($_POST['admin_whatsapp_add'])){
            if(!valida_whatsapp($_POST['admin_whatsapp_add'])){
                die_error("O whatsapp é inválido");
            }
            $admin_whatsapp_add = $_POST['admin_whatsapp_add'];
       }
       
       if(isset($_FILES['admin_avatar_add']['tmp_name']['0']) && !empty($_FILES['admin_avatar_add']['tmp_name']['0'])){
            
        $res = upload_imagem($_FILES['admin_avatar_add']);
        $admin_avatar_add = $res['name']; 
        $img_tmp          = $res['tmp_name'];
 
       }

       if(!adicionar_administrador($admin_nome_add, $admin_email_add, $admin_senha_add,$admin_avatar_add,
                                   $admin_nome,$admin_hash_confirmacao_email,
                                   $admin_celular_add,$admin_whatsapp_add)){
           die_error("Não foi possível adicionar.");
       }
   

       if($admin_avatar_add != SITE_AVATAR){ 
          $caminho = BASE_IMAGES_AVATARS_PATCH.$admin_avatar_add; 
          move_uploaded_file($img_tmp, $caminho);
       } 
       
       $mensagem_email  = template_administrador_confirmar_email($admin_email_add, $_POST['admin_senha_add'],$admin_nome_add,$admin_nome,$admin_hash_confirmacao_email);
       
       if(!enviar_email($admin_email_add, $admin_nome_add, SITE_NOME . " Cadastro conta administrador ",$mensagem_email)){
            die_success_redirect("O administrador foi adicionado. Mais não foi possível enviar as informações de login por email.", BASE_ADMIN.'administradores/listar');
       }

       die_url(BASE_ADMIN.'administradores/listar');

   }

   /*
    ======================= EDITAR INFORMAÇÕES PESSOAIS ==============================
   */
   if($_POST['acao'] == 'admin-informacoes-pessoais'){

    if(empty($_POST['admin_id_edit']) OR !intval($_POST['admin_id_edit']) OR 
       empty($_POST['admin_email_edit']) OR !filter_var($_POST['admin_email_edit'], FILTER_VALIDATE_EMAIL) OR 
       empty(get_admin_por_email_e_id($_POST['admin_id_edit'], $_POST['admin_email_edit']))){
        die_error("Administrador não encontrado.");
    }

    if($admin_id == $_POST['admin_id_edit'] OR $admin_email == $_POST['admin_email_edit']){
        die_error("Acesse o seu perfil. Para editar suas informações pessoais.");
    }

    $admin_email_edit = trim(addslashes($_POST['admin_email_edit']));
    $admin_id_edit    = intval($_POST['admin_id_edit']);


    $a = get_admin_por_email_e_id($admin_id_edit, $admin_email_edit);

    $admin_nome_edit     = trim(addslashes(ucwords($_POST['admin_nome_edit'])));
    $admin_celular_edit  = $a['admin_celular'];
    $admin_whatsapp_edit = $a['admin_whatsapp'];
    $admin_avatar_edit   = $a['admin_avatar'];


    if(isset($_POST['admin_celular_edit']) && !empty($_POST['admin_celular_edit'])){
        if(!valida_celular($_POST['admin_celular_edit'])){
            die_error("O celular é inválido");
        }
        $admin_celular_edit = $_POST['admin_celular_edit'];
    }else{
        $admin_celular_edit = NULL; 
    }

    if(isset($_POST['admin_whatsapp_edit']) && !empty($_POST['admin_whatsapp_edit'])){
         if(!valida_celular($_POST['admin_whatsapp_edit'])){
             die_error("O whatsapp é inválido");
         }
         $admin_whatsapp_edit = $_POST['admin_whatsapp_edit'];
    }else{
         $admin_whatsapp_edit = NULL;
    }
    


    if(isset($_FILES['admin_avatar_edit']['tmp_name']['0']) && !empty($_FILES['admin_avatar_edit']['tmp_name']['0'])){
            
        $res = upload_imagem($_FILES['admin_avatar_edit']);
        $admin_avatar_edit = $res['name']; 
        $img_tmp           = $res['tmp_name'];
 
    }
 
    if(!atualizar_informacoes_pessoais_administrador($admin_nome_edit,$admin_celular_edit,
                                                     $admin_whatsapp_edit,$admin_avatar_edit,
                                                     $admin_id_edit, $admin_email_edit)){
        die_error("Não foi possível editar.");
    }
    if($admin_avatar_edit != $a['admin_avatar']){
        $caminho = BASE_IMAGES_AVATARS_PATCH.$admin_avatar_edit; 
        move_uploaded_file($img_tmp, $caminho);
        
        if($a['admin_avatar'] != SITE_AVATAR){
            $caminho_excluir = BASE_IMAGES_AVATARS_PATCH.$a['admin_avatar'];
            if(file_exists($caminho_excluir)){
                @unlink($caminho_excluir);
            }
        }
    }
    die_success_reload("Informações salvas.");

   }


   /*
    ======================= ALTERAR SENHA ==============================
   */
   if($_POST['acao'] == 'admin-alterar-senha'){

     if(!isset($_POST['admin_senha_edit']) OR empty($_POST['admin_senha_edit']) OR 
        !isset($_POST['admin_confirma_senha_edit']) OR empty($_POST['admin_confirma_senha_edit'])){
        die_error("Informe e confirme a nova senha.");
     } 
    
     if(empty($_POST['admin_id_edit']) OR !intval($_POST['admin_id_edit']) OR 
        empty($_POST['admin_email_edit']) OR !filter_var($_POST['admin_email_edit'], FILTER_VALIDATE_EMAIL) OR 
        empty(get_admin_por_email_e_id($_POST['admin_id_edit'], $_POST['admin_email_edit']))){
            die_error("Administrador não encontrado.");
     }

     if($admin_id == $_POST['admin_id_edit'] OR $admin_email == $_POST['admin_email_edit']){
        die_error("Acesse o seu perfil. Para alterar sua senha.");
     }

     if(!valida_senha($_POST['admin_senha_edit'])){
        die_error("A senha deve conter pelo menos 6 caractéres.");
     }

     if($_POST['admin_senha_edit'] != $_POST['admin_confirma_senha_edit']){
         die_error("As senhas não estão iguais.");
     }
     

     
     $admin_email_edit = trim(addslashes($_POST['admin_email_edit']));
     $admin_id_edit    = intval($_POST['admin_id_edit']);
     $admin_senha_edit = md5_hash($_POST['admin_senha_edit']);

     $a = get_admin_por_email_e_id($admin_id_edit, $admin_email_edit);

     if(!atualizar_senha_administrador($admin_id_edit, $admin_email_edit, $admin_senha_edit)){
         die_error("Não foi possível salvar.");
     }

     die_success_reload("A senha foi alterada.");
    

   }


   //EXCLUIR

   if($_POST['acao'] == 'excluir-administrador'){

        if(!isset($_POST['admin_id']) OR !intval($_POST['admin_id'])){
            die_error("Administrador não encontrado.");
        }

        $a = get_admin($_POST['admin_id']);

        if(empty($a)){
            die_error("Administrador não encontrado.");
        }
 
        if($a['admin_id'] == $admin_id OR $a['admin_email'] == $admin_email){
            die_error("Você não pode excluir sua própria conta.");
        }

        if(!excluir_administrador($a['admin_id'], $a['admin_email'])){
            die_error("Não foi possível excluir.");
        }
        
        if($a['admin_avatar'] != SITE_AVATAR){
            if(file_exists(BASE_IMAGES_AVATARS_PATCH.$a['admin_avatar'])){
                @unlink(BASE_IMAGES_AVATARS_PATCH.$a['admin_avatar']);
            }
        }

        die_reload(); 

   }



}   
