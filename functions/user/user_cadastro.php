<?php 
function user_cadastrar($user_nome, $user_email, $user_senha, $user_avatar, $user_hash){
	global $pdo;
	$cad = $pdo->prepare("INSERT INTO usuarios SET 
		                  user_nome = (:user_nome),
		                  user_email = (:user_email),
		                  user_senha = (:user_senha), 
						  user_avatar = (:user_avatar),
						  user_hash = (:user_hash)");
	$cad->bindValue(":user_nome", $user_nome);
	$cad->bindValue(":user_email", $user_email);
	$cad->bindValue(":user_senha", $user_senha);
	$cad->bindValue(":user_avatar", $user_avatar);
	$cad->bindValue(":user_hash", $user_hash);
	if($cad->execute()){
		return true;
	}
}