<?php 
function admin_editar_informacoes_pessoais(
    $admin_nome,
    $admin_celular,
    $admin_telefone,
    $admin_whatsapp,
    $admin_avatar,
    $admin_id,
    $admin_email
) {
    global $pdo;
    $up = $pdo->prepare("UPDATE administradores SET 
                         admin_nome = (:admin_nome),
                         admin_celular = (:admin_celular),
                         admin_telefone = (:admin_telefone),
                         admin_whatsapp = (:admin_whatsapp),
                         admin_avatar = (:admin_avatar) WHERE
                         admin_id = (:admin_id) AND 
                         admin_email = (:admin_email)  LIMIT 1");
    $up->bindValue(":admin_nome", $admin_nome);
    $up->bindValue(":admin_celular", $admin_celular);
    $up->bindValue(":admin_telefone", $admin_telefone);
    $up->bindValue(":admin_whatsapp", $admin_whatsapp);
    $up->bindValue(":admin_avatar", $admin_avatar);
    $up->bindValue(":admin_id", $admin_id);
    $up->bindValue(":admin_email", $admin_email);
    if ($up->execute()) {
        return true;

    }
    return false;
} 

function atualizar_nome_admin_responsavel($admin_responsavel_novo, $admin_responsavel_atual){
    global $pdo;
    $up = $pdo->prepare("UPDATE administradores SET 
                         admin_responsavel = (:admin_responsavel_novo) WHERE 
                         admin_responsavel = (:admin_responsavel_atual)");
    $up->bindValue(":admin_responsavel_novo", $admin_responsavel_novo);
    $up->bindValue(":admin_responsavel_atual", $admin_responsavel_atual);       
    $up->execute();              
}

function get_senha_admin_verificar($admin_id, $admin_email, $admin_senha){
    global $pdo;
    $v = $pdo->prepare("SELECT admin_id,admin_email,admin_senha FROM administradores WHERE 
                        admin_id = (:admin_id) AND 
                        admin_email = (:admin_email) AND 
                        admin_senha = (:admin_senha) LIMIT 1");
    $v->bindValue(":admin_id", $admin_id);
    $v->bindValue(":admin_email", $admin_email);                    
    $v->bindValue(":admin_senha", $admin_senha);
    $v->execute();
    return $v->rowCount();
}

function atualizar_senha_admin($admin_id, $admin_email, $admin_senha){
    global $pdo;
    $up = $pdo->prepare("UPDATE administradores SET 
                         admin_senha = (:admin_senha) WHERE
                         admin_id = (:admin_id) AND 
                         admin_email = (:admin_email) LIMIT 1");
    $up->bindValue(":admin_senha", $admin_senha);                     
    $up->bindValue(":admin_id", $admin_id);
    $up->bindValue(":admin_email", $admin_email);       
    if($up->execute()){
        return true; 
    }
    return false;
}