<?php 
require_once $_SERVER['DOCUMENT_ROOT'].'/controller/admin/admin_controller.php';

if(isset($_POST['acao'])){

    //EXCLUIR COMENTÁRIO
    if($_POST['acao'] == 'excluir-comentario'){
        if(!isset($_POST['comentario_id']) OR !intval($_POST['comentario_id']) OR empty(get_comentario_por_id($_POST['comentario_id']))){
            die_error("O comentário não foi encontrado.");
        }

        if(!excluir_comentario($_POST['comentario_id'])){
            die_error("Não foi possível excluir.");
        }

        die_reload();
        
    }
}