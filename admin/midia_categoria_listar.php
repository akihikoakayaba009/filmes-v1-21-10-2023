<?php 
require_once $_SERVER['DOCUMENT_ROOT'].'/controller/admin/admin_controller.php';
$page_title = 'Listando Categorias';
require_once $_SERVER['DOCUMENT_ROOT'].'/admin/header.php'; 
?>


<div class="card shadow card-header-title"> 
    <h1>Listando Categorias</h1>
    <small>Categorias Para: Animes, Canais, Filmes, Infantis, Novelas, Sériess.</small> 
</div>

<div class="d-flex justify-content-end align-items-end mb-3">
  <a class="btn btn-two btn-sm" href="<?php echo BASE_ADMIN.'midia/categoria/adicionar';?>"><i class="fas fa-sign-in me-2"></i>Nova Categoria</a>  
</div>


<div class="card card-form shadow">
    <div class="card-body">

    <div class="table-responsive"> 
      <table class="w-100 table border" id="dataTable">
        <div class="table-responsive">
        <thead>
          <tr>
            <td>Imagem</td>  
            <th>Título</th>
            <th>Para</th> 
            <th>Editar</th>
            <th>Excluir</th>
          </tr> 
        </thead> 
        <tbody> 
            <?php foreach(listar_categoria() as $item):?> 
              <tr>
                <td>
                    <img src="<?php echo !empty($item['categoria_image']) ? exibir_image_upload_or_url(BASE_IMAGES_CATEGORIAS_PATCH, BASE_IMAGES_CATEGORIAS_URL, $item['categoria_image']) : exibir_image_upload_or_url(BASE_IMAGES_CATEGORIAS_PATCH, BASE_IMAGES_CATEGORIAS_URL, SITE_CATEGORIA_IMAGE);?>" class="image-categoria-list">
                </td> 
                <td><?php echo $item['categoria_titulo'];?></td> 
                <td><?php echo midia_tipo_single_title($item['categoria_para']);?></td>
                <td><a class="btn btn-sm btn-three" title="Editar" href="<?php echo BASE_ADMIN.'midia/categoria/'.$item['categoria_para'].'/editar/'.$item['categoria_id'];?>">
                      <i class="fa fa-pencil me-2"></i>Editar
                  </a>
                </td>
                <td><button data-id="<?php echo $item['categoria_id'];?>"
                            data-titulo="<?php echo $item['categoria_titulo'];?>"
                            data-para="<?php echo $item['categoria_para'];?>"
                            data-image="<?php echo !empty($item['categoria_image']) ? exibir_image_upload_or_url(BASE_IMAGES_CATEGORIAS_PATCH, BASE_IMAGES_CATEGORIAS_URL, $item['categoria_image']) : exibir_image_upload_or_url(BASE_IMAGES_CATEGORIAS_PATCH, BASE_IMAGES_CATEGORIAS_URL, SITE_CATEGORIA_IMAGE);?>" 
                            class="btn btn-sm btn-excluir btn-four"  
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


<!-- Modal Excluir -->
<div class="modal fade" id="modal-excluir" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5 modal-excluir-title">Excluir</h1>
        <button class="btn modal-close-btn" type="button" data-bs-dismiss="modal"><i class="fas fa-times"></i></button>
      </div>
      <form id="form-excluir">
            <div class="modal-body d-flex justify-content-center align-items-center flex-column">
                <div class="text-center"><img src="" class="img-cat-excluir image-categoria-list mb-1"></div>
                <p class="txt-excluir-title mb-0">Todo o conteúdo da categoria será excluído.</p>
                <p class="txt-excluir-title mb-0">Tem certeza que deseja excluir ?</p></p>
                <p class="txt-excluir-title text-excluir-1">A categoria</p>
                <p class="txt-excluir-title text-excluir-2"></p>
            </div>
            <div class="modal-footer">
                <input type="hidden" name="categoria_id">
                <input type="hidden" name="categoria_para">
                <input type="hidden" name="acao" value="excluir-categoria">
                <button type="button" class="btn btn-sm btn-1" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-sm btn-3">Excluir</button>
            </div>
      </form>
    </div>
  </div>
</div>  

<?php require_once $_SERVER['DOCUMENT_ROOT'].'/admin/footer.php';?>

<script>
    $("#dataTable").on("click", ".btn-excluir", function(){
        $(".text-excluir-2").html($(this).attr("data-titulo"));
        $(".img-cat-excluir").attr("src", $(this).attr("data-image"));
        $("input[name=categoria_id]").val($(this).attr("data-id"));
        $("input[name=categoria_para]").val($(this).attr("data-para"));
    }); 
    $("#form-excluir").on("submit", function(e) {
      e.preventDefault();
      admin_submit_form(this, "midia_categorias.php");
    });
</script>

</div> 
</div>
</body>
</html>