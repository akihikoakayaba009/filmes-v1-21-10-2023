<?php if(contar_carousel("home") > 0):?>

    <div class="container container-carousel-home">
		<div id="carouselExampleIndicators" class="carousel carousel-home slide" data-bs-ride="true">
            <div class="carousel-indicators">
                <?php for($c_carousel = 0; $c_carousel < contar_carousel("home"); $c_carousel++):?>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="<?php echo $c_carousel;?>" <?php echo $c_carousel == 0 ? 'class="active" aria-current="true"' : '';?>></button>
                <?php endfor;?>
			</div>
			<div class="carousel-inner">
            <?php foreach(listar_carousel("home") as $key => $carousel):?>
				<a href="<?php echo $carousel['carousel_item_url_destino'];?>" class="carousel-item <?php echo $key == 0 ? 'active' : '';?>" data-bs-interval="10000">
				    <img src="<?php echo exibir_image_upload_or_url(BASE_IMAGES_CAROUSEL_PATCH, BASE_IMAGES_CAROUSEL_URL, $carousel['carousel_item_url']);?>" class="d-block w-100" alt="...">
				</a>
            <?php endforeach;?>
			</div>
			<button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
				<span class="carousel-control-prev-icon" aria-hidden="true"></span>
				<span class="visually-hidden">Previous</span>
			</button>
			<button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
				<span class="carousel-control-next-icon" aria-hidden="true"></span>
				<span class="visually-hidden">Next</span>
			</button>
		</div>
	</div>

<?php endif;?>  

 
<div class="container">
    <div class="lista-splide-midia-tipo">
        <div class="splide splide-midia-tipo">
        <div class="splide__track">
            <ul class="splide__list">
            
            <a href="<?php echo BASE_PUBLIC;?>animes/pagina/1" class="splide__slide">
                <i class="fas fa-film"></i>ANIMES
            </a>
            <a href="<?php echo BASE_PUBLIC;?>canais/pagina/1" class="splide__slide">
                <i class="fas fa-film"></i>CANAIS
            </a>
            <a href="<?php echo BASE_PUBLIC;?>filmes/pagina/1" class="splide__slide">
                <i class="fas fa-film"></i>FILMES
            </a>
            <a href="<?php echo BASE_PUBLIC;?>infantis/pagina/1" class="splide__slide">
                <i class="fas fa-film"></i>INFANTIS
            </a>
            <a href="<?php echo BASE_PUBLIC;?>novelas/pagina/1" class="splide__slide">
                <i class="fas fa-film"></i>NOVELAS
            </a>
            <a href="<?php echo BASE_PUBLIC;?>series/pagina/1" class="splide__slide">
                <i class="fas fa-film"></i>SÉRIES
            </a>
            </ul>
        </div>
        </div>
    </div>
</div>





