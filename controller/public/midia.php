<?php 
require_once $_SERVER['DOCUMENT_ROOT'].'/autoload/public_autoload.php';

$data = array("status" => "error");

if(!isset($_POST['acao'])){
   die(json_encode($status));
}

if(!$user_logado){
    $data = array("status" => "login");
    die(json_encode($data));
}

//LOAD TEMPORADAS
if($_POST['acao'] == 'load-temporadas'){

    if(!isset($_POST['midia_id']) OR !intval($_POST['midia_id']) OR empty(get_midia_por_id($_POST['midia_id']))){
        $data = array("status" => "error-temp-1");
        die(json_encode($data));
    }
    if(empty(get_temporadas($_POST['midia_id']))){
        $data = array("status" => "error-temp-2");
        die(json_encode($data));
    }
    $midia      = get_midia_por_id($_POST['midia_id']);
    $temporadas = get_temporadas($_POST['midia_id']);
    
  
    foreach($temporadas as $item){
        $array[] = array('temporada_id' => $item['temporada_id'],
                         'temporada_titulo' => $item['temporada_titulo'],
                         'total_episodios' => contar_episodios_temporada($midia['midia_id'], $item['temporada_id']));
        
    }

    $data = array("status" => "ok", "array_temporadas" => $array);
    
    die(json_encode($data));
 
    
}

//LOAD EPISODIOS
if($_POST['acao'] == 'load_episodios'){
    
    if(!isset($_POST['midia_id']) OR !intval($_POST['midia_id']) OR empty(get_midia_por_id($_POST['midia_id']))){
        $data = array("status" => "error-ep-1");
        die(json_encode($data));
    }
    if(empty(get_temporada_por_id($_POST['midia_id'], $_POST['temporada_id']))){
        $data = array("status" => "error-ep-2");
        die(json_encode($data));
    }
    if(count(get_episodios_temporada($_POST['midia_id'], $_POST['temporada_id'])) < 1){
        $data = array("status" => "error-ep-3");
        die(json_encode($data));
    }
    $midia      = get_midia_por_id($_POST['midia_id']);
    $temporada  = get_temporada_por_id($_POST['midia_id'], $_POST['temporada_id']);
    $episodios  = get_episodios_temporada($_POST['midia_id'], $_POST['temporada_id']);

    foreach($episodios as $item){
        $episodio_image    = !empty($item['episodio_image']) ? exibir_image_upload_or_url(BASE_IMAGES_EPISODIOS_PATCH, BASE_IMAGES_EPISODIOS_URL, $item['episodio_image']) : '';
        $episodio_duracao  = get_duracao_episodio($midia['midia_id'], $temporada['temporada_id'], $item['episodio_id']);
        $array[] = array("episodio_titulo" => $item['episodio_titulo'],
                         "episodio_image" => $episodio_image,
                         "episodio_descricao" => $item['episodio_descricao'],
                         "episodio_id" => $item['episodio_id'],
                         "episodio_duracao" => $episodio_duracao,
                         "episodio_numero" => $item['episodio_numero'],
                         "status" => "ok");
    }

    $data = array("status" => "ok", "array_episodios" => $array);
    die(json_encode($data));


}


