<?php if(count(get_novas_midias("filme")) > 0):?>

<div class="container pb-3">
<div class="splide-lista">
    <div class="splide splide-lista-midia splide_novas_midias_home">
    <div class="d-flex justify-content-between align-items-center top-info">
        <h4>Novos Filmes</h4>
        <div class="splide__arrows">
        <button class="btn btn-sm splide__arrow--prev prev"><i class="fas fa-arrow-left"></i></button>
        <button class="btn btn-sm splide__arrow--next next"><i class="fas fa-arrow-right"></i></button>
        </div>
    </div>
    <div class="splide__track">
        <ul class="splide__list">
        <?php foreach(get_novas_midias("filme") as $a):?>
            <a href="<?php echo BASE_PUBLIC.$a['midia_tipo'].'/'.$a['midia_diretorio'];?>" class="splide__slide lista-midia">
            <img src="<?php echo exibir_image_upload_or_url(BASE_IMAGES_MIDIA_PATCH, BASE_IMAGES_MIDIA_URL, $a['midia_image']);?>" class="img-fluid">
            <div class="bottom-right badge">
                <?php if($user_premium):?>
                    <i class="far fa-play-circle"></i>Assistir
                <?php else:?>
                    <?php if(contar_player_gratis($a['midia_id']) > 0):?>
                        <i class="far fa-play-circle"></i>Assistir
                    <?php else:?>
                        <i class="far fa-lock"></i>Premium  
                    <?php endif;?>    
                <?php endif;?>      
            </div>
            <?php if(!empty($a['midia_avaliacao'])):?>
                <div class="top-left badge">
                    <i class="far fa-thumbs-up"></i><?php echo $a['midia_avaliacao'];?> 
                </div>
            <?php endif;?>
            <div class="center">
                <div class="title"><?php echo $a['midia_titulo'];?></div>
            </div>
            </a>
        <?php endforeach;?>	
        </ul>
    </div> 
    </div>
</div>
</div> 

<?php endif;?> 

<?php if(count(get_novas_midias("serie")) > 0):?>

<div class="container pb-3">
<div class="splide-lista">
    <div class="splide splide-lista-midia splide_novas_midias_home">
    <div class="d-flex justify-content-between align-items-center top-info">
        <h4>Novas Séries</h4>
        <div class="splide__arrows">
        <button class="btn btn-sm splide__arrow--prev prev"><i class="fas fa-arrow-left"></i></button>
        <button class="btn btn-sm splide__arrow--next next"><i class="fas fa-arrow-right"></i></button>
        </div>
    </div>
    <div class="splide__track">
        <ul class="splide__list">
        <?php foreach(get_novas_midias("serie") as $b):?>
            <a href="<?php echo BASE_PUBLIC.$b['midia_tipo'].'/'.$b['midia_diretorio'];?>" class="splide__slide lista-midia">
            <img src="<?php echo exibir_image_upload_or_url(BASE_IMAGES_MIDIA_PATCH, BASE_IMAGES_MIDIA_URL, $b['midia_image']);?>" class="img-fluid">
            <div class="bottom-right badge">
                <?php if($user_premium):?>
                    <i class="far fa-play-circle"></i>Assistir
                <?php else:?>
                    <?php if(contar_player_gratis($b['midia_id']) > 0):?>
                        <i class="far fa-play-circle"></i>Assistir
                    <?php else:?>
                        <i class="far fa-lock"></i>Premium  
                    <?php endif;?>    
                <?php endif;?>      
            </div>
            <?php if(!empty($b['midia_avaliacao'])):?>
                <div class="top-left badge">
                    <i class="far fa-thumbs-up"></i><?php echo $b['midia_avaliacao'];?> 
                </div>
            <?php endif;?>
            <div class="center">
                <div class="title"><?php echo $b['midia_titulo'];?></div>
            </div>
            </a>
        <?php endforeach;?>	
        </ul>
    </div> 
    </div>
</div>
</div> 

<?php endif;?>     





