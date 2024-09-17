<?php 
require_once $_SERVER['DOCUMENT_ROOT'].'/autoload/public_autoload.php';

if(!isset($_GET['midia_tipo']) OR empty($_GET['midia_tipo']) OR 
   !isset($_GET['midia_diretorio']) OR empty($_GET['midia_diretorio']) OR 
   !midia_tipo($_GET['midia_tipo']) OR empty(get_midia_por_diretorio($_GET['midia_tipo'], $_GET['midia_diretorio']))){
    die(header("Location:".BASE_PUBLIC));
}

$res          = get_midia_por_diretorio($_GET['midia_tipo'], $_GET['midia_diretorio']);
$mais_vistos  = get_midia_mais_vistas_por_tipo($res['midia_tipo']);
$recomendados = get_midias_recomendados($res['midia_id'], $res['midia_categoria'], $res['midia_tipo']);
$page_title   = $res['midia_titulo'];
require_once $_SERVER['DOCUMENT_ROOT'].'/public/public_header.php';
?>

<style>
  .midia-intro{
    padding-bottom: 20px;
  }
  .midia-intro .midia-background{
    background: url('<?php echo !empty($res['midia_background']) ? exibir_image_upload_or_url(BASE_IMAGES_MIDIA_PATCH, BASE_IMAGES_MIDIA_URL, $res['midia_background']) : exibir_image_upload_or_url(BASE_IMAGES_MIDIA_PATCH, BASE_IMAGES_MIDIA_URL, SITE_MIDIA_BACKGROUND);?>') no-repeat center top fixed;
  } 
</style>

