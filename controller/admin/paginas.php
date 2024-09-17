<?php 
require_once $_SERVER['DOCUMENT_ROOT'].'/controller/admin/admin_controller.php';

if(isset($_POST['acao'])){

	/*
      ADICIONAR 
	*/
    if($_POST['acao'] == 'adicionar'){
        if(!isset($_POST['pagina_titulo']) OR empty($_POST['pagina_titulo']) OR
           !isset($_POST['pagina_conteudo']) OR empty($_POST['pagina_conteudo'])){
            die_error("Preencha todos os campos.");
        }

        $pagina_titulo = ucwords($_POST['pagina_titulo']);
        $pagina_diretorio = diretorio($pagina_titulo);
        $pagina_conteudo  = $_POST['pagina_conteudo'];

        if(contar_pagina_por_diretorio($pagina_diretorio) > 0){
        	die_error("A página já existe.");
        }

        if(!cadastar_pagina($pagina_titulo, $pagina_diretorio, $pagina_conteudo)){
        	die_error("Não foi possível adicionar.");
        }
        die_success_redirect("A página foi adicionada.", BASE_ADMIN.'pagina/listar');

    }  


    /*
       EDITAR
    */
    if($_POST['acao'] == 'editar'){
      
        if(!isset($_POST['pagina_titulo']) OR empty($_POST['pagina_titulo']) OR
           !isset($_POST['pagina_conteudo']) OR empty($_POST['pagina_conteudo']) OR
           !isset($_POST['pagina_id']) OR !intval($_POST['pagina_id'])){
            die_error("Preencha todos os campos.");
        }
        
        $pagina_id    = $_POST['pagina_id'];
        $pagina_titulo = ucwords($_POST['pagina_titulo']);
        $pagina_diretorio = diretorio($pagina_titulo);
        $pagina_conteudo  = $_POST['pagina_conteudo'];

        if(empty(get_pagina_por_id($pagina_id))){
        	die_error("A página não foi encontrada.");
        }

        if(contar_pagina_por_diretorio($pagina_diretorio) > 1){
        	die_error("A página já existe.");
        }

        if(!editar_pagina($pagina_titulo, $pagina_diretorio, $pagina_conteudo, $pagina_id)){
        	die_error("Não foi possível editar.");
        }

        die_success_redirect("A página foi editada.", BASE_ADMIN.'pagina/listar');

    }   

    /*
      EXCLUIR
    */
    if($_POST['acao'] == 'excluir'){
    	if(!isset($_POST['pagina_id']) OR !intval($_POST['pagina_id']) OR empty(get_pagina_por_id($_POST['pagina_id']))){
    		die_error("A página não foi encontrada.");
    	}

        $pg = get_pagina_por_id($_POST['pagina_id']);
        $pagina_id = $pg['pagina_id'];

    	if(!excluir_pagina($_POST['pagina_id'])){
    		die_error("Não foi possível excluir.");
    	}

    	die_reload("A página foi excluída.");
    }  
}