<?php 
require_once $_SERVER['DOCUMENT_ROOT'].'/controller/admin/admin_controller.php';

if(isset($_POST['acao'])){

    //ADICIONAR
    if($_POST['acao'] == 'adicionar'){
        if(!isset($_POST['player_titulo']) OR !isset($_POST['player_url']) OR empty($_POST['player_url']) OR 
           !isset($_POST['player_audio']) OR empty($_POST['player_audio']) OR
           !isset($_POST['player_tipo']) OR empty($_POST['player_tipo']) OR
           !isset($_POST['player_acesso']) OR empty($_POST['player_acesso']) OR !isset($_POST['player_duracao']) OR 
           !isset($_POST['midia_id']) OR !isset($_POST['temporada_id']) OR !isset($_POST['episodio_id']) OR 
           !isset($_POST['midia_tipo']) OR empty($_POST['midia_tipo'])){
                die_error("Preencha todos os campos.");
        }

        $player_titulo    = !empty($_POST['player_titulo']) ? ucwords(trim($_POST['player_titulo'])) : NULL; 
        $player_url       = $_POST['player_url'];
        $player_tipo      = $_POST['player_tipo'];
        $player_duracao   = NULL;
        $player_acesso    = $_POST['player_acesso'];
        $player_audio     = $_POST['player_audio'];
        
        $midia_id         = $_POST['midia_id'];
        $temporada_id     = 0;
        $episodio_id      = 0;
        $midia_tipo       = $_POST['midia_tipo']; 

        if(!midia_tipo($midia_tipo)){
            die_error("O formato da mídia é inválido.");
        }


        $res  = get_midia_por_id($midia_id, $midia_tipo);

        if(empty($res)){
            die_error("A mídia não existe.");
        }

        if($midia_tipo == 'anime' OR $midia_tipo == 'novela' OR $midia_tipo == 'serie'){

            $temporada_id     = $_POST['temporada_id'];
            $episodio_id      = $_POST['episodio_id'];

            $temp = get_temporada_por_id($temporada_id, $midia_id);
            $ep   = get_episodio_por_id($temporada_id, $midia_id, $episodio_id);

            if(empty($temp)){
                die_error("A temporada não existe.");
            }
    
            if(empty($ep)){
                die_error("O episódio não existe.");
            }
    
        }

        if(!filter_var($player_url, FILTER_VALIDATE_URL)){
            die_error("A url é inválida.");
        }

        if($player_tipo != 'mp4' && $player_tipo != 'm3u8' && $player_tipo != 'iframe'){
            die_error("O aúdio do player é inválido.");
        }

        if(!empty($_POST['player_duracao'])){
            $player_duracao = $_POST['player_duracao'];
        }

        if($player_audio != 'legendado' && $player_audio != 'dublado'){
            die_error("O aúdio é inválido.");
        }

        if($player_acesso != "gratis" && $player_acesso != "premium"){
            die_error("O player deve ser grátis ou premium.");
        }

        if(!adicionar_player($player_titulo, $player_url, $player_tipo, 
                             $player_duracao, $player_audio, $player_acesso, $res['midia_tipo'],
                             $episodio_id, $temporada_id, $midia_id)){
            die_error("Não foi possível adicionar.");                    
        }

        die_url(BASE_ADMIN.'midia/'.$midia_tipo.'/'.$midia_id.'/temporada/'.$temporada_id.'/episodio/'.$episodio_id.'/players/listar');

    }

    //EDITAR
    if($_POST['acao'] == 'editar'){
        
        if(!isset($_POST['player_titulo']) OR 
           !isset($_POST['player_url']) OR empty($_POST['player_url']) OR 
           !isset($_POST['player_audio']) OR empty($_POST['player_audio']) OR
           !isset($_POST['player_tipo']) OR empty($_POST['player_tipo']) OR
           !isset($_POST['player_acesso']) OR empty($_POST['player_acesso']) OR !isset($_POST['player_duracao']) OR 
           !isset($_POST['midia_id']) OR !isset($_POST['temporada_id']) OR !isset($_POST['episodio_id']) OR 
           !isset($_POST['midia_tipo']) OR empty($_POST['midia_tipo']) OR 
           !isset($_POST['player_id']) OR !intval($_POST['player_id'])){
                die_error("Preencha todos os campos.");
        }

        $player_titulo    = !empty($_POST['player_titulo']) ? ucwords(trim($_POST['player_titulo'])) : null; 
        $player_url       = $_POST['player_url'];
        $player_tipo      = $_POST['player_tipo'];
        $player_duracao   = NULL;
        $player_acesso    = $_POST['player_acesso'];
        $player_audio     = $_POST['player_audio'];
        
        $midia_id         = $_POST['midia_id'];
        $temporada_id     = 0; 
        $episodio_id      = 0;
        $midia_tipo       = $_POST['midia_tipo']; 
        $player_id        = $_POST['player_id'];



        if(!midia_tipo($midia_tipo)){
            die_error("O formato da mídia é inválido.");
        }

        $res  = get_midia_por_id($midia_id, $midia_tipo);

        if(empty($res)){
            die_error("A mídia não existe.");
        }

        if($midia_tipo == 'anime' OR $midia_tipo == 'novela' OR $midia_tipo == 'serie'){

            $temporada_id     = $_POST['temporada_id'];
            $episodio_id      = $_POST['episodio_id'];

            $temp = get_temporada_por_id($temporada_id, $midia_id);
            $ep   = get_episodio_por_id($temporada_id, $midia_id, $episodio_id);

            if(empty($temp)){
                die_error("A temporada não existe.");
            }
    
            if(empty($ep)){
                die_error("O episódio não existe.");
            }
    
        }

        $play = get_player_por_id($midia_id, $temporada_id, $episodio_id, $player_id);


        if(empty($play)){
            die_error("O player não existe.");
        }


        if(!filter_var($player_url, FILTER_VALIDATE_URL)){
            die_error("A url é inválida.");
        }

        if($player_tipo != 'mp4' && $player_tipo != 'm3u8' && $player_tipo != 'iframe'){
            die_error("O aúdio do player é inválido.");
        }

        if(!empty($_POST['player_duracao'])){
            $player_duracao = $_POST['player_duracao'];
        }

        if($player_audio != 'legendado' && $player_audio != 'dublado'){
            die_error("O aúdio é inválido.");
        }

        if($player_acesso != "gratis" && $player_acesso != "premium"){
            die_error("O player deve ser grátis ou premium.");
        }

        if(!editar_player($player_titulo, $player_url, $player_tipo, 
                          $player_duracao, $player_audio, $player_acesso,
                          $episodio_id, $temporada_id, $midia_id, $player_id)){
            die_error("Não foi possível editar.");                    
        }

        die_url(BASE_ADMIN.'midia/'.$midia_tipo.'/'.$midia_id.'/temporada/'.$temporada_id.'/episodio/'.$episodio_id.'/players/listar');
    }

    //EXCLUIR
    if($_POST['acao'] == 'excluir'){
        if(!isset($_POST['midia_id']) OR !isset($_POST['temporada_id']) OR 
           !isset($_POST['episodio_id']) OR 
           !isset($_POST['midia_tipo']) OR empty($_POST['midia_tipo']) OR 
           !isset($_POST['player_id']) OR !intval($_POST['player_id'])){
                die_error("Player não encontrado.");
        }
 
        $midia_id         = $_POST['midia_id'];
        $temporada_id     = 0;
        $episodio_id      = 0;
        $midia_tipo       = $_POST['midia_tipo']; 
        $player_id        = $_POST['player_id'];

        $res  = get_midia_por_id($midia_id, $midia_tipo);

        if(empty($res)){
            die_error("A mídia não existe.");
        }

        if($midia_tipo == 'anime' OR $midia_tipo == 'novela' OR $midia_tipo == 'serie'){

            $temporada_id     = $_POST['temporada_id'];
            $episodio_id      = $_POST['episodio_id'];

            $temp = get_temporada_por_id($temporada_id, $midia_id);
            $ep   = get_episodio_por_id($temporada_id, $midia_id, $episodio_id);

            if(empty($temp)){
                die_error("A temporada não existe.");
            }
    
            if(empty($ep)){
                die_error("O episódio não existe.");
            }
    
        }

        $play = get_player_por_id($midia_id, $temporada_id, $episodio_id, $player_id);

        if(empty($play)){
            die_error("O player não existe.");
        }

        if(!excluir_player($midia_id, $temporada_id, $episodio_id, $player_id)){
            die_error("Não foi possível excluir.");
        }

        die_url(BASE_ADMIN.'midia/'.$midia_tipo.'/'.$midia_id.'/temporada/'.$temporada_id.'/episodio/'.$episodio_id.'/players/listar');

    }
}