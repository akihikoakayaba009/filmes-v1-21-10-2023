<?php 
require_once $_SERVER['DOCUMENT_ROOT'].'/controller/admin/admin_controller.php';

if(isset($_POST['admin_online'])){
    
    if(date("Y-m-d H:i:s") > date("Y-m-d H:i:s", strtotime($admin_online."+ 45 seconds")) OR $admin_online == NULL){
        cadastrar_admin_online($admin_id, $admin_email);
    }
}