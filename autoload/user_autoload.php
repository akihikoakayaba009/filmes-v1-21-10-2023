<?php 
require_once $_SERVER['DOCUMENT_ROOT'].'/config/config.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/functions/global/global.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/functions/global/inputs_filter.php';


require_once $_SERVER['DOCUMENT_ROOT'].'/functions/user/user_cadastro.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/functions/user/user_login.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/functions/user/user_session.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/functions/user/user_recuperar_senha.php';

require_once $_SERVER['DOCUMENT_ROOT'].'/functions/user/user_perfil.php';

require_once $_SERVER['DOCUMENT_ROOT'].'/functions/global/premium.php';

require_once $_SERVER['DOCUMENT_ROOT'].'/autoload/mercado_pago.php';