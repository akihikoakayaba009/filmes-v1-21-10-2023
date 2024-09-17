<?php 
session_start();
setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Bahia');


ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

/* DATABASE INFORMAÇÕES */
define("DB_HOST", "localhost");
define("DB_NAME", "");
define("DB_USER", "root");
define("DB_PASS", "");
define("DB_CON", "mysql:dbname=" . DB_NAME . ";host=" . DB_HOST . ";charset=utf8");

/* DATABASE CONEXAO */
require_once $_SERVER['DOCUMENT_ROOT'].'/config/database.php';

/* SITE CONFIG */
define("SITE_NOME", site_config()['site_nome']);
define("SITE_EMAIL", site_config()['site_email']);
define("SITE_WHATSAPP", site_config()['site_whatsapp']);
define("SITE_FACEBOOK", site_config()['site_facebook']);
define("SITE_INSTAGRAM", site_config()['site_instagram']);
define("SITE_TWITTER", site_config()['site_twitter']);
define("SITE_YOUTUBE", site_config()['site_youtube']);
define("SITE_DESCRICAO", site_config()['site_descricao']);
define("SITE_KEYWORDS", site_config()['site_keywords']);
define("SITE_LOGO", site_config()['site_logo']);
define("SITE_FAVICON", site_config()['site_favicon']);
define("SITE_BACKGROUND", site_config()['site_background']);
define("SITE_TOKEN_MP", site_config()['site_token_mp']);
define("SITE_COPYRIGHT","© ".date("Y")." ".SITE_NOME); 
define("SITE_AVATAR", site_config()['site_avatar']);
define("SITE_CATEGORIA_IMAGE", site_config()['site_categoria_image']);
define("SITE_EPISODIOS_IMAGE", site_config()['site_episodio_image']);
define("SITE_MIDIA_BACKGROUND", site_config()['site_midia_background']);
define("SITE_PAGINACAO", site_config()['site_paginacao']); 
define("SITE_CACHE", site_config()['site_cache']);


/* BASE GLOBAL*/
define("SITE_URL", $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['HTTP_HOST']); 

/* BASE ADMIN*/
define("BASE_ADMIN", SITE_URL . '/admin/');
define("BASE_CSS_ADMIN", SITE_URL . '/assets/css/admin/');
define("BASE_JS_ADMIN", SITE_URL . '/assets/js/admin/');
define("BASE_PLUGINS", SITE_URL.'/assets/plugins/');

/* BASE USER*/
define("BASE_CSS_USER", SITE_URL . '/assets/css/user/');
define("BASE_JS_USER", SITE_URL . '/assets/js/user/');
define("BASE_USER", SITE_URL . '/user/');

/* BASE REVENDEDOR */
define("BASE_CSS_REVENDEDOR", SITE_URL . '/assets/css/revendedor/');
define("BASE_JS_REVENDEDOR", SITE_URL . '/assets/js/revendedor/');
define("BASE_REVENDEDOR", SITE_URL . '/revendedor/');

/* BASE JS PUBLIC */
define("BASE_PUBLIC", SITE_URL . '/');
define("BASE_CSS_PUBLIC", SITE_URL . '/assets/css/public/');
define("BASE_JS_PUBLIC", SITE_URL . '/assets/js/public/');

/* IMAGES URL */
define("BASE_IMAGES_SYSTEM_URL", SITE_URL.'/assets/images/system/');
define("BASE_IMAGES_AVATARS_URL", SITE_URL.'/assets/images/avatars/');
define("BASE_IMAGES_AVATARS_PERFIL_SELECT_URL", SITE_URL.'/assets/images/avatars-perfil-select/');
define("BASE_IMAGES_CATEGORIAS_URL", SITE_URL.'/assets/images/categorias/');
define("BASE_IMAGES_MIDIA_URL", SITE_URL.'/assets/images/midia/');
define("BASE_IMAGES_EPISODIOS_URL", SITE_URL.'/assets/images/episodios/');
define("BASE_IMAGES_CAROUSEL_URL", SITE_URL . '/assets/images/carousel/');


/* IMAGES PATCH */
define("BASE_IMAGES_AVATARS_PATCH", $_SERVER['DOCUMENT_ROOT'].'/assets/images/avatars/');
define("BASE_IMAGES_AVATARS_PERFIL_SELECT_PATCH", $_SERVER['DOCUMENT_ROOT'].'/assets/images/avatars-perfil-select/');
define("BASE_IMAGES_SYSTEM_PATCH", $_SERVER['DOCUMENT_ROOT'].'/assets/images/system/');
define("BASE_IMAGES_CATEGORIAS_PATCH", $_SERVER['DOCUMENT_ROOT'].'/assets/images/categorias/');
define("BASE_IMAGES_MIDIA_PATCH", $_SERVER['DOCUMENT_ROOT'].'/assets/images/midia/');
define("BASE_IMAGES_EPISODIOS_PATCH", $_SERVER['DOCUMENT_ROOT'].'/assets/images/episodios/');
define("BASE_IMAGES_CAROUSEL_PATCH", $_SERVER['DOCUMENT_ROOT'] . '/assets/images/carousel/');

/*
   CKEDITOR
*/
define("BASE_CKEDITOR_UPLOADS",SITE_URL.'/controller/admin/ckeditor_uploads.php');
define("BASE_CKEDITOR_FILES_UPLOAD",$_SERVER['DOCUMENT_ROOT'].'/assets/ckeditor/');
define("BASE_CKEDITOR_FILES_URL",SITE_URL.'/assets/ckeditor/');
define("BASE_CKEDITOR", SITE_URL . '/assets/plugins/ckeditor/');

/* 
   PHP MAILER
*/
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception; 