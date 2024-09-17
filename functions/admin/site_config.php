<?php 
/*
  ============================== INFORMAÇÕES DO SITE =================================
*/

function atualizar_informacoes_site($site_nome,$site_keywords,$site_descricao, 
                                    $site_email, $site_whatsapp, $site_facebook,
                                    $site_instagram, $site_twitter, $site_youtube,
                                    $site_token_mp, $site_paginacao,
                                    $site_cache){
     global $pdo;
     $v = $pdo->prepare("SELECT * FROM site_config LIMIT 1");
     $v->execute();
     if($v->rowCount() > 0){
             
           //ADICIONAR
           $cad = $pdo->prepare("UPDATE site_config SET 
                                 site_nome = (:site_nome),
                                 site_keywords = (:site_keywords),
                                 site_descricao = (:site_descricao),
                                 site_email = (:site_email),
                                 site_whatsapp = (:site_whatsapp),
                                 site_facebook = (:site_facebook),
                                 site_instagram = (:site_instagram),
                                 site_twitter = (:site_twitter),
                                 site_youtube = (:site_youtube),
                                 site_token_mp = (:site_token_mp),
                                 site_paginacao = (:site_paginacao),
                                 site_cache = (:site_cache)");

     }else{

           //EDITAR
           $cad = $pdo->prepare("INSERT INTO site_config SET 
                                 site_nome = (:site_nome),
                                 site_keywords = (:site_keywords),
                                 site_descricao = (:site_descricao),
                                 site_email = (:site_email),
                                 site_whatsapp = (:site_whatsapp),
                                 site_facebook = (:site_facebook),
                                 site_instagram = (:site_instagram),
                                 site_twitter = (:site_twitter),
                                 site_youtube = (:site_youtube),
                                 site_token_mp = (:site_token_mp),
                                 site_paginacao = (:site_paginacao),
                                 site_cache = (:site_cache)");
        
        
     } 

           $cad->bindValue(":site_nome", $site_nome);
           $cad->bindValue(":site_keywords", $site_keywords);
           $cad->bindValue(":site_descricao", $site_descricao);
           $cad->bindValue(":site_email", $site_email);
           $cad->bindValue(":site_whatsapp", $site_whatsapp);
           $cad->bindValue(":site_facebook", $site_facebook);
           $cad->bindValue(":site_instagram", $site_instagram);
           $cad->bindValue(":site_twitter", $site_twitter);
           $cad->bindValue(":site_youtube", $site_youtube);
           $cad->bindValue(":site_token_mp", $site_token_mp);
           $cad->bindValue(":site_paginacao", $site_paginacao);
           $cad->bindValue(":site_cache", $site_cache);

           if($cad->execute()){
               return true;
           }
     
}

/*
  ============================== ATUALIZAR IMAGENS DO SITE =================================
*/

function atualizar_images_site($img_name, $image_tipo){
    global $pdo;
    if($image_tipo == 'site_favicon'){
        
        //ALTERAR FAVICON
        $up = $pdo->prepare("UPDATE site_config SET site_favicon = (:img_name)");
    
    }else if($image_tipo == 'site_logo'){
        
        //ALTERAR LOGO
        $up = $pdo->prepare("UPDATE site_config SET site_logo = (:img_name)");

    }else if($image_tipo == 'site_avatar'){ 

        //ALTERAR AVATAR PADRAO
        $up = $pdo->prepare("UPDATE site_config SET site_avatar = (:img_name)");
        
        $site_avatar_atual = SITE_AVATAR;

    }else if($image_tipo == 'site_background'){

        //ALTERAR BACKGROUND PADRAO
        $up = $pdo->prepare("UPDATE site_config SET site_background = (:img_name)");
    }else if($image_tipo == 'site_categoria_image'){
        
        //ALTERAR BACKGROUND DAS CATEGORIAS
        $up = $pdo->prepare("UPDATE site_config SET site_categoria_image = (:img_name)");

    }else if($image_tipo == 'site_midia_background'){ 

        //ALTERAR BACKGROUND MIDIAS
        $up = $pdo->prepare("UPDATE site_config SET site_midia_background = (:img_name)");

    }else if($image_tipo == 'site_episodio_image'){ 

        //ALTERAR BACKGROUND MIDIAS
        $up = $pdo->prepare("UPDATE site_config SET site_episodio_image = (:img_name)");
            
        
    }else{
        return false;
    }

    $up->bindValue(":img_name", $img_name);
    if($up->execute()){
        if($image_tipo == 'site_avatar'){
            $r = $pdo->prepare("UPDATE revendedores SET revendedor_avatar = (:img_name) WHERE revendedor_avatar = (:site_avatar_atual)");
            $r->bindValue(":site_avatar_atual", $site_avatar_atual);
            $r->bindValue(":img_name", $img_name);
            $r->execute();

            $u = $pdo->prepare("UPDATE usuarios SET user_avatar = (:img_name) WHERE user_avatar = (:site_avatar_atual)");
            $u->bindValue(":site_avatar_atual", $site_avatar_atual);
            $u->bindValue(":img_name", $img_name);
            $u->execute();

            $a = $pdo->prepare("UPDATE administradores SET admin_avatar = (:img_name) WHERE admin_avatar = (:site_avatar_atual)");
            $a->bindValue(":site_avatar_atual", $site_avatar_atual);
            $a->bindValue(":img_name", $img_name);
            $a->execute();
        }
        return true;
    }
    
} 
   
/*
  ============================== SMTP ADICIONAR / EDITAR =================================
*/
function add_editar_servidor_smtp($smtp_user,$smtp_senha,$smtp_email,$smtp_porta,$smtp_host){
    global $pdo;
    if(empty(get_servidor_smtp())){

        $smtp = $pdo->prepare("INSERT INTO smtp SET 
                          smtp_user  = (:smtp_user),
                          smtp_senha = (:smtp_senha),
                          smtp_email = (:smtp_email),
                          smtp_porta = (:smtp_porta),
                          smtp_host  = (:smtp_host)");
        $smtp->bindValue(":smtp_user", $smtp_user);
        $smtp->bindValue(":smtp_senha", $smtp_senha);
        $smtp->bindValue(":smtp_email", $smtp_email);
        $smtp->bindValue(":smtp_porta", $smtp_porta);
        $smtp->bindValue(":smtp_host", $smtp_host);           

    }else{

        $smtp = $pdo->prepare("UPDATE smtp SET 
                            smtp_user  = (:smtp_user),
                            smtp_senha = (:smtp_senha), 
                            smtp_email = (:smtp_email),
                            smtp_porta = (:smtp_porta),
                            smtp_host  = (:smtp_host)");
        $smtp->bindValue(":smtp_user", $smtp_user);
        $smtp->bindValue(":smtp_senha", $smtp_senha);
        $smtp->bindValue(":smtp_email", $smtp_email);
        $smtp->bindValue(":smtp_porta", $smtp_porta);
        $smtp->bindValue(":smtp_host", $smtp_host);       
        
    }

    if($smtp->execute()){
        return true; 
    }  

}