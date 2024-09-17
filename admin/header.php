<?php require_once $_SERVER['DOCUMENT_ROOT'].'/autoload/admin_autoload.php';?>

<!DOCTYPE html>
<html lang="PT-BR">
<head>
    <meta charset="UTF-8">
    <meta name="robots" content="noindex">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo BASE_PLUGINS;?>sweetalert/sweetalert.css?site_cache=<?php echo SITE_CACHE;?>">
    <link rel="stylesheet" href="<?php echo BASE_PLUGINS;?>fontawesome/css/all.css?site_cache=<?php echo SITE_CACHE;?>">
    <link rel="stylesheet" href="<?php echo BASE_CSS_ADMIN;?>bootstrap.css?site_cache=<?php echo SITE_CACHE;?>"> 
    <link rel="stylesheet" href="<?php echo BASE_PLUGINS;?>datatables/datatables.min.css?site_cache=<?php echo SITE_CACHE;?>">
    <link rel="stylesheet" href="<?php echo BASE_CSS_ADMIN;?>admin.css?site_cache=<?php echo SITE_CACHE;?>"> 
    <link rel="stylesheet" href="<?php echo BASE_CSS_ADMIN;?>colors.css?site_cache=<?php echo SITE_CACHE;?>"> 
    <link rel="stylesheet" href="<?php echo BASE_CSS_ADMIN;?>responsive.css?site_cache=<?php echo SITE_CACHE;?>"> 
    <link rel="icon" href="<?php echo BASE_IMAGES_SYSTEM_URL.SITE_FAVICON;?>">
    <title><?php echo isset($page_title) ? $page_title.' '.SITE_NOME : SITE_NOME;?></title>

    <?php if(isset($_GET['dir']) && $_GET['dir'] == 'admin_recuperar_senha_ps1' OR $_GET['dir'] == 'admin_login' OR $_GET['dir'] == 'admin_recuperar_senha_ps2' OR $_GET['dir'] == 'admin_confirmar_email'):?>

      <style>
        body[data-theme=theme-1]{
          background: url('<?php echo BASE_IMAGES_SYSTEM_URL.SITE_BACKGROUND;?>') no-repeat center center fixed;
		  background-color: rgba(0, 0, 0, 0.8);
          background-blend-mode: overlay;
          min-height: 100%;
          background-size: cover;
    
        } 
      </style>

    <?php endif;?>  
    
</head>
<body data-theme="theme-1">

