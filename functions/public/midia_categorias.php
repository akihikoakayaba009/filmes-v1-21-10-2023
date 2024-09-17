<?php 
function contar_categorias_por_tipo($categoria_para){
    global $pdo;
    $v = $pdo->prepare("SELECT categoria_para FROM midia_categorias WHERE categoria_para = (:categoria_para)");
    $v->bindValue(":categoria_para", $categoria_para);
    $v->execute();
    return $v->rowCount();
}

function listar_categorias_v1($categoria_para){
    global $pdo;
    $res = array();
    $v = $pdo->prepare("SELECT * FROM midia_categorias WHERE categoria_para = (:categoria_para) ORDER BY categoria_titulo * 1, categoria_titulo ASC");
    $v->bindValue(":categoria_para", $categoria_para);
    $v->execute();
    if($v->rowCount() > 0){
        $res = $v->fetchAll();
    }
    return $res;
}

function get_categoria_por_diretorio($categoria_diretorio, $categoria_para){
    global $pdo;
    $v = $pdo->prepare("SELECT * FROM midia_categorias WHERE 
                        categoria_diretorio = (:categoria_diretorio) AND 
                        categoria_para = (:categoria_para) LIMIT 1");
    $v->bindValue(":categoria_diretorio", $categoria_diretorio);
    $v->bindValue(":categoria_para", $categoria_para);  
    $v->execute();
    return $v->fetch();                  
}

function get_categoria_por_id($categoria_para, $categoria_id){
    global $pdo;
    $v = $pdo->prepare("SELECT * FROM midia_categorias WHERE 
                        categoria_id = (:categoria_id) AND 
                        categoria_para = (:categoria_para) LIMIT 1");
    $v->bindValue(":categoria_id", $categoria_id);
    $v->bindValue(":categoria_para", $categoria_para);  
    $v->execute();
    return $v->fetch();
}