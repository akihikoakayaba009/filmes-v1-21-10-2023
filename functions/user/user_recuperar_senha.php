<?php 
function get_user_por_email($user_email){
    global $pdo;
    $v = $pdo->prepare("SELECT * FROM usuarios WHERE 
                        user_email = (:user_email) LIMIT 1");
    $v->bindValue(":user_email", $user_email);     
    $v->execute();
    return $v->fetch();         
}

function get_user_por_hash_recuperar_senha($user_hash_recuperar_senha){
    global $pdo;
    $v = $pdo->prepare("SELECT * FROM usuarios WHERE 
                        user_hash_recuperar_senha = (:user_hash_recuperar_senha) AND 
                        user_hash_recuperar_senha_expiracao > NOW() LIMIT 1");
    $v->bindValue(":user_hash_recuperar_senha", $user_hash_recuperar_senha);
    $v->execute();
    return $v->fetch();

}

function atulizar_hash_recuperar_senha_user($user_hash_recuperar_senha, $user_hash_recuperar_senha_expiracao, $user_email, $user_id){
    global $pdo;
    $up = $pdo->prepare("UPDATE usuarios SET 
                         user_hash_recuperar_senha = (:user_hash_recuperar_senha),
                         user_hash_recuperar_senha_expiracao = (:user_hash_recuperar_senha_expiracao) WHERE 
                         user_email = (:user_email) AND  
                         user_id = (:user_id) LIMIT 1");
    $up->bindValue(":user_hash_recuperar_senha", $user_hash_recuperar_senha);
    $up->bindValue(":user_hash_recuperar_senha_expiracao", $user_hash_recuperar_senha_expiracao);
    $up->bindValue(":user_email", $user_email);
    $up->bindValue(":user_id", $user_id);
    if ($up->execute()) {
        return true;
    }
    return false;
}

function atualizar_senha_hash_recuperar($user_senha, $user_hash, $user_hash_recuperar_senha, $user_email, $user_id){
    global $pdo;
    $up = $pdo->prepare("UPDATE usuarios SET 
                         user_senha = (:user_senha),
                         user_hash = (:user_hash),
                         user_hash_recuperar_senha = NULL,
                         user_hash_recuperar_senha_expiracao = NULL WHERE
                         user_hash_recuperar_senha = (:user_hash_recuperar_senha) AND 
                         user_email = (:user_email) AND 
                         user_id = (:user_id) AND 
                         user_hash_recuperar_senha_expiracao > NOW() LIMIT 1");
    $up->bindValue(":user_senha", $user_senha); 
    $up->bindValue(":user_hash", $user_hash); 
    $up->bindValue(":user_hash_recuperar_senha", $user_hash_recuperar_senha);                    
    $up->bindValue(":user_email", $user_email); 
    $up->bindValue(":user_id", $user_id); 
    if($up->execute()){
        return true;
    }

}