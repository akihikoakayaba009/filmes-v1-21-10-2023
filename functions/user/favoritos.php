<?php 
function adicionar_favorito($idUser, $emailUser, $idMidia){
    global $pdo;
    $cad = $pdo->prepare("INSERT INTO favoritos SET 
                          idUser = (:idUser),
                          emailUser = (:emailUser),
                          idMidia = (:idMidia)");
    $cad->bindValue(":idUser", $idUser);
    $cad->bindValue(":emailUser", $emailUser);
    $cad->bindValue(":idMidia", $idMidia);
    if($cad->execute()){
        return true;
    }
}

function listar_favoritos($idUser, $emailUser){
    global $pdo;
    $res = array();
    $v = $pdo->prepare("SELECT * FROM midia INNER JOIN favoritos ON 
                        favoritos.idUser = (:idUser) AND 
                        favoritos.emailUser = (:emailUser) AND 
                        midia.idMidia = favoritos.idMidia");
    $v->bindValue(":idUser", $idUser);
    $v->bindValue(":emailUser", $emailUser);
    $v->execute();
    if($v->rowCount() > 0){
        $res = $v->fetchAll();
    }
    return $res;
}

function verificar_favorito($idUser, $emailUser, $idMidia){
    global $pdo;
    $v = $pdo->prepare("SELECT * FROM favoritos WHERE 
                        idUser = (:idUser) AND 
                        emailUser = (:emailUser) AND 
                        idMidia = (:idMidia) LIMIT 1");
    $v->bindValue(":idUser", $idUser);
    $v->bindValue(":emailUser", $emailUser);
    $v->bindValue(":idMidia", $idMidia);
    $v->execute();
    if($v->rowCount() > 0){
        return true;
    }
}

function excluir_favorito($idUser, $emailUser, $idMidia){
    global $pdo;
    $del = $pdo->prepare("DELETE FROM favoritos WHERE 
                          idUser = (:idUser) AND 
                          emailUser = (:emailUser) AND 
                          idMidia = (:idMidia) LIMIT 1");
    $del->bindValue(":idUser", $idUser);
    $del->bindValue(":emailUser", $emailUser);
    $del->bindValue(":idMidia", $idMidia);
    if($del->execute()){
        return true;
    }
}