<?php 
function cadastar_pagina($pagina_titulo, $pagina_diretorio, $pagina_conteudo){
    global $pdo;
    $cad = $pdo->prepare("INSERT INTO paginas SET 
    	                  pagina_titulo = (:pagina_titulo),
    	                  pagina_diretorio = (:pagina_diretorio),
    	                  pagina_conteudo = (:pagina_conteudo)");
    $cad->bindValue(":pagina_titulo", $pagina_titulo);
    $cad->bindValue(":pagina_diretorio", $pagina_diretorio);
    $cad->bindValue(":pagina_conteudo", $pagina_conteudo);
    if($cad->execute()){
    	return true;
    }
}

function editar_pagina($pagina_titulo, $pagina_diretorio, $pagina_conteudo, $pagina_id){
    global $pdo;
    $up = $pdo->prepare("UPDATE paginas SET 
    	                  pagina_titulo = (:pagina_titulo),
    	                  pagina_diretorio = (:pagina_diretorio),
    	                  pagina_conteudo = (:pagina_conteudo) WHERE 
    	                  pagina_id = (:pagina_id) LIMIT 1");
    $up->bindValue(":pagina_titulo", $pagina_titulo);
    $up->bindValue(":pagina_diretorio", $pagina_diretorio);
    $up->bindValue(":pagina_conteudo", $pagina_conteudo);
    $up->bindValue(":pagina_id", $pagina_id);
    if($up->execute()){
    	return true;
    }
}

function contar_pagina_por_diretorio($pagina_diretorio){
	global $pdo;
	$v = $pdo->prepare("SELECT * FROM paginas WHERE pagina_diretorio = (:pagina_diretorio)");
	$v->bindValue(":pagina_diretorio", $pagina_diretorio);
	$v->execute();
	return $v->rowCount();
}

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

function get_pagina_por_id($pagina_id){
	global $pdo;
	$v = $pdo->prepare("SELECT * FROM paginas WHERE 
		                pagina_id = (:pagina_id) LIMIT 1");
	$v->bindValue(":pagina_id", $pagina_id);
	$v->execute();
	return $v->fetch();
}

function excluir_pagina($pagina_id){
	global $pdo;
	$v = $pdo->prepare("DELETE FROM paginas WHERE pagina_id = (:pagina_id) LIMIT 1");
	$v->bindValue(":pagina_id", $pagina_id);
	if($v->execute()){
		return true;
	}
}