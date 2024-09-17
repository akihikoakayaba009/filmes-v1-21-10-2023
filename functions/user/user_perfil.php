<?php 
function atualizar_senha_user($user_senha_atual, $user_senha_nova, $user_hash, $user_email, $user_id){
    global $pdo;
    $up = $pdo->prepare("UPDATE usuarios SET 
                        user_senha = (:user_senha_nova),
                        user_hash = (:user_hash) WHERE
                        user_senha = (:user_senha_atual) AND 
                        user_id = (:user_id) AND 
                        user_email = (:user_email)");
    $up->bindValue(":user_senha_nova", $user_senha_nova);
    $up->bindValue(":user_hash", $user_hash);
    $up->bindValue(":user_senha_atual", $user_senha_atual);
    $up->bindValue(":user_id", $user_id);
    $up->bindValue(":user_email", $user_email);
    if($up->execute()){
        return true;
    }

}