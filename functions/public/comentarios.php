<?php 
function cadastrar_comentario($comentario, $comentario_midia_id, $comentario_perfil_apelido, $comentario_perfil_id, $comentario_perfil_avatar){
    global $pdo;
    $cad = $pdo->prepare("INSERT INTO comentarios SET 
                          comentario = (:comentario),
                          comentario_midia_id = (:comentario_midia_id),
                          comentario_perfil_apelido = (:comentario_perfil_apelido),
                          comentario_perfil_id = (:comentario_perfil_id),
                          comentario_perfil_avatar = (:comentario_perfil_avatar)");
    $cad->bindValue(":comentario", $comentario);
    $cad->bindValue(":comentario_midia_id", $comentario_midia_id);
    $cad->bindValue(":comentario_perfil_apelido", $comentario_perfil_apelido);
    $cad->bindValue(":comentario_perfil_id", $comentario_perfil_id);
    $cad->bindValue(":comentario_perfil_avatar", $comentario_perfil_avatar);
    if($cad->execute()){
        return true;
    }
}


function exibir_comentarios($comentario_midia_id){
    global $pdo;
    $res = array();
    $v = $pdo->prepare("SELECT * FROM comentarios WHERE comentario_midia_id = (:comentario_midia_id) ORDER BY comentario_id DESC");
    $v->bindValue(":comentario_midia_id", $comentario_midia_id);
    $v->execute();
    if($v->rowCount() > 0){
        $res = $v->fetchAll();
    }

    return $res;
}