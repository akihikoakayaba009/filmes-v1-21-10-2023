<?php 
function listar_vendas(){
    global $pdo;
    $res = array();
    $v = $pdo->prepare("SELECT * FROM vendas  ORDER BY venda_id DESC");
    $v->execute();
    $res = $v->fetchAll();
    return $res;
} 

function contar_vendas($venda_status=""){
    global $pdo;
 
    if($venda_status == 'approved'){
        $v = $pdo->prepare("SELECT venda_id,venda_status FROM vendas WHERE venda_status = 'approved' AND venda_finalizada = 'sim'");
    
    }else if($venda_status == 'pending'){
        $v = $pdo->prepare("SELECT venda_id,venda_status FROM vendas WHERE venda_status = 'pending' OR venda_status = 'in_process' AND venda_finalizada = 'nao'");
    }else{
        $v = $pdo->prepare("SELECT venda_id FROM vendas");
    }

    $v->execute();
    return $v->rowCount();

}

function listar_venda_por_user_id_email($venda_user_id, $venda_user_email){
    global $pdo;
    $res = array();
    $v = $pdo->prepare("SELECT * FROM vendas WHERE 
                        venda_user_id = (:venda_user_id) AND 
                        venda_user_email = (:venda_user_email) ORDER BY venda_id DESC");
    $v->bindValue(":venda_user_id", $venda_user_id);    
    $v->bindValue(":venda_user_email", $venda_user_email);
    $v->execute();
    if($v->rowCount() > 0){
        $res = $v->fetchAll();
    }                    
    return $res;
} 