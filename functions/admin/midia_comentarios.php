<?php 
function listar_comentarios(){
    global $pdo;
    $res = array();
    $v = $pdo->prepare("SELECT * FROM comentarios ORDER BY comentario_id DESC");
    $v->execute();
    if($v->rowCount() > 0){
        $res = $v->fetchAll();
    }
    return $res;

}
function contar_comentarios(){
    global $pdo;
    $v = $pdo->prepare("SELECT comentario_id FROM comentarios");
    $v->execute();
    return $v->rowCount();
}

function get_comentario_por_id($comentario_id){
    global $pdo;
    $v = $pdo->prepare("SELECT * FROM comentarios WHERE comentario_id = (:comentario_id) LIMIT 1");
    $v->bindValue(":comentario_id", $comentario_id);
    $v->execute();
    return $v->fetch();
}

function excluir_comentario($comentario_id){
    global $pdo;
    $del = $pdo->prepare("DELETE FROM comentarios WHERE comentario_id = (:comentario_id) LIMIT 1");
    $del->bindValue(":comentario_id", $comentario_id);
    if($del->execute()){
        return true;
    }
}