<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/controller/admin/admin_controller.php';

if(!isset($_GET['carousel_para']) OR !verificar_carousel_para($_GET['carousel_para'])){
    die(header("Locacation:".BASE_ADMIN));
}

$page_title = "Carousel ". ucwords($_GET['carousel_para']);

require_once $_SERVER['DOCUMENT_ROOT'] . '/admin/header.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/admin/header.php';
?>

<div class="card shadow card-header-title"> 
    <h1>Carousel</h1>
    <small>As images deste carousel são exibidas na: <?php echo strtoupper($_GET['carousel_para']);?></small> 
</div>  


<div class="d-flex justify-content-end align-items-end mb-3">
  <a class="btn btn-sm btn-two" href="<?php echo BASE_ADMIN.'carousel/'.$_GET['carousel_para'].'/adicionar';?>"><i class="fas fa-sign-in me-2"></i>Adicionar Imagem</a>  
</div>


<div class="card card-form shadow">
  <div class="card-body">

        <div class="table-responsive"> 
        <table class="w-100 table border" id="dataTable">
          <div class="table-responsive">
          <thead>
            <tr>
              <th>Imagem</th> 
              <th>Url Destino</th>
              <th>Posição</th>
              <th>Editar</th>
              <th>Excluir</th>
            </tr> 
          </thead> 
          <tbody> 
              <?php foreach(get_carousel_para("home") as $key => $item):?>
                <tr>

                  <td><img class="image-table-carousel" src="<?php echo  exibir_image_upload_or_url(BASE_IMAGES_CAROUSEL_PATCH, BASE_IMAGES_CAROUSEL_URL, $item['carousel_item_url']);?>"></td>
                  <td><?php echo substr($item['carousel_item_url_destino'], 0,30).'...';?></td> 
                  <td><?php echo $item['carousel_posicao'];?></td>
                  <td><a class="btn btn-sm btn-three" title="Editar Item" 
                        href="<?php echo BASE_ADMIN.'carousel/'.$_GET['carousel_para'].'/editar/'.$item['carousel_id'];?>">
                          <i class="fa fa-pencil me-2"></i>Editar
                    </a>
                  </td>
                  <td><button data-id="<?php echo $item['carousel_id'];?>"
                              class="btn btn-sm btn-four btn-excluir"  
                              data-bs-toggle="modal" 
                              data-bs-target="#modal-excluir" 
                              title="Excluir"><i class="fa fa-trash me-2"></i>Excluir
                      </button>
                  </td>
                </tr>
              <?php endforeach;?>
          </tbody>
        </table>
      </div>

  </div>
</div>





<!-- EXCLUIR START -->
<div class="modal fade" id="modal-excluir" tabindex="-1" data-bs-backdrop="static">
  <div class="modal-dialog modal-fullscreen-md-down">
    <div class="modal-content">
      <div class="modal-header">
        <h6 class="modal-title" id="fullscreenModalLabel">Excluir Item Carousel</h6>
        <button class="btn btn-close p-1 ms-auto" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="form-excluir" autocomplete="off">
          <div class="modal-body text-center">
                <h6>Tem Certeza que deseja excluir a imagem do carousel ? </h6>
                <p class="text-excluir"></p>
          </div>
          <div class="modal-footer">
            <button class="btn btn-sm btn-secondary" type="button" data-bs-dismiss="modal">Cancelar</button>
            <input type="hidden" name="carousel_id" id="carousel_id">
            <input type="hidden" name="acao" value="excluir-item-carousel"> 
            <button class="btn btn-sm btn-primary" type="submit">Excluir</button>
          </div>
      </form>
    </div> 
  </div>
</div>
<!-- EXCLUIR END -->     


<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/admin/footer.php'; ?>

<script>
  $("#dataTable").on("click", ".btn-excluir", function(){
         $(".text-excluir").html($(this).attr("data-titulo"));
         $("#carousel_id").val($(this).attr("data-id"));
  });
  $("#form-excluir").on("submit", function(e) {
      e.preventDefault();
      admin_submit_form(this, "carousel.php"); 
    });
</script>
