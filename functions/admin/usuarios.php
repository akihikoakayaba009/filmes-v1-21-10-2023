<?php 
function adicionar_usuario($user_nome, $user_email, $user_senha, $user_avatar, $user_premium, $user_hash, $user_online){
    global $pdo;
    $cad = $pdo->prepare("INSERT INTO usuarios SET 
                          user_nome = (:user_nome),
                          user_email = (:user_email),
                          user_senha = (:user_senha),
                          user_avatar = (:user_avatar),
                          user_premium = (:user_premium),
                          user_hash = (:user_hash),
                          user_online = (:user_online)");
    $cad->bindValue(":user_nome", $user_nome); 
    $cad->bindValue(":user_email", $user_email); 
    $cad->bindValue(":user_senha", $user_senha); 
    $cad->bindValue(":user_avatar", $user_avatar); 
    $cad->bindValue(":user_premium", $user_premium); 
    $cad->bindValue(":user_hash", $user_hash);    
    $cad->bindValue(":user_online", $user_online);     
    if($cad->execute()){
        return true;
    }                 
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

function contar_usuarios(){
    global $pdo;
    $v = $pdo->prepare("SELECT user_id FROM usuarios");
    $v->execute();
    return $v->rowCount();
}

function listar_usuarios(){
    global $pdo;
    $res = array();
    $v = $pdo->prepare("SELECT * FROM usuarios");
    $v->execute();
    if($v->rowCount() > 0){
        $res = $v->fetchAll();
    }
    return $res;
}

function contar_usuarios_premium(){
    global $pdo;
    $v = $pdo->prepare("SELECT * FROM usuarios WHERE user_premium > NOW()");
    $v->execute();
    return $v->rowCount();
}

function contar_usuarios_expirado(){
    global $pdo;
    $v = $pdo->prepare("SELECT * FROM usuarios WHERE user_premium < NOW()");
    $v->execute();
    return $v->rowCount();
}

function excluir_usuario($user_id, $user_email){
    global $pdo;
    $del = $pdo->prepare("DELETE FROM usuarios WHERE user_id = (:user_id) AND user_email = (:user_email) LIMIT 1");
    $del->bindValue(":user_id", $user_id);
    $del->bindValue(":user_email", $user_email);
    if($del->execute()){
        return true;
    }
}


