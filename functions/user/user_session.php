<?php 
function get_user_por_email_e_senha($user_email, $user_senha){
    global $pdo;
    $v = $pdo->prepare("SELECT * FROM usuarios WHERE 
                        user_email = (:user_email) AND 
                        user_senha = (:user_senha) LIMIT 1");
    $v->bindValue(":user_email", $user_email); 
    $v->bindValue(":user_senha", $user_senha);      
    $v->execute();
    return $v->fetch();              
}

function get_user_por_hash($user_hash){
    global $pdo;
    $v = $pdo->prepare("SELECT * FROM usuarios WHERE 
                        user_hash = (:user_hash) LIMIT 1");
    $v->bindValue(":user_hash", $user_hash);      
    $v->execute();
    return $v->fetch();              
}

function atualizar_user_online($user_id, $user_email, $user_online){
    global $pdo;
    $v = $pdo->prepare("UPDATE usuarios SET 
                        user_online = (:user_online) WHERE 
                        user_id = (:user_id) AND 
                        user_email = (:user_email) LIMIT 1");
    $v->bindValue(":user_online", $user_online);
    $v->bindValue(":user_id", $user_id);
    $v->bindValue(":user_email", $user_email);
    $v->execute();                    
}