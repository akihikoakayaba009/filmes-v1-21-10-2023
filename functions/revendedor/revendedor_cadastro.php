<?php 
function revendedor_cadastrar($revendedor_nome, $revendedor_email, $revendedor_senha, $revendedor_avatar, $revendedor_hash){
	global $pdo;
	$cad = $pdo->prepare("INSERT INTO revendedores SET 
		                  revendedor_nome = (:revendedor_nome),
		                  revendedor_email = (:revendedor_email),
		                  revendedor_senha = (:revendedor_senha), 
						  revendedor_avatar = (:revendedor_avatar),
						  revendedor_hash = (:revendedor_hash)");
	$cad->bindValue(":revendedor_nome", $revendedor_nome);
	$cad->bindValue(":revendedor_email", $revendedor_email);
	$cad->bindValue(":revendedor_senha", $revendedor_senha);
	$cad->bindValue(":revendedor_avatar", $revendedor_avatar);
	$cad->bindValue(":revendedor_hash", $revendedor_hash);
	if($cad->execute()){
		return true;
	}
}