<?php if(isset($_GET['dir']) && $_GET['dir'] != 'admin_login' && $_GET['dir'] !== 'admin_recuperar_senha_ps1' && $_GET['dir'] != 'admin_recuperar_senha_ps2' && $_GET['dir'] != 'admin_confirmar_email'):?>

  



  <div id="sidebar-left">
      <div class="sidebar-perfil bg-gradient shadow">
          <img src="<?php echo exibir_image_upload_or_url(BASE_IMAGES_AVATARS_PATCH, BASE_IMAGES_AVATARS_URL, $admin_avatar);?>" class="avatar">
          <small class="sidebar-text-one"><?php echo $admin_primeiro_nome;?></small>
          <small class="sidebar-text-two"><i class="fas fa-user-crown me-2"></i>Administrador</small>
      </div>
      <ul class="list-group list-group-flush sidebar-list">
          <a href="<?php echo BASE_ADMIN;?>" class="list-group-item"><i class="fas fa-home"></i>Início</a>

           
          <!-- CATEGORIAS -->
          <div class="accordion" id="sidebar-accordion-categorias">
              <div class="accordion-item">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebar-collapse-categorias" aria-expanded="false" aria-controls="sidebar-collapse-categorias">
                <i class="fas fa-list"></i>Categorias
              </button>
              <div id="sidebar-collapse-categorias" class="accordion-collapse collapse" aria-labelledby="sidebar-collapse-categorias" data-bs-parent="#sidebar-accordion-categorias">
                  <div class="accordion-body">
                  <ul class="list-group">
                      <a class="list-group-item" href="<?php echo BASE_ADMIN;?>midia/categoria/adicionar">Adicionar</a>
                      <a class="list-group-item" href="<?php echo BASE_ADMIN;?>midia/categoria/listar">Listar</a>
                  </ul>
                  </div>
              </div>
              </div>
          </div>
          <!-- CATEGORIAS --> 

           <!-- MIDIAS LISTAR -->
           <div class="accordion" id="sidebar-accordion-midia-listar">
              <div class="accordion-item">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebar-collapse-midia-listar" aria-expanded="false" aria-controls="sidebar-collapse-midia-listar">
                <i class="fas fa-video"></i>Mídias
              </button>
              <div id="sidebar-collapse-midia-listar" class="accordion-collapse collapse" aria-labelledby="sidebar-collapse-midia-listar" data-bs-parent="#sidebar-accordion-midia-listar">
                  <div class="accordion-body">
                  <ul class="list-group">
                      <a class="list-group-item" href="<?php echo BASE_ADMIN;?>midia/anime/listar">Animes</a>
                      <a class="list-group-item" href="<?php echo BASE_ADMIN;?>midia/canal/listar">Canais</a>
                      <a class="list-group-item" href="<?php echo BASE_ADMIN;?>midia/filme/listar">Filmes</a>
                      <a class="list-group-item" href="<?php echo BASE_ADMIN;?>midia/infantil/listar">Infantis</a>
                      <a class="list-group-item" href="<?php echo BASE_ADMIN;?>midia/novela/listar">Novelas</a>
                      <a class="list-group-item" href="<?php echo BASE_ADMIN;?>midia/serie/listar">Séries</a>
                      <a class="list-group-item" href="<?php echo BASE_ADMIN;?>midia/comentarios">Comentários</a>
                  </ul>
                  </div>
              </div>
              </div>
          </div>
          <!-- MIDIAS LISTAR --> 

          <!-- MIDIAS ADICIONAR -->
          <div class="accordion" id="sidebar-accordion-midia-adicionar">
              <div class="accordion-item">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebar-collapse-midia-adicionar" aria-expanded="false" aria-controls="sidebar-collapse-midia-adicionar">
                <i class="fas fa-plus-circle"></i>Adicionar Mídia
              </button>
              <div id="sidebar-collapse-midia-adicionar" class="accordion-collapse collapse" aria-labelledby="sidebar-collapse-midia-adicionar" data-bs-parent="#sidebar-accordion-midia-adicionar">
                  <div class="accordion-body">
                  <ul class="list-group">
                      <a class="list-group-item" href="<?php echo BASE_ADMIN;?>midia/anime/adicionar">Anime</a>
                      <a class="list-group-item" href="<?php echo BASE_ADMIN;?>midia/canal/adicionar">Canal</a>
                      <a class="list-group-item" href="<?php echo BASE_ADMIN;?>midia/filme/adicionar">Filme</a>
                      <a class="list-group-item" href="<?php echo BASE_ADMIN;?>midia/infantil/adicionar">Infantil</a>
                      <a class="list-group-item" href="<?php echo BASE_ADMIN;?>midia/novela/adicionar">Novela</a>
                      <a class="list-group-item" href="<?php echo BASE_ADMIN;?>midia/serie/adicionar">Série</a>
                  </ul>
                  </div>
              </div>
              </div>
          </div>
          <!-- MIDIAS ADICIONAR --> 

          <!-- MIDIAS PLANOS PREMIUM USER -->
          <div class="accordion" id="sidebar-accordion-planos-user">
              <div class="accordion-item">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebar-collapse-planos-user" aria-expanded="false" aria-controls="sidebar-collapse-planos-user">
                <i class="fas fa-boxes"></i>Planos Premium
              </button>
              <div id="sidebar-collapse-planos-user" class="accordion-collapse collapse" aria-labelledby="sidebar-collapse-planos-user" data-bs-parent="#sidebar-accordion-planos-user">
                  <div class="accordion-body">
                  <ul class="list-group">
                      <a class="list-group-item" href="<?php echo BASE_ADMIN;?>planos-premium/listar">Listar</a>
                      <a class="list-group-item" href="<?php echo BASE_ADMIN;?>planos-premium/adicionar">Adicionar</a>
                  </ul>
                  </div>
              </div>
              </div>
          </div>
          <!-- MIDIAS PLANOS PREMIUM USER --> 

          <!-- USUARIOS -->
          <div class="accordion" id="sidebar-accordion-usuarios">
              <div class="accordion-item">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebar-collapse-usuarios" aria-expanded="false" aria-controls="sidebar-collapse-usuarios">
                <i class="fas fa-users"></i>Usuários
              </button> 
              <div id="sidebar-collapse-usuarios" class="accordion-collapse collapse" aria-labelledby="sidebar-collapse-usuarios" data-bs-parent="#sidebar-accordion-usuarios">
                  <div class="accordion-body">
                  <ul class="list-group">
                      <a class="list-group-item" href="<?php echo BASE_ADMIN;?>usuarios/listar">Listar</a>
                      <a class="list-group-item" href="<?php echo BASE_ADMIN;?>usuarios/adicionar">Adicionar</a>
                  </ul>
                  </div>
              </div>
              </div>
          </div>
          <!-- USUARIOS --> 

          <!-- REVENDEDORES -->
          <div class="accordion" id="sidebar-accordion-revendedores">
              <div class="accordion-item">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebar-collapse-revendedores" aria-expanded="false" aria-controls="sidebar-collapse-revendedores">
                <i class="fas fa-user-headset"></i>Revendedores
              </button> 
              <div id="sidebar-collapse-revendedores" class="accordion-collapse collapse" aria-labelledby="sidebar-collapse-revendedores" data-bs-parent="#sidebar-accordion-revendedores">
                  <div class="accordion-body">
                  <ul class="list-group">
                      <a class="list-group-item" href="<?php echo BASE_ADMIN;?>revendedores/listar">Listar</a>
                      <a class="list-group-item" href="<?php echo BASE_ADMIN;?>revendedores/adicionar">Adicionar</a>
                  </ul>
                  </div>
              </div>
              </div>
          </div>
          <!-- REVENDEDORES --> 

          <!-- ADMINISTRADORES -->
          <div class="accordion" id="sidebar-accordion-administradores">
              <div class="accordion-item">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebar-collapse-administradores" aria-expanded="false" aria-controls="sidebar-collapse-administradores">
                <i class="fas fa-users-crown"></i>Administradores
              </button>
              <div id="sidebar-collapse-administradores" class="accordion-collapse collapse" aria-labelledby="sidebar-collapse-administradores" data-bs-parent="#sidebar-accordion-administradores">
                  <div class="accordion-body">
                  <ul class="list-group">
                      <a class="list-group-item" href="<?php echo BASE_ADMIN;?>administradores/listar">Listar</a>
                      <a class="list-group-item" href="<?php echo BASE_ADMIN;?>administradores/adicionar">Adicionar</a>
                  </ul>
                  </div>
              </div>
              </div>
          </div>
          <!-- ADMINISTRADORES --> 

          <!-- ADMINISTRADOR PERFIL -->
          <div class="accordion" id="sidebar-accordion-admin-perfil">
              <div class="accordion-item">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebar-collapse-admin-perfil" aria-expanded="false" aria-controls="sidebar-collapse-admin-perfil">
                <i class="fas fa-user-edit"></i>Meu Perfil
              </button>
              <div id="sidebar-collapse-admin-perfil" class="accordion-collapse collapse" aria-labelledby="sidebar-collapse-admin-perfil" data-bs-parent="#sidebar-accordion-admin-perfil">
                  <div class="accordion-body">
                  <ul class="list-group">
                      <a class="list-group-item" href="<?php echo BASE_ADMIN;?>perfil/editar">Editar</a>
                      <a class="list-group-item" href="<?php echo BASE_ADMIN;?>perfil/alterar-senha">Alterar Senha</a>
                  </ul>
                  </div>
              </div>
              </div>
          </div>
          <!-- ADMINISTRADOR PERFIL --> 

          <!-- CAROUSEL -->
          <div class="accordion" id="sidebar-accordion-carousel">
              <div class="accordion-item">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebar-collapse-carousel" aria-expanded="false" aria-controls="sidebar-collapse-carousel">
                <i class="fas fa-images"></i>Carousel
              </button>
              <div id="sidebar-collapse-carousel" class="accordion-collapse collapse" aria-labelledby="sidebar-collapse-carousel" data-bs-parent="#sidebar-accordion-carousel">
                  <div class="accordion-body">
                  <ul class="list-group">
                      <a class="list-group-item" href="<?php echo BASE_ADMIN;?>carousel/home">Página Inicial</a>
                  </ul>
                  </div>
              </div>
              </div>
          </div>

          <!-- CONFIGURACOES -->
          <div class="accordion" id="sidebar-accordion-configuracoes">
              <div class="accordion-item">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebar-collapse-configuracoes" aria-expanded="false" aria-controls="sidebar-collapse-configuracoes">
                <i class="fas fa-cog"></i>Configurações
              </button>
              <div id="sidebar-collapse-configuracoes" class="accordion-collapse collapse" aria-labelledby="sidebar-collapse-configuracoes" data-bs-parent="#sidebar-accordion-configuracoes">
                  <div class="accordion-body">
                  <ul class="list-group">
                      <a class="list-group-item" href="<?php echo BASE_ADMIN;?>configuracoes/smtp">Envio de email</a>
                      <a class="list-group-item" href="<?php echo BASE_ADMIN;?>configuracoes/site-informacoes">Informações Do Site</a>
                      <a class="list-group-item" href="<?php echo BASE_ADMIN;?>configuracoes/site-imagens">Imagens Do Site</a>
                      <a class="list-group-item" href="<?php echo BASE_ADMIN;?>monetizacao/listar">Monetização</a>
                  </ul>
                  </div>
              </div>
              </div>
          </div>

          <!-- CONFIGURACOES --> 
          <a href="<?php echo BASE_ADMIN;?>vendas/listar" class="list-group-item"><i class="fas fa-sack-dollar"></i>Vendas</a>  
          <a href="<?php echo BASE_ADMIN;?>pagina/listar" class="list-group-item"><i class="fas fa-file"></i>Páginas</a>  
          <a href="<?php echo BASE_PUBLIC;?>" target="_BLANK" class="list-group-item"><i class="fas fa-external-link"></i>Visualizar Site</a>  
          <a href="<?php echo BASE_ADMIN;?>logout" class="list-group-item"><i class="fas fa-power-off"></i>Terminar Sessão</a>

      </ul>
    </div>
    </div>

    <div class="page-content" id="page-fixed">
        <nav class="navbar fixed-top shadow" id="navbar-top">
        <div class="container-fluid">
            <div class="me-auto">
                <a href="<?php echo BASE_ADMIN;?>" class="navbar-brand"><img src="<?php echo exibir_image_upload_or_url(BASE_IMAGES_SYSTEM_PATCH,BASE_IMAGES_SYSTEM_URL,SITE_LOGO);?>" class="navbar-logo"></a>
            </div>
            <div class="d-flex">
                <button class="btn btn-one btn-sm ms-1 open-sidebar-left d-block d-xl-none" type="button"><i class="fas fa-bars"></i></button>
            </div>
        </div>
        </nav>
        
    <div id="page-content">
    <div class="container-fluid">


<?php endif;?>
