<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/controller/admin/admin_controller.php';
$page_title = "Editar Imagem Carousel";

if(!isset($_GET['carousel_para']) OR !verificar_carousel_para($_GET['carousel_para'])){
  die(header("Locacation:".BASE_ADMIN));
}

$res = get_carousel_item_por_id($_GET['carousel_id']);

if(empty($res)){
    die(header("Location:".BASE_ADMIN.'carousel/listar'));
}

require_once $_SERVER['DOCUMENT_ROOT'] . '/admin/header.php';
?>


<div class="card shadow card-header-title"> 
    <h1>Editar Carousel</h1>
    <small>Certifique-se de enviar as imagens com tamanhos iguais.</small> 
</div>  

<div class="d-flex justify-content-start align-items-start mb-3">
  <a class="btn btn-sm btn-two" href="<?php echo BASE_ADMIN.'carousel/'.$_GET['carousel_para'];?>"><i class="fas fa-arrow-left me-2"></i>Voltar para o carousel</a>  
</div>

<div class="card card-form shadow carousel-adicionar-editar">
    <div class="card-body">

    <div class="d-flex justify-content-center mb-2">
        <img src="<?php echo  exibir_image_upload_or_url(BASE_IMAGES_CAROUSEL_PATCH, BASE_IMAGES_CAROUSEL_URL, $res['carousel_item_url']);?>" class="image-carousel-adicionar-editar load-image-on-change">
    </div>
    
    <form id="form-editar-item-carousel" autocomplete="off" enctype="multipart/form-data">
        <!-- ITEM -->
        <div class="form-group">
          <label class="form-label">Url Imagem</label>
          <input type="text" name="carousel_item_url" class="form-control" 
                 value="<?php echo filter_var($res['carousel_item_url'], FILTER_VALIDATE_URL) ? $res['carousel_item_url'] : '';?>">
        </div> 
        <!-- ITEM --> 
        <div class="form-group">
          <label class="form-label-light">Upload Imagem</label>
          <input type="file" name="carousel_item_upload" class="form-control input-image-change">
        </div>
        <!-- ITEM -->
        <div class="form-group">
          <label class="form-label">Url Destino</label>
          <input type="text" name="carousel_item_url_destino" class="form-control" 
                 value="<?php echo $res['carousel_item_url_destino'];?>">
        </div>
        <!-- ITEM -->
        <div class="form-group">
          <label class="form-label">Posição</label>
          <input type="text" name="carousel_posicao" class="form-control quatro_digitos" 
                 value="<?php echo $res['carousel_posicao'];?>"> 
        </div>
        <!-- ITEM -->
        <div class="form-group">
          <input type="hidden" name="acao" value="editar-item-carousel">
          <input type="hidden" name="carousel_para" value="<?php echo $_GET['carousel_para'];?>">
          <input type="hidden" name="carousel_id" value="<?php echo $_GET['carousel_id'];?>">
          <button class="btn btn-four" type="submit"><i class="fas fa-sign-in me-2"></i>Editar</button>
        </div>
    </form>
  </div>
</div>


<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/admin/footer.php'; ?>

<script>
    $("#form-editar-item-carousel").on("submit", function(e) {
      e.preventDefault();
      admin_submit_form(this, "carousel.php");
    });
</script>