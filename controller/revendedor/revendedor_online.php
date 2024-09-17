<?php 
require_once $_SERVER['DOCUMENT_ROOT'].'/controller/revendedor/revendedor_controller.php';

if(isset($_POST['acao'])){
    
    if($_POST['acao'] == 'cad_revendedor_online'){

        if(date("Y-m-d H:i:s") > date("Y-m-d H:i:s", strtotime($rev['revendedor_online']."+ 30 seconds")) OR $rev['revendedor_online'] == NULL){
            atualizar_revendedor_online($revendedor_email, $revendedor_id);
        }
    }
} 