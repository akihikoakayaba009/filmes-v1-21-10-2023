<?php 
function admin_cadastrar_revendedor($revendedor_nome, $revendedor_email, $revendedor_senha, $revendedor_avatar, 
                                    $revendedor_whatsapp, $revendedor_telegram, $revendedor_instagram,
                                    $revendedor_creditos, $revendedor_online, $revendedor_hash){
	global $pdo;
	$cad = $pdo->prepare("INSERT INTO revendedores SET 
		                  revendedor_nome = (:revendedor_nome),
		                  revendedor_email = (:revendedor_email),
		                  revendedor_senha = (:revendedor_senha), 
						  revendedor_avatar = (:revendedor_avatar),
                          revendedor_whatsapp = (:revendedor_whatsapp),
                          revendedor_telegram = (:revendedor_telegram),
                          revendedor_instagram = (:revendedor_instagram),
                          revendedor_creditos = (:revendedor_creditos),
                          revendedor_online = (:revendedor_online),
                          revendedor_hash = (:revendedor_hash)");
	$cad->bindValue(":revendedor_nome", $revendedor_nome);
	$cad->bindValue(":revendedor_email", $revendedor_email);
	$cad->bindValue(":revendedor_senha", $revendedor_senha);
	$cad->bindValue(":revendedor_avatar", $revendedor_avatar);
    $cad->bindValue(":revendedor_whatsapp", $revendedor_whatsapp);
    $cad->bindValue(":revendedor_telegram", $revendedor_telegram);
    $cad->bindValue(":revendedor_instagram", $revendedor_instagram);
    $cad->bindValue(":revendedor_creditos", $revendedor_creditos);
    $cad->bindValue(":revendedor_online", $revendedor_online);
    $cad->bindValue(":revendedor_hash", $revendedor_hash);
	if($cad->execute()){
		return true;
	}
}

function admin_get_revendedor_por_id($revendedor_id){
    global $pdo;
    $v = $pdo->prepare("SELECT * FROM revendedores WHERE revendedor_id = (:revendedor_id) LIMIT 1");
    $v->bindValue(":revendedor_id", $revendedor_id);
    $v->execute();
    return $v->fetch();
}

function admin_excluir_revendedor($revendedor_id, $revendedor_email){
    global $pdo;
    $del = $pdo->prepare("DELETE FROM revendedores WHERE 
                          revendedor_id = (:revendedor_id) AND 
                          revendedor_email = (:revendedor_email) LIMIT 1");
    $del->bindValue(":revendedor_id", $revendedor_id);
    $del->bindValue(":revendedor_email", $revendedor_email);               
    if($del->execute()){
        return true;
    }       
}

function admin_listar_revendedores(){
    global $pdo;
    $res = array();
    $v = $pdo->prepare("SELECT * FROM revendedores");
    $v->execute();
    if($v->rowCount() > 0){
        $res = $v->fetchAll();
    }
    return $res;
}

function admin_editar_creditos_revendedor($revendedor_creditos, $revendedor_email, $revendedor_id){
    global $pdo;
    $up = $pdo->prepare("UPDATE revendedores SET 
                         revendedor_creditos = (:revendedor_creditos) WHERE 
                         revendedor_id = (:revendedor_id) AND 
                         revendedor_email = (:revendedor_email) LIMIT 1");
    $up->bindValue(":revendedor_creditos", $revendedor_creditos);      
    $up->bindValue(":revendedor_email", $revendedor_email);                     
    $up->bindValue(":revendedor_id", $revendedor_id);      
    if($up->execute()){
        return true;
    }
}


function admin_contar_revendedores(){
    global $pdo;
    $v = $pdo->prepare("SELECT revendedor_id FROM revendedores");
    $v->execute();
    return $v->rowCount();
}