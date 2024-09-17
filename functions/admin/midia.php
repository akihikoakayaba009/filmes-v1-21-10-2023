<?php 
function adicionar_midia($midia_titulo, $midia_avaliacao, $midia_ano,
                         $midia_image, $midia_background, $midia_trailer, $midia_sinopse, $midia_categoria,
                         $midia_tipo, $midia_tmdb, $midia_diretorio){
    global $pdo;    
    $cad = $pdo->prepare("INSERT INTO midia SET 
                          midia_titulo = (:midia_titulo),
                          midia_avaliacao = (:midia_avaliacao),
                          midia_ano = (:midia_ano),
                          midia_image = (:midia_image),
                          midia_background = (:midia_background),
                          midia_trailer = (:midia_trailer),
                          midia_sinopse = (:midia_sinopse),
                          midia_categoria = (:midia_categoria),
                          midia_tipo = (:midia_tipo),
                          midia_tmdb = (:midia_tmdb),
                          midia_diretorio = (:midia_diretorio)");
    $cad->bindValue(":midia_titulo", $midia_titulo);
    $cad->bindValue(":midia_avaliacao", $midia_avaliacao);
    $cad->bindValue(":midia_ano", $midia_ano);
    $cad->bindValue(":midia_image", $midia_image);
    $cad->bindValue(":midia_background", $midia_background);
    $cad->bindValue(":midia_trailer", $midia_trailer);
    $cad->bindValue(":midia_sinopse", $midia_sinopse);
    $cad->bindValue(":midia_categoria", $midia_categoria);
    $cad->bindValue(":midia_tipo", $midia_tipo);
    $cad->bindValue(":midia_tmdb", $midia_tmdb);
    $cad->bindValue(":midia_diretorio", $midia_diretorio);
    if($cad->execute()){
        return true;
    }                                   
}

function editar_midia($midia_titulo, $midia_avaliacao, $midia_ano,
                      $midia_image, $midia_background, $midia_trailer, $midia_sinopse, $midia_categoria,
                      $midia_tipo, $midia_tmdb, $midia_diretorio, $midia_id){
    global $pdo;
    $edt = $pdo->prepare("UPDATE midia SET 
                          midia_titulo = (:midia_titulo),
                          midia_avaliacao = (:midia_avaliacao),
                          midia_ano = (:midia_ano),
                          midia_image = (:midia_image),
                          midia_background = (:midia_background),
                          midia_trailer = (:midia_trailer),
                          midia_sinopse = (:midia_sinopse),
                          midia_categoria = (:midia_categoria),
                          midia_tipo = (:midia_tipo),
                          midia_tmdb = (:midia_tmdb),
                          midia_diretorio = (:midia_diretorio) WHERE 
                          midia_id = (:midia_id) LIMIT 1");
    $edt->bindValue(":midia_titulo", $midia_titulo);
    $edt->bindValue(":midia_avaliacao", $midia_avaliacao);
    $edt->bindValue(":midia_ano", $midia_ano);
    $edt->bindValue(":midia_image", $midia_image);
    $edt->bindValue(":midia_background", $midia_background);
    $edt->bindValue(":midia_trailer", $midia_trailer);
    $edt->bindValue(":midia_sinopse", $midia_sinopse);
    $edt->bindValue(":midia_categoria", $midia_categoria);
    $edt->bindValue(":midia_tipo", $midia_tipo);
    $edt->bindValue(":midia_tmdb", $midia_tmdb);
    $edt->bindValue(":midia_diretorio", $midia_diretorio);                      
    $edt->bindValue(":midia_id", $midia_id);
    if($edt->execute()){
        return true;
    }
}

function excluir_midia($midia_id){
    global $pdo;
    $v = $pdo->prepare("DELETE FROM midia WHERE midia_id = (:midia_id) LIMIT 1");
    $v->bindValue(":midia_id", $midia_id);
    if($v->execute()){
        return true;
    }
}

function contar_midia_por_diretorio($midia_tipo, $midia_diretorio){
    global $pdo;
    $v = $pdo->prepare("SELECT * FROM midia WHERE midia_tipo = (:midia_tipo) AND 
                        midia_diretorio = (:midia_diretorio)");
    $v->bindValue(":midia_tipo", $midia_tipo);
    $v->bindValue(":midia_diretorio", $midia_diretorio);
    $v->execute();
    return $v->rowCount();                    
}

function get_midia_por_id($midia_id, $midia_tipo){
    global $pdo;
    $v = $pdo->prepare("SELECT * FROM midia WHERE midia_id = (:midia_id) AND midia_tipo = (:midia_tipo) LIMIT 1");
    $v->bindValue(":midia_id", $midia_id);
    $v->bindValue(":midia_tipo", $midia_tipo);
    $v->execute();
    return $v->fetch();
}

function get_midia_por_id_segundo($midia_id){
    global $pdo;
    $v = $pdo->prepare("SELECT * FROM midia WHERE midia_id = (:midia_id) LIMIT 1");
    $v->bindValue(":midia_id", $midia_id);
    $v->execute();
    return $v->fetch();
}

 
function listar_midia($midia_tipo){
    global $pdo;
    $res = array();
    $v = $pdo->prepare("SELECT * FROM midia WHERE midia_tipo = (:midia_tipo)");
    $v->bindValue(":midia_tipo", $midia_tipo);
    $v->execute();
    if($v->rowCount() > 0){
        $res = $v->fetchAll();
    }
    return $res;
}

function contar_midia_por_tipo($midia_tipo){
    global $pdo;
    $v = $pdo->prepare("SELECT midia_tipo FROM midia WHERE midia_tipo = (:midia_tipo)");
    $v->bindValue(":midia_tipo", $midia_tipo);
    $v->execute();
    return $v->rowCount();
}

function midia_get_temporadas($temporada_midia_id){
    global $pdo;
    $res = array();
    $v = $pdo->prepare("SELECT * FROM midia_temporadas WHERE temporada_midia_id = (:temporada_midia_id)");
    $v->bindValue(":temporada_midia_id", $temporada_midia_id);
    $v->execute();
    if($v->rowCount() > 0){
        $res = $v->fetchAll();
    }
    return $res;
} 

function midia_get_episodios($episodio_midia_id){
    global $pdo;
    $res = array();
    $v = $pdo->prepare("SELECT * FROM midia_episodios WHERE episodio_midia_id = (:episodio_midia_id)");
    $v->bindValue(":episodio_midia_id", $episodio_midia_id);
    $v->execute();
    if($v->rowCount() > 0){
        $res = $v->fetchAll();
    }
    return $res;
}

function midia_get_players($player_midia_id){
    global $pdo;
    $res = array();
    $v = $pdo->prepare("SELECT * FROM midia_players WHERE player_midia_id = (:player_midia_id)");
    $v->bindValue(":player_midia_id", $player_midia_id);
    $v->execute();
    if($v->rowCount() > 0){
        $res = $v->fetchAll();
    }
    return $res;
}


function listar_midia_por_categoria($midia_tipo, $midia_categoria){
    global $pdo;
    $res = array();
    $v = $pdo->prepare("SELECT * FROM midia WHERE 
                        midia_tipo = (:midia_tipo) AND 
                        midia_categoria LIKE (:midia_categoria)");
    $v->bindValue(":midia_tipo", $midia_tipo);
    $v->bindValue(":midia_categoria", "%".$midia_categoria."%");
    $v->execute();
    if($v->rowCount() > 0){
        $res = $v->fetchAll();
    }
    return $res;
}

function midia_excluir_temporadas($temporada_midia_id){
    global $pdo;
    $v = $pdo->prepare("DELETE FROM midia_temporadas WHERE temporada_midia_id = (:temporada_midia_id)");
    $v->bindValue(":temporada_midia_id", $temporada_midia_id);
    $v->execute();
}

function midia_excluir_episodios($episodio_midia_id){
    global $pdo;
    $v = $pdo->prepare("DELETE FROM midia_episodios WHERE episodio_midia_id = (:episodio_midia_id)");
    $v->bindValue(":episodio_midia_id", $episodio_midia_id);
    $v->execute();
}

function midia_excluir_players($player_midia_id){
    global $pdo;
    $v = $pdo->prepare("DELETE FROM midia_players WHERE player_midia_id = (:player_midia_id)");
    $v->bindValue(":player_midia_id", $player_midia_id);
    $v->execute();
}

function get_visualizacoes_midia($player_midia_id){
    global $pdo;
    $player_visualizacoes = 0;
    $v = $pdo->prepare("SELECT * FROM midia_players WHERE 
                        player_midia_id = (:player_midia_id)");
    $v->bindValue(":player_midia_id", $player_midia_id);  
    $v->execute();
    if($v->rowCount() > 0){
        foreach($v->fetchAll() as $item){
            $player_visualizacoes += $item['player_visualizacoes'];    
        }
    }
    return $player_visualizacoes;
                      
}