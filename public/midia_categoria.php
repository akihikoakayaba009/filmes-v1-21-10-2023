<?php 
require_once $_SERVER['DOCUMENT_ROOT'].'/autoload/public_autoload.php';

if(!isset($_GET['midia_tipo']) OR empty(midia_tipo_plural_convert($_GET['midia_tipo'])) OR 
   !isset($_GET['categoria_diretorio']) OR empty($_GET['categoria_diretorio']) OR   
   !isset($_GET['pagina']) OR !intval($_GET['pagina'])){
    die(header("Location:".BASE_PUBLIC));
}

$midia_tipo           = midia_tipo_plural_convert($_GET['midia_tipo']);
$categoria_diretorio  = $_GET['categoria_diretorio'];
$pagina               = $_GET['pagina'];
 

if(empty(get_categoria_por_diretorio($categoria_diretorio, $midia_tipo))){
    die(header("Location:".BASE_PUBLIC));
}
 
$res             = get_categoria_por_diretorio($categoria_diretorio, $midia_tipo);    
$categoria_id    = $res['categoria_id'];
$midias          = listar_midia_por_categoria($midia_tipo, $pagina, $categoria_id);

$pagina_anterior = null;
$pagina_proxima  = null;
if(!empty(listar_midia_por_categoria_paginacao($midia_tipo, $pagina, $categoria_id,$categoria_diretorio))){
    
    $pagina_anterior = listar_midia_por_categoria_paginacao($midia_tipo, $pagina, $categoria_id,$categoria_diretorio)['pagina_anterior'];
    $pagina_proxima  = listar_midia_por_categoria_paginacao($midia_tipo, $pagina, $categoria_id,$categoria_diretorio)['pagina_proxima'];
    
    $link_anterior   = BASE_PUBLIC.$_GET['midia_tipo'].'/'.$categoria_diretorio.'/pagina/'.$pagina_anterior;
    $link_proxima    = BASE_PUBLIC.$_GET['midia_tipo'].'/'.$categoria_diretorio.'/pagina/'.$pagina_proxima;
}


$page_title      = midia_tipo_plural_title($midia_tipo) . ' ' . $res['categoria_titulo'];

require_once $_SERVER['DOCUMENT_ROOT'].'/public/public_header.php';
?> 


<?php if(count(listar_categorias_v1($midia_tipo))):?>
<div class="container pb-2 pt-2">
  <div class="lista-splide-categorias">
    <div class="splide splide-categorias">
    <div class="d-flex justify-content-between align-items-center top-info">
      <h4>Categorias</h4>
      <div class="splide__arrows">
        <button class="btn btn-sm splide__arrow--prev prev"><i class="fas fa-arrow-left"></i></button>
        <button class="btn btn-sm splide__arrow--next next"><i class="fas fa-arrow-right"></i></button>
      </div>
    </div>
    <div class="splide__track">
      <ul class="splide__list">
      <?php foreach(listar_categorias_v1($midia_tipo) as $cats):?>
        <a href="<?php echo BASE_PUBLIC.$_GET['midia_tipo'].'/'.$cats['categoria_diretorio'].'/pagina/1';?>" class="splide__slide">
          <i class="fas fa-film"></i><?php echo $cats['categoria_titulo'];?>
        </a>
      <?php endforeach;?>
      </ul>
    </div>
    </div>
  </div>
</div>
<?php endif;?>

<div class="container pb-2"> 
<div class="listar-midia-page">

<div class="row">    
    <div class="col-12 col-lg-9 col-md-12 col-sm-12">
        <?php if(count($midias) > 0):?>
        <h4 class="title"><?php echo $page_title;?></h4>
        <div class="lista-midia">
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
                    <?php if(!empty($item['midia_avaliacao'])):?>
                        <div class="top-left badge">
                            <i class="far fa-thumbs-up"></i><?php echo $item['midia_avaliacao'];?> 
                        </div>
                    <?php endif;?>
                    <div class="center">
                        <div class="title"><?php echo $item['midia_titulo'];?></div>
                    </div>
                </a>
            <?php endforeach;?>  
        </div>
        <!-- END LISTA-MIDIA --> 
        <div class="paginacao">
          <?php if(!empty($pagina_anterior)):?>
              <a href="<?php echo $link_anterior;?>" class="btn">Página Anterior</a>
          <?php endif;?>
          <?php if(!empty($pagina_proxima)):?>
            <a href="<?php echo $link_proxima;?>" class="btn">Próxima Página</a>
          <?php endif;?>  
        </div>
        <?php else:?>
            <div class="no-content">
                <i class="fas fa-film"></i>
                <p>Sem <?php echo midia_tipo_plural_title($midia_tipo);?> nesta categoria.</p>
            </div>
        <?php endif;?>    
    </div>
    <!-- END COL --> 
    <!-- CATEGORIAS -->
    <?php if(count(listar_categorias_v1($midia_tipo))):?>
    <div class="col-lg-3 ms-auto col-categorias">
        <h4 class="title">Categorias</h4>
        <ul class="list-group">
            <?php foreach(listar_categorias_v1($midia_tipo) as $cat):?>
            <a href="<?php echo BASE_PUBLIC.$_GET['midia_tipo'].'/'.$cat['categoria_diretorio'].'/pagina/1';?>" 
                class="list-group-item <?php echo $categoria_diretorio == $cat['categoria_diretorio'] ? 'active' : '';?>">
                <?php echo $cat['categoria_titulo'];?>
            </a>
            <?php endforeach;?>  
        </ul>  
    </div>
    <?php endif;?>
    <!-- CATEGORIAS -->
                
</div> 
<!-- END ROW --> 

<?php require_once $_SERVER['DOCUMENT_ROOT'].'/public/public_footer.php';?>



