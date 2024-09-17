<?php 
function get_revendedor_por_email($revendedor_email){
    global $pdo;
    $v = $pdo->prepare("SELECT * FROM revendedores WHERE 
                        revendedor_email = (:revendedor_email) LIMIT 1");
    $v->bindValue(":revendedor_email", $revendedor_email);     
    $v->execute();
    return $v->fetch();         
}

function get_revendedor_por_hash_recuperar_senha($revendedor_hash_recuperar_senha){
    global $pdo;
    $v = $pdo->prepare("SELECT * FROM revendedores WHERE 
                        revendedor_hash_recuperar_senha = (:revendedor_hash_recuperar_senha) AND 
                        revendedor_hash_recuperar_senha_expiracao > NOW() LIMIT 1");
    $v->bindValue(":revendedor_hash_recuperar_senha", $revendedor_hash_recuperar_senha);
    $v->execute();
    return $v->fetch();

}

function atulizar_hash_recuperar_senha_revendedor($revendedor_hash_recuperar_senha, $revendedor_hash_recuperar_senha_expiracao, $revendedor_email, $revendedor_id){
    global $pdo;
    $up = $pdo->prepare("UPDATE revendedores SET 
                         revendedor_hash_recuperar_senha = (:revendedor_hash_recuperar_senha),
                         revendedor_hash_recuperar_senha_expiracao = (:revendedor_hash_recuperar_senha_expiracao) WHERE 
                         revendedor_email = (:revendedor_email) AND  
                         revendedor_id = (:revendedor_id) LIMIT 1");
    $up->bindValue(":revendedor_hash_recuperar_senha", $revendedor_hash_recuperar_senha);
    $up->bindValue(":revendedor_hash_recuperar_senha_expiracao", $revendedor_hash_recuperar_senha_expiracao);
    $up->bindValue(":revendedor_email", $revendedor_email);
    $up->bindValue(":revendedor_id", $revendedor_id);
    if ($up->execute()) {
        return true;
    }
    return false;
}

function atualizar_senha_hash_recuperar($revendedor_senha, $revendedor_hash, $revendedor_hash_recuperar_senha, $revendedor_email, $revendedor_id){
    global $pdo;
    $up = $pdo->prepare("UPDATE revendedores SET 
                         revendedor_senha = (:revendedor_senha),
                         revendedor_hash = (:revendedor_hash),
                         revendedor_hash_recuperar_senha = NULL,
                         revendedor_hash_recuperar_senha_expiracao = NULL WHERE
                         revendedor_hash_recuperar_senha = (:revendedor_hash_recuperar_senha) AND 
                         revendedor_email = (:revendedor_email) AND 
                         revendedor_id = (:revendedor_id) AND 
                         revendedor_hash_recuperar_senha_expiracao > NOW() LIMIT 1");
    $up->bindValue(":revendedor_senha", $revendedor_senha); 
    $up->bindValue(":revendedor_hash", $revendedor_hash); 
    $up->bindValue(":revendedor_hash_recuperar_senha", $revendedor_hash_recuperar_senha);                    
    $up->bindValue(":revendedor_email", $revendedor_email); 
    $up->bindValue(":revendedor_id", $revendedor_id); 
    if($up->execute()){
        return true;
    }

}