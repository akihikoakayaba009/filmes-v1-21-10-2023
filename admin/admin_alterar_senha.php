<?php 
require_once $_SERVER['DOCUMENT_ROOT'].'/controller/admin/admin_controller.php';
$page_title = 'Alterar Senha Administrador';
require_once $_SERVER['DOCUMENT_ROOT'].'/admin/header.php'; 
?>

<div class="card shadow card-header-title"> 
    <h1>Alterar Senha</h1>
    <small>Conta administrador</small> 
</div> 
 
<div class="d-flex justify-content-end align-items-end mb-3">
  <a class="btn btn-sm btn-two" href="<?php echo BASE_ADMIN.'perfil/editar';?>"><i class="fas fa-sign-in me-2"></i>Editar Perfil</a>  
</div>
 
<div class="card card-form shadow">
    <div class="card-body">
        <form id="admin-alterar-senha" class="row" autocomplete="off">
            <div class="text-center">
                <img src="<?php echo exibir_image_upload_or_url(BASE_IMAGES_AVATARS_PATCH, BASE_IMAGES_AVATARS_URL,$admin_avatar);?>" class="image-avatar">
                <small class="d-block"><?php echo $admin_primeiro_nome;?></small> 
            </div>
            <div class="form-group col-12">
            <label class="form-label-light">Senha Atual</label>
                <div class="input-group">
                    <input type="password" name="senha_atual" class="form-control" id="input-one">
                    <span class="input-group-text v-senha-1 cursor-pointer"><i class="fas fa-eye"></i></span>
                </div>
            </div>
            <div class="form-group col-12">
            <label class="form-label-light">Nova Senha</label>
                <div class="input-group">
                    <input type="password" name="senha_nova" class="form-control" id="input-two">
                    <span class="input-group-text v-senha-2 cursor-pointer"><i class="fas fa-eye"></i></span>
                </div>
            </div>
            <div class="form-group col-12">
                <label class="form-label-light">Confirmar Nova Senha</label>
                <div class="input-group">
                    <input type="password" name="senha_confirma" class="form-control" id="input-three">
                    <span class="input-group-text v-senha-3 cursor-pointer"><i class="fas fa-eye"></i></span>
                </div>
            </div> 
            <div class="form-group col-12">
                <input type="hidden" name="acao" value="admin-alterar-senha">
                <button type="submit" class="btn btn-four"><i class="fas fa-sign-in me-2"></i>Alterar</button>
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
        if($("input[name=senha_atual]").attr("type") == 'password'){
            $("input[name=senha_atual]").attr("type","text");
            $(".v-senha-1").html('<i class="fas fa-eye-slash"></i>');
        }else{
            $("input[name=senha_atual]").attr("type","password");
            $(".v-senha-1").html('<i class="fas fa-eye"></i>');
        }
    });
    $(".v-senha-2").on("click", function(){
        if($("input[name=senha_nova]").attr("type") == 'password'){
            $("input[name=senha_nova]").attr("type","text");
            $(".v-senha-2").html('<i class="fas fa-eye-slash"></i>');
        }else{
            $("input[name=senha_nova]").attr("type","password");
            $(".v-senha-2").html('<i class="fas fa-eye"></i>');
        }
    });
    $(".v-senha-3").on("click", function(){
        if($("input[name=senha_confirma]").attr("type") == 'password'){
            $("input[name=senha_confirma]").attr("type","text");
            $(".v-senha-3").html('<i class="fas fa-eye-slash"></i>');
        }else{
            $("input[name=senha_confirma]").attr("type","password");
            $(".v-senha-3").html('<i class="fas fa-eye"></i>');
        }
    });
    $("#admin-alterar-senha").on("submit", function(e) {
      e.preventDefault();
      admin_submit_form(this, "admin_perfil.php");
    });
</script>



</div>
</div>
</body>
</html>