<?php 
function listar_plano_premium(){
    global $pdo;
    $res = array(); 
    $v = $pdo->prepare("SELECT * FROM planos_premium WHERE plano_status = 1 ORDER BY premium_preco * 1 ASC");
    $v->execute();
    if($v->rowCount() > 0){    
        $res = $v->fetchAll();
    }
    return $res;
}

function contar_plano_premium(){
    global $pdo;
    $v = $pdo->prepare("SELECT premium_id, plano_status FROM planos_premium WHERE plano_status = 1");
    $v->execute();
    return $v->rowCount();
}

function get_plano_premium_por_id($premium_id){
    global $pdo;
    $v = $pdo->prepare("SELECT * FROM planos_premium WHERE 
                        premium_id = (:premium_id) AND 
                        plano_status = 1 LIMIT 1");
    $v->bindValue(":premium_id", $premium_id);
    $v->execute();
    return $v->fetch();                
}