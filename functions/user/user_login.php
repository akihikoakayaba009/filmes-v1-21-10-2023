<?php 
function verificar_login_user($user_email, $user_senha){
    global $pdo;
    
    $v = $pdo->prepare("SELECT user_email,user_senha FROM usuarios WHERE 
                        user_email = (:user_email) AND 
                        user_senha = (:user_senha)");
    $v->bindValue(":user_email", $user_email);
    $v->bindValue(":user_senha", $user_senha);
    $v->execute();
    return $v->rowCount();               
}