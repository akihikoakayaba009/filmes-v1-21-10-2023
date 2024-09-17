<?php 
function cadastrar_item_carousel($carousel_item_url, $carousel_item_url_destino, 
                                 $carousel_para, $carousel_posicao){
        global $pdo;
        $cad = $pdo->prepare("INSERT INTO carousel SET 
                             carousel_item_url  = (:carousel_item_url),
                             carousel_item_url_destino  = (:carousel_item_url_destino),
                             carousel_para  = (:carousel_para),
                             carousel_posicao  = (:carousel_posicao)");
        $cad->bindValue(":carousel_item_url", $carousel_item_url);
        $cad->bindValue(":carousel_item_url_destino", $carousel_item_url_destino);                                                   
        $cad->bindValue(":carousel_para", $carousel_para);
        $cad->bindValue(":carousel_posicao", $carousel_posicao);
        if($cad->execute()){
            return true;
        }
            return false;

}

function get_carousel_para($carousel_para){
    global $pdo;
    $array = array();
    $v = $pdo->prepare("SELECT * FROM carousel WHERE 
                        carousel_para = (:carousel_para) ORDER BY carousel_posicao ASC");
    $v->bindValue(":carousel_para", $carousel_para);                    
    $v->execute();
    if($v->rowCount() > 0){
         $array = $v->fetchAll();
    }
    return $array;
    
}


function contar_carousel_item_para($carousel_para){
    global $pdo;
    $v = $pdo->prepare("SELECT carousel_para FROM carousel WHERE carousel_para = (:carousel_para)");
    $v->bindValue(":carousel_para", $carousel_para);
    $v->execute();
    return $v->rowCount();
}


function get_carousel_item_por_id($carousel_id){
    global $pdo;
    $v = $pdo->prepare("SELECT * FROM carousel WHERE carousel_id = (:carousel_id) LIMIT 1");
    $v->bindValue(":carousel_id", $carousel_id);
    $v->execute();
    return $v->fetch();
}

function verificar_posicao_carousel_existe($carousel_para, $carousel_posicao){
    global $pdo;
    $v = $pdo->prepare("SELECT carousel_para,carousel_posicao FROM carousel WHERE 
                        carousel_para = (:carousel_para) AND 
                        carousel_posicao = (:carousel_posicao)");
    $v->bindValue(":carousel_para", $carousel_para);
    $v->bindValue(":carousel_posicao", $carousel_posicao);
    $v->execute();
    return $v->rowCount();
}

function editar_item_carousel($carousel_item_url, $carousel_item_url_destino, $carousel_para,
                              $carousel_posicao, $carousel_id){
        global $pdo;
        $cad = $pdo->prepare("UPDATE carousel SET 
                             carousel_item_url  = (:carousel_item_url),
                             carousel_item_url_destino  = (:carousel_item_url_destino),
                             carousel_para  = (:carousel_para),
                             carousel_posicao = (:carousel_posicao) WHERE 
                             carousel_id = (:carousel_id) LIMIT 1");
        $cad->bindValue(":carousel_item_url", $carousel_item_url);
        $cad->bindValue(":carousel_item_url_destino", $carousel_item_url_destino);                                                  
        $cad->bindValue(":carousel_para", $carousel_para);
        $cad->bindValue(":carousel_posicao", $carousel_posicao);
        $cad->bindValue(":carousel_id", $carousel_id);
        if($cad->execute()){
            return true;
        }
            return false;

}

function excluir_item_carousel($carousel_id){
    global $pdo;
    $del = $pdo->prepare("DELETE FROM carousel WHERE carousel_id = (:carousel_id) LIMIT 1");
    $del->bindValue(":carousel_id", $carousel_id);
    if($del->execute()){
        return true;
    }
}

function verificar_carousel_para($carousel_para){
    $array = array("home");
    if(in_array($carousel_para, $array)){
        return true;
    }
}