//LOAD PLAYERS
if($_POST['acao'] == 'load_players'){
   
     if(!isset($_POST['midia_id']) OR !intval($_POST['midia_id']) OR 
        !isset($_POST['temporada_id']) OR !is_numeric($_POST['temporada_id']) OR 
        !isset($_POST['episodio_id']) OR !is_numeric($_POST['episodio_id']) OR empty(get_midia_por_id($_POST['midia_id']))){
            $data = array("status" => "error-play-1");
            die(json_encode($data));
    }

    $midia      = get_midia_por_id($_POST['midia_id']);

    if(empty($midia)){
        $data = array("status" => "error-play-21");
        die(json_encode($data));
    }


    if($midia['midia_tipo'] == 'anime' OR $midia['midia_tipo'] == 'novela' OR $midia['midia_tipo'] == 'serie'){
        if(empty(get_temporada_por_id($_POST['midia_id'], $_POST['temporada_id']))){
            $data = array("status" => "error-play-2");
            die(json_encode($data));
        }

        if(count(get_episodios_temporada($_POST['midia_id'], $_POST['temporada_id'])) < 1){
            $data = array("status" => "error-play-3");
            die(json_encode($data));
        }
    }

    $temporada     = get_temporada_por_id($_POST['midia_id'], $_POST['temporada_id']);
    $episodios     = get_episodios_temporada($_POST['midia_id'], $_POST['temporada_id']);
    $players       = listar_players($_POST['midia_id'], $_POST['temporada_id'], $_POST['episodio_id']);
    $total_players = count($players);

    if($total_players < 1){
        $data = array("status" => "error-play-4");
        die(json_encode($data));
    }

    foreach($players as $item){
        
        $array[] = array("player_titulo" => $item['player_titulo'],
                         "player_url" => $item['player_url'],
                         "player_tipo" => $item['player_tipo'],
                         "player_duracao" => $item['player_duracao'],
                         "player_audio" => ucfirst($item['player_audio']),
                         "player_acesso" => $item['player_acesso'],
                         "player_id" => $item['player_id']);
    }

    if($user_premium){
        $premium = "sim"; 
    }else{
        $premium = "nao";
    }
    $data = array("status" => "ok", "site_revenda" => "sim", "user_premium" => $premium, "total_players" => $total_players,  "array_players" => $array);

    die(json_encode($data));
}

// LOAD PLAYER ASSISTIR
if($_POST['acao'] == 'assistir'){
    if(!isset($_POST['midia_id']) OR !intval($_POST['midia_id']) OR 
       !isset($_POST['temporada_id']) OR !is_numeric($_POST['temporada_id']) OR 
       !isset($_POST['episodio_id']) OR !is_numeric($_POST['episodio_id']) OR empty(get_midia_por_id($_POST['midia_id'])) OR 
       !isset($_POST['player_id']) OR !intval($_POST["player_id"])){
            $data = array("status" => "error-assistir-1");
            die(json_encode($data));
    }

    $midia      = get_midia_por_id($_POST['midia_id']);

    if($midia['midia_tipo'] == 'anime' OR $midia['midia_tipo'] == 'novela' OR $midia['midia_tipo'] == 'serie'){
        if(empty(get_temporada_por_id($_POST['midia_id'], $_POST['temporada_id']))){
            $data = array("status" => "error-assistir-2");
            die(json_encode($data));
        }

        if(count(get_episodios_temporada($_POST['midia_id'], $_POST['temporada_id'])) < 1){
            $data = array("status" => "error-assistir-3");
            die(json_encode($data));
        }
    }

    $temporada     = get_temporada_por_id($_POST['midia_id'], $_POST['temporada_id']);
    $episodio      = get_episodio_por_id($_POST['midia_id'], $_POST['temporada_id']);
    $player        = get_player_por_id($_POST['midia_id'], $_POST['temporada_id'], $_POST['episodio_id'], $_POST['player_id']);

    $player_visualizacoes = $player['player_visualizacoes'] + 1;

    if(empty($player)){
        $data = array("status" => "error-assistir-4");
        die(json_encode($data));
    }
  

    if(empty($player)){
        $data = array("status" => "error-assistir-5");
        die(json_encode($data));
    }


    $midia_temporada = null;
    $midia_episodio  = null;

    if($midia['midia_tipo'] == 'serie' OR $midia['midia_tipo'] == 'novela' OR $midia['midia_tipo'] == 'anime'){
        $midia_temporada = $temporada['temporada_titulo'];
        $midia_episodio  = "Episódio ".$episodio['episodio_numero'];
    }

    if($user_premium){
        $premium = "sim";
        atualizar_visualizacoes_player($player_visualizacoes, $player['player_midia_id'], $player['player_temporada_id'], $player['player_episodio_id'], $player['player_id']);
        atualizar_visualizacoes_midia($player['player_midia_id'], $midia['midia_visualizacoes'] + 1);
    }else{
        $premium = "nao";
    }
    $data = array("status" => "ok", "site_revenda" => "sim", "user_premium" => $premium, "player" => $player, "midia_temporada" => $midia_temporada, "midia_episodio" => $midia_episodio, "midia_titulo" => $midia['midia_titulo']);
    
    die(json_encode($data));

} 