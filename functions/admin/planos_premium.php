<?php 
function adicionar_plano_premium($premium_titulo, $premium_diretorio,
                                 $premium_preco, $premium_dias_acesso,
                                 $premium_caracteristica , $premium_telas,
                                 $premium_consumo_creditos_revendedor){
    global $pdo;
    $cad = $pdo->prepare("INSERT INTO planos_premium SET 
                          premium_titulo = (:premium_titulo),
                          premium_diretorio = (:premium_diretorio),
                          premium_preco = (:premium_preco),
                          premium_dias_acesso = (:premium_dias_acesso),
                          premium_caracteristica = (:premium_caracteristica),
                          premium_telas = (:premium_telas),
                          premium_consumo_creditos_revendedor = (:premium_consumo_creditos_revendedor)");
    $cad->bindValue(":premium_titulo", $premium_titulo);
    $cad->bindValue(":premium_diretorio", $premium_diretorio);                      
    $cad->bindValue(":premium_preco", $premium_preco);
    $cad->bindValue(":premium_dias_acesso", $premium_dias_acesso);
    $cad->bindValue(":premium_caracteristica", $premium_caracteristica);
    $cad->bindValue(":premium_telas", $premium_telas);
    $cad->bindValue(":premium_consumo_creditos_revendedor", $premium_consumo_creditos_revendedor);
    if($cad->execute()){
        return true;
    }
}

function editar_plano_premium($premium_titulo, $premium_diretorio,
                              $premium_preco, $premium_dias_acesso,
                              $premium_caracteristica, $premium_telas, 
                              $premium_consumo_creditos_revendedor, $premium_id){
    global $pdo;
    $edt = $pdo->prepare("UPDATE planos_premium SET 
                          premium_titulo = (:premium_titulo),
                          premium_diretorio = (:premium_diretorio),
                          premium_preco = (:premium_preco),
                          premium_dias_acesso = (:premium_dias_acesso),
                          premium_caracteristica = (:premium_caracteristica),
                          premium_telas = (:premium_telas),
                          premium_consumo_creditos_revendedor = (:premium_consumo_creditos_revendedor) WHERE
                          premium_id = (:premium_id) LIMIT 1");
    $edt->bindValue(":premium_titulo", $premium_titulo);
    $edt->bindValue(":premium_diretorio", $premium_diretorio);                      
    $edt->bindValue(":premium_preco", $premium_preco);
    $edt->bindValue(":premium_dias_acesso", $premium_dias_acesso);
    $edt->bindValue(":premium_caracteristica", $premium_caracteristica);
    $edt->bindValue(":premium_telas", $premium_telas);
    $edt->bindValue(":premium_consumo_creditos_revendedor", $premium_consumo_creditos_revendedor);
    $edt->bindValue(":premium_id", $premium_id);
    if($edt->execute()){
        return true;
    }
}


function excluir_plano_premium($premium_id){
    global $pdo;
    $del = $pdo->prepare("UPDATE planos_premium SET 
                          plano_status = 0 WHERE 
                          premium_id = (:premium_id) LIMIT 1");
    $del->bindValue(":premium_id", $premium_id);
    if($del->execute()){
        return true;
    }                      
} 

function contar_plano_premium_por_diretorio($premium_diretorio){
    global $pdo;
    $v = $pdo->prepare("SELECT * FROM planos_premium WHERE premium_diretorio = (:premium_diretorio) AND plano_status = 1");
    $v->bindValue(":premium_diretorio", $premium_diretorio);
    $v->execute();
    return $v->rowCount();
}
 
function listar_plano_premium(){
    global $pdo;
    $res = array(); 
    $v = $pdo->prepare("SELECT * FROM planos_premium WHERE plano_status = 1 ORDER BY premium_preco * 1 ASC");
    $v->execute();
    if($v->rowCount() > 0){    
        $res = $v->fetchAll();
    }
    return $res;
}

function listar_todos_plano_premium(){
    global $pdo;
    $res = array(); 
    $v = $pdo->prepare("SELECT * FROM planos_premium");
    $v->execute();
    if($v->rowCount() > 0){    
        $res = $v->fetchAll();
    }
    return $res;
}

function contar_plano_premium(){
    global $pdo;
    $v = $pdo->prepare("SELECT premium_id, plano_status FROM planos_premium WHERE plano_status = 1");
    $v->execute();
    return $v->rowCount();
}

function get_plano_premium_por_id($premium_id){
    global $pdo;
    $v = $pdo->prepare("SELECT * FROM planos_premium WHERE 
                        premium_id = (:premium_id) AND 
                        plano_status = 1 LIMIT 1");
    $v->bindValue(":premium_id", $premium_id);
    $v->execute();
    return $v->fetch();                
}