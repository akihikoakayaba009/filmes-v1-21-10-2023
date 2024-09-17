<?php
function get_administrador_por_hash_confirmacao_email($admin_hash_confirmacao_email)
{
    global $pdo;
    $get = $pdo->prepare("SELECT * FROM administradores WHERE 
                          admin_hash_confirmacao_email = (:admin_hash_confirmacao_email) AND 
                          admin_email_confirmado = 'nao' LIMIT 1");
    $get->bindValue(":admin_hash_confirmacao_email", $admin_hash_confirmacao_email);
    $get->execute();
    return $get->fetch();
}

function get_administrador_por_hash_recuperar_senha($admin_hash_recuperar_senha)
{
    global $pdo;
    $get = $pdo->prepare("SELECT * FROM administradores WHERE 
                          admin_hash_recuperar_senha = (:admin_hash_recuperar_senha) AND 
                          admin_hash_recuperar_senha_expiracao	> NOW() AND
                          admin_email_confirmado = 'sim' LIMIT 1");
    $get->bindValue(":admin_hash_recuperar_senha", $admin_hash_recuperar_senha);
    $get->execute();
    return $get->fetch();
}

function alterar_senha_por_recuperacao_administrador($admin_senha, $admin_hash_recuperar_senha, $admin_email, $admin_id)
{
    global $pdo;
    $up = $pdo->prepare("UPDATE administradores SET 
                         admin_senha = (:admin_senha),
                         admin_hash_recuperar_senha = NULL,
                         admin_hash_recuperar_senha_expiracao = NULL WHERE 
                         admin_hash_recuperar_senha = (:admin_hash_recuperar_senha) AND 
                         admin_email = (:admin_email) AND  
                         admin_id = (:admin_id) AND 
                         admin_email_confirmado = 'sim' AND 
                         admin_hash_recuperar_senha_expiracao > NOW() LIMIT 1");
    $up->bindValue(":admin_senha", $admin_senha);
    $up->bindValue(":admin_hash_recuperar_senha", $admin_hash_recuperar_senha);
    $up->bindValue(":admin_email", $admin_email);
    $up->bindValue(":admin_id", $admin_id);
    if ($up->execute()) {
        return true;
    }
    return false;
}


function contar_administradores()
{
    global $pdo;
    $v = $pdo->prepare("SELECT * FROM administradores");
    $v->execute();
    return $v->rowCount();
}

function listar_administradores()
{
    global $pdo;
    $res = array();
    $v = $pdo->prepare("SELECT * FROM administradores");                  
    $v->execute();
    $res = $v->fetchAll();
    return $res;
}

function get_admin($admin_id)
{
    global $pdo;
    $v = $pdo->prepare("SELECT * FROM administradores WHERE 
                        admin_id = (:admin_id)");
    $v->bindValue(":admin_id", $admin_id);
    $v->execute();
    return $v->fetch();
}


function get_admin_por_email($admin_email)
{
    global $pdo;
    $get = $pdo->prepare("SELECT * FROM administradores WHERE 
                          admin_email = (:admin_email) AND 
                          admin_email_confirmado = 'sim' LIMIT 1");
    $get->bindValue(":admin_email", $admin_email);
    $get->execute();
    return $get->fetch();
}

function get_admin_por_email_e_id($admin_id, $admin_email)
{
    global $pdo;
    $get = $pdo->prepare("SELECT * FROM administradores WHERE 
                          admin_id = (:admin_id) AND 
                          admin_email = (:admin_email) LIMIT 1");
    $get->bindValue(":admin_id", $admin_id);
    $get->bindValue(":admin_email", $admin_email);
    $get->execute();
    return $get->fetch();
}

function confirmar_email_admin($admin_hash_confirmacao_email, $admin_email, $admin_id)
{
    global $pdo;
    $up = $pdo->prepare("UPDATE administradores SET 
                         admin_email_confirmado = 'sim' WHERE 
                         admin_hash_confirmacao_email = (:admin_hash_confirmacao_email) AND 
                         admin_email = (:admin_email) AND 
                         admin_id = (:admin_id) AND 
                         admin_email_confirmado = 'nao' LIMIT 1");
    $up->bindValue(":admin_hash_confirmacao_email", $admin_hash_confirmacao_email);
    $up->bindValue(":admin_email", $admin_email);
    $up->bindValue(":admin_id", $admin_id);
    if ($up->execute()) {
        return true;
    }
    return false;
}

function atulizar_hash_recuperar_senha_admin($admin_hash_recuperar_senha, $admin_hash_recuperar_senha_expiracao, $admin_email, $admin_id)
{
    global $pdo;
    $up = $pdo->prepare("UPDATE administradores SET 
                         admin_hash_recuperar_senha = (:admin_hash_recuperar_senha),
                         admin_hash_recuperar_senha_expiracao = (:admin_hash_recuperar_senha_expiracao) WHERE 
                         admin_email = (:admin_email) AND  
                         admin_id = (:admin_id) LIMIT 1");
    $up->bindValue(":admin_hash_recuperar_senha", $admin_hash_recuperar_senha);
    $up->bindValue(":admin_hash_recuperar_senha_expiracao", $admin_hash_recuperar_senha_expiracao);
    $up->bindValue(":admin_email", $admin_email);
    $up->bindValue(":admin_id", $admin_id);
    if ($up->execute()) {
        return true;
    }
    return false;
}


function adicionar_administrador(
    $admin_nome,
    $admin_email,
    $admin_senha,
    $admin_avatar,
    $admin_responsavel,
    $admin_hash_confirmacao_email,
    $admin_celular,
    $admin_whatsapp
) {
    global $pdo;
    $cad = $pdo->prepare("INSERT INTO administradores SET 
                          admin_nome   = (:admin_nome),
                          admin_email  = (:admin_email),
                          admin_celular = (:admin_celular),
                          admin_whatsapp = (:admin_whatsapp),  
                          admin_senha  = (:admin_senha),
                          admin_avatar = (:admin_avatar),
                          admin_responsavel = (:admin_responsavel),
                          admin_email_confirmado = 'nao',
                          admin_hash_confirmacao_email = (:admin_hash_confirmacao_email)");
    $cad->bindValue(":admin_nome", $admin_nome);
    $cad->bindValue(":admin_email", $admin_email);
    $cad->bindValue(":admin_celular", $admin_celular);
    $cad->bindValue(":admin_whatsapp", $admin_whatsapp);
    $cad->bindValue(":admin_senha", $admin_senha);
    $cad->bindValue(":admin_avatar", $admin_avatar);
    $cad->bindValue(":admin_responsavel", $admin_responsavel);
    $cad->bindValue(":admin_hash_confirmacao_email", $admin_hash_confirmacao_email);
    if ($cad->execute()) {
        return true;
    }
    return false;
}

function atualizar_informacoes_pessoais_administrador(
    $admin_nome,
    $admin_celular,
    $admin_whatsapp,
    $admin_avatar,
    $admin_id,
    $admin_email
) {
    global $pdo;
    $up = $pdo->prepare("UPDATE administradores SET 
                            admin_nome = (:admin_nome),
                            admin_celular = (:admin_celular),
                            admin_whatsapp = (:admin_whatsapp),
                            admin_avatar = (:admin_avatar) WHERE
                            admin_id = (:admin_id) AND 
                            admin_email = (:admin_email)  LIMIT 1");
    $up->bindValue(":admin_nome", $admin_nome);
    $up->bindValue(":admin_celular", $admin_celular);
    $up->bindValue(":admin_whatsapp", $admin_whatsapp);
    $up->bindValue(":admin_avatar", $admin_avatar);
    $up->bindValue(":admin_id", $admin_id);
    $up->bindValue(":admin_email", $admin_email);
    if ($up->execute()) {
        return true;
    }
    return false;
} 

function atualizar_senha_administrador($admin_id, $admin_email, $admin_senha){
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

function excluir_administrador($admin_id, $admin_email){
    global $pdo;
    $del = $pdo->prepare("DELETE FROM administradores WHERE 
                          admin_id = (:admin_id) AND 
                          admin_email = (:admin_email) LIMIT 1");
    $del->bindValue(":admin_id", $admin_id); 
    $del->bindValue(":admin_email", $admin_email);    
    if($del->execute()){
        return true;
    }               
}  