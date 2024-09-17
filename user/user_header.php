<?php require_once $_SERVER['DOCUMENT_ROOT'].'/autoload/user_autoload.php';?>

<!DOCTYPE html>
<html lang="PT-BR">
<head>
    <meta charset="UTF-8">
    <meta name="robots" content="noindex">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo BASE_PLUGINS;?>sweetalert/sweetalert.css?site_cache=<?php echo SITE_CACHE;?>">
    <link rel="stylesheet" href="<?php echo BASE_PLUGINS;?>fontawesome/css/all.css?site_cache=<?php echo SITE_CACHE;?>">
    <link rel="stylesheet" href="<?php echo BASE_CSS_USER;?>bootstrap.css?site_cache=<?php echo SITE_CACHE;?>"> 
    <link rel="stylesheet" href="<?php echo BASE_CSS_USER;?>user.css?site_cache=<?php echo SITE_CACHE;?>"> 
    <link rel="icon" href="<?php echo BASE_IMAGES_SYSTEM_URL.SITE_FAVICON;?>">
    <title><?php echo isset($page_title) ? $page_title.' '.SITE_NOME : SITE_NOME;?></title>    
</head>
<body data-theme="theme-1">

<?php if(isset($_GET['dir']) && $_GET['dir'] == "user_login" OR $_GET['dir'] == "user_cadastro" OR
		 $_GET['dir'] == "user_recuperar_senha_ps1" OR $_GET['dir'] == "user_recuperar_senha_ps2" OR $_GET['dir'] == 'perfil_select'):?>

<style>
        <?php if($_GET['dir'] != 'perfil_select'):?> 
            
            body[data-theme=theme-1]{
                background: url('<?php echo BASE_IMAGES_SYSTEM_URL.SITE_BACKGROUND;?>') no-repeat center center fixed;
		        background-color: rgba(0, 0, 0, 0.8);
                background-blend-mode: overlay;
                min-height: 100%;
                background-size: cover;
    
            }

        <?php endif;?> 
</style>	 

<?php else:?>
  
    <div id="sidebar-left"> 
      <div class="sidebar-perfil">
         
            <img src="<?php echo exibir_image_upload_or_url(BASE_IMAGES_AVATARS_PERFIL_SELECT_PATCH, BASE_IMAGES_AVATARS_PERFIL_SELECT_URL, $perfil_avatar);?>" class="avatar">
            <small class="sidebar-text-one"><?php echo $perfil_apelido;?></small>

            <?php if($user_premium):?>
                <small class="sidebar-text-two"><i class="fas fa-gem me-1"></i>Premium Ativo</small>
            <?php else:?>
                <small class="sidebar-text-two"><i class="fas fa-exclamation-circle me-1"></i>Premium Inativo</small>
            <?php endif;?>
      </div>

      <ul class="list-group list-group-flush sidebar-list">

                <a href="<?php echo BASE_PUBLIC;?>" class="list-group-item"><i class="fas fa-home"></i>Início</a>
                <a href="<?php echo BASE_PUBLIC;?>categorias" class="list-group-item"><i class="far fa-video"></i>Categorias</a>
                <a href="<?php echo BASE_PUBLIC;?>minha-lista" class="list-group-item"><i class="fas fa-film"></i>Minha Lista</a>
                <a href="<?php echo BASE_PUBLIC;?>premium" class="list-group-item"><i class="fas fa-gem"></i>Seja Premium</a>

                <?php if(premium_free_contar_perfis($user_id, $user_email) > 1):?>
                        <a href="<?php echo BASE_USER;?>perfil-select" class="list-group-item"><i class="fas fa-exchange"></i>Trocar Perfil</a>
                <?php endif;?> 

                <a href="<?php echo BASE_USER;?>" class="list-group-item"><i class="fas fa-user-cog"></i>Minha Conta</a>
                <a href="<?php echo BASE_USER;?>logout" class="list-group-item"><i class="fas fa-power-off"></i>Sair</a>
      </ul>  

    </div> 
 
	<div class="page-content" id="page-fixed">
        <nav class="navbar navbar-expand-lg fixed-top shadow" id="navbar-top"> 
        <div class="container">
            <a href="<?php echo BASE_PUBLIC;?>" class="navbar-brand"><img src="<?php echo exibir_image_upload_or_url(BASE_IMAGES_SYSTEM_PATCH,BASE_IMAGES_SYSTEM_URL,SITE_LOGO);?>" class="navbar-logo"></a>
            <div class="d-none d-xl-block desktop">
                <ul class="navbar-nav list-group-horizontal">

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <img class="avatar-nav" src="<?php echo exibir_image_upload_or_url(BASE_IMAGES_AVATARS_PERFIL_SELECT_PATCH, BASE_IMAGES_AVATARS_PERFIL_SELECT_URL, $perfil_avatar);?>">
                            <small class="apelido-nav"><?php echo $perfil_apelido;?></small>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                                    <li><a class="dropdown-item" href="<?php echo BASE_PUBLIC;?>"><i class="fas fa-home me-2"></i>Início</a></li>
                                    <li><a class="dropdown-item" href="<?php echo BASE_PUBLIC;?>minha-lista"><i class="fas fa-film me-2"></i>Minha Lista</a></li>

                                    <?php if(premium_free_contar_perfis($user_id, $user_email) > 1):?>
                                        <li><a class="dropdown-item" href="<?php echo BASE_USER;?>perfil-select"><i class="fas fa-exchange me-2"></i>Trocar Perfil</a></li>
                                    <?php endif;?> 

                                    <li><a class="dropdown-item" href="<?php echo BASE_USER;?>"><i class="fas fa-user-cog me-2"></i>Minha Conta</a></li>
                                    <li><a class="dropdown-item" href="<?php echo BASE_USER;?>logout"><i class="fas fa-power-off me-2"></i>Sair</a></li>
                        </ul>
                    </li>
                    
                </ul>
            </div>

            <div class="d-block d-xl-none d-xxl-none mobile d-flex justify-content-end align-items-end"> 
                <a href="<?php echo BASE_PUBLIC;?>" class="btn btn-sm"><i class="far fa-home"></i></a>
                <button class="btn btn-sm" id="show-busca-two"><i class="far fa-search"></i></button>
                <a href="<?php echo BASE_PUBLIC;?>categorias" class="btn btn-sm"><i class="far fa-video"></i></a>
                <button class="btn btn-one btn-sm open-sidebar-left" type="button"><i class="fas fa-bars"></i></button>
            </div>

        </div>    
        </nav> 
        
        <div id="page-content">
            

<?php endif;?>