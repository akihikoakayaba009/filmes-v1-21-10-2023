<?php require_once $_SERVER['DOCUMENT_ROOT'].'/autoload/public_autoload.php';?>

<!DOCTYPE html>
<html lang="PT-BR">
<head>
    <meta charset="UTF-8">
    <meta name="robots" content="noindex">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="<?php echo SITE_DESCRICAO;?>">
    <meta name="keywords" content="<?php echo SITE_KEYWORDS;?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, user-scalable=no">
    <link rel="stylesheet" href="<?php echo BASE_PLUGINS;?>pace/pace-theme-default.css?site_cache=<?php echo SITE_CACHE;?>">
    <link rel="stylesheet" href="<?php echo BASE_PLUGINS;?>sweetalert/sweetalert.css?site_cache=<?php echo SITE_CACHE;?>">
    <link rel="stylesheet" href="<?php echo BASE_PLUGINS;?>fontawesome/css/all.css?site_cache=<?php echo SITE_CACHE;?>">
    <link rel="stylesheet" href="<?php echo BASE_PLUGINS;?>splide/splide.min.css?site_cache=<?php echo SITE_CACHE;?>">
    <link rel="stylesheet" href="<?php echo BASE_CSS_PUBLIC;?>bootstrap.css?site_cache=<?php echo SITE_CACHE;?>"> 
    <link rel="stylesheet" href="<?php echo BASE_CSS_PUBLIC;?>style.css?site_cache=<?php echo SITE_CACHE;?>"> 
    <link rel="icon" href="<?php echo BASE_IMAGES_SYSTEM_URL.SITE_FAVICON;?>">
    <title><?php echo isset($page_title) ? $page_title.' '.SITE_NOME : SITE_NOME;?></title>    
</head>
<body data-theme="theme-1"> 

