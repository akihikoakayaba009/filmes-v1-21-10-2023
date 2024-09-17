<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/controller/admin/admin_controller.php';
$page_title = "Adicionar Imagem Carousel";

require_once $_SERVER['DOCUMENT_ROOT'] . '/admin/header.php';
?>


<div class="card shadow card-header-title"> 
    <h1>Carousel <?php echo strtoupper($_GET['carousel_para']);?></h1>
    <small>Adicionar Imagem. Certifique-se de enviar as imagens com tamanhos iguais.</small> 
</div>  


<div class="d-flex justify-content-start align-items-start mb-3">
  <a class="btn btn-sm btn-two" href="<?php echo BASE_ADMIN.'carousel/'.$_GET['carousel_para'];?>"><i class="fas fa-arrow-left me-2"></i>Voltar para o carousel</a>  
</div>

<div class="card card-form shadow carousel-adicionar-editar"> 
  <div class="card-body"> 

    <form id="form-adicionar-item-carousel" autocomplete="off" enctype="multipart/form-data">
        <div class="form-group">
          <label class="form-label">Url Imagem</label>
          <input type="text" name="carousel_item_url" class="form-control">
        </div>
        <div class="form-group">
          <label class="form-label">Upload Imagem</label>
          <input type="file" name="carousel_item_upload" class="form-control">
        </div>
        <div class="form-group">
          <label class="form-label">Url Destino</label>
          <input type="text" name="carousel_item_destino" class="form-control">
        </div>
        <div class="form-group">
          <input type="hidden" name="acao" value="adicionar-item-carousel">
          <input type="hidden" name="carousel_para" value="<?php echo $_GET['carousel_para'];?>">
          <button class="btn btn-four" type="submit"><i class="fas fa-sign-in me-2"></i>Adicionar</button>
        </div>
    </form>
  </div>
</div>


<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/admin/footer.php'; ?>

<script>
    $("#form-adicionar-item-carousel").on("submit", function(e) {
      e.preventDefault();
      admin_submit_form(this, "carousel.php");
    });
</script>