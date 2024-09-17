<?php 
function adicionar_monetizacao($monetizacao_posicao, $monetizacao_codigo, $monetizacao_titulo){
    global $pdo;
    $cad = $pdo->prepare("INSERT INTO site_monetizacao  SET 
                          monetizacao_posicao = (:monetizacao_posicao),
                          monetizacao_codigo = (:monetizacao_codigo),
                          monetizacao_titulo = (:monetizacao_titulo)");
    $cad->bindValue(":monetizacao_posicao", $monetizacao_posicao);       
    $cad->bindValue(":monetizacao_codigo", $monetizacao_codigo);   
    $cad->bindValue(":monetizacao_titulo", $monetizacao_titulo);       
    if($cad->execute()){
        return true;
    }               
}

function editar_monetizacao($monetizacao_posicao, $monetizacao_codigo, $monetizacao_titulo, $monetizacao_id){
    global $pdo;
    $edt = $pdo->prepare("UPDATE site_monetizacao  SET 
                          monetizacao_posicao = (:monetizacao_posicao),
                          monetizacao_codigo = (:monetizacao_codigo),
                          monetizacao_titulo = (:monetizacao_titulo) WHERE 
                          monetizacao_id = (:monetizacao_id) LIMIT 1");
    $edt->bindValue(":monetizacao_posicao", $monetizacao_posicao);       
    $edt->bindValue(":monetizacao_codigo", $monetizacao_codigo);    
    $edt->bindValue(":monetizacao_titulo", $monetizacao_titulo);    
    $edt->bindValue(":monetizacao_id", $monetizacao_id);       
    if($edt->execute()){
        return true;
    }               
}

function excluir_monetizacao($monetizacao_id){
    global $pdo;
    $del = $pdo->prepare("DELETE FROM site_monetizacao WHERE 
                          monetizacao_id = (:monetizacao_id) LIMIT 1");
    $del->bindValue(":monetizacao_id", $monetizacao_id);
    if($del->execute()){
        return true;
    }                      
}

function get_monetizacao_por_id($monetizacao_id){
    global $pdo;
    $v = $pdo->prepare("SELECT * FROM site_monetizacao WHERE 
                        monetizacao_id = (:monetizacao_id) LIMIT 1");
    $v->bindValue(":monetizacao_id", $monetizacao_id);
    $v->execute();
    return $v->fetch();                    
}

function listar_monetizacao(){
    global $pdo;
    $res = array();
    $v = $pdo->prepare("SELECT * FROM site_monetizacao");
    $v->execute();
    if($v->rowCount() > 0){
        $res = $v->fetchAll();
    }
    return $res;
} 

function verificar_monetizacao_posicao($monetizacao_posicao){
    $array = array("head");
    if(in_array($monetizacao_posicao, $array)){
        return true;
    }
}