<?php 
require_once $_SERVER['DOCUMENT_ROOT'].'/config/config.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/functions/global/global.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/functions/global/inputs_filter.php';


require_once $_SERVER['DOCUMENT_ROOT'].'/functions/revendedor/revendedor_cadastro.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/functions/revendedor/revendedor_login.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/functions/revendedor/revendedor_session.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/functions/revendedor/revendedor_recuperar_senha.php';


require_once $_SERVER['DOCUMENT_ROOT'].'/functions/revendedor/revendedor_perfil.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/functions/revendedor/revendedor_usuarios.php';

require_once $_SERVER['DOCUMENT_ROOT'].'/functions/revendedor/revendedor_planos_premium.php';

require_once $_SERVER['DOCUMENT_ROOT'].'/functions/global/premium.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/autoload/mercado_pago.php'; 