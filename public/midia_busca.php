<?php 
require_once $_SERVER['DOCUMENT_ROOT'].'/autoload/public_autoload.php';

if(!isset($_GET['midia_busca']) OR empty($_GET['midia_busca']) OR 
   !isset($_GET['pagina']) OR !intval($_GET['pagina'])){
    die(header("Location:".BASE_PUBLIC));
}

$midia_busca = strip_tags(addslashes($_GET['midia_busca']));
$pagina      = $_GET['pagina']; 

$pagina_anterior = null;
$pagina_proxima  = null;
if(!empty(listar_midia_por_busca_paginacao($midia_busca, $pagina))){
    $pagina_anterior = listar_midia_por_busca_paginacao($midia_busca, $pagina)['pagina_anterior'];
    $pagina_proxima  = listar_midia_por_busca_paginacao($midia_busca, $pagina)['pagina_proxima'];
    $link_anterior   = BASE_PUBLIC.'busca/midia/'.$midia_busca.'/pagina/'.$pagina_anterior;
    $link_proxima    = BASE_PUBLIC.'busca/midia/'.$midia_busca.'/pagina/'.$pagina_proxima;
}

$midias = listar_midia_por_busca($midia_busca, $pagina);

$page_title      = 'Resultados Busca';


require_once $_SERVER['DOCUMENT_ROOT'].'/public/public_header.php';
?>

<div class="container pb-2"> 
<div class="listar-midia-page">  

<div class="row">

<?php if(count($midias) > 0):?> 

    <div class="col-12 col-lg-9 col-md-12 col-sm-12">
        <h4 class="title"><?php echo $page_title;?></h4>               
        <div class="lista-midia lista-busca">
            <?php foreach($midias as $item):?>
                <a href="<?php echo BASE_PUBLIC.$item['midia_tipo'].'/'.$item['midia_diretorio'];?>">
                    <img src="<?php echo exibir_image_upload_or_url(BASE_IMAGES_MIDIA_PATCH, BASE_IMAGES_MIDIA_URL, $item['midia_image']);?>" class="img-fluid">
                    <div class="bottom-right badge">
                        <?php if($user_premium):?>
                            <i class="far fa-play-circle"></i>Assistir
                        <?php else:?>
                            <?php if(contar_player_gratis($item['midia_id']) > 0):?>
                                <i class="far fa-play-circle"></i>Assistir
                            <?php else:?>
                                <i class="far fa-lock"></i>Premium  
                            <?php endif;?>    
                        <?php endif;?>      
                    </div>
                    <div class="top-left badge">
                        <?php echo midia_tipo_single_title($item['midia_tipo']);?>
                    </div>
                    <div class="center">
                        <div class="title"><?php echo $item['midia_titulo'];?></div>
                    </div>
                </a>
            <?php endforeach;?>    
        </div>
    <div class="d-flex justify-content-center align-items-center paginacao">
        <?php if(!empty($pagina_anterior)):?>
            <a class="btn btn-anterior m-2" href="<?php echo $link_anterior;?>"><i class="fas fa-arrow-left me-2"></i>Página Anterior</a>
        <?php endif;?> 
        <?php if(!empty($pagina_proxima)):?>
            <a class="btn btn-proximo m-2" href="<?php echo $link_proxima;?>">Próxima Página<i class="fas fa-arrow-right ms-2"></i></a>
        <?php endif;?>   
    </div>
    <?php else:?>
            <div class="no-content">
                <i class="fas fa-film"></i>
                <p>Sem Resultados.</p>
            </div>
    <?php endif;?>   
    </div>
    <!-- END COL -->   
    <div class="col-lg-3 ms-auto col-categorias"></div> 
    
    
</div> 
<!-- END ROW --> 
    </div>
</div> 


<?php require_once $_SERVER['DOCUMENT_ROOT'].'/public/public_footer.php';?>