<?php require_once $_SERVER['DOCUMENT_ROOT'].'/autoload/revendedor_autoload.php';?>

<!DOCTYPE html>
<html lang="PT-BR">
<head>
    <meta charset="UTF-8">
    <meta name="robots" content="noindex">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo BASE_PLUGINS;?>sweetalert/sweetalert.css?site_cache=<?php echo SITE_CACHE;?>">
    <link rel="stylesheet" href="<?php echo BASE_PLUGINS;?>fontawesome/css/all.css?site_cache=<?php echo SITE_CACHE;?>">
    <link rel="stylesheet" href="<?php echo BASE_PLUGINS;?>datatables/datatables.min.css?site_cache=<?php echo SITE_CACHE;?>">
    <link rel="stylesheet" href="<?php echo BASE_CSS_REVENDEDOR;?>bootstrap.css?site_cache=<?php echo SITE_CACHE;?>"> 
    <link rel="stylesheet" href="<?php echo BASE_CSS_REVENDEDOR;?>revendedor.css?site_cache=<?php echo SITE_CACHE;?>"> 
	<link rel="stylesheet" href="<?php echo BASE_CSS_REVENDEDOR;?>colors.css?site_cache=<?php echo SITE_CACHE;?>"> 
    <link rel="stylesheet" href="<?php echo BASE_CSS_REVENDEDOR;?>responsive.css?site_cache=<?php echo SITE_CACHE;?>"> 
    <link rel="icon" href="<?php echo BASE_IMAGES_SYSTEM_URL.SITE_FAVICON;?>">
    <title><?php echo isset($page_title) ? $page_title.' '.SITE_NOME : SITE_NOME;?></title>    
</head>
<body data-theme="theme-1">
<?php if(isset($_GET['dir']) && $_GET['dir'] == "revendedor_login" OR $_GET['dir'] == "revendedor_cadastro" OR
		 $_GET['dir'] == "revendedor_recuperar_senha_ps1"OR $_GET['dir'] == "revendedor_recuperar_senha_ps2"):?>

<style>
        body[data-theme=theme-1]{
          background: url('<?php echo BASE_IMAGES_SYSTEM_URL.SITE_BACKGROUND;?>') no-repeat center center fixed;
		  background-color: rgba(0, 0, 0, 0.8);
          background-blend-mode: overlay;
          min-height: 100%;
          background-size: cover;
    
        } 
</style>	 

<?php else:?>

    <div id="sidebar-left">
      <div class="sidebar-perfil bg-gradient shadow">
          <img src="<?php echo exibir_image_upload_or_url(BASE_IMAGES_AVATARS_PATCH, BASE_IMAGES_AVATARS_URL, $revendedor_avatar);?>" class="avatar">
          <small class="sidebar-text-one"><?php echo $revendedor_primeiro_nome;?></small>
          <small class="sidebar-text-two"><i class="fas fa-coins me-2"></i>Créditos <?php echo $revendedor_creditos;?></small>
      </div>
      <ul class="list-group list-group-flush sidebar-list">
          <a href="<?php echo BASE_REVENDEDOR;?>" class="list-group-item"><i class="fas fa-users"></i>Usuários</a>
          <a href="<?php echo BASE_REVENDEDOR;?>usuarios/adicionar" class="list-group-item"><i class="fas fa-user-plus"></i>Adicionar Usuário</a>
          <a href="<?php echo BASE_REVENDEDOR;?>perfil" class="list-group-item"><i class="fas fa-user-cog"></i>Meu Perfil</a>
          <a href="<?php echo BASE_PUBLIC;?>" target="_blank" class="list-group-item"><i class="fas fa-external-link"></i>Ver site</a>
          <a href="<?php echo BASE_REVENDEDOR;?>logout" class="list-group-item"><i class="fas fa-sign-out"></i>Sair</a>

      </ul>
    </div> 

    <div class="page-content" id="page-fixed">
        <nav class="navbar fixed-top shadow" id="navbar-top">
        <div class="container-fluid">
            <div class="me-auto">
                <a href="<?php echo BASE_REVENDEDOR;?>" class="navbar-brand"><img src="<?php echo exibir_image_upload_or_url(BASE_IMAGES_SYSTEM_PATCH,BASE_IMAGES_SYSTEM_URL,SITE_LOGO);?>" class="navbar-logo"></a>
            </div>
            <div class="d-flex">
                <button class="btn btn-one btn-sm ms-1 open-sidebar-left d-block d-xl-none" type="button"><i class="fas fa-bars"></i></button>
            </div>
        </div>
        </nav>
        
        <div id="page-content">
        <div class="container-fluid">

<?php endif;?>