<div class="midia-intro" data-image="<?php echo exibir_image_upload_or_url(BASE_IMAGES_MIDIA_PATCH, BASE_IMAGES_MIDIA_URL, $res['midia_image']);?>" data-id="<?php echo $res['midia_id'];?>" data-background="<?php echo !empty($res['midia_background']) ? exibir_image_upload_or_url(BASE_IMAGES_MIDIA_PATCH, BASE_IMAGES_MIDIA_URL, $res['midia_background']) : exibir_image_upload_or_url(BASE_IMAGES_MIDIA_PATCH, BASE_IMAGES_MIDIA_URL, SITE_MIDIA_BACKGROUND);?>">
  <div class="container">
    <div class="midia-background">
      
          <!-- MIDIA IMAGE GROUP -->
          <div class="midia-image-group">
            <img src="<?php echo exibir_image_upload_or_url(BASE_IMAGES_MIDIA_PATCH, BASE_IMAGES_MIDIA_URL, $res['midia_image']);?>" class="img-fluid midia-image">
            <div class="btn-assistir">

                  <?php if($res['midia_tipo'] == 'infantil' OR $res['midia_tipo'] == 'filme' OR $res['midia_tipo'] == 'canal'):?>
                    <button class="btn load-players"><i class="fas fa-play me-2 "></i>Assistir</button>
                  <?php endif;?>

                  <?php if($res['midia_tipo'] == 'novela' OR $res['midia_tipo'] == 'serie' OR $res['midia_tipo'] == 'anime'):?>
                    <button class="btn load-temporadas"><i class="fas fa-play me-2 "></i>Assistir</button>
                  <?php endif;?>    
              </div>
          </div>
          <!-- MIDIA INFO -->
          <div class="midia-info">
              <div>
                  <div class="">
                    <h1 class="midia-title"><?php echo $res['midia_titulo'];?></h1>
                  </div>
                  <div class="sinopse"> 
                    <p>Sinopse</p>
                    <small><?php echo $res['midia_sinopse'];?></small>
                  </div>
                  <div class="row badge-group pt-1 pb-2 g-2">
                        <?php if($user_logado):?>
                            <div class="col"> 
                              <span class="badge badge-midia minha-lista-btn cursor-pointer">
                                <?php echo verificar_minha_lista($res['midia_id'], $perfil_id) > 0 ? '<span class="icon-lista-change"><i class="fas fa-check"></i></span>Minha Lista' : '<span class="icon-lista-change"><i class="fas fa-plus"></i></span>Minha Lista';?>
                              </span>
                            </div>     
                        <?php endif;?>
                        <?php if(!empty($res['midia_ano'])):?>
                            <div class="col"><span class="badge badge-midia"><i class="fas fa-calendar"></i>Ano <?php echo $res['midia_ano'];?></span></div>
                        <?php endif;?>
                            <div class="col"><span class="badge badge-midia"><i class="fas fa-eye"></i><?php echo $res['midia_visualizacoes'];?></span></div>
                        <?php if(!empty($res['midia_avaliacao'])):?>
                            <div class="col"><span class="badge badge-midia"><i class="far fa-thumbs-up"></i><?php echo $res['midia_avaliacao'];?></span></div>
                        <?php endif;?>
                        <?php if(!empty($res['midia_trailer'])):?>
                            <div class="col"><button data-bs-toggle="modal" data-bs-target="#modal-trailer" data-trailer="<?php echo $res['midia_trailer'];?>"  type="button" class="badge badge-midia open-trailer"><i class="fas fa-play-circle"></i>Trailer</button></div>
                        <?php endif;?>
                  </div>
                  <div class="midia-cats">
                        <p>Categorias</p> 
                        <?php $aa = count(explode(",", $res['midia_categoria']));?>
                        <?php foreach(explode(",", $res['midia_categoria']) as $cats):?>
                          <?php 
                              $gc = get_categoria_por_id($res['midia_tipo'], $cats);
                          ?>
                          <?php if($aa-- > 1):?>
                            <a href="<?php echo BASE_PUBLIC.midia_tipo_plural($gc['categoria_para']).'/'.$gc['categoria_diretorio'].'/pagina/1';?>"><?php echo $gc['categoria_titulo'].', ';?></a>
                          <?php else:?>
                            <a href="<?php echo BASE_PUBLIC.midia_tipo_plural($gc['categoria_para']).'/'.$gc['categoria_diretorio'].'/pagina/1';?>"><?php echo $gc['categoria_titulo'];?></a>
                          <?php endif;?>  
                          
                        <?php endforeach;?> 
                  </div>
              </div>
          </div>
          <!-- MIDIA INFO -->
    </div>
    <!-- MIDIA BACKGROUND --> 
  </div>
  <!-- CONTAINER --> 
</div> 
<!-- MIDIA INTRO -->


<!-- RECOMENDADOS --> 
<?php if(count($recomendados) > 1 && !empty($recomendados)):?>

<div class="container pb-3">
  <div class="splide-lista">
    <div class="splide splide-lista-midia recomendados">
      <div class="d-flex justify-content-between align-items-center top-info">
        <h4>Recomendados</h4>
        <div class="splide__arrows">
          <button class="btn btn-sm splide__arrow--prev prev"><i class="fas fa-arrow-left"></i></button>
          <button class="btn btn-sm splide__arrow--next next"><i class="fas fa-arrow-right"></i></button>
        </div>
      </div>
      <div class="splide__track">
        <ul class="splide__list">
          <?php foreach($recomendados as $rec):?>
            <a href="<?php echo BASE_PUBLIC.$rec['midia_tipo'].'/'.$rec['midia_diretorio'];?>" class="splide__slide lista-midia">
              <img src="<?php echo exibir_image_upload_or_url(BASE_IMAGES_MIDIA_PATCH, BASE_IMAGES_MIDIA_URL, $rec['midia_image']);?>" class="img-fluid">
              <div class="bottom-right badge">
                  <?php if($user_premium):?>
                      <i class="far fa-play-circle"></i>Assistir
                  <?php else:?>
                      <?php if(contar_player_gratis($rec['midia_id']) > 0):?>
                          <i class="far fa-play-circle"></i>Assistir
                      <?php else:?>
                          <i class="far fa-lock"></i>Premium  
                      <?php endif;?>    
                  <?php endif;?>      
              </div>
              <?php if(!empty($rec['midia_avaliacao'])):?>
                  <div class="top-left badge">
                      <i class="far fa-thumbs-up"></i><?php echo $rec['midia_avaliacao'];?> 
                  </div>
              <?php endif;?>
              <div class="center">
                <div class="title"><?php echo $rec['midia_titulo'];?></div>
              </div>
            </a>
          <?php endforeach;?>	
        </ul>
      </div> 
    </div>
  </div>
