<?php 
require_once $_SERVER['DOCUMENT_ROOT'].'/controller/admin/admin_controller.php';
$page_title = 'Usuários';
require_once $_SERVER['DOCUMENT_ROOT'].'/admin/header.php'; 
?>

<div class="card shadow card-header-title"> 
    <h1>Usuários</h1>
    <small>Total de usuários: <?php echo contar_usuarios();?></small> 
</div>  

<div class="d-flex justify-content-end align-items-end mb-3">
  <a class="btn btn-sm btn-two" href="<?php echo BASE_ADMIN.'usuarios/adicionar';?>"><i class="fas fa-sign-in me-2"></i>Adicionar Usuário</a>  
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
              <th>Premium</th>
              <th>Telas</th>
              <th>Online/Offline</th>
              <th>Perfil</th>
              <th>Excluir</th>
            </tr>  
          </thead> 
          <tbody> 
              <?php foreach(listar_usuarios() as $item):?>
                <tr>
                  <td><img src="<?php echo exibir_image_upload_or_url(BASE_IMAGES_AVATARS_PATCH,BASE_IMAGES_AVATARS_URL,$item['user_avatar']);?>" class="image-avatar-list"></td>
                  <td><?php echo $item['user_nome'];?></td> 
                  <td><?php echo $item['user_premium'] > date("Y-m-d H:i:s") ? 'Premium Ativo' : 'Premium Inativo';?></td> 
                  <td><?php echo premium_free_contar_perfis($item['user_id'], $item['user_email']) > 1 ?  premium_free_contar_perfis($item['user_id'], $item['user_email']) . ' Telas' : premium_free_contar_perfis($item['user_id'], $item['user_email']) . ' Tela';?></td>
                  <td><?php echo !empty($item['user_online']) ?   (date("Y-m-d H:i:s", strtotime("- 1 minutes")) < date("Y-m-d H:i:s", strtotime($item['user_online'])) ? '<span class="text-online">Online</span>' : '<span class="text-offline">Offline</span>') : '<span class="text-offline">Offline</span>';?></td>
                  <td><a class="btn btn-sm btn-three " title="Editar" href="<?php echo BASE_ADMIN.'usuarios/perfil/'.$item['user_id'];?>"><i class="fa fa-user me-2"></i>Ver Perfil</a></td>
                  <td><button data-id="<?php echo $item['user_id'];?>"
                              data-email="<?php echo $item['user_email'];?>"
                              data-image="<?php echo exibir_image_upload_or_url(BASE_IMAGES_AVATARS_PATCH,BASE_IMAGES_AVATARS_URL,$item['user_avatar']);?>" 
                              data-nome="<?php echo $item['user_nome'];?>" 
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
                <p class="txt-excluir-title text-excluir-1">Usuário</p>
                <p class="txt-excluir-title text-excluir-2"></p>
            </div>
            <div class="modal-footer">
                <input type="hidden" name="acao" value="excluir-usuario">
                <input type="hidden" name="user_id">
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
      $("input[name=user_id]").val($(this).attr("data-id"));
      $(".text-excluir-2").html($(this).attr("data-nome"));
    })
    $("#form-excluir").on("submit", function(e) {
      e.preventDefault(); 
      admin_submit_form(this, "usuarios.php"); 
    });
</script>


</div>
</div>
</body>
</html>