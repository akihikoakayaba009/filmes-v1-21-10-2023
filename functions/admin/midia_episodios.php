<?php 
function adicionar_episodio($episodio_titulo, $episodio_numero, $episodio_image, $episodio_descricao,
                            $episodio_diretorio, $episodio_temporada_id, $episodio_midia_id){
    global $pdo;
    $cad = $pdo->prepare("INSERT INTO midia_episodios SET 
                          episodio_titulo = (:episodio_titulo),
                          episodio_numero = (:episodio_numero),
                          episodio_image = (:episodio_image),
                          episodio_descricao = (:episodio_descricao),
                          episodio_diretorio = (:episodio_diretorio),
                          episodio_temporada_id = (:episodio_temporada_id),
                          episodio_midia_id = (:episodio_midia_id)");
    $cad->bindValue(":episodio_titulo", $episodio_titulo);
    $cad->bindValue(":episodio_numero", $episodio_numero);
    $cad->bindValue(":episodio_image", $episodio_image);
    $cad->bindValue(":episodio_descricao", $episodio_descricao);
    $cad->bindValue(":episodio_diretorio", $episodio_diretorio);
    $cad->bindValue(":episodio_temporada_id", $episodio_temporada_id);                      
    $cad->bindValue(":episodio_midia_id", $episodio_midia_id);
    if($cad->execute()){
        return true;
    }
}

function editar_episodio($episodio_titulo, $episodio_numero, $episodio_image, $episodio_descricao,
                         $episodio_diretorio, $episodio_temporada_id, $episodio_midia_id, $episodio_id){
    global $pdo;
    $edt = $pdo->prepare("UPDATE midia_episodios SET 
                          episodio_titulo = (:episodio_titulo),
                          episodio_numero = (:episodio_numero),
                          episodio_image = (:episodio_image),
                          episodio_descricao = (:episodio_descricao),
                          episodio_diretorio = (:episodio_diretorio) WHERE
                          episodio_temporada_id = (:episodio_temporada_id) AND 
                          episodio_midia_id = (:episodio_midia_id) AND 
                          episodio_id = (:episodio_id) LIMIT 1");
    $edt->bindValue(":episodio_titulo", $episodio_titulo);
    $edt->bindValue(":episodio_numero", $episodio_numero);
    $edt->bindValue(":episodio_image", $episodio_image);
    $edt->bindValue(":episodio_descricao", $episodio_descricao);
    $edt->bindValue(":episodio_diretorio", $episodio_diretorio);
    $edt->bindValue(":episodio_temporada_id", $episodio_temporada_id);                      
    $edt->bindValue(":episodio_midia_id", $episodio_midia_id);
    $edt->bindValue(":episodio_id", $episodio_id);
    if($edt->execute()){
        return true;
    }
}

function verificar_episodio_por_diretorio($episodio_diretorio, $episodio_temporada_id, $episodio_midia_id){
    global $pdo;
    $v = $pdo->prepare("SELECT * FROM midia_episodios WHERE 
                        episodio_diretorio = (:episodio_diretorio) AND 
                        episodio_temporada_id = (:episodio_temporada_id) AND 
                        episodio_midia_id = (:episodio_midia_id)");
    $v->bindValue(":episodio_diretorio", $episodio_diretorio);
    $v->bindValue(":episodio_temporada_id", $episodio_temporada_id);                    
    $v->bindValue(":episodio_midia_id", $episodio_midia_id);
    $v->execute();
    return $v->rowCount();
}

function verifica_episodio_existe($episodio_numero, $episodio_temporada_id, $episodio_midia_id){
    global $pdo;
    $v = $pdo->prepare("SELECT * FROM midia_episodios WHERE 
                        episodio_numero = (:episodio_numero) AND 
                        episodio_temporada_id = (:episodio_temporada_id) AND 
                        episodio_midia_id = (:episodio_midia_id)");
    $v->bindValue(":episodio_numero", $episodio_numero);
    $v->bindValue(":episodio_temporada_id", $episodio_temporada_id);                    
    $v->bindValue(":episodio_midia_id", $episodio_midia_id);
    $v->execute();
    return $v->rowCount();
}

function excluir_episodio($episodio_temporada_id, $episodio_midia_id, $episodio_id){
    global $pdo;
    $del = $pdo->prepare("DELETE FROM midia_episodios WHERE 
                          episodio_temporada_id = (:episodio_temporada_id) AND 
                          episodio_midia_id = (:episodio_midia_id) AND
                          episodio_id = (:episodio_id) LIMIT 1");
    $del->bindValue(":episodio_temporada_id", $episodio_temporada_id);                    
    $del->bindValue(":episodio_midia_id", $episodio_midia_id);                    
    $del->bindValue(":episodio_id", $episodio_id);                    
    if($del->execute()){
        return true;
    }
} 

function get_episodio_por_id($episodio_temporada_id, $episodio_midia_id, $episodio_id){
    global $pdo;
    $v = $pdo->prepare("SELECT * FROM midia_episodios WHERE
                        episodio_temporada_id = (:episodio_temporada_id) AND 
                        episodio_midia_id = (:episodio_midia_id) AND 
                        episodio_id = (:episodio_id) LIMIT 1");
    $v->bindValue(":episodio_temporada_id", $episodio_temporada_id);     
    $v->bindValue(":episodio_midia_id", $episodio_midia_id);       
    $v->bindValue(":episodio_id", $episodio_id);       
    $v->execute();
    return $v->fetch();             
}

function listar_episodios($episodio_temporada_id, $episodio_midia_id){
    global $pdo;
    $res = array();
    $v = $pdo->prepare("SELECT * FROM midia_episodios WHERE 
                        episodio_temporada_id = (:episodio_temporada_id) AND 
                        episodio_midia_id = (:episodio_midia_id) ORDER BY episodio_numero ASC");
    $v->bindValue(":episodio_temporada_id", $episodio_temporada_id);  
    $v->bindValue(":episodio_midia_id", $episodio_midia_id);      
    $v->execute();
    if($v->rowCount() > 0){
        $res = $v->fetchAll();
    }              
    return $res;
} 

function contar_episodios($episodio_midia_id){
    global $pdo;
    $v = $pdo->prepare("SELECT episodio_midia_id FROM midia_episodios WHERE episodio_midia_id = (:episodio_midia_id)");
    $v->bindValue(":episodio_midia_id", $episodio_midia_id);
    $v->execute();
    return $v->rowCount();
}

function contar_episodios_por_temporada($episodio_midia_id,$episodio_temporada_id){
    global $pdo;
    $v = $pdo->prepare("SELECT episodio_midia_id,episodio_temporada_id FROM midia_episodios WHERE 
                        episodio_midia_id = (:episodio_midia_id) AND 
                        episodio_temporada_id = (:episodio_temporada_id)");
    $v->bindValue(":episodio_midia_id", $episodio_midia_id);
    $v->bindValue(":episodio_temporada_id", $episodio_temporada_id);
    $v->execute();
    return $v->rowCount();
}

function get_visualizacoes_episodio($player_midia_id, $player_temporada_id, $player_episodio_id){
    global $pdo;
    $player_visualizacoes = 0;
    $v = $pdo->prepare("SELECT * FROM midia_players WHERE 
                        player_midia_id = (:player_midia_id) AND 
                        player_temporada_id = (:player_temporada_id) AND
                        player_episodio_id = (:player_episodio_id)");
    $v->bindValue(":player_midia_id", $player_midia_id);  
    $v->bindValue(":player_temporada_id", $player_temporada_id);  
    $v->bindValue(":player_episodio_id", $player_episodio_id);  
    $v->execute();
    if($v->rowCount() > 0){
        foreach($v->fetchAll() as $item){
            $player_visualizacoes += $item['player_visualizacoes'];    
        }
    }
    return $player_visualizacoes;
                      
}

function get_episodio_por_numero($episodio_numero, $episodio_midia_id, $episodio_temporada_id){
    global $pdo;
    $v = $pdo->prepare("SELECT * FROM midia_episodios WHERE 
                        episodio_numero = (:episodio_numero) AND 
                        episodio_midia_id = (:episodio_midia_id) AND 
                        episodio_temporada_id = (:episodio_temporada_id) LIMIT 1");
    $v->bindValue(":episodio_numero", $episodio_numero);
    $v->bindValue(":episodio_midia_id", $episodio_midia_id);                    
    $v->bindValue(":episodio_temporada_id", $episodio_temporada_id);
    $v->execute();
    return $v->fetch();
}