<?php require_once $_SERVER['DOCUMENT_ROOT'].'/autoload/public_autoload.php';?>

<!DOCTYPE html>
<html lang="PT-BR">
<head>
    <meta charset="UTF-8">
    <meta name="robots" content="noindex">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="<?php echo SITE_DESCRICAO;?>">
    <meta name="keywords" content="<?php echo SITE_KEYWORDS;?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo BASE_PLUGINS;?>sweetalert/sweetalert.css?<?php echo SITE_CACHE;?>">
    <link rel="stylesheet" href="<?php echo BASE_PLUGINS;?>fontawesome/css/all.css?<?php echo SITE_CACHE;?>">
    <link rel="stylesheet" href="<?php echo BASE_PLUGINS;?>splide/splide.min.css?<?php echo SITE_CACHE;?>">
    <link rel="stylesheet" href="<?php echo BASE_CSS_PUBLIC;?>bootstrap.css?<?php echo SITE_CACHE;?>"> 
    <link rel="stylesheet" href="<?php echo BASE_CSS_PUBLIC;?>public.css?<?php echo SITE_CACHE;?>"> 
    <link rel="stylesheet" href="<?php echo BASE_CSS_PUBLIC;?>colors.css?<?php echo SITE_CACHE;?>"> 
    <link rel="stylesheet" href="<?php echo BASE_CSS_PUBLIC;?>responsive.css?<?php echo SITE_CACHE;?>"> 
    <link rel="icon" href="<?php echo BASE_IMAGES_SYSTEM_URL.SITE_FAVICON;?>">
    <title><?php echo SITE_NOME ;?> 404</title>    
    <style>
        .quatro-zero-quatro{
            display: flex;
            flex-direction: column;
            min-height: 95vh;
        }
        .quatro-zero-quatro-box{
            display: flex;
            justify-content: center;
            align-items: center;
            flex-grow: 1;
            flex-direction: column;
        }
        i{
            color: #fff;
        }
        h1{
            font-size: 60px;
        }
        h4{
            text-align: center;
        }
        a, a:hover,a:visited {
            color: #fff;
        }
    </style>
</head>
<body data-theme="theme-1"> 



<div class="container">
    <div class="quatro-zero-quatro">
      <div class="quatro-zero-quatro-box">
            <h1>404</h1>
            <h4>A página que você procura não existe.</h4>
            <h4><a href="<?php echo BASE_PUBLIC;?>"><i class="fas fa-home me-2"></i>Página inicial</a></h4>
      </div>
    </div>
</div>


<script src="<?php echo BASE_JS_PUBLIC;?>jquery.js?<?php echo SITE_CACHE;?>"></script>   
<script src="<?php echo BASE_JS_PUBLIC;?>bootstrap.bundle.js?<?php echo SITE_CACHE;?>"></script>
<script src="<?php echo BASE_JS_PUBLIC;?>public.js?<?php echo SITE_CACHE;?>"></script>  

</body>
</html>



