<?php 
function listar_pagina(){
	global $pdo;
	$res = array();
	$v = $pdo->prepare("SELECT * FROM paginas");
	$v->execute();
	if($v->rowCount() > 0){
		$res = $v->fetchAll();
	}
	return $res;
}

function get_pagina_por_diretorio($pagina_diretorio){
	global $pdo;
	$v = $pdo->prepare("SELECT * FROM paginas WHERE pagina_diretorio = (:pagina_diretorio)");
	$v->bindValue(":pagina_diretorio", $pagina_diretorio);
	$v->execute();
	return $v->fetch();
}