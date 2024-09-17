<?php 
require_once $_SERVER['DOCUMENT_ROOT'].'/controller/admin/admin_controller.php';

if(isset($_POST['acao'])){

    if($_POST['acao'] == 'adicionar'){

        //ADICIONAR
        if(!isset($_POST['monetizacao_posicao']) OR empty($_POST['monetizacao_posicao']) OR 
           !isset($_POST['monetizacao_codigo']) OR empty($_POST['monetizacao_codigo']) OR 
           !isset($_POST['monetizacao_titulo']) OR empty($_POST['monetizacao_titulo'])){
            die_error("Preencha todos os campos.");
        }

        $monetizacao_titulo  = ucwords(trim($_POST['monetizacao_titulo']));
        $monetizacao_posicao = $_POST['monetizacao_posicao'];
        $monetizacao_codigo  = $_POST['monetizacao_codigo'];

        if(!verificar_monetizacao_posicao($monetizacao_posicao)){
            die_error("A posição é inválida.");
        }

        if(!adicionar_monetizacao($monetizacao_posicao, $monetizacao_codigo, $monetizacao_titulo)){
            die_error("Não foi possível adicionar.");
        }

        die_url(BASE_ADMIN.'monetizacao/listar');

    }

    //EDITAR
    if($_POST['acao'] == 'editar'){

        if(!isset($_POST['monetizacao_posicao']) OR empty($_POST['monetizacao_posicao']) OR 
           !isset($_POST['monetizacao_codigo']) OR empty($_POST['monetizacao_codigo']) OR
           !isset($_POST['monetizacao_titulo']) OR empty($_POST['monetizacao_titulo']) OR 
           !isset($_POST['monetizacao_id']) OR !intval($_POST['monetizacao_id'])){
            die_error("Preencha todos os campos.");
        }

        $monetizacao_id      = $_POST['monetizacao_id'];
        $monetizacao_titulo  = ucwords(trim($_POST['monetizacao_titulo']));
        $monetizacao_posicao = $_POST['monetizacao_posicao'];
        $monetizacao_codigo  = $_POST['monetizacao_codigo'];

        if(!verificar_monetizacao_posicao($monetizacao_posicao)){
            die_error("A posição é inválida.");
        }

        if(!editar_monetizacao($monetizacao_posicao, $monetizacao_codigo, $monetizacao_titulo, $monetizacao_id)){
            die_error("Não foi possível editar.");
        }

        die_url(BASE_ADMIN.'monetizacao/listar');
    }

    //EXCLUIR
    if($_POST['acao'] == 'excluir'){
        if(!isset($_POST['monetizacao_id']) OR !intval($_POST['monetizacao_id'])){
            die_error("A monetização não foi encontrada.");
        }

        $monetizacao_id = $_POST['monetizacao_id'];

        if(empty(get_monetizacao_por_id($monetizacao_id))){
            die_error("A monetização não existe.");
        }

        if(!excluir_monetizacao($monetizacao_id)){
            die_error("Não foi possível excluir.");
        }

        die_reload();


    }
    
}