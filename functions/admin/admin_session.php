<?php 
function admin_login($email, $senha){
    global $pdo;
    $v = $pdo->prepare("SELECT * FROM administradores WHERE 
                        admin_email = (:email) AND 
                        admin_senha = (:senha) LIMIT 1");
    $v->bindValue(":email", $email);
    $v->bindValue(":senha", $senha);
    $v->execute();
    return $v->fetch();  

} 
function get_admin_por_hash($admin_hash){
    global $pdo;
    $v = $pdo->prepare("SELECT * FROM administradores WHERE 
                        admin_hash = (:admin_hash) LIMIT 1");
    $v->bindValue(":admin_hash", $admin_hash);     
    $v->execute();
    return $v->fetch();                
}

function atualiza_sessao_admin($admin_email,$admin_id,$admin_hash){
    global $pdo;  
    $up = $pdo->prepare("UPDATE administradores SET 
                         admin_hash = (:admin_hash),
                         admin_ultimo_login = NOW(),
                         admin_online = NOW() WHERE 
                         admin_email = (:admin_email) AND 
                         admin_id = (:admin_id) LIMIT 1");
    $up->bindValue(":admin_hash", $admin_hash);
    $up->bindValue(":admin_email", $admin_email);                      
    $up->bindValue(":admin_id", $admin_id);
    if($up->execute()){
        return true;
    }
    return false;
}

function cadastrar_admin_online($admin_id, $admin_email){
    global $pdo;
    $cad = $pdo->prepare("UPDATE administradores SET 
                          admin_online = NOW() WHERE
                          admin_id = (:admin_id) AND 
                          admin_email = (:admin_email) LIMIT 1");
    $cad->bindValue(":admin_id", $admin_id);
    $cad->bindValue(":admin_email", $admin_email);
    $cad->execute();                      
}