<?php if(count(get_novas_midias("canal")) > 0):?>

<div class="container pb-3">
<div class="splide-lista">
    <div class="splide splide-lista-midia splide_novas_midias_home">
    <div class="d-flex justify-content-between align-items-center top-info">
        <h4>Novos Canais</h4>
        <div class="splide__arrows">
        <button class="btn btn-sm splide__arrow--prev prev"><i class="fas fa-arrow-left"></i></button>
        <button class="btn btn-sm splide__arrow--next next"><i class="fas fa-arrow-right"></i></button>
        </div>
    </div>
    <div class="splide__track">
        <ul class="splide__list">
        <?php foreach(get_novas_midias("canal") as $c):?>
            <a href="<?php echo BASE_PUBLIC.$c['midia_tipo'].'/'.$c['midia_diretorio'];?>" class="splide__slide lista-midia">
            <img src="<?php echo exibir_image_upload_or_url(BASE_IMAGES_MIDIA_PATCH, BASE_IMAGES_MIDIA_URL, $c['midia_image']);?>" class="img-fluid">
            <div class="bottom-right badge">
                <?php if($user_premium):?>
                    <i class="far fa-play-circle"></i>Assistir
                <?php else:?>
                    <?php if(contar_player_gratis($c['midia_id']) > 0):?>
                        <i class="far fa-play-circle"></i>Assistir
                    <?php else:?>
                        <i class="far fa-lock"></i>Premium  
                    <?php endif;?>    
                <?php endif;?>      
            </div>
            <?php if(!empty($c['midia_avaliacao'])):?>
                <div class="top-left badge">
                    <i class="far fa-thumbs-up"></i><?php echo $c['midia_avaliacao'];?> 
                </div>
            <?php endif;?>
            <div class="center">
                <div class="title"><?php echo $c['midia_titulo'];?></div>
            </div>
            </a>
        <?php endforeach;?>	
        </ul>
    </div> 
    </div>
</div>
</div> 

<?php endif;?>     


<?php if(count(get_novas_midias("anime")) > 0):?>


<div class="container pb-3">
<div class="splide-lista">
    <div class="splide splide-lista-midia splide_novas_midias_home">
    <div class="d-flex justify-content-between align-items-center top-info">
        <h4>Novos Animes</h4>
        <div class="splide__arrows">
        <button class="btn btn-sm splide__arrow--prev prev"><i class="fas fa-arrow-left"></i></button>
        <button class="btn btn-sm splide__arrow--next next"><i class="fas fa-arrow-right"></i></button>
        </div>
    </div>
    <div class="splide__track">
        <ul class="splide__list">
        <?php foreach(get_novas_midias("anime") as $d):?>
            <a href="<?php echo BASE_PUBLIC.$d['midia_tipo'].'/'.$c['midia_diretorio'];?>" class="splide__slide lista-midia">
            <img src="<?php echo exibir_image_upload_or_url(BASE_IMAGES_MIDIA_PATCH, BASE_IMAGES_MIDIA_URL, $d['midia_image']);?>" class="img-fluid">
            <div class="bottom-right badge">
                <?php if($user_premium):?>
                    <i class="far fa-play-circle"></i>Assistir
                <?php else:?>
                    <?php if(contar_player_gratis($d['midia_id']) > 0):?>
                        <i class="far fa-play-circle"></i>Assistir
                    <?php else:?>
                        <i class="far fa-lock"></i>Premium  
                    <?php endif;?>    
                <?php endif;?>      
            </div>
            <?php if(!empty($d['midia_avaliacao'])):?>
                <div class="top-left badge">
                    <i class="far fa-thumbs-up"></i><?php echo $d['midia_avaliacao'];?> 
                </div>
            <?php endif;?>
            <div class="center">
                <div class="title"><?php echo $d['midia_titulo'];?></div>
            </div>
            </a>
        <?php endforeach;?>	
        </ul>
    </div> 
    </div>
</div>
</div> 

<?php endif;?>     




