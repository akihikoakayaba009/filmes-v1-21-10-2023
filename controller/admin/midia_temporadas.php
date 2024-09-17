<?php 
require_once $_SERVER['DOCUMENT_ROOT'].'/controller/admin/admin_controller.php';

if(isset($_POST['acao'])){

    //ADICIONAR
    if($_POST['acao'] == 'adicionar'){
           
        if(!isset($_POST['temporada_titulo']) OR empty($_POST['temporada_titulo']) OR 
           !isset($_POST['midia_id']) OR !intval($_POST['midia_id']) OR 
           !isset($_POST['midia_tipo']) OR empty($_POST['midia_tipo'])){
            die_error("Preencha todos os campos.");      
        }

        $temporada_titulo    = trim(ucwords($_POST['temporada_titulo']));
        $temporada_diretorio = diretorio($temporada_titulo);
        $midia_id            = $_POST['midia_id']; 
        $midia_tipo          = $_POST['midia_tipo'];

        if(!midia_tipo($midia_tipo)){
            die_error("O formato da mídia é inválido.");
        }

        $res = get_midia_por_id($midia_id, $midia_tipo);

        if(empty($res)){
            die_error("A mídia não existe.");
        }

        if(verificar_temporada_por_diretorio($temporada_diretorio, $midia_id) > 0){
            die_error("A temporada já existe.");
        }

        if(!adicionar_temporada($temporada_titulo, $temporada_diretorio, $midia_id)){
            die_error("Não foi possível adicionar.");
        }

        die_url(BASE_ADMIN.'midia/'.$midia_tipo.'/'.$midia_id.'/temporadas/listar');


    }

    //EDITAR
    if($_POST['acao'] == 'editar'){

        if(!isset($_POST['temporada_titulo']) OR empty($_POST['temporada_titulo']) OR 
           !isset($_POST['midia_id']) OR !intval($_POST['midia_id']) OR 
           !isset($_POST['midia_tipo']) OR empty($_POST['midia_tipo']) OR 
           !isset($_POST['temporada_id']) OR !intval($_POST['temporada_id'])){
            die_error("Preencha todos os campos.");      
        }

        $temporada_id        = $_POST['temporada_id'];
        $temporada_titulo    = trim(ucwords($_POST['temporada_titulo']));
        $temporada_diretorio = diretorio($temporada_titulo);
        $midia_id            = $_POST['midia_id']; 
        $midia_tipo          = $_POST['midia_tipo'];

        if(!midia_tipo($midia_tipo)){
            die_error("O formato da mídia é inválido.");
        }
        
        $res  = get_midia_por_id($midia_id, $midia_tipo);
        $temp = get_temporada_por_id($temporada_id, $midia_id);

        if(empty($res)){
            die_error("A mídia não existe.");
        }

        if(empty($temp)){
            die_error("A temporada não existe.");
        }

        if(verificar_temporada_por_diretorio($temporada_diretorio, $midia_id) > 1){
            die_error("A temporada já existe.");
        }

        if(!editar_temporada($temporada_titulo, $temporada_diretorio, 
                             $midia_id, $temporada_id)){
            die_error("Não foi possível adicionar.");
        }

        die_url(BASE_ADMIN.'midia/'.$midia_tipo.'/'.$midia_id.'/temporadas/listar');
 
    }

    //EXCLUIR
    if($_POST['acao'] == 'excluir'){
        if(!isset($_POST['midia_id']) OR !intval($_POST['midia_id']) OR 
           !isset($_POST['temporada_id']) OR !intval($_POST['temporada_id'])){
            die_error("Mídia ou temporada não encontradas.");      
        }

        $temporada_id        = $_POST['temporada_id'];
        $midia_id            = $_POST['midia_id']; 

        $temp = get_temporada_por_id($temporada_id, $midia_id);

        if(empty($temp)){
            die_error("A temporada não existe.");
        }

        if(!excluir_temporada($temporada_id, $midia_id)){
            die_error("Não foi possível excluir.");
        }

        die_reload();

    }
}