</div> 

<?php endif;?>
<!-- RECOMENDADOS -->






<!-- Modal Temporadas -->
<div class="modal" id="modal-temporadas" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-fullscreen modal-dialog-scrollable">
    <div class="modal-content">
      <div class="container">
          <div class="modal-header fixed-top">
            <button class="btn btn-sm" data-bs-dismiss="modal"><i class="fas fa-arrow-left"></i></button>
          </div>
          
          <div class="modal-body">       
            <ul class="list-group modal-temporadas"></ul>
          </div>
      </div>
    </div>
  </div>
</div>
                                                    
<!-- Modal episodios -->
<div class="modal" id="modal-episodios" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-fullscreen modal-dialog-scrollable">
    <div class="modal-content">
      <div class="container">
          <div class="modal-header fixed-top">
            <button class="btn btn-sm" data-bs-dismiss="modal"><i class="fas fa-arrow-left"></i></button>
          </div>
          <div class="modal-body">
              <ul class="list-group modal-episodios"></ul>
          </div>
      </div>
    </div>
  </div>
</div>
 
<!-- Modal episodios -->
<div class="modal" id="modal-players" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-fullscreen modal-dialog-scrollable">
    <div class="modal-content">
    <div class="container">
        <div class="modal-header fixed-top">
          <button class="btn btn-sm" data-bs-dismiss="modal"><i class="fas fa-arrow-left"></i></button>
        </div>
        <div class="modal-body">
            <ul class="list-group modal-players"></ul>
        </div>
    </div>
    </div>
  </div>
</div>

<!-- Modal Assistir -->
<div class="modal" id="modal-assistir" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-fullscreen modal-dialog-scrollable">
    <div class="modal-content">
    <div class="container">
      <div class="modal-header fixed-top">
        <button class="btn btn-sm bg-gradient" data-bs-dismiss="modal"><i class="fas fa-arrow-left"></i></button>
      </div>
      <div class="modal-body modal-assistir">
          <div class="assistir-player"></div>
          <div class="midia-assistir-info">
              <h4 class="md-title"></h4> 
              <p class="ep-title"></p>
          </div>
          <form id="form-comentar"> 
            <textarea class="form-control" id="comentario-textarea" name="comentario" placeholder="Adicione um comentário..."></textarea>
            <input type="hidden" name="acao" value="comentar">
            <input type="hidden" name="midia_id" value="<?php echo $res['midia_id'];?>">
            <button type="submit" class="btn btn-sm bt-comentar"><i class="fas fa-comment me-2"></i>Comentar</button>
          </form>
          <div class="load-comentarios"></div>
      </div>
    </div>
    </div>
  </div> 
</div>
 

<!-- Modal Trailer -->
<div class="modal" id="modal-trailer" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-fullscreen ">
    <div class="modal-content">
      <div class="container">
        <div class="modal-header fixed-top">
          <button class="btn btn-sm" data-bs-dismiss="modal"><i class="fas fa-arrow-left"></i></button>
        </div>
        <div class="modal-body">
              <div class="ratio ratio-16x9 modal-trailer"></div>
              <h4>Trailer</h4>
              <p><?php echo $res['midia_titulo'];?></p>
        </div>
      </div>
    </div> 
  </div> 
</div>

<?php require_once $_SERVER['DOCUMENT_ROOT'].'/public/public_footer.php';?>
<script src="<?php echo BASE_JS_PUBLIC;?>assistir.js"></script> 