<?php 
require_once $_SERVER['DOCUMENT_ROOT'].'/controller/admin/admin_controller.php';

if(isset($_POST['acao'])){

    if($_POST['acao'] == 'adicionar-midia'){ 
        if(!isset($_POST['midia_titulo']) OR empty($_POST['midia_titulo']) OR 
           !isset($_POST['midia_avaliacao']) OR !isset($_POST['midia_ano']) OR 
           !isset($_POST['midia_image_url']) OR !isset($_POST['midia_trailer']) OR 
           !isset($_POST['midia_sinopse']) OR empty($_POST['midia_sinopse']) OR 
           !isset($_POST['midia_categoria']) OR empty($_POST['midia_categoria']) OR 
           !isset($_POST['midia_tipo']) OR empty($_POST['midia_titulo']) OR 
           !isset($_POST['midia_tmdb']) OR !isset($_FILES['midia_image_upload']) OR
           !isset($_POST['midia_background_url']) OR !isset($_FILES['midia_background_upload'])){
                die_error("Preencha todos os campos.");
        }

        $midia_titulo     = trim(ucwords($_POST['midia_titulo']));
        $midia_diretorio  = diretorio($midia_titulo);
        $midia_avaliacao  = NULL;
        $midia_ano        = NULL;
        $midia_image      = NULL;
        $midia_trailer    = NULL;
        $midia_sinopse    = strip_tags($_POST['midia_sinopse']);
        $midia_categoria  = NULL;
        $midia_tipo       = $_POST['midia_tipo'];
        $midia_tmdb       = NULL;
        $midia_background = NULL;

        if(!midia_tipo($midia_tipo)){
            die_error("O tipo da mídia é inválido.");
        }

        if(contar_midia_por_diretorio($midia_tipo, $midia_diretorio) > 0){
            die_error("A mídia já existe.");    
        }
        
        if(!empty($_POST['midia_avaliacao'])){
            $a = str_replace("%", "", $_POST['midia_avaliacao']);
            if($a < 0 OR $a > 100 OR !is_numeric($a)){
                die_error("A avaliação é inválida.");
            }
            $midia_avaliacao = $a.'%';
        }

        if(!empty($_POST['midia_ano'])){
            if(!intval($_POST['midia_ano']) OR strlen($_POST['midia_ano']) != 4){
                die_error("O ano é inválido");
            }
            $midia_ano = $_POST['midia_ano'];
        }

        foreach($_POST['midia_categoria'] as $cat){
            if(empty(get_categoria_por_id($midia_tipo, $cat))){
                die_error("Uma ou mais categorias selecionadas não existe.");
            }
            $midia_categoria .= $cat.',';
        }
        $midia_categoria = substr($midia_categoria,0,-1);

        if(!empty($_POST['midia_tmdb']) && intval($_POST['midia_tmdb'])){
            $midia_tmdb = $_POST['midia_tmdb'];
        }
       
       
        if(!empty($_POST['midia_image_url']) && !empty($_FILES['midia_image_upload']['tmp_name'])){
            die_error("Informe somente a url ou faça somente o upload da imagem.");
        }

        if(!empty($_POST['midia_trailer'])){
            if(!filter_var($_POST['midia_trailer'], FILTER_VALIDATE_URL)){
                die_error("A url do trailer é inválida.");
            }
            $midia_trailer = $_POST['midia_trailer'];
        }

        if(!empty($_POST['midia_image_url'])){
            if(!filter_var($_POST['midia_image_url'], FILTER_VALIDATE_URL)){
                die_error("A url da imagem é inválida.");
            }
            $midia_image = $_POST['midia_image_url'];
        }

        if(!empty($_FILES['midia_image_upload']['tmp_name'])){
            $img = upload_imagem($_FILES['midia_image_upload']);
            $midia_image = $img['name'];
            $tmp = $img['tmp_name'];
            $caminho = BASE_IMAGES_MIDIA_PATCH.$midia_image;
        }

        if(!empty($_POST['midia_background_url'])){
            if(!filter_var($_POST['midia_background_url'], FILTER_VALIDATE_URL)){
                die_error("A url do background é inválida.");
            }
            $midia_background = $_POST['midia_background_url'];
        }

        if(!empty($_FILES['midia_background_upload']['tmp_name'])){
            $back = upload_imagem($_FILES['midia_background_upload']);
            $midia_background   = 'background_'.$back['name'];
            $tmp_background     = $back['tmp_name'];
            $caminho_background = BASE_IMAGES_MIDIA_PATCH.$midia_background;
        }

        if(!adicionar_midia($midia_titulo, $midia_avaliacao, $midia_ano,
                            $midia_image, $midia_background, $midia_trailer, $midia_sinopse, $midia_categoria,
                            $midia_tipo, $midia_tmdb, $midia_diretorio)){
            die_error("Não foi possível adicionar.");
        }

        if(isset($caminho)){
            mover_imagem_upload($caminho, $tmp);
        }

        if(isset($caminho_background)){
            mover_imagem_upload($caminho_background, $tmp_background);
        }

        $midia_id = $pdo->lastInsertId();

        if($midia_tipo == 'filme' OR $midia_tipo == 'infantil' OR $midia_tipo == 'canal'){
            die_url(BASE_ADMIN.'midia/'.$midia_tipo.'/'.$midia_id.'/temporada/0/episodio/0/players/listar');
        }else{
            die_url(BASE_ADMIN.'midia/'.$midia_tipo.'/'.$midia_id.'/temporadas/listar');
        }
 
    }


    //EDITAR
    if($_POST['acao'] == 'midia-editar'){
        if(!isset($_POST['midia_titulo']) OR empty($_POST['midia_titulo']) OR 
           !isset($_POST['midia_avaliacao']) OR !isset($_POST['midia_ano']) OR 
           !isset($_POST['midia_image_url']) OR !isset($_POST['midia_trailer']) OR 
           !isset($_POST['midia_sinopse']) OR empty($_POST['midia_sinopse']) OR 
           !isset($_POST['midia_categoria']) OR empty($_POST['midia_categoria']) OR 
           !isset($_POST['midia_tipo']) OR empty($_POST['midia_titulo']) OR 
           !isset($_POST['midia_tmdb']) OR !isset($_FILES['midia_image_upload']) OR 
           !isset($_POST['midia_background_url']) OR !isset($_FILES['midia_background_upload']) OR 
           !isset($_POST['midia_id']) OR !intval($_POST['midia_id'])){
             die_error("Preencha todos os campos.");
        }

        if(empty(get_midia_por_id($_POST['midia_id'], $_POST['midia_tipo']))){
            die_error("A mídia não foi encontrada.");
        }

        $res = get_midia_por_id($_POST['midia_id'], $_POST['midia_tipo']);

        $midia_id          = $_POST['midia_id'];
        $midia_titulo      = trim(ucwords($_POST['midia_titulo']));
        $midia_diretorio   = diretorio($midia_titulo);
        $midia_avaliacao   = NULL;
        $midia_ano         = NULL;
        $midia_image       = $res['midia_image'];
        $midia_trailer     = NULL;
        $midia_sinopse     = strip_tags($_POST['midia_sinopse']);
        $midia_categoria   = NULL;
        $midia_tipo        = $_POST['midia_tipo'];
        $midia_tmdb        = NULL;
        $midia_background  = $res['midia_background'];

        if(!midia_tipo($midia_tipo)){
            die_error("O tipo da mídia é inválido.");
        }

        if(contar_midia_por_diretorio($midia_tipo, $midia_diretorio) > 1){
            die_error("A mídia já existe.");    
        }

        if(!empty($_POST['midia_avaliacao'])){
            $a = str_replace("%", "", $_POST['midia_avaliacao']);
            if($a < 0 OR $a > 100 OR !is_numeric($a)){
                die_error("A avaliação é inválida.");
            }
            $midia_avaliacao = $a.'%';
        }

        if(!empty($_POST['midia_ano'])){
            if(!intval($_POST['midia_ano']) OR strlen($_POST['midia_ano']) != 4){
                die_error("O ano é inválido");
            }
            $midia_ano = $_POST['midia_ano'];
        }

        foreach($_POST['midia_categoria'] as $cat){
            if(empty(get_categoria_por_id($midia_tipo, $cat))){
                die_error("Uma ou mais categorias selecionadas não existe.");
            }
            $midia_categoria .= $cat.',';
        }
        $midia_categoria = substr($midia_categoria,0,-1);

        if(!empty($_POST['midia_tmdb']) && intval($_POST['midia_tmdb'])){
            $midia_tmdb = $_POST['midia_tmdb'];
        }
       
       
        if(!empty($_POST['midia_image_url']) && !empty($_FILES['midia_image_upload']['tmp_name'])){
            die_error("Informe somente a url ou faça somente o upload da imagem.");
        }

        if(!empty($_POST['midia_trailer'])){
            if(!filter_var($_POST['midia_trailer'], FILTER_VALIDATE_URL)){
                die_error("A url do trailer é inválida.");
            }
            $midia_trailer = $_POST['midia_trailer'];
        }

        if(!empty($_POST['midia_image_url'])){
            if(!filter_var($_POST['midia_image_url'], FILTER_VALIDATE_URL)){
                die_error("A url da imagem é inválida.");
            }
            $midia_image = $_POST['midia_image_url'];
        }

        if(!empty($_FILES['midia_image_upload']['tmp_name'])){
            $img = upload_imagem($_FILES['midia_image_upload']);
            $midia_image = $img['name'];
            $tmp = $img['tmp_name'];
            $caminho = BASE_IMAGES_MIDIA_PATCH.$midia_image;
        }

        if(!empty($_POST['midia_background_url'])){
            if(!filter_var($_POST['midia_background_url'], FILTER_VALIDATE_URL)){
                die_error("A url do background é inválida.");
            }
            $midia_background = $_POST['midia_background_url'];
        }

        if(!empty($_FILES['midia_background_upload']['tmp_name'])){
            $back = upload_imagem($_FILES['midia_background_upload']);
            $midia_background   = 'background_'.$back['name'];
            $tmp_background     = $back['tmp_name'];
            $caminho_background = BASE_IMAGES_MIDIA_PATCH.$midia_background;
        }

        if(isset($_POST['remover_image']) && !empty($_POST['remover_image'])){
            $midia_background = NULL;
            $remover_image = true;
        }

        if(!editar_midia($midia_titulo, $midia_avaliacao, $midia_ano,
                         $midia_image, $midia_background, $midia_trailer, $midia_sinopse, $midia_categoria,
                         $midia_tipo, $midia_tmdb, $midia_diretorio, $midia_id)){
            die_error("Não foi possível editar.");                
        }

        if($midia_image != $res['midia_image']){
            if(file_exists(BASE_IMAGES_MIDIA_PATCH.$res['midia_image'])){
                excluir_imagem(BASE_IMAGES_MIDIA_PATCH.$res['midia_image']);
            }
        }

        if($midia_background != $res['midia_background'] OR isset($remover_image)){
            if(file_exists(BASE_IMAGES_MIDIA_PATCH.$res['midia_background'])){
                excluir_imagem(BASE_IMAGES_MIDIA_PATCH.$res['midia_background']);
            }
        }

        if(isset($caminho)){
            mover_imagem_upload($caminho, $tmp);
        }

        if(isset($caminho_background)){
            mover_imagem_upload($caminho_background, $tmp_background);
        }

        die_success_reload("A mídia foi editada.");



    }

    //EXCLUIR
    if($_POST['acao'] == 'excluir'){
        if(!isset($_POST['midia_id']) OR !intval($_POST['midia_id']) OR 
           !isset($_POST['midia_tipo']) OR empty($_POST['midia_tipo'])){
            die_error("Mídia não encontrada.");
        }

        $midia_id   = $_POST['midia_id'];
        $midia_tipo = $_POST['midia_tipo'];

        if(!midia_tipo($midia_tipo)){
            die_error("O formato da mídia é inválido");
        }

        $res = get_midia_por_id($midia_id, $midia_tipo);

        if(empty($res)){
            die_error("A mídia não existe.");
        }

        $temp = midia_get_temporadas($midia_id);
        $ep   = midia_get_episodios($midia_id);
        $play = midia_get_players($midia_id);

        if(excluir_midia($midia_id)){

            if(count($ep) > 0){
                foreach($ep as $b){
                    if(file_exists(BASE_IMAGES_EPISODIOS_PATCH.'/'.$b['episodio_image'])){
                        excluir_imagem(BASE_IMAGES_EPISODIOS_PATCH.'/'.$b['episodio_image']);
                    }
                }
            }

            midia_excluir_temporadas($midia_id);
            midia_excluir_episodios($midia_id);
            midia_excluir_players($midia_id);
    
            if(file_exists(BASE_IMAGES_MIDIA_PATCH.'/'.$res['midia_image'])){
                excluir_imagem(BASE_IMAGES_MIDIA_PATCH.'/'.$res['midia_image']);
            }
            if(file_exists(BASE_IMAGES_MIDIA_PATCH.'/'.$res['midia_background'])){
                excluir_imagem(BASE_IMAGES_MIDIA_PATCH.'/'.$res['midia_background']);
            }

            die_reload();

        }

        die_error("Não foi possível excluir.");

        





    }
}