<?php 
function verificar_login_revendedor($revendedor_email, $revendedor_senha){
    global $pdo;
    
    $v = $pdo->prepare("SELECT revendedor_email,revendedor_senha FROM revendedores WHERE 
                        revendedor_email = (:revendedor_email) AND 
                        revendedor_senha = (:revendedor_senha)");
    $v->bindValue(":revendedor_email", $revendedor_email);
    $v->bindValue(":revendedor_senha", $revendedor_senha);
    $v->execute();
    return $v->rowCount();               
}