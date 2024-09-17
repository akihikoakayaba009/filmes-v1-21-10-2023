<?php 
require_once $_SERVER['DOCUMENT_ROOT'].'/controller/admin/admin_controller.php';

if(isset($_POST['acao'])){

    //ADICONAR
    if($_POST['acao'] == 'adicionar'){

        if(!isset($_POST['episodio_titulo']) OR !isset($_POST['episodio_numero']) OR !intval($_POST['episodio_numero']) OR
           !isset($_POST['midia_id']) OR !intval($_POST['midia_id']) OR
           !isset($_POST['temporada_id']) OR !intval($_POST['temporada_id']) OR 
           !isset($_POST['midia_tipo']) OR empty($_POST['midia_tipo']) OR 
           !isset($_POST['episodio_descricao']) OR !isset($_FILES['episodio_image'])){
            die_error("Preencha todos os campos.");
        }
        $midia_id     = $_POST['midia_id'];
        $temporada_id = $_POST['temporada_id'];
        $midia_tipo   = $_POST['midia_tipo'];

        if(!midia_tipo($midia_tipo)){
            die_error("O formato da mídia é inválido");
        }

        if($midia_tipo != 'anime' && $midia_tipo != 'novela' && $midia_tipo != 'serie'){
            die_error("O formato da mídia não aceita episódios");
        }

        $res  = get_midia_por_id($midia_id, $midia_tipo);
        $temp = get_temporada_por_id($temporada_id, $midia_id);

        if(empty($res)){
            die_error("A mídia não existe.");
        }

        if(empty($temp)){
            die_error("A temporada não existe.");
        }

        $episodio_numero    = $_POST['episodio_numero'];
        $episodio_titulo    = !empty($_POST['episodio_titulo']) ? ucwords(trim($_POST['episodio_titulo'])) : NULL;
        $episodio_diretorio = diretorio('episodio '.$episodio_numero);
        $episodio_descricao = !empty($_POST['episodio_descricao']) ? strip_tags($_POST['episodio_descricao']) : NULL;
        $episodio_image     = NULL; 

        if(verifica_episodio_existe($episodio_numero, $temporada_id, $midia_id) > 0){
            die_error("O episódio já existe.");    
        }

        if(!empty($_FILES['episodio_image']['tmp_name'])){
            $img = upload_imagem($_FILES['episodio_image']);
            $episodio_image = $img['name'];
            $tmp = $img['tmp_name'];
            $caminho = BASE_IMAGES_EPISODIOS_PATCH.$episodio_image;
        }

        if(!adicionar_episodio($episodio_titulo, $episodio_numero, $episodio_image, $episodio_descricao,
                               $episodio_diretorio, $temporada_id, $midia_id)){
            die_error("Não foi possível adicionar.");                    
        }

        if(isset($caminho)){
            mover_imagem_upload($caminho, $tmp);
        }

        die_url(BASE_ADMIN.'midia/'.$midia_tipo.'/'.$midia_id.'/temporada/'.$temporada_id.'/episodios/listar');

    }

    //EDITAR
    if($_POST['acao'] == 'editar'){

        if(!isset($_POST['episodio_titulo']) OR !isset($_POST['episodio_numero']) OR !intval($_POST['episodio_numero']) OR
           !isset($_POST['midia_id']) OR !intval($_POST['midia_id']) OR
           !isset($_POST['temporada_id']) OR !intval($_POST['temporada_id']) OR 
           !isset($_POST['midia_tipo']) OR empty($_POST['midia_tipo']) OR 
           !isset($_POST['episodio_descricao']) OR !isset($_FILES['episodio_image']) OR     
           !isset($_POST['episodio_id']) OR !intval($_POST['episodio_id'])){
            die_error("Preencha todos os campos.");
        }


        $midia_id     = $_POST['midia_id'];
        $temporada_id = $_POST['temporada_id'];
        $midia_tipo   = $_POST['midia_tipo'];
        $episodio_id  = $_POST['episodio_id'];

        $res  = get_midia_por_id($midia_id, $midia_tipo);
        $temp = get_temporada_por_id($temporada_id, $midia_id);
        $ep   = get_episodio_por_id($temporada_id, $midia_id, $episodio_id);
        

        if(empty($res)){
            die_error("A mídia não existe.");
        }

        if(empty($temp)){
            die_error("A temporada não existe.");
        }

        if(empty($ep)){
            die_error("O episódio não existe.");
        }

        $episodio_numero    = $_POST['episodio_numero'];
        $episodio_titulo    = !empty($_POST['episodio_titulo']) ? ucwords(trim($_POST['episodio_titulo'])) : NULL;
        $episodio_diretorio = diretorio('episodio '.$episodio_numero);
        $episodio_descricao = !empty($_POST['episodio_descricao']) ? strip_tags($_POST['episodio_descricao']) : NULL;;
        $episodio_image     = $ep['episodio_image']; 


        if(verifica_episodio_existe($episodio_numero, $temporada_id, $midia_id) > 1){
            die_error("O episódio já existe.");    
        }

        if(!empty($_FILES['episodio_image']['tmp_name'])){
            $img = upload_imagem($_FILES['episodio_image']);
            $episodio_image = $img['name'];
            $tmp = $img['tmp_name'];
            $caminho = BASE_IMAGES_EPISODIOS_PATCH.$episodio_image;
        } 

        if(isset($_POST['remover_image'])){
            $episodio_image = NULL;
        }

        if(!editar_episodio($episodio_titulo, $episodio_numero, $episodio_image, $episodio_descricao,
                            $episodio_diretorio, $temporada_id, 
                            $midia_id, $episodio_id)){
            die_error("Não foi possível excluir.");                    
        }


        if(isset($caminho)){
            mover_imagem_upload($caminho, $tmp);
        }

        if($episodio_image != $ep['episodio_image']){
            if(file_exists(BASE_IMAGES_EPISODIOS_PATCH.$ep['episodio_image'])){
                excluir_imagem(BASE_IMAGES_EPISODIOS_PATCH.$ep['episodio_image']);
            }    
        }

        die_url(BASE_ADMIN.'midia/'.$midia_tipo.'/'.$midia_id.'/temporada/'.$temporada_id.'/episodios/listar');


        


    }

    //EXCLUIR
    if($_POST['acao'] == 'excluir'){
        if(!isset($_POST['midia_id']) OR !intval($_POST['midia_id']) OR
           !isset($_POST['temporada_id']) OR !intval($_POST['temporada_id']) OR 
           !isset($_POST['midia_tipo']) OR empty($_POST['midia_tipo']) OR 
           !isset($_POST['episodio_id']) OR !intval($_POST['episodio_id'])){
            die_error("Episódio não encontrado.");
        }

        $midia_id     = $_POST['midia_id'];
        $temporada_id = $_POST['temporada_id'];
        $midia_tipo   = $_POST['midia_tipo'];
        $episodio_id  = $_POST['episodio_id'];


        $res  = get_midia_por_id($midia_id, $midia_tipo);
        $temp = get_temporada_por_id($temporada_id, $midia_id);
        $ep   = get_episodio_por_id($temporada_id, $midia_id, $episodio_id);
        

        if(empty($res)){
            die_error("A mídia não existe.");
        }

        if(empty($temp)){
            die_error("A temporada não existe.");
        }

        if(empty($ep)){
            die_error("O episódio não existe.");
        }

        $caminho = BASE_IMAGES_EPISODIOS_PATCH.$ep['episodio_image'];

        if(!excluir_episodio($temporada_id, $midia_id, $episodio_id)){
            die_error("Não foi possível excluir.");
        }
        if(!empty($ep['episodio_image'])){
            excluir_imagem($caminho);
        }

        die_url(BASE_ADMIN.'midia/'.$midia_tipo.'/'.$midia_id.'/temporada/'.$temporada_id.'/episodios/listar');



    }
}