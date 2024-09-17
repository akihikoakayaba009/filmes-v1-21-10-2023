<?php 
function contar_midia_por_categoria($midia_categoria){
    global $pdo;
	$total = 0;
    $v = $pdo->prepare("SELECT * FROM midia WHERE midia_categoria LIKE (:midia_categoria)");
    $v->bindValue(":midia_categoria", "%".$midia_categoria."%");
    $v->execute();
    if($v->rowCount() > 0){
		foreach($v->fetchAll() as $item){
			if(in_array($midia_categoria, explode(",", $item['midia_categoria']))){
				$total++;
			}
		}
	}
	return $total;
}

function listar_midia_por_categoria($midia_tipo, $pagina, $midia_categoria){
	global $pdo;
	$res = array();
	$inicio = ($pagina * SITE_PAGINACAO) - SITE_PAGINACAO;
	$v = $pdo->prepare("SELECT * FROM midia WHERE 
		                midia_tipo = (:midia_tipo) AND 
		                midia_categoria LIKE (:midia_categoria)
						ORDER BY midia_id DESC
		                LIMIT ".$inicio." , ".SITE_PAGINACAO);
	$v->bindValue(":midia_tipo", $midia_tipo);
	$v->bindValue(":midia_categoria", "%".$midia_categoria."%");
	$v->execute();
	if($v->rowCount() > 0){
		$res = $v->fetchAll();
	}
	return $res;
}

function listar_midia_por_categoria_paginacao($midia_tipo, $pagina, $midia_categoria,$categoria_diretorio){
	global $pdo;
	$array = array("pagina_anterior" => "", "pagina_proxima" => "");
	$v = $pdo->prepare("SELECT midia_tipo,midia_categoria,midia_id FROM midia WHERE 
		                midia_tipo = (:midia_tipo) AND 
		                midia_categoria LIKE (:midia_categoria) ORDER BY midia_id DESC");
	$v->bindValue(":midia_tipo", $midia_tipo);
	$v->bindValue(":midia_categoria", "%".$midia_categoria."%");
	$v->execute();
	$qtdPag = ceil($v->rowCount() / SITE_PAGINACAO);
	if($pagina >= 2){
        $array["pagina_anterior"] =  $pagina -1;
    }  

    if($qtdPag > 1 && $pagina <= $qtdPag){
    	for($i = 1; $i <= $qtdPag; $i++){
    		if($i == $pagina && $i < $qtdPag){
    			$array["pagina_proxima"] = $i+1;
    		}
    	}
    }

    if($pagina <= $qtdPag){
    	return $array;
    }

    if($qtdPag != 0 && $pagina > $qtdPag){
    	return public_redirect(midia_tipo_plural($midia_tipo).'/'.$categoria_diretorio.'/pagina/1');
    }
}

function listar_midia_por_tipo($midia_tipo, $pagina){
	global $pdo;
	$res = array();
	$inicio = ($pagina * SITE_PAGINACAO) - SITE_PAGINACAO;
	$v = $pdo->prepare("SELECT * FROM midia WHERE 
		                midia_tipo = (:midia_tipo) 
		                ORDER BY midia_id DESC LIMIT ".$inicio." , ".SITE_PAGINACAO);
	$v->bindValue(":midia_tipo", $midia_tipo);
	$v->execute();
	if($v->rowCount() > 0){
		$res = $v->fetchAll();
	}
	return $res;
}
function listar_midia_por_tipo_paginacao($midia_tipo, $pagina){
	global $pdo;
	$array = array("pagina_anterior" => "", "pagina_proxima" => "");
	$v = $pdo->prepare("SELECT midia_tipo, midia_id FROM midia WHERE 
		                midia_tipo = (:midia_tipo) ORDER BY midia_id DESC");
	$v->bindValue(":midia_tipo", $midia_tipo);
	$v->execute();
	$qtdPag = ceil($v->rowCount() / SITE_PAGINACAO);
	if($pagina >= 2){
        $array["pagina_anterior"] =  $pagina -1;
    }  

    if($qtdPag > 1 && $pagina <= $qtdPag){
    	for($i = 1; $i <= $qtdPag; $i++){
    		if($i == $pagina && $i < $qtdPag){
    			$array["pagina_proxima"] = $i+1;
    		}
    	}
    }

    if($pagina <= $qtdPag){
    	return $array;
    }

    if($qtdPag != 0 && $pagina > $qtdPag){
    	return public_redirect(midia_tipo_plural($midia_tipo).'/pagina/1');
    }
}

function listar_midia_por_busca($midia_busca, $pagina){
	global $pdo;
	$midia_busca = str_replace("-", "%", $midia_busca);
	$res = array();
	$inicio = ($pagina * SITE_PAGINACAO) - SITE_PAGINACAO;
	$v = $pdo->prepare("SELECT * FROM midia WHERE 
		                midia_diretorio LIKE (:midia_busca) 
		                LIMIT ".$inicio." , ".SITE_PAGINACAO);
	$v->bindValue(":midia_busca", "%".$midia_busca."%");
	$v->execute();
	if($v->rowCount() > 0){
		$res = $v->fetchAll();
	}
	return $res;
}
function listar_midia_por_busca_paginacao($midia_busca, $pagina){
	global $pdo;
	$midia_busca = str_replace("-", "%", $midia_busca);
	$array = array("pagina_anterior" => "", "pagina_proxima" => "");
	$v = $pdo->prepare("SELECT midia_diretorio FROM midia WHERE 
		                midia_diretorio LIKE (:midia_busca) ");
	$v->bindValue(":midia_busca", "%".$midia_busca."%");
	$v->execute();
	$qtdPag = ceil($v->rowCount() / SITE_PAGINACAO);
	if($pagina >= 2){
        $array["pagina_anterior"] =  $pagina -1;
    }  

    if($qtdPag > 1 && $pagina <= $qtdPag){
    	for($i = 1; $i <= $qtdPag; $i++){
    		if($i == $pagina && $i < $qtdPag){
    			$array["pagina_proxima"] = $i+1;
    		}
    	}
    }

    if($pagina <= $qtdPag){
    	return $array;
    }

    if($qtdPag != 0 && $pagina > $qtdPag){
    	return public_redirect('busca/midia/'.$midia_busca.'/pagina/1');
    }
}

function get_midia_por_diretorio($midia_tipo, $midia_diretorio){
	global $pdo;
	$v = $pdo->prepare("SELECT * FROM midia WHERE 
						midia_tipo = (:midia_tipo) AND 
						midia_diretorio = (:midia_diretorio) LIMIT 1");
	$v->bindValue(":midia_tipo", $midia_tipo);
	$v->bindValue(":midia_diretorio", $midia_diretorio);
	$v->execute();
	return $v->fetch();					
}

function get_atores_midia_tmdb($ator_tmdb_midia){
	global $pdo;
	$res = array();
	$v = $pdo->prepare("SELECT * FROM midia_atores WHERE ator_tmdb_midia = (:ator_tmdb_midia)");
	$v->bindValue(":ator_tmdb_midia", $ator_tmdb_midia);
	$v->execute();
	if($v->rowCount() > 0){
		$res = $v->fetchAll();
	}
	return $res;
}

function get_midias_recomendados($midia_id, $midia_categoria, $midia_tipo){
	global $pdo;
	$res = array("");
	$array_md = array();
	foreach(explode(",", $midia_categoria) as $md){
		array_push($array_md, $md);
	}
	$query = "SELECT * FROM midia WHERE midia_tipo = (:midia_tipo) AND midia_id != (:midia_id) AND ";
	foreach($array_md as $item){
		$query .= "midia_categoria = ".$item." OR ";
	}
	$query = trim($query);
	$query = substr($query, 0,-2);
	$query .= " ORDER BY RAND() LIMIT 18";
	$v = $pdo->prepare($query);
	$v->bindValue(":midia_tipo", $midia_tipo);
	$v->bindValue(":midia_id", $midia_id);
	$v->execute();
	if($v->rowCount() > 0){
		$res = $v->fetchAll();
	}
	return $res;
}

function contar_player_gratis($player_midia_id){
	global $pdo;
	$v = $pdo->prepare("SELECT * FROM midia_players WHERE player_acesso = 'gratis' AND player_midia_id = (:player_midia_id)");
	$v->bindValue(":player_midia_id", $player_midia_id);
	$v->execute();
	return $v->rowCount();

}

function get_midia_por_id($midia_id){
	global $pdo;
	$v = $pdo->prepare("SELECT * FROM midia WHERE 
						midia_id = (:midia_id) LIMIT 1");
	$v->bindValue(":midia_id", $midia_id);
	$v->execute();
	return $v->fetch();					
}

function get_temporadas($temporada_midia_id){
	global $pdo;
	$res = array();
	$v = $pdo->prepare("SELECT * FROM midia_temporadas WHERE temporada_midia_id = (:temporada_midia_id) ORDER BY temporada_titulo * 1 ASC");
	$v->bindValue(":temporada_midia_id", $temporada_midia_id);
	$v->execute();
	if($v->rowCount() > 0){
		$res = $v->fetchAll();
	}
	return $res;
}


function contar_episodios_temporada($episodio_midia_id, $episodio_temporada_id){
	global $pdo;
	$v = $pdo->prepare("SELECT * FROM midia_episodios WHERE 
						episodio_midia_id = (:episodio_midia_id) AND 
						episodio_temporada_id = (:episodio_temporada_id)");
	$v->bindValue(":episodio_midia_id", $episodio_midia_id);	
	$v->bindValue(":episodio_temporada_id", $episodio_temporada_id);			
	$v->execute();
	return $v->rowCount();		
}

function get_temporada_por_id($temporada_midia_id,$temporada_id){
	global $pdo;
	$v = $pdo->prepare("SELECT * FROM midia_temporadas WHERE temporada_midia_id = (:temporada_midia_id) AND  temporada_id = (:temporada_id) LIMIT 1");
	$v->bindValue(":temporada_midia_id", $temporada_midia_id);
	$v->bindValue(":temporada_id", $temporada_id);
	$v->execute();
	return $v->fetch();
}

function get_episodios_temporada($episodio_midia_id, $episodio_temporada_id){
	global $pdo;
	$res = array();
	$v = $pdo->prepare("SELECT * FROM midia_episodios WHERE 
						episodio_midia_id = (:episodio_midia_id) AND 
						episodio_temporada_id = (:episodio_temporada_id) ORDER BY episodio_numero ASC");
	$v->bindValue(":episodio_midia_id", $episodio_midia_id);			
	$v->bindValue(":episodio_temporada_id", $episodio_temporada_id);	
	$v->execute();		
	if($v->rowCount() > 0){
		$res = $v->fetchAll();
	}		
	return $res;
}

function get_episodio_por_id($episodio_midia_id, $episodio_temporada_id){
	global $pdo;
	$v = $pdo->prepare("SELECT * FROM midia_episodios WHERE 
						episodio_midia_id = (:episodio_midia_id) AND 
						episodio_temporada_id = (:episodio_temporada_id) ORDER BY episodio_numero ASC");
	$v->bindValue(":episodio_midia_id", $episodio_midia_id);			
	$v->bindValue(":episodio_temporada_id", $episodio_temporada_id);	
	$v->execute();
	return $v->fetch();
}

function listar_players($player_midia_id, $player_temporada_id, $player_episodio_id){
	global $pdo;
	$res = array();
	$v = $pdo->prepare("SELECT * FROM midia_players WHERE 
						player_midia_id = (:player_midia_id) AND 
						player_temporada_id = (:player_temporada_id) AND 
						player_episodio_id  = (:player_episodio_id)");
	$v->bindValue(":player_midia_id", $player_midia_id);
	$v->bindValue(":player_temporada_id", $player_temporada_id);	
	$v->bindValue(":player_episodio_id", $player_episodio_id);				
	$v->execute();
	if($v->rowCount() > 0){
		$res = $v->fetchAll();
	}
	return $res;

}

function get_duracao_episodio($player_midia_id, $player_temporada_id, $player_episodio_id){
	global $pdo;
	$v = $pdo->prepare("SELECT player_midia_id, player_temporada_id, player_episodio_id, player_duracao FROM midia_players WHERE 
						player_midia_id = (:player_midia_id) AND 
						player_temporada_id = (:player_temporada_id) AND 
						player_episodio_id  = (:player_episodio_id) LIMIT 1");
	$v->bindValue(":player_midia_id", $player_midia_id);
	$v->bindValue(":player_temporada_id", $player_temporada_id);	
	$v->bindValue(":player_episodio_id", $player_episodio_id);					
	$v->execute();
	if($v->rowCount() > 0){
		$res = $v->fetch();
		return $res['player_duracao'];
	}
	return "";
}

function get_player_por_id($player_midia_id, $player_temporada_id, $player_episodio_id, $player_id){
	global $pdo;
	$v = $pdo->prepare("SELECT * FROM midia_players WHERE 
						player_midia_id = (:player_midia_id) AND 
						player_temporada_id = (:player_temporada_id) AND 
						player_episodio_id  = (:player_episodio_id) AND 
						player_id = (:player_id) LIMIT 1");
	$v->bindValue(":player_midia_id", $player_midia_id);
	$v->bindValue(":player_temporada_id", $player_temporada_id);	
	$v->bindValue(":player_episodio_id", $player_episodio_id);		
	$v->bindValue(":player_id", $player_id);				
	$v->execute();
	return $v->fetch();
}
function atualizar_visualizacoes_midia($midia_id, $midia_visualizacoes){
	global $pdo;
	$up = $pdo->prepare("UPDATE midia SET 
						midia_visualizacoes = (:midia_visualizacoes) WHERE 
						midia_id = (:midia_id) LIMIT 1");
	$up->bindValue(":midia_visualizacoes", $midia_visualizacoes);
	$up->bindValue(":midia_id", $midia_id);
	$up->execute();					
}
function atualizar_visualizacoes_player($player_visualizacoes, $player_midia_id, $player_temporada_id, $player_episodio_id, $player_id){
	global $pdo;
	$up = $pdo->prepare("UPDATE midia_players SET 
						 player_visualizacoes = (:player_visualizacoes) WHERE 
						 player_midia_id = (:player_midia_id) AND 
						 player_temporada_id = (:player_temporada_id) AND 
						 player_episodio_id = (:player_episodio_id) AND 
						 player_id = (:player_id) LIMIT 1");
    $up->bindValue(":player_visualizacoes", $player_visualizacoes);
	$up->bindValue(":player_midia_id", $player_midia_id);
	$up->bindValue(":player_temporada_id", $player_temporada_id);
	$up->bindValue(":player_episodio_id", $player_episodio_id);
	$up->bindValue(":player_id", $player_id);
	$up->execute();						 
}

function get_visualizacoes_midia($player_midia_id){
	global $pdo;
	$player_visualizacoes = 0;
	$v = $pdo->prepare("SELECT * FROM midia_players WHERE 
						player_midia_id = (:player_midia_id)");
	$v->bindValue(":player_midia_id", $player_midia_id);			
	$v->execute();
	if($v->rowCount() > 0){
		foreach($v->fetchAll() as $p){
			$player_visualizacoes += $p['player_visualizacoes'];
		}
	}
	return $player_visualizacoes;
}

function get_midia_mais_vistas_por_tipo($midia_tipo){
	global $pdo;
	$res = array();
	$v = $pdo->prepare("SELECT * FROM midia WHERE 
						midia_tipo = (:midia_tipo) AND midia_visualizacoes > 0 ORDER BY midia_visualizacoes DESC LIMIT 5");
	$v->bindValue(":midia_tipo", $midia_tipo);
	$v->execute();
	if($v->rowCount() > 0){
		$res = $v->fetchAll();
	}
	return $res;
}