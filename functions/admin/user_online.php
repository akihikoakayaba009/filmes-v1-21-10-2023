<?php 
function get_users_online(){
    global $pdo;
    $res = array();
    $user_online = date("Y-m-d H:i:s", strtotime("-1 minute"));
    $v = $pdo->prepare("SELECT * FROM usuarios WHERE user_online > (:user_online)");
    $v->bindValue(":user_online", $user_online);
    $v->execute();
    if($v->rowCount() > 0){
        $res = $v->fetchAll();
    }
    return $res;
}