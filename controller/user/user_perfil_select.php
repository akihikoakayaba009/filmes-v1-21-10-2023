<?php 
require_once $_SERVER['DOCUMENT_ROOT'].'/controller/user/user_controller.php';

if(isset($_POST['acao'])){
    if($_POST['acao'] == 'editar-perfil-select'){ 

        if(!isset($_POST['perfil_apelido']) OR empty($_POST['perfil_apelido']) OR 
           !isset($_POST['perfil_avatar']) OR empty($_POST['perfil_avatar'])){
            die_error("Informe o apelido ou selecione o avatar.");
        }
 
        if(!valida_apelido($_POST['perfil_apelido'])){
            die_error("O apelido é inválido.");
        }

        if(!in_array($_POST['perfil_avatar'], avatars_perfis_tela())){
            die_error("O avatar é inválido.");
        }

        $perfil_apelido   = trim(ucwords($_POST['perfil_apelido']));
        $perfil_avatar = $_POST['perfil_avatar'];

        if(!premium_free_editar_perfil($perfil_apelido, $perfil_avatar, $perfil_id, $user_id, $user_email)){
            die_error("Não foi possível editar.");
        }
        die_success_reload("Perfil editado.");

    }
}