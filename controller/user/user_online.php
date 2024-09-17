<?php 
require_once $_SERVER['DOCUMENT_ROOT'].'/controller/user/user_controller.php';

if(isset($_POST['acao'])){

    if($_POST['acao'] == 'cad-user-online'){
        echo date("Y-m-d H:i:s", strtotime("+ 1 minutes".$user_online));
        if(date("Y-m-d H:i:s") > date("Y-m-d H:i:s", strtotime("+ 1 minutes".$user_online))){
            atualizar_user_online($user_id, $user_email, date("Y-m-d H:i:s", strtotime("+ 1 minutes")));
        }
    }
}