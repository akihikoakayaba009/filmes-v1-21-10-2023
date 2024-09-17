<?php 
function get_visitas_hoje(){
    global $pdo;
    $hoje = date("Y-m-d");
    $v = $pdo->prepare("SELECT * FROM visitas WHERE visita_data LIKE (:hoje)");
    $v->bindValue(":hoje", "%".$hoje."%");
    $v->execute();
    return $v->rowCount();
}

function get_visitas_ontem(){
    global $pdo;
    $hoje = date("Y-m-d", strtotime("- 1 days"));
    $v = $pdo->prepare("SELECT * FROM visitas WHERE visita_data LIKE (:hoje)");
    $v->bindValue(":hoje", "%".$hoje."%");
    $v->execute();
    return $v->rowCount();
}

function get_visitas_mes(){
    global $pdo;
    $hoje = date("Y-m");
    $v = $pdo->prepare("SELECT * FROM visitas WHERE visita_data LIKE (:hoje)");
    $v->bindValue(":hoje", "%".$hoje."%");
    $v->execute();
    return $v->rowCount();
}

function get_visitas_mes_passado(){
    global $pdo;
    $hoje = date("Y-m", strtotime("- 1 month"));
    $v = $pdo->prepare("SELECT * FROM visitas WHERE visita_data LIKE (:hoje)");
    $v->bindValue(":hoje", "%".$hoje."%");
    $v->execute();
    return $v->rowCount();
}