<div id="sidebar-left"> 
      <div class="sidebar-perfil">
         
          <?php if($user_logado):?>

            <img src="<?php echo exibir_image_upload_or_url(BASE_IMAGES_AVATARS_PERFIL_SELECT_PATCH, BASE_IMAGES_AVATARS_PERFIL_SELECT_URL, $perfil_avatar);?>" class="avatar">
            <small class="sidebar-text-one"><?php echo $perfil_apelido;?></small>

            <?php if($user_premium):?>
                    <small class="sidebar-text-two"><i class="fas fa-gem me-1"></i>Premium Ativo</small>
            <?php else:?>
                <small class="sidebar-text-two"><i class="fas fa-exclamation-circle me-1"></i>Premium Inativo</small>
            <?php endif;?>
 
          <?php else:?>

            <img src="<?php echo exibir_image_upload_or_url(BASE_IMAGES_AVATARS_PATCH, BASE_IMAGES_AVATARS_URL,SITE_AVATAR);?>" class="avatar">
            <small class="sidebar-text-one">Visitante</small>
            <small class="sidebar-text-one text-center">Crie ou acesse a sua conta.</small>

          <?php endif;?>  
      </div>
 
      <ul class="list-group list-group-flush sidebar-list">

                <a href="<?php echo BASE_PUBLIC;?>" class="list-group-item"><i class="fas fa-home"></i>Início</a>
                <a href="<?php echo BASE_PUBLIC;?>categorias" class="list-group-item"><i class="far fa-video"></i>Categorias</a>


            <?php if(!$user_logado):?>    
                <a href="<?php echo BASE_USER;?>login" class="list-group-item"><i class="fas fa-user"></i>Login</a>
                <a href="<?php echo BASE_USER;?>cadastro" class="list-group-item"><i class="far fa-user-plus"></i>Criar Conta</a>
            <?php endif;?>    

            <?php if($user_logado):?>
                
                <a href="<?php echo BASE_PUBLIC;?>minha-lista" class="list-group-item"><i class="fas fa-film"></i>Minha Lista</a>

                <?php if(!$user_premium):?>
                    <a href="<?php echo BASE_PUBLIC;?>premium" class="list-group-item"><i class="fas fa-gem"></i>Seja Premium</a>
                <?php endif;?>  

                <?php if(premium_free_contar_perfis($user_id, $user_email) > 1):?>
                        <a href="<?php echo BASE_USER;?>perfil-select" class="list-group-item"><i class="fas fa-exchange"></i>Trocar Perfil</a>
                <?php endif;?> 

                <a href="<?php echo BASE_USER;?>" class="list-group-item"><i class="fas fa-user-cog"></i>Minha Conta</a>
                <a href="<?php echo BASE_PUBLIC;?>paginas/listar" class="list-group-item"><i class="fas fa-external-link-alt"></i>Páginas</a>
                <a href="<?php echo BASE_USER;?>logout" class="list-group-item"><i class="fas fa-power-off"></i>Sair</a>

            <?php else:?>

                <a href="<?php echo BASE_PUBLIC;?>premium" class="list-group-item"><i class="fas fa-gem"></i>Seja Premium</a> 

            <?php endif;?>

            <!-- CATEGORIAS -->
            <div class="accordion" id="sidebar-accordion-links-uteis">
                <div class="accordion-item">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebar-collapse-links-uteis" aria-expanded="false" aria-controls="sidebar-collapse-links-uteis">
                    <i class="fas fa-link"></i>Links Úteis
                </button>
                <div id="sidebar-collapse-links-uteis" class="accordion-collapse collapse" aria-labelledby="sidebar-collapse-links-uteis" data-bs-parent="#sidebar-accordion-links-uteis">
                    <div class="accordion-body">
                    <ul class="list-group">
                        <a class="list-group-item" href="<?php echo BASE_PUBLIC;?>paginas/listar">Contatos</a>
                        <?php foreach(listar_pagina() as $pgl):?>
                            <a class="list-group-item" href="<?php echo BASE_PUBLIC.'paginas/listar/'.$pgl['pagina_diretorio'];?>"><?php echo $pgl['pagina_titulo'];?></a>
                        <?php endforeach;?>
                    </ul>
                    </div>
                </div>
                </div>
            </div>
            <!-- CATEGORIAS --> 
           

      </ul>

    </div> 
  
	<div class="page-content" id="page-fixed">
        <nav class="navbar navbar-expand-lg fixed-top shadow" id="navbar-top"> 
        <div class="container">
            <a href="<?php echo BASE_PUBLIC;?>" class="navbar-brand"><img src="<?php echo exibir_image_upload_or_url(BASE_IMAGES_SYSTEM_PATCH,BASE_IMAGES_SYSTEM_URL,SITE_LOGO);?>" class="navbar-logo"></a>
            <div class="d-none d-xl-block ms-auto ">        
                <ul class="navbar-nav ps-3 mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo BASE_PUBLIC;?>"><i class="fas fa-home"></i></a>
                    </li> 
                    <li class="nav-item">
                        <a type="button" class="nav-link" id="show-busca-one"><i class="fas fa-search"></i></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo BASE_PUBLIC;?>categorias"><i class="fas fa-video"></i>Categorias</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo BASE_PUBLIC;?>premium"><i class="fas fa-gem"></i>Premium</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo BASE_PUBLIC;?>paginas/listar"><i class="fas fa-link"></i>Links</a>
                    </li>
                </ul>
            </div>
      
            <div class="d-none d-xl-block desktop">
                <ul class="navbar-nav list-group-horizontal">

                    <?php if($user_logado):?>

                        <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <img class="avatar-nav bg-gradient" src="<?php echo exibir_image_upload_or_url(BASE_IMAGES_AVATARS_PERFIL_SELECT_PATCH, BASE_IMAGES_AVATARS_PERFIL_SELECT_URL, $perfil_avatar);?>">
                            <small class="apelido-nav"><?php echo $perfil_apelido;?></small>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            
                                
                                    <li><a class="dropdown-item" href="<?php echo BASE_PUBLIC;?>minha-lista"><i class="fas fa-film me-2"></i>Minha Lista</a></li>

                                    <?php if(premium_free_contar_perfis($user_id, $user_email) > 1):?>
                                        <li><a class="dropdown-item" href="<?php echo BASE_USER;?>perfil-select"><i class="fas fa-exchange me-2"></i>Trocar Perfil</a></li>
                                    <?php endif;?> 

                                    <li><a class="dropdown-item" href="<?php echo BASE_USER;?>"><i class="fas fa-user-cog me-2"></i>Minha Conta</a></li>
                                    <li><a class="dropdown-item" href="<?php echo BASE_USER;?>logout"><i class="fas fa-power-off me-2"></i>Sair</a></li>

                        </ul>
                        </li>
                        <?php else:?>
                            

                                <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <img class="avatar-nav" src="<?php echo exibir_image_upload_or_url(BASE_IMAGES_AVATARS_PATCH, BASE_IMAGES_AVATARS_URL,SITE_AVATAR);?>">
                                    <small class="apelido-nav">Entrar</small>
                                </a>

                                <ul class="dropdown-menu dropdown-menu-end">

                                        <li><a class="dropdown-item" href="<?php echo BASE_USER;?>login"><i class="fas fa-user me-2"></i>Login</a></li>
                                        <li><a class="dropdown-item" href="<?php echo BASE_USER;?>cadastro"><i class="fas fa-user-plus me-2"></i>Criar Conta</a></li>

                                </ul>
                                </li>

                        <?php endif;?>
                        
                    
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
            <div class="container container-busca">
                <form id="form-busca">
                    <div class="input-group">
                        <input type="text" name="input-busca" autocomplete="off" autofocus class="form-control" placeholder="Buscar: Filmes, Séries, Canais, Novelas e etc...">
                        <button type="submit" class="input-group-text"><i class="fas fa-search"></i></button>
                    </div>
                </form>
            </div>
            