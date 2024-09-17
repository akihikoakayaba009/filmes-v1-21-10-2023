<?php 
function cadastrar_visita(){
    global $pdo;
    $visita_ip = $_SERVER['REMOTE_ADDR'];
    $hoje = date("Y-m-d");
    $v = $pdo->prepare("SELECT * FROM visitas WHERE visita_data LIKE (:hoje) AND visita_ip = (:visita_ip)");
    $v->bindValue(":hoje", "%".$hoje."%");
    $v->bindValue(":visita_ip", $visita_ip);
    $v->execute();
    if($v->rowCount() < 1){ 
        $cad = $pdo->prepare("INSERT INTO visitas SET visita_ip = (:visita_ip)");
        $cad->bindValue(":visita_ip", $visita_ip);
        $cad->execute();
    }
}
