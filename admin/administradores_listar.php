<?php 
require_once $_SERVER['DOCUMENT_ROOT'].'/controller/admin/admin_controller.php';
$page_title = 'Administradores';
require_once $_SERVER['DOCUMENT_ROOT'].'/admin/header.php'; 
?>

<div class="card shadow card-header-title"> 
    <h1>Administradores</h1>
    <small>Total de administradores: <?php echo contar_administradores();?></small> 
</div>  

<div class="d-flex justify-content-end align-items-end mb-3">
  <a class="btn btn-sm btn-two" href="<?php echo BASE_ADMIN.'administradores/adicionar';?>"><i class="fas fa-sign-in me-2"></i>Adicionar Administrador</a>  
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
              <th>Email</th> 
              <th>Online/Offline</th>
              <th>Perfil</th>
              <th>Excluir</th>
            </tr> 
          </thead> 
          <tbody> 
              <?php foreach(listar_administradores() as $item):?>
                <tr>
                  <td><img src="<?php echo exibir_image_upload_or_url(BASE_IMAGES_AVATARS_PATCH,BASE_IMAGES_AVATARS_URL,$item['admin_avatar']);?>" class="image-avatar-list"></td>
                  <td><?php echo $item['admin_nome'];?></td> 
                  <td><?php echo $item['admin_email'];?></td>
                  <td><?php echo !empty($item['admin_online']) ?   (date("Y-m-d H:i:s", strtotime("- 1 minutes")) < date("Y-m-d H:i:s", strtotime($item['admin_online'])) ? '<span class="text-online">Online</span>' : '<span class="text-offline">Offline</span>') : '<span class="text-offline">Offline</span>';?></td>
                  <td><a class="btn btn-sm btn-three " title="Visualizar Perfil" href="<?php echo BASE_ADMIN.'administradores/perfil/'.$item['admin_id'];?>"><i class="fa fa-user me-2"></i>Ver Perfil</a></td>
                  <td><button data-id="<?php echo $item['admin_id'];?>"
                              data-email="<?php echo $item['admin_email'];?>"
                              data-image="<?php echo exibir_image_upload_or_url(BASE_IMAGES_AVATARS_PATCH,BASE_IMAGES_AVATARS_URL,$item['admin_avatar']);?>" 
                              data-nome="<?php echo $item['admin_nome'];?>" 
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
                <p class="txt-excluir-title text-excluir-1">Administrador</p>
                <p class="txt-excluir-title text-excluir-2"></p>
            </div>
            <div class="modal-footer">
                <input type="hidden" name="acao" value="excluir-administrador">
                <input type="hidden" name="admin_id">
                <button type="button" class="btn btn-sm" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-sm">Excluir</button>
            </div>
      </form>
    </div>
  </div>
</div>  

<?php require_once $_SERVER['DOCUMENT_ROOT'].'/admin/footer.php';?>


<script>
    $("#dataTable").on("click", ".btn-excluir", function(){
      $(".img-modal-excluir").attr("src", $(this).attr("data-image"));
      $("input[name=admin_id]").val($(this).attr("data-id"));
      $(".text-excluir-2").html($(this).attr("data-nome"));
    })
    $("#form-excluir").on("submit", function(e) {
      e.preventDefault(); 
      admin_submit_form(this, "administradores.php"); 
    });
</script>



</div>
</div>
</body>
</html>