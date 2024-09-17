<?php 
require_once $_SERVER['DOCUMENT_ROOT'].'/controller/admin/admin_controller.php';
$page_title = 'Editar Perfil Administrador';
require_once $_SERVER['DOCUMENT_ROOT'].'/admin/header.php'; 
?>

<div class="card shadow card-header-title"> 
    <h1>Editar Perfil</h1>
    <small>Conta administrador</small> 
</div>

<div class="d-flex justify-content-end align-items-end mb-3">
  <a class="btn btn-sm btn-two" href="<?php echo BASE_ADMIN.'perfil/alterar-senha';?>"><i class="fas fa-sign-in me-2"></i>Alterar Senha</a>  
</div>

<div class="card card-form shadow">
    <div class="card-body">

        <form id="admin-editar-perfil" class="row" autocomplete="off" enctype="multipart/form-data">
            <div class="text-center"> 
                <label for="image" class="cursor-pointer">
                    <img src="<?php echo exibir_image_upload_or_url(BASE_IMAGES_AVATARS_PATCH, BASE_IMAGES_AVATARS_URL, $admin_avatar);?>" class="image-avatar-change load-image-on-change">
                    <p class="p-0 text-1">Alterar Avatar</p>
                </label>
            </div> 
            <div class="form-group col-12 col-lg-6">
                <label class="form-label-light">Nome Completo</label>
                <input type="text" class="form-control" name="admin_nome" value="<?php echo $admin_nome;?>">
            </div>
            <div class="form-group col-12 col-lg-6">
                <label class="form-label-light">Email</label>
                <input type="email" class="form-control" name="admin_email" value="<?php echo $admin_email;?>" disabled>
            </div>
            <div class="form-group col-12 col-lg-6">
                <label class="form-label-light">Celular (opcional)</label>
                <input type="text" class="form-control celular" name="admin_celular" value="<?php echo $admin_celular;?>">
            </div>
            <div class="form-group col-12 col-lg-6">
                <label class="form-label-light">Whatsapp (opcional)</label>
                <input type="text" class="form-control whatsapp" name="admin_whatsapp" value="<?php echo $admin_whatsapp;?>">
            </div>
            <div class="form-group col-12"> 
                <input type="file" class="d-none input-image-change" name="admin_avatar" id="image">
                <input type="hidden" name="acao" value="admin-editar-perfil">
                <button type="submit" class="btn btn-four"><i class="fas fa-sign-in me-2"></i>Editar</button>
            </div>
        </form>

    </div>
</div>

<?php require_once $_SERVER['DOCUMENT_ROOT'].'/admin/footer.php';?>
 
<script>
    $(".gerar-senha").on("click", function() {
      var pass = getPassword();
      var pswone = $("#input-one");
      var pstwo = $("#input-two");
      pswone.val(pass);
      pstwo.val(pass);
    }); 
    $(".v-senha-1").on("click", function(){
        if($("input[name=admin_senha_add]").attr("type") == 'password'){
            $("input[name=admin_senha_add]").attr("type","text");
            $(".v-senha-1").html('<i class="fas fa-eye-slash"></i>');
        }else{
            $("input[name=admin_senha_add]").attr("type","password");
            $(".v-senha-1").html('<i class="fas fa-eye"></i>');
        }
    });
    $(".v-senha-2").on("click", function(){
        if($("input[name=admin_confirma_senha_add]").attr("type") == 'password'){
            $("input[name=admin_confirma_senha_add]").attr("type","text");
            $(".v-senha-2").html('<i class="fas fa-eye-slash"></i>');
        }else{
            $("input[name=admin_confirma_senha_add]").attr("type","password");
            $(".v-senha-2").html('<i class="fas fa-eye"></i>');
        }
    });
    $("#admin-editar-perfil").on("submit", function(e) {
      e.preventDefault();
      admin_submit_form(this, "admin_perfil.php");
    });
</script>



</div>
</div>
</body>
</html>