<?php if(count(get_novas_midias("novela")) > 0):?>


<div class="container pb-3">
<div class="splide-lista">
    <div class="splide splide-lista-midia splide_novas_midias_home">
    <div class="d-flex justify-content-between align-items-center top-info">
        <h4>Novas Novelas</h4>
        <div class="splide__arrows">
        <button class="btn btn-sm splide__arrow--prev prev"><i class="fas fa-arrow-left"></i></button>
        <button class="btn btn-sm splide__arrow--next next"><i class="fas fa-arrow-right"></i></button>
        </div>
    </div>
    <div class="splide__track">
        <ul class="splide__list">
        <?php foreach(get_novas_midias("novela") as $f):?>
            <a href="<?php echo BASE_PUBLIC.$f['midia_tipo'].'/'.$f['midia_diretorio'];?>" class="splide__slide lista-midia">
            <img src="<?php echo exibir_image_upload_or_url(BASE_IMAGES_MIDIA_PATCH, BASE_IMAGES_MIDIA_URL, $f['midia_image']);?>" class="img-fluid">
            <div class="bottom-right badge">
                <?php if($user_premium):?>
                    <i class="far fa-play-circle"></i>Assistir
                <?php else:?>
                    <?php if(contar_player_gratis($f['midia_id']) > 0):?>
                        <i class="far fa-play-circle"></i>Assistir
                    <?php else:?>
                        <i class="far fa-lock"></i>Premium  
                    <?php endif;?>    
                <?php endif;?>      
            </div>
            <?php if(!empty($f['midia_avaliacao'])):?>
                <div class="top-left badge">
                    <i class="far fa-thumbs-up"></i><?php echo $f['midia_avaliacao'];?> 
                </div>
            <?php endif;?>
            <div class="center">
                <div class="title"><?php echo $f['midia_titulo'];?></div>
            </div>
            </a>
        <?php endforeach;?>	
        </ul>
    </div> 
    </div>
</div>
</div> 


<?php endif;?>      


<?php if(count(get_novas_midias("infantil")) > 0):?>


<div class="container pb-3">
<div class="splide-lista">
    <div class="splide splide-lista-midia splide_novas_midias_home">
    <div class="d-flex justify-content-between align-items-center top-info">
        <h4>Novos Infantis</h4>
        <div class="splide__arrows">
        <button class="btn btn-sm splide__arrow--prev prev"><i class="fas fa-arrow-left"></i></button>
        <button class="btn btn-sm splide__arrow--next next"><i class="fas fa-arrow-right"></i></button>
        </div>
    </div>
    <div class="splide__track">
        <ul class="splide__list">
        <?php foreach(get_novas_midias("infantil") as $e):?>
            <a href="<?php echo BASE_PUBLIC.$e['midia_tipo'].'/'.$e['midia_diretorio'];?>" class="splide__slide lista-midia">
            <img src="<?php echo exibir_image_upload_or_url(BASE_IMAGES_MIDIA_PATCH, BASE_IMAGES_MIDIA_URL, $e['midia_image']);?>" class="img-fluid">
            <div class="bottom-right badge">
                <?php if($user_premium):?>
                    <i class="far fa-play-circle"></i>Assistir
                <?php else:?>
                    <?php if(contar_player_gratis($e['midia_id']) > 0):?>
                        <i class="far fa-play-circle"></i>Assistir
                    <?php else:?>
                        <i class="far fa-lock"></i>Premium  
                    <?php endif;?>    
                <?php endif;?>      
            </div>
            <?php if(!empty($e['midia_avaliacao'])):?>
                <div class="top-left badge">
                    <i class="far fa-thumbs-up"></i><?php echo $e['midia_avaliacao'];?> 
                </div>
            <?php endif;?>
            <div class="center">
                <div class="title"><?php echo $e['midia_titulo'];?></div>
            </div>
            </a>
        <?php endforeach;?>	
        </ul>
    </div> 
    </div>
</div>
</div> 

<?php endif;?>     
