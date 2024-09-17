<?php 
function cadastrar_minha_lista($usuario_lista_midia_id, $usuario_lista_perfil_id){
    global $pdo;
    $cad = $pdo->prepare("INSERT INTO usuarios_lista SET 
                          usuario_lista_midia_id = (:usuario_lista_midia_id),
                          usuario_lista_perfil_id = (:usuario_lista_perfil_id)");
    $cad->bindValue(":usuario_lista_midia_id", $usuario_lista_midia_id);
    $cad->bindValue(":usuario_lista_perfil_id", $usuario_lista_perfil_id);
    if($cad->execute()){
        return true;
    }
}

function verificar_minha_lista($usuario_lista_midia_id, $usuario_lista_perfil_id){
    global $pdo;
    $v = $pdo->prepare("SELECT * FROM usuarios_lista WHERE     
                        usuario_lista_midia_id = (:usuario_lista_midia_id) AND 
                        usuario_lista_perfil_id = (:usuario_lista_perfil_id) LIMIT 1");
    $v->bindValue(":usuario_lista_midia_id", $usuario_lista_midia_id);
    $v->bindValue(":usuario_lista_perfil_id", $usuario_lista_perfil_id);
    $v->execute();
    return $v->rowCount();
}

function listar_minha_lista($usuario_lista_perfil_id){
    global $pdo;
    $res = array();
    $v = $pdo->prepare("SELECT * FROM midia INNER JOIN usuarios_lista ON 
                        usuarios_lista.usuario_lista_perfil_id = (:usuario_lista_perfil_id) AND 
                        midia.midia_id = usuarios_lista.usuario_lista_midia_id ORDER BY usuarios_lista.usuario_lista_id DESC");
    $v->bindValue(":usuario_lista_perfil_id", $usuario_lista_perfil_id);
    $v->execute();                    
    if($v->rowCount() > 0){
        $res = $v->fetchAll();
    }
    return $res;
}

function remover_minha_lista($usuario_lista_midia_id, $usuario_lista_perfil_id){
    global $pdo;
    $del = $pdo->prepare("DELETE FROM usuarios_lista WHERE 
                          usuario_lista_midia_id = (:usuario_lista_midia_id) AND 
                          usuario_lista_perfil_id = (:usuario_lista_perfil_id) LIMIT 1");
    $del->bindValue(":usuario_lista_midia_id", $usuario_lista_midia_id);
    $del->bindValue(":usuario_lista_perfil_id", $usuario_lista_perfil_id);
    if($del->execute()){
        return true;
    }                      
}