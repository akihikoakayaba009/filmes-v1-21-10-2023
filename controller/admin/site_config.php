<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/controller/admin/admin_controller.php';

if (isset($_POST['acao'])) {

    /*
    ======================= EDITAR INFORMAÇÕES DO SITE ==============================
   */
 
    if ($_POST['acao'] == 'editar-informacoes-site') {
        if (!isset($_POST['site_nome']) OR !isset($_POST['site_email']) OR !isset($_POST['site_whatsapp']) OR !isset($_POST['site_facebook']) OR 
            !isset($_POST['site_instagram']) OR !isset($_POST['site_twitter']) OR !isset($_POST['site_youtube']) OR !isset($_POST['site_descricao']) OR 
            !isset($_POST['site_keywords']) OR !isset($_POST['site_token_mp']) OR empty($_POST['site_token_mp']) OR 
            !isset($_POST['site_paginacao']) OR !intval($_POST['site_paginacao']) OR 
            !isset($_POST['site_cache']) OR !intval($_POST['site_cache'])){
            die_error("Alguns campos não foram enviados.");
        }

        if(empty($_POST['site_nome']) OR empty($_POST['site_descricao']) OR empty($_POST['site_keywords'])){
            die_error("O nome do site a descrição e as keywords são obrigatórias.");
        }

        $site_nome       = trim(addslashes($_POST['site_nome']));
        $site_keywords   = trim(addslashes($_POST['site_keywords']));
        $site_descricao  = trim(addslashes($_POST['site_descricao']));
        $site_email      = NULL;
        $site_whatsapp   = NULL;
        $site_facebook   = NULL;
        $site_instagram  = NULL;
        $site_twitter    = NULL;
        $site_youtube    = NULL;
        $site_token_mp   = $_POST['site_token_mp'];
        $site_paginacao  = $_POST['site_paginacao'];
        $site_cache      = $_POST['site_cache'];
        
        if(!empty($_POST['site_email'])){
               if(!filter_var($_POST['site_email'], FILTER_VALIDATE_EMAIL)){
                    die_error("O email é inválido.");
               }
               $site_email = $_POST['site_email'];
        }
        if(!empty($_POST['site_whatsapp'])){
               if(!valida_whatsapp($_POST['site_whatsapp'])){
                    die_error("O whatsapp é inválido.");
               }
               $site_whatsapp = $_POST['site_whatsapp'];
        }
        if(!empty($_POST['site_facebook'])){
            if(!filter_var($_POST['site_facebook'], FILTER_VALIDATE_URL)){
                die_error("O facebook é inválido.");
            }
            $site_facebook = $_POST['site_facebook'];
        }
        if(!empty($_POST['site_instagram'])){
            if(!filter_var($_POST['site_instagram'], FILTER_VALIDATE_URL)){
                die_error("O instagram é inválido.");
            }
            $site_instagram = $_POST['site_instagram'];
        }
        if(!empty($_POST['site_twitter'])){
            if(!filter_var($_POST['site_twitter'], FILTER_VALIDATE_URL)){
                die_error("O twitter é inválido.");
            }
            $site_twitter = $_POST['site_twitter'];
        }
        if(!empty($_POST['site_youtube'])){
            if(!filter_var($_POST['site_youtube'], FILTER_VALIDATE_URL)){
                die_error("O youtube é inválido.");
            }
            $site_youtube = $_POST['site_youtube'];
        }
        if(!empty($_POST['site_descricao'])){
              $site_descricao =  trim(addslashes(htmlspecialchars($_POST['site_descricao'])));
        }
        if(!empty($_POST['site_keywords'])){
               $site_keywords = trim(addslashes(htmlspecialchars($_POST['site_keywords'])));
        } 

        if(!atualizar_informacoes_site($site_nome,$site_keywords,$site_descricao, 
                                       $site_email, $site_whatsapp, $site_facebook,
                                       $site_instagram, $site_twitter, $site_youtube,
                                       $site_token_mp, $site_paginacao, $site_cache)){
            die_error("Não foi possível salvar."); 
        }
        die_success_reload("Informações salvas.");
    }

    /*
    ======================= EDITAR SERVIDOR SMTP ==============================
   */

    if ($_POST['acao'] == 'smtp-editar') {
        if (
            !isset($_POST['smtp_user']) OR empty($_POST['smtp_user']) OR
            !isset($_POST['smtp_senha']) OR empty($_POST['smtp_senha']) OR
            !isset($_POST['smtp_email']) OR empty($_POST['smtp_email']) OR
            !isset($_POST['smtp_porta']) OR empty($_POST['smtp_porta']) OR
            !isset($_POST['smtp_host']) OR empty($_POST['smtp_host'])){
                die_error("Preencha todos os campos.");
        }


        $smtp_user  = addslashes($_POST['smtp_user']);
        $smtp_senha = addslashes($_POST['smtp_senha']);
        $smtp_email = addslashes($_POST['smtp_email']);
        $smtp_porta = addslashes($_POST['smtp_porta']);
        $smtp_host  = addslashes($_POST['smtp_host']);

        //ADICIONAR / EDITAR 
        if (!add_editar_servidor_smtp($smtp_user, $smtp_senha, $smtp_email, $smtp_porta, $smtp_host)) {
            die_error("Não foi possível salvar.");
        }
        die_success_reload("Informações salvas.");
    }

    /*
    ======================= EDITAR IMAGENS DO SITE ==============================
    */
    if($_POST['acao'] == 'editar-site-imagens'){

         //LOGO 
         if(isset($_FILES['site_logo']['tmp_name']) && !empty($_FILES['site_logo']['tmp_name'])){
            
            $res = upload_imagem($_FILES['site_logo']);
            $img_name = $res['name']; 
            $img_tmp  = $res['tmp_name'];

            $caminho = BASE_IMAGES_SYSTEM_PATCH.$img_name;
            
            if(!move_uploaded_file($img_tmp, $caminho)){
                die_error("Não foi possível alterar.");
            }

            if(!atualizar_images_site($img_name, "site_logo")){
                die_error("Não foi possível alterar.");
            }

            excluir_imagem(BASE_IMAGES_SYSTEM_PATCH.SITE_LOGO);
            die_success_reload("Informações salvas.");
        
         }

         //FAVICON

         if(isset($_FILES['site_favicon']['tmp_name']) && !empty($_FILES['site_favicon']['tmp_name'])){
            
            $res = upload_imagem($_FILES['site_favicon']);
            $img_name = $res['name']; 
            $img_tmp  = $res['tmp_name'];

            $caminho = BASE_IMAGES_SYSTEM_PATCH.$img_name;
            if(!move_uploaded_file($img_tmp, $caminho)){
                die_error("Não foi possível alterar.");
            }

            if(!atualizar_images_site($img_name, "site_favicon")){
                die_error("Não foi possível alterar.");
            }
            
            excluir_imagem(BASE_IMAGES_SYSTEM_PATCH.SITE_FAVICON);
            die_success_reload("Informações salvas.");
        
         }

         //AVATAR PADRAO

         if(isset($_FILES['site_avatar']['tmp_name']) && !empty($_FILES['site_avatar']['tmp_name'])){
            
            $res = upload_imagem($_FILES['site_avatar']);
            $img_name = $res['name']; 
            $img_tmp  = $res['tmp_name'];

            $caminho = BASE_IMAGES_AVATARS_PATCH.$img_name;
            if(!move_uploaded_file($img_tmp, $caminho)){
                die_error("Não foi possível alterar.");
            }

            if(!atualizar_images_site($img_name, "site_avatar")){
                die_error("Não foi possível alterar.");
            }
            
            excluir_imagem(BASE_IMAGES_AVATARS_PATCH.SITE_AVATAR);
            die_success_reload("Informações salvas.");
        
         }

         //BACKGROUND
         if(isset($_FILES['site_background']['tmp_name']) && !empty($_FILES['site_background']['tmp_name'])){
            
            $res = upload_imagem($_FILES['site_background']);
            $img_name = $res['name']; 
            $img_tmp  = $res['tmp_name'];


            $caminho = BASE_IMAGES_SYSTEM_PATCH.$img_name;
            if(!move_uploaded_file($img_tmp, $caminho)){
                die_error("Não foi possível alterar.");
            }

            if(!atualizar_images_site($img_name, "site_background")){
                die_error("Não foi possível alterar.");
            }
            

            excluir_imagem(BASE_IMAGES_SYSTEM_PATCH.SITE_BACKGROUND);
            die_success_reload("Informações salvas.");
            
         }

         //BACKGROUND CATEGORIAS
         if(isset($_FILES['site_categoria_image']['tmp_name']) && !empty($_FILES['site_categoria_image']['tmp_name'])){
            
            $res = upload_imagem($_FILES['site_categoria_image']);
            $img_name = $res['name']; 
            $img_tmp  = $res['tmp_name'];


            $caminho = BASE_IMAGES_CATEGORIAS_PATCH.$img_name;
            if(!move_uploaded_file($img_tmp, $caminho)){
                die_error("Não foi possível alterar.");
            }

            if(!atualizar_images_site($img_name, "site_categoria_image")){
                die_error("Não foi possível alterar.");
            }
            
            excluir_imagem(BASE_IMAGES_CATEGORIAS_PATCH.SITE_CATEGORIA_IMAGE);
            die_success_reload("Informações salvas.");
            
         }

         //BACKGROUND MÍDIAS
         if(isset($_FILES['site_midia_background']['tmp_name']) && !empty($_FILES['site_midia_background']['tmp_name'])){
            
            $res = upload_imagem($_FILES['site_midia_background']);
            $img_name = $res['name']; 
            $img_tmp  = $res['tmp_name'];


            $caminho = BASE_IMAGES_MIDIA_PATCH.$img_name;
            if(!move_uploaded_file($img_tmp, $caminho)){
                die_error("Não foi possível alterar.");
            }

            if(!atualizar_images_site($img_name, "site_midia_background")){
                die_error("Não foi possível alterar.");
            }
            
            excluir_imagem(BASE_IMAGES_MIDIA_PATCH.SITE_MIDIA_BACKGROUND);
            die_success_reload("Informações salvas.");
            
         }

         //BACKGROUND EPISODIOS
         if(isset($_FILES['site_episodio_image']['tmp_name']) && !empty($_FILES['site_episodio_image']['tmp_name'])){
            
            $res = upload_imagem($_FILES['site_episodio_image']);
            $img_name = $res['name']; 
            $img_tmp  = $res['tmp_name'];


            $caminho = BASE_IMAGES_EPISODIOS_PATCH.$img_name;
            if(!move_uploaded_file($img_tmp, $caminho)){
                die_error("Não foi possível alterar.");
            }
 
            if(!atualizar_images_site($img_name, "site_episodio_image")){
                die_error("Não foi possível alterar.");
            }
            
            excluir_imagem(BASE_IMAGES_EPISODIOS_PATCH.SITE_EPISODIOS_IMAGE);
            die_success_reload("Informações salvas.");
            
         }
          

         die_error_reload("Selecione uma imagem.");

    }












}
