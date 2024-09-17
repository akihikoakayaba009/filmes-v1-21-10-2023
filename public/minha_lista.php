<?php 
require_once $_SERVER['DOCUMENT_ROOT'].'/autoload/public_autoload.php';

if(!$user_logado){
    die(header("Location:".BASE_USER.'login'));
}

$res =  listar_minha_lista($perfil_id);




$page_title = "Minha Lista";

require_once $_SERVER['DOCUMENT_ROOT'].'/public/public_header.php';
?>

<div class="container pb-2 pt-2"> 
    <div class="listar-midia-page">
    <h4 class="title">Minha Lista</h4>     
    <?php if(count($res) > 0):?>
    <div class="lista-midia minha-lista"> 
            <?php foreach($res as $item):?>
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
    </div>
    <?php else:?>
        <div class="no-content">
            <i class="fas fa-film"></i>
            <p>Sua lista está vázia.</p>
        </div>
    <?php endif;?>    
    </div>
</div>

<?php require_once $_SERVER['DOCUMENT_ROOT'].'/public/public_footer.php';?>