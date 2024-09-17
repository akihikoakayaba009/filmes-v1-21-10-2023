<?php 
function adicionar_usuario($user_nome, $user_email, $user_senha, $user_avatar, $user_premium, $user_hash, $user_online, $user_revendedor){
    global $pdo;
    $cad = $pdo->prepare("INSERT INTO usuarios SET 
                          user_nome = (:user_nome),
                          user_email = (:user_email),
                          user_senha = (:user_senha),
                          user_avatar = (:user_avatar),
                          user_premium = (:user_premium),
                          user_hash = (:user_hash),
                          user_online = (:user_online),
                          user_revendedor = (:user_revendedor)");
    $cad->bindValue(":user_nome", $user_nome); 
    $cad->bindValue(":user_email", $user_email); 
    $cad->bindValue(":user_senha", $user_senha); 
    $cad->bindValue(":user_avatar", $user_avatar); 
    $cad->bindValue(":user_premium", $user_premium); 
    $cad->bindValue(":user_hash", $user_hash);    
    $cad->bindValue(":user_online", $user_online);  
    $cad->bindValue(":user_revendedor", $user_revendedor);     
    if($cad->execute()){
        return true;
    }                 
}

function get_user($user_id, $user_email){ 
    global $pdo;
    $v = $pdo->prepare("SELECT * FROM usuarios WHERE user_id = (:user_id) AND user_email = (:user_email) LIMIT 1");
    $v->bindValue(":user_id", $user_id);
    $v->bindValue(":user_email", $user_email);
    $v->execute();
    return $v->fetch();
}


function get_user_por_id($user_id){
    global $pdo;
    $v = $pdo->prepare("SELECT * FROM usuarios WHERE user_id = (:user_id) LIMIT 1");
    $v->bindValue(":user_id", $user_id);
    $v->execute();
    return $v->fetch();
}

function listar_usuarios($user_revendedor){
    global $pdo;
    $res = array();
    $v = $pdo->prepare("SELECT * FROM usuarios WHERE user_revendedor = (:user_revendedor)");
    $v->bindValue(":user_revendedor", $user_revendedor);
    $v->execute();
    if($v->rowCount() > 0){
        $res = $v->fetchAll();
    }
    return $res;
}

function alterar_senha_user($user_senha, $user_hash, $user_id, $user_email){
    global $pdo;
    $up = $pdo->prepare("UPDATE usuarios SET 
                         user_senha = (:user_senha),
                         user_hash = (:user_hash) WHERE
                         user_id = (:user_id) AND 
                         user_email = (:user_email) LIMIT 1");
    $up->bindValue(":user_senha", $user_senha);
    $up->bindValue(":user_hash", $user_hash);
    $up->bindValue(":user_id", $user_id);
    $up->bindValue(":user_email", $user_email);
    if($up->execute()){
        return true;
    }                     
}