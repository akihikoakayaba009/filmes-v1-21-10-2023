<?php 
function get_revendedor_por_email_e_senha($revendedor_email, $revendedor_senha){
    global $pdo;
    $v = $pdo->prepare("SELECT * FROM revendedores WHERE 
                        revendedor_email = (:revendedor_email) AND 
                        revendedor_senha = (:revendedor_senha) LIMIT 1");
    $v->bindValue(":revendedor_email", $revendedor_email); 
    $v->bindValue(":revendedor_senha", $revendedor_senha);      
    $v->execute();
    return $v->fetch();              
}

function get_revendedor_por_hash($revendedor_hash){
    global $pdo;
    $v = $pdo->prepare("SELECT * FROM revendedores WHERE 
                        revendedor_hash = (:revendedor_hash) LIMIT 1");
    $v->bindValue(":revendedor_hash", $revendedor_hash);      
    $v->execute();
    return $v->fetch();              
}

function atualizar_revendedor_online($revendedor_email, $revendedor_id){
    global $pdo;
    $up = $pdo->prepare("UPDATE revendedores SET 
                         revendedor_online = NOW() WHERE 
                         revendedor_email = (:revendedor_email) AND 
                         revendedor_id = (:revendedor_id) LIMIT 1");
    $up->bindValue(":revendedor_email", $revendedor_email);
    $up->bindValue(":revendedor_id", $revendedor_id);
    if($up->execute()){
        return true;
    }                     
}