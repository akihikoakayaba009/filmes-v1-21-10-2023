<?php 
require_once $_SERVER['DOCUMENT_ROOT'].'/autoload/public_autoload.php';

if(isset($_POST['midia_id']) && intval($_POST['midia_id']) && !empty(get_midia_por_id($_POST['midia_id']))){

    if(!$user_logado){
         die_error("error-1");
    }

    if(verificar_minha_lista($_POST['midia_id'], $perfil_id) > 0){
        if(remover_minha_lista($_POST['midia_id'], $perfil_id)){
            die_success("removido");
        }
    }

    if(verificar_minha_lista($_POST['midia_id'], $perfil_id) < 1){
        if(cadastrar_minha_lista($_POST['midia_id'], $perfil_id)){
            die_success("adicionado");
            die(json_encode(array("status" => "adicionado")));
        }
    }
}