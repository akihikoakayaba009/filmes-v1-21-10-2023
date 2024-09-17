<?php 
require_once $_SERVER['DOCUMENT_ROOT'].'/controller/admin/admin_controller.php';
$page_title = 'Administradores';
require_once $_SERVER['DOCUMENT_ROOT'].'/admin/header.php'; 
?>

<div class="card shadow card-header-title"> 
    <h1>Revendedores</h1>
    <small>Total de revendedores: <?php echo admin_contar_revendedores();?></small> 
</div>  

<div class="d-flex justify-content-end align-items-end mb-3">
  <a class="btn btn-sm btn-two" href="<?php echo BASE_ADMIN.'revendedores/adicionar';?>"><i class="fas fa-sign-in me-2"></i>Adicionar Revendedor</a>  
</div>

<div class="card card-form shadow">
  <div class="card-body">

        <div class="table-responsive"> 
        <table class="w-100 table border" id="dataTable">
          <div class="table-responsive">
          <thead>
            <tr>
              <th>Image</th>
              <th>Nome</th>
              <th>Créditos</th> 
              <th>Online/Offline</th>
              <th>Perfil</th>
              <th>Editar Créditos</th>
              <th>Excluir</th>
            </tr>  
          </thead> 
          <tbody> 
              <?php foreach(admin_listar_revendedores() as $item):?>
                <tr>
                  <td><img src="<?php echo exibir_image_upload_or_url(BASE_IMAGES_AVATARS_PATCH,BASE_IMAGES_AVATARS_URL,$item['revendedor_avatar']);?>" class="image-avatar-list"></td>
                  <td><?php echo $item['revendedor_nome'];?></td> 
                  <td><?php echo $item['revendedor_creditos'];?></td>
                  <td><?php echo !empty($item['revendedor_online']) ?   (date("Y-m-d H:i:s", strtotime("- 1 minutes")) < date("Y-m-d H:i:s", strtotime($item['revendedor_online'])) ? '<span class="text-online">Online</span>' : '<span class="text-offline">Offline</span>') : '<span class="text-offline">Offline</span>';?></td>
                  <td><a class="btn btn-sm btn-five" title="Visualizar Perfil" href="<?php echo BASE_ADMIN.'revendedores/perfil/'.$item['revendedor_id'];?>"><i class="fa fa-user me-2"></i>Ver Perfil</a></td>
                  <td><a class="btn btn-sm btn-three " title="Editar" href="<?php echo BASE_ADMIN.'revendedores/editar/'.$item['revendedor_id'];?>"><i class="fa fa-coins me-2"></i>Editar</a></td>
                  <td><button data-id="<?php echo $item['revendedor_id'];?>"
                              data-email="<?php echo $item['revendedor_email'];?>"
                              data-image="<?php echo exibir_image_upload_or_url(BASE_IMAGES_AVATARS_PATCH,BASE_IMAGES_AVATARS_URL,$item['revendedor_avatar']);?>" 
                              data-nome="<?php echo $item['revendedor_nome'];?>" 
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
                <img src="" class="img-modal-excluir"> 
                <p class="txt-excluir-title">Tem certeza que deseja excluir ?</p>
                <p class="txt-excluir-title text-excluir-1">Revendedor</p>
                <p class="txt-excluir-title text-excluir-2"></p>
            </div>
            <div class="modal-footer">
                <input type="hidden" name="acao" value="excluir-revendedor">
                <input type="hidden" name="revendedor_id">
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
      $(".img-modal-excluir").attr("src", $(this).attr("data-image"));
      $("input[name=revendedor_id]").val($(this).attr("data-id"));
      $(".text-excluir-2").html($(this).attr("data-nome"));
    })
    $("#form-excluir").on("submit", function(e) {
      e.preventDefault(); 
      admin_submit_form(this, "revendedores.php"); 
    });
</script>



</div>
</div>
</body>
</html>