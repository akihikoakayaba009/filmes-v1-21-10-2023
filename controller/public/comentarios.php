<?php 
require_once $_SERVER['DOCUMENT_ROOT'].'/autoload/public_autoload.php';

if(isset($_POST['acao'])){

    if($_POST['acao'] == 'comentar'){
        
        if(!$user_logado){
            die_error("error-1");
        }
    
        if(!isset($_POST['midia_id']) OR !intval($_POST['midia_id']) OR empty(get_midia_por_id($_POST['midia_id']))){
            die_error("error-2");
        }

        $midia = get_midia_por_id($_POST['midia_id']);

        if(!$user_premium){
            midia_tipo_single_title($midia['midia_tipo']) . " premium. Para comentar mude para um plano premium.";
        }

        if(!isset($_POST['comentario']) OR empty($_POST['comentario'])){
            die_error("error-3");
        }
    
        $comentario = ucfirst(addslashes(trim(strip_tags($_POST['comentario']))));
    
        if(!cadastrar_comentario($comentario, $_POST['midia_id'], $perfil_apelido, $perfil_id, $perfil_avatar)){
            die_error("error-2");
        }
    
        die_success("publicado");
    }

    if($_POST['acao'] == 'load-comentarios'){

        if(!isset($_POST['midia_id']) OR !intval($_POST['midia_id']) OR !get_midia_por_id($_POST['midia_id']) OR count(exibir_comentarios($_POST['midia_id'])) < 1){
            die();
        }
       
        foreach(exibir_comentarios($_POST['midia_id']) as $item){
            $array_comentarios[] = array("comentario" => $item['comentario'], "data" => date("d/m/Y H:i", strtotime($item['comentario_data'])), "perfil_apelido" => $item['comentario_perfil_apelido'], "avatar" => BASE_IMAGES_AVATARS_PERFIL_SELECT_URL . $item['comentario_perfil_avatar']); 
        }

        die(json_encode($array_comentarios));
    }

}
