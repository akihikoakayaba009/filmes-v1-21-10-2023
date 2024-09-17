<?php 
function atualizar_senha_revendedor($revendedor_senha_atual, $revendedor_senha_nova, $revendedor_email, $revendedor_id){
    global $pdo;
    $up = $pdo->prepare("UPDATE revendedores SET 
                        revendedor_senha = (:revendedor_senha_nova) WHERE
                        revendedor_senha = (:revendedor_senha_atual) AND 
                        revendedor_id = (:revendedor_id) AND 
                        revendedor_email = (:revendedor_email)");
    $up->bindValue(":revendedor_senha_nova", $revendedor_senha_nova);
    $up->bindValue(":revendedor_senha_atual", $revendedor_senha_atual);
    $up->bindValue(":revendedor_id", $revendedor_id);
    $up->bindValue(":revendedor_email", $revendedor_email);
    if($up->execute()){
        return true;
    }

}

function editar_perfil_revendedor($revendedor_nome, $revendedor_whatsapp,
                                  $revendedor_telegram, $revendedor_instagram, $revendedor_avatar,
                                  $revendedor_email, $revendedor_id){
    global $pdo;
    $up = $pdo->prepare("UPDATE revendedores SET 
                         revendedor_nome = (:revendedor_nome),
                         revendedor_whatsapp = (:revendedor_whatsapp),
                         revendedor_telegram = (:revendedor_telegram),
                         revendedor_instagram = (:revendedor_instagram),
                         revendedor_avatar = (:revendedor_avatar) WHERE 
                         revendedor_email = (:revendedor_email) AND
                         revendedor_id = (:revendedor_id) LIMIT 1");
    $up->bindValue(":revendedor_nome", $revendedor_nome);
    $up->bindValue(":revendedor_whatsapp", $revendedor_whatsapp);
    $up->bindValue(":revendedor_telegram", $revendedor_telegram);
    $up->bindValue(":revendedor_instagram", $revendedor_instagram);
    $up->bindValue(":revendedor_avatar", $revendedor_avatar);
    $up->bindValue(":revendedor_email", $revendedor_email);
    $up->bindValue(":revendedor_id", $revendedor_id);
    if($up->execute()){
        return true;
    }                      

}

function remover_creditos_revendedor($revendedor_id, $revendedor_email, $revendedor_creditos){
    global $pdo;
    $up = $pdo->prepare("UPDATE revendedores SET 
                         revendedor_creditos = (:revendedor_creditos) WHERE 
                         revendedor_id = (:revendedor_id) AND 
                         revendedor_email = (:revendedor_email) LIMIT 1");
    $up->bindValue(":revendedor_creditos", $revendedor_creditos);                    
    $up->bindValue(":revendedor_id", $revendedor_id);                    
    $up->bindValue(":revendedor_email", $revendedor_email);   
    $up->execute();                 
}