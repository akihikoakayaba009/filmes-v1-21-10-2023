<?php 
require_once $_SERVER['DOCUMENT_ROOT'].'/autoload/public_autoload.php';
$page_title = "Categorias";
require_once $_SERVER['DOCUMENT_ROOT'].'/public/public_header.php';
?>

<div class="container">

    <?php if(contar_categorias_por_tipo("anime") > 0):?>
        <div class="categorias-container">
            <div class="d-flex justify-content-between align-items-center pb-2">
                <h4 class="mb-0">Categorias Animes</h4>   
            </div>   
            <div class="line"></div>  
            <div class="row g-3">
            <?php foreach(listar_categorias_v1("anime") as $ani):?>
                <div class="col-6 col-md-4 col-lg-3 col-xl-3 col-xxl-2">
                <a href="<?php echo BASE_PUBLIC.midia_tipo_plural($ani['categoria_para']).'/'.$ani['categoria_diretorio'].'/pagina/1';?>" class="">
                    <div class="card categorias-card" style="background-image: url('<?php echo !empty($ani['categoria_image']) ? BASE_IMAGES_CATEGORIAS_URL.$ani['categoria_image'] : BASE_IMAGES_CATEGORIAS_URL.SITE_CATEGORIA_IMAGE;?>') !important;">
                            <h6><?php echo $ani['categoria_titulo'];?></h6>
                            <h6><?php echo contar_midia_por_categoria($ani['categoria_id']);?></h6>
                        
                    </div>
                </a>
                </div>
            <?php endforeach;?>
            </div>	
        </div>
    <?php endif;?>

    <?php if(contar_categorias_por_tipo("canal") > 0):?>
        <div class="categorias-container">
            <div class="d-flex justify-content-between align-items-center pb-2">
                <h4 class="mb-0">Categorias Canais</h4>   
            </div>   
            <div class="line"></div>
            <div class="row g-3">
            <?php foreach(listar_categorias_v1("canal") as $can):?>
                <div class="col-6 col-md-4 col-lg-3 col-xl-3 col-xxl-2">
                <a href="<?php echo BASE_PUBLIC.midia_tipo_plural($can['categoria_para']).'/'.$can['categoria_diretorio'].'/pagina/1';?>" class="">
                    <div class="card categorias-card" style="background-image: url('<?php echo !empty($can['categoria_image']) ? BASE_IMAGES_CATEGORIAS_URL.$can['categoria_image'] : BASE_IMAGES_CATEGORIAS_URL.SITE_CATEGORIA_IMAGE;?>') !important;">
                            <h6><?php echo $can['categoria_titulo'];?></h6>
                            <h6><?php echo contar_midia_por_categoria($can['categoria_id']);?></h6>
                        
                    </div>
                </a>
                </div>
            <?php endforeach;?>
            </div>	
        </div>
    <?php endif;?>
 
    <?php if(contar_categorias_por_tipo("filme") > 0):?>
        <div class="categorias-container">
            <div class="d-flex justify-content-between align-items-center pb-2">
                <h4 class="mb-0">Categorias Filmes</h4>   
            </div>   
            <div class="line"></div>
            <div class="row g-3">
            <?php foreach(listar_categorias_v1("filme") as $fil):?>
                <div class="col-6 col-md-4 col-lg-3 col-xl-3 col-xxl-2">
                <a href="<?php echo BASE_PUBLIC.midia_tipo_plural($fil['categoria_para']).'/'.$fil['categoria_diretorio'].'/pagina/1';?>" class="">
                    <div class="card categorias-card" style="background-image: url('<?php echo !empty($fil['categoria_image']) ? BASE_IMAGES_CATEGORIAS_URL.$fil['categoria_image'] : BASE_IMAGES_CATEGORIAS_URL.SITE_CATEGORIA_IMAGE;?>') !important;">
                            <h6><?php echo $fil['categoria_titulo'];?></h6>
                            <h6><?php echo contar_midia_por_categoria($fil['categoria_id']);?></h6>
                        
                    </div>
                </a>
                </div>
            <?php endforeach;?>
            </div>	
        </div>
    <?php endif;?>

    <?php if(contar_categorias_por_tipo("infantil") > 0):?>
        <div class="categorias-container">
            <div class="d-flex justify-content-between align-items-center pb-2">
                <h4 class="mb-0">Categorias Infantis</h4>   
            </div>   
            <div class="line"></div>
            <div class="row g-3">
            <?php foreach(listar_categorias_v1("infantil") as $inf):?>
                <div class="col-6 col-md-4 col-lg-3 col-xl-3 col-xxl-2">
                <a href="<?php echo BASE_PUBLIC.midia_tipo_plural($inf['categoria_para']).'/'.$inf['categoria_diretorio'].'/pagina/1';?>" class="">
                    <div class="card categorias-card" style="background-image: url('<?php echo !empty($inf['categoria_image']) ? BASE_IMAGES_CATEGORIAS_URL.$inf['categoria_image'] : BASE_IMAGES_CATEGORIAS_URL.SITE_CATEGORIA_IMAGE;?>') !important;">
                            <h6><?php echo $inf['categoria_titulo'];?></h6>
                            <h6><?php echo contar_midia_por_categoria($inf['categoria_id']);?></h6>
                        
                    </div>
                </a>
                </div>
            <?php endforeach;?> 
            </div>	
        </div>
    <?php endif;?>

    <?php if(contar_categorias_por_tipo("novela") > 0):?>
        <div class="categorias-container">
            <div class="d-flex justify-content-between align-items-center pb-2">
                <h4 class="mb-0">Categorias Novelas</h4>   
            </div>   
            <div class="line"></div>
            <div class="row g-3">
            <?php foreach(listar_categorias_v1("novela") as $nov):?>
                <div class="col-6 col-md-4 col-lg-3 col-xl-3 col-xxl-2">
                <a href="<?php echo BASE_PUBLIC.midia_tipo_plural($nov['categoria_para']).'/'.$nov['categoria_diretorio'].'/pagina/1';?>" class="">
                    <div class="card categorias-card" style="background-image: url('<?php echo !empty($nov['categoria_image']) ? BASE_IMAGES_CATEGORIAS_URL.$nov['categoria_image'] : BASE_IMAGES_CATEGORIAS_URL.SITE_CATEGORIA_IMAGE;?>') !important;">
                            <h6><?php echo $nov['categoria_titulo'];?></h6>
                            <h6><?php echo contar_midia_por_categoria($nov['categoria_id']);?></h6>
                        
                    </div>
                </a>
                </div>
            <?php endforeach;?>
            </div>	
        </div>
    <?php endif;?>

    <?php if(contar_categorias_por_tipo("serie") > 0):?>
        <div class="categorias-container">
            <div class="d-flex justify-content-between align-items-center pb-2">
                <h4 class="mb-0">Categorias Séries</h4>   
            </div>   
            <div class="line"></div>
            <div class="row g-3">
            <?php foreach(listar_categorias_v1("serie") as $ser):?>
                <div class="col-6 col-md-4 col-lg-3 col-xl-3 col-xxl-2">
                <a href="<?php echo BASE_PUBLIC.midia_tipo_plural($ser['categoria_para']).'/'.$ser['categoria_diretorio'].'/pagina/1';?>" class="">
                    <div class="card categorias-card" style="background-image: url('<?php echo !empty($ser['categoria_image']) ? BASE_IMAGES_CATEGORIAS_URL.$ser['categoria_image'] : BASE_IMAGES_CATEGORIAS_URL.SITE_CATEGORIA_IMAGE;?>') !important;">
                            <h6><?php echo $ser['categoria_titulo'];?></h6>
                            <h6><?php echo contar_midia_por_categoria($ser['categoria_id']);?></h6>
                        
                    </div>
                </a>
                </div>
            <?php endforeach;?>
            </div>	
        </div>
    <?php endif;?>
    

    

</div>


<?php require_once $_SERVER['DOCUMENT_ROOT'].'/public/public_footer.php';?>
