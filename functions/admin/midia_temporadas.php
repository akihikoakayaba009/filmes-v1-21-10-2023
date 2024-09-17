<?php
function adicionar_temporada($temporada_titulo, $temporada_diretorio, $temporada_midia_id){
    global $pdo;
    $cad = $pdo->prepare("INSERT INTO midia_temporadas SET 
                          temporada_titulo = (:temporada_titulo),
                          temporada_diretorio = (:temporada_diretorio),
                          temporada_midia_id = (:temporada_midia_id)");
    $cad->bindValue(":temporada_titulo", $temporada_titulo);
    $cad->bindValue(":temporada_diretorio", $temporada_diretorio);
    $cad->bindValue(":temporada_midia_id", $temporada_midia_id);
    if($cad->execute()){
        return true;
    }                      
} 

function editar_temporada($temporada_titulo, $temporada_diretorio, $temporada_midia_id,
                          $temporada_id){
    global $pdo;
    $up = $pdo->prepare("UPDATE midia_temporadas SET 
                         temporada_titulo = (:temporada_titulo),
                         temporada_diretorio = (:temporada_diretorio) WHERE
                         temporada_midia_id = (:temporada_midia_id) AND
                         temporada_id = (:temporada_id) LIMIT 1");
    $up->bindValue(":temporada_titulo", $temporada_titulo);
    $up->bindValue(":temporada_diretorio", $temporada_diretorio);
    $up->bindValue(":temporada_midia_id", $temporada_midia_id);
    $up->bindValue(":temporada_id", $temporada_id);
    if($up->execute()){
        return true;
    }                      
}

function verificar_temporada_por_diretorio($temporada_diretorio, $temporada_midia_id){
    global $pdo;
    $v = $pdo->prepare("SELECT * FROM midia_temporadas WHERE 
                        temporada_diretorio = (:temporada_diretorio) AND 
                        temporada_midia_id = (:temporada_midia_id)");
    $v->bindValue(":temporada_diretorio", $temporada_diretorio);
    $v->bindValue(":temporada_midia_id", $temporada_midia_id);
    $v->execute();
    return $v->rowCount();                    
}

function excluir_temporada($temporada_id, $temporada_midia_id){
    global $pdo;
    $v = $pdo->prepare("DELETE FROM midia_temporadas WHERE 
                        temporada_id = (:temporada_id) AND 
                        temporada_midia_id = (:temporada_midia_id) LIMIT 1");
    $v->bindValue(":temporada_id", $temporada_id);
    $v->bindValue(":temporada_midia_id", $temporada_midia_id);
    if($v->execute()){
        return true;
    }                    
}

function get_temporada_por_id($temporada_id, $temporada_midia_id){
    global $pdo;
    $v = $pdo->prepare("SELECT * FROM midia_temporadas WHERE 
                        temporada_id = (:temporada_id) AND 
                        temporada_midia_id = (:temporada_midia_id) LIMIT 1");
    $v->bindValue(":temporada_id", $temporada_id);    
    $v->bindValue(":temporada_midia_id", $temporada_midia_id);    
    $v->execute();
    return $v->fetch();                
}

function listar_temporadas($temporada_midia_id){
    global $pdo;
    $res = array();
    $v = $pdo->prepare("SELECT * FROM midia_temporadas WHERE 
                        temporada_midia_id = (:temporada_midia_id) ORDER BY 
                        temporada_titulo * 1, temporada_titulo ASC");
    $v->bindValue(":temporada_midia_id", $temporada_midia_id);
    $v->execute(); 
    if($v->rowCount() > 0){
        $res = $v->fetchAll();
    }                   
    return $res;
}

function contar_temporadas($temporada_midia_id){
    global $pdo;
    $v = $pdo->prepare("SELECT temporada_midia_id FROM midia_temporadas WHERE temporada_midia_id = (:temporada_midia_id)");
    $v->bindValue(":temporada_midia_id", $temporada_midia_id);
    $v->execute();
    return $v->rowCount();
}

function get_visualizacoes_temporada($player_midia_id, $player_temporada_id){
    global $pdo;
    $player_visualizacoes = 0;
    $v = $pdo->prepare("SELECT * FROM midia_players WHERE 
                        player_midia_id = (:player_midia_id) AND 
                        player_temporada_id = (:player_temporada_id)");
    $v->bindValue(":player_midia_id", $player_midia_id);  
    $v->bindValue(":player_temporada_id", $player_temporada_id);   
    $v->execute();
    if($v->rowCount() > 0){
        foreach($v->fetchAll() as $item){
            $player_visualizacoes += $item['player_visualizacoes'];    
        }
    }
    return $player_visualizacoes;
                      
}