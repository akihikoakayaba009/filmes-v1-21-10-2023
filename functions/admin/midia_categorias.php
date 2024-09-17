<?php 
function get_categoria_por_id($categoria_para, $categoria_id){
    global $pdo;
    $v = $pdo->prepare("SELECT * FROM midia_categorias WHERE 
                        categoria_para = (:categoria_para) AND 
                        categoria_id = (:categoria_id) LIMIT 1");
    $v->bindValue(":categoria_para", $categoria_para);
    $v->bindValue(":categoria_id", $categoria_id);
    $v->execute();
    return $v->fetch();                    
}

function listar_categoria(){
    global $pdo;
    $res = array();
    $v = $pdo->prepare("SELECT * FROM midia_categorias");
    $v->execute();
    if($v->rowCount() > 0){
        $res = $v->fetchAll();
    }
    return $res;
}


function verificar_categoria_existe($categoria_diretorio, $categoria_para){
    global $pdo;
    $v = $pdo->prepare("SELECT * FROM midia_categorias WHERE     
                        categoria_diretorio = (:categoria_diretorio) AND 
                        categoria_para = (:categoria_para)");
    $v->bindValue(":categoria_diretorio", $categoria_diretorio);
    $v->bindValue(":categoria_para", $categoria_para);
    $v->execute();
    return $v->rowCount();                    
}

function adicionar_categoria($categoria_titulo, $categoria_descricao, $categoria_para,
                             $categoria_image, $categoria_diretorio){

    global $pdo;
    $cad = $pdo->prepare("INSERT INTO midia_categorias SET 
                          categoria_titulo = (:categoria_titulo),
                          categoria_descricao = (:categoria_descricao),
                          categoria_para = (:categoria_para),
                          categoria_image = (:categoria_image),
                          categoria_diretorio = (:categoria_diretorio)");
    $cad->bindValue(":categoria_titulo", $categoria_titulo);
    $cad->bindValue(":categoria_descricao", $categoria_descricao);
    $cad->bindValue(":categoria_para", $categoria_para);
    $cad->bindValue(":categoria_image", $categoria_image);
    $cad->bindValue(":categoria_diretorio", $categoria_diretorio);
    if($cad->execute()){
        return true;
    }                      

}

function editar_categoria($categoria_titulo, $categoria_descricao, $categoria_para,
                          $categoria_image, $categoria_diretorio,
                          $categoria_id){
    global $pdo;
    $up = $pdo->prepare("UPDATE midia_categorias SET 
                         categoria_titulo = (:categoria_titulo),
                         categoria_descricao = (:categoria_descricao),
                         categoria_para = (:categoria_para),
                         categoria_image = (:categoria_image),
                         categoria_diretorio = (:categoria_diretorio) WHERE 
                         categoria_id = (:categoria_id) LIMIT 1");
    $up->bindValue(":categoria_titulo", $categoria_titulo);
    $up->bindValue(":categoria_descricao", $categoria_descricao);
    $up->bindValue(":categoria_para", $categoria_para);
    $up->bindValue(":categoria_image", $categoria_image);
    $up->bindValue(":categoria_diretorio", $categoria_diretorio);
    $up->bindValue(":categoria_id", $categoria_id);
    if($up->execute()){
        return true;
    }                                             

}

function excluir_categoria($categoria_id){
    global $pdo;
    $v = $pdo->prepare("DELETE FROM midia_categorias WHERE 
                        categoria_id = (:categoria_id) LIMIT 1");
    $v->bindValue(":categoria_id", $categoria_id);
    if($v->execute()){
        return true;
    }                    
}


function listar_categoria_por_tipo($categoria_para){
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
