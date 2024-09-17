<?php 
require_once $_SERVER['DOCUMENT_ROOT'].'/controller/admin/admin_controller.php';
$page_title = 'Listando Comentários';
require_once $_SERVER['DOCUMENT_ROOT'].'/admin/header.php'; 
?>


<div class="card shadow card-header-title"> 
    <h1>Listando Comentários</h1>
    <small>Comentários <?php echo contar_comentarios();?></small> 
</div>


<div class="card card-form shadow">
    <div class="card-body">

    <div class="table-responsive"> 
      <table class="w-100 table border" id="dataTable">
        <div class="table-responsive">
        <thead>
          <tr>
            <td>Imagem</td>
            <td>Mídia</td>
            <td>Apelido</td>  
            <th>Comentário</th>
            <th>Data</th> 
            <th>Ver Comentário</th>
            <th>Excluir</th>
          </tr> 
        </thead> 
        <tbody> 
            <?php foreach(listar_comentarios() as $item):?> 

              <?php $res = get_midia_por_id_segundo($item['comentario_midia_id']);?>
              <tr> 
                <td>
                    <img src="<?php echo !empty($res) ? exibir_image_upload_or_url(BASE_IMAGES_MIDIA_PATCH, BASE_IMAGES_MIDIA_URL, $res['midia_image']) : exibir_image_upload_or_url(BASE_IMAGES_MIDIA_PATCH, BASE_IMAGES_MIDIA_URL, 'midia_background.png')?>" class="image-midia-lista">
                </td> 
                <td><?php echo !empty($res) ? $res['midia_titulo'] : 'Excluído';?></td>
                <td><?php echo $item['comentario_perfil_apelido'];?></td>
                <td><?php echo strlen($item['comentario']) > 35 ? substr($item['comentario'],0,35).'...' : $item['comentario'];?></td> 
                <td><?php echo date("d/m/Y H:i", strtotime($item['comentario_data']));?></td>
                <td>
                  <a href="#" class="btn btn-sm btn-three btn-ver-comentario" data-bs-toggle="modal" data-bs-target="#modal-ver-comentario" data-perfil="<?php echo $item['comentario_perfil_apelido'];?>" data-comentario="<?php echo $item['comentario'];?>" title="Ver comentário completo"><i class="fa fa-eye me-2"></i>Ver Mais</a>
                </td>
                <td><button data-id="<?php echo $item['comentario_id'];?>"
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

<!-- Modal Ver Comentário -->
<div class="modal fade" id="modal-excluir" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5">Excluir</h1>
        <button class="btn modal-close-btn" type="button" data-bs-dismiss="modal"><i class="fas fa-times"></i></button>
      </div>
      <form id="form-excluir">
            <div class="modal-body d-flex justify-content-center align-items-center flex-column">
                <p class="txt-excluir-title">Tem certeza que excluir ?</p>
                <p class="txt-excluir-title text-excluir-1">O comentário</p>
                <p class="txt-excluir-title text-excluir-2"></p>
            </div>
            <div class="modal-footer">
                <input type="hidden" name="comentario_id">
                <input type="hidden" name="acao" value="excluir-comentario">
                <button type="button" class="btn btn-sm btn-1" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-sm btn-3">Excluir</button>
            </div>
      </form>
    </div>
  </div>
</div>  

<!-- Modal Excluir -->
<div class="modal fade" id="modal-ver-comentario" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5">Excluir</h1>
        <button class="btn modal-close-btn" type="button" data-bs-dismiss="modal"><i class="fas fa-times"></i></button>
      </div>
      <form id="form-excluir">
            <div class="modal-body d-flex justify-content-center align-items-center flex-column">
                <p class="txt-excluir-title mb-0">Visualizando Comentário.</p>
                <p class="txt-excluir-title text-excluir-1 mb-2"></p>
                <p class="txt-excluir-title text-excluir-2"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-1" data-bs-dismiss="modal">Fechar</button>
            </div>
      </form>
    </div>
  </div>
</div>  


<?php require_once $_SERVER['DOCUMENT_ROOT'].'/admin/footer.php';?>

<script>
    $("#dataTable").on("click", ".btn-excluir", function(){
        $(".text-excluir-2").html($(this).attr("data-comentario"));
        $("input[name=comentario_id]").val($(this).attr("data-id"));
    }); 
    $("#dataTable").on("click", ".btn-ver-comentario", function(){
        $(".text-excluir-1").html($(this).attr("data-perfil"));
        $(".text-excluir-2").html($(this).attr("data-comentario"));
    }); 
    $("#form-excluir").on("submit", function(e) {
      e.preventDefault();
      admin_submit_form(this, "midia_comentarios.php");
    });
</script>

</div> 
</div>
</body>
</html> 