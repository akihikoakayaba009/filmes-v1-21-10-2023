<?php 
function adicionar_player($player_titulo, $player_url, $player_tipo, 
                          $player_duracao, $player_audio, $player_acesso, $player_para,
                          $player_episodio_id, $player_temporada_id, $player_midia_id){
    global $pdo;
    $cad = $pdo->prepare("INSERT INTO midia_players SET 
                          player_titulo = (:player_titulo),
                          player_url = (:player_url),
                          player_tipo = (:player_tipo),
                          player_duracao = (:player_duracao),
                          player_audio = (:player_audio),
                          player_acesso = (:player_acesso),
                          player_para = (:player_para),
                          player_episodio_id = (:player_episodio_id),
                          player_temporada_id = (:player_temporada_id),
                          player_midia_id = (:player_midia_id)");
    $cad->bindValue(":player_titulo", $player_titulo);
    $cad->bindValue(":player_url", $player_url);
    $cad->bindValue(":player_tipo", $player_tipo);
    $cad->bindValue(":player_duracao", $player_duracao);
    $cad->bindValue(":player_audio", $player_audio);
    $cad->bindValue(":player_acesso", $player_acesso);
    $cad->bindValue(":player_para", $player_para);
    $cad->bindValue(":player_episodio_id", $player_episodio_id);
    $cad->bindValue(":player_temporada_id", $player_temporada_id);
    $cad->bindValue(":player_midia_id", $player_midia_id);
    if($cad->execute()){
        return true;
    }                        
}

function editar_player($player_titulo, $player_url, $player_tipo, 
                       $player_duracao, $player_audio, $player_acesso,
                       $player_episodio_id, $player_temporada_id, $player_midia_id, $player_id){
    global $pdo;
    $up = $pdo->prepare("UPDATE midia_players SET 
                          player_titulo = (:player_titulo),
                          player_url = (:player_url),
                          player_tipo = (:player_tipo),
                          player_duracao = (:player_duracao),
                          player_audio = (:player_audio),
                          player_acesso = (:player_acesso) WHERE
                          player_episodio_id = (:player_episodio_id) AND
                          player_temporada_id = (:player_temporada_id) AND
                          player_midia_id = (:player_midia_id) AND 
                          player_id = (:player_id) LIMIT 1");
    $up->bindValue(":player_titulo", $player_titulo);
    $up->bindValue(":player_url", $player_url);
    $up->bindValue(":player_tipo", $player_tipo);
    $up->bindValue(":player_duracao", $player_duracao);
    $up->bindValue(":player_audio", $player_audio);
    $up->bindValue(":player_acesso", $player_acesso);
    $up->bindValue(":player_episodio_id", $player_episodio_id);
    $up->bindValue(":player_temporada_id", $player_temporada_id);
    $up->bindValue(":player_midia_id", $player_midia_id);
    $up->bindValue(":player_id", $player_id);
    if($up->execute()){
        return true;
    }                        
}

function get_player_por_id($player_midia_id, $player_temporada_id, $player_episodio_id, $player_id){
    global $pdo;
    $v = $pdo->prepare("SELECT * FROM midia_players WHERE 
                        player_midia_id = (:player_midia_id) AND 
                        player_temporada_id = (:player_temporada_id) AND 
                        player_episodio_id = (:player_episodio_id) AND 
                        player_id = (:player_id) LIMIT 1");
    $v->bindValue(":player_midia_id", $player_midia_id);
    $v->bindValue(":player_temporada_id", $player_temporada_id);
    $v->bindValue(":player_episodio_id", $player_episodio_id);
    $v->bindValue(":player_id", $player_id);
    $v->execute();
    return $v->fetch();                    
}

function listar_players($player_midia_id, $player_temporada_id, $player_episodio_id){
    global $pdo;
    $res = array();
    $v = $pdo->prepare("SELECT * FROM midia_players WHERE 
                        player_midia_id = (:player_midia_id) AND 
                        player_temporada_id = (:player_temporada_id) AND 
                        player_episodio_id = (:player_episodio_id)");
    $v->bindValue(":player_midia_id", $player_midia_id);
    $v->bindValue(":player_temporada_id", $player_temporada_id);
    $v->bindValue(":player_episodio_id", $player_episodio_id);
    $v->execute();
    if($v->rowCount() > 0){
        $res = $v->fetchAll();
    }
    return $res;
}
 
function excluir_player($player_midia_id, $player_temporada_id, $player_episodio_id, $player_id){
    global $pdo;
    $del = $pdo->prepare("DELETE FROM midia_players WHERE 
                          player_midia_id = (:player_midia_id) AND 
                          player_temporada_id = (:player_temporada_id) AND 
                          player_episodio_id = (:player_episodio_id) AND 
                          player_id = (:player_id) LIMIT 1");
    $del->bindValue(":player_midia_id", $player_midia_id);
    $del->bindValue(":player_temporada_id", $player_temporada_id);
    $del->bindValue(":player_episodio_id", $player_episodio_id);
    $del->bindValue(":player_id", $player_id); 
    if($del->execute()){
        return true;
    }                     

}

function contar_players($player_midia_id){
    global $pdo;
    $v = $pdo->prepare("SELECT player_midia_id FROM midia_players WHERE player_midia_id = (:player_midia_id)");
    $v->bindValue(":player_midia_id", $player_midia_id);
    $v->execute();
    return $v->rowCount();
}

function contar_players_por_episodio($player_midia_id, $player_episodio_id){
    global $pdo;
    $v = $pdo->prepare("SELECT player_midia_id,player_episodio_id FROM midia_players WHERE 
                        player_midia_id = (:player_midia_id) AND 
                        player_episodio_id = (:player_episodio_id)");
    $v->bindValue(":player_midia_id", $player_midia_id);
    $v->bindValue(":player_episodio_id", $player_episodio_id);
    $v->execute();
    return $v->rowCount();
}