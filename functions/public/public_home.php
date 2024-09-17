<?php 
function get_novas_midias($midia_tipo){
    global $pdo;
    $res = array();
    $v = $pdo->prepare("SELECT * FROM midia WHERE midia_tipo = (:midia_tipo) ORDER BY midia_id DESC LIMIT 10");
    $v->bindValue(":midia_tipo", $midia_tipo);
    $v->execute();
    if($v->rowCount() > 0){
        $res = $v->fetchAll();
    }
    return $res;
}