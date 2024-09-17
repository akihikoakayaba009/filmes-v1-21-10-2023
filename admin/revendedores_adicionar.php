<?php 
require_once $_SERVER['DOCUMENT_ROOT'].'/controller/admin/admin_controller.php';
$page_title = 'Adicionar Revendedor';
require_once $_SERVER['DOCUMENT_ROOT'].'/admin/header.php'; 
?>

<div class="card shadow card-header-title"> 
    <h1><?php echo $page_title;?></h1>
    <small>Servidor de email precisa estar configurado.</small> 
</div> 

<div class="d-flex justify-content-start align-items-start mb-3">
  <a class="btn btn-1 btn-two" href="<?php echo BASE_ADMIN.'revendedores/listar';?>"><i class="fas fa-arrow-left me-2"></i>Revendedores</a>  
</div>


<div class="card card-form shadow">
    <div class="card-body">
        <form id="adicionar-revendedor" class="row" autocomplete="off" enctype="multipart/form-data">
            <div class="text-center">
                <label for="image" class="cursor-pointer">
                    <img src="<?php echo BASE_IMAGES_AVATARS_URL.SITE_AVATAR;?>" class="image-avatar-change load-image-on-change">
                    <small class="d-block">Avatar (Opcional)</small>
                </label>
            </div>
            <div class="form-group col-12 col-lg-6">
                <label class="form-label-light">Nome Completo</label>
                <input type="text" class="form-control" name="revendedor_nome">
            </div>
            <div class="form-group col-12 col-lg-6">
                <label class="form-label-light">Email</label>
                <input type="email" class="form-control" name="revendedor_email">
            </div>
            <div class="form-group col-12 col-lg-6">
                <label class="form-label-light">Whatsapp (opcional)</label>
                <input type="text" class="form-control whatsapp" name="revendedor_whatsapp">
            </div>
            <div class="form-group col-12 col-lg-6">
                <label class="form-label-light">Telegram (opcional)</label>
                <input type="text" class="form-control whatsapp" name="revendedor_telegram">
            </div>
            <div class="form-group col-12 col-lg-6">
                <label class="form-label-light">Instagram Url (opcional)</label>
                <input type="text" class="form-control" name="revendedor_instagram">
            </div>
            <div class="form-group col-12 col-lg-6">
                <label class="form-label-light">Quantidade de créditos (Zero ou maior que zero)</label>
                <input type="text" class="form-control" name="revendedor_creditos">
            </div>
            <div class="form-group col-12 col-lg-6">
            <label class="form-label-light">Senha</label>
                <div class="input-group">
                    <input type="password" name="revendedor_senha" class="form-control" id="input-one">
                    <span class="input-group-text v-senha-1 cursor-pointer"><i class="fas fa-eye"></i></span>
                </div>
            </div>
            <div class="form-group col-12 col-lg-6">
                <label class="form-label-light">Confirmar Senha</label>
                <div class="input-group">
                    <input type="password" name="revendedor_confirma_senha" class="form-control" id="input-two">
                    <span class="input-group-text v-senha-2 cursor-pointer"><i class="fas fa-eye"></i></span>
                </div>
                <div class="text-end"><small class="text-1 cursor-pointer gerar-senha">Gerar Senha</small></div>
            </div> 
            <div class="form-group col-12">
                <input type="file" class="d-none input-image-change" name="revendedor_avatar" id="image">
                <input type="hidden" name="acao" value="adicionar-revendedor">
                <button type="submit" class="btn btn-four"><i class="fas fa-sign-in me-2"></i>Adicionar</button>
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
        if($("input[name=revendedor_senha]").attr("type") == 'password'){
            $("input[name=revendedor_senha]").attr("type","text");
            $(".v-senha-1").html('<i class="fas fa-eye-slash"></i>');
        }else{
            $("input[name=revendedor_senha]").attr("type","password");
            $(".v-senha-1").html('<i class="fas fa-eye"></i>');
        }
    });
    $(".v-senha-2").on("click", function(){
        if($("input[name=revendedor_confirma_senha]").attr("type") == 'password'){
            $("input[name=revendedor_confirma_senha]").attr("type","text");
            $(".v-senha-2").html('<i class="fas fa-eye-slash"></i>');
        }else{
            $("input[name=revendedor_confirma_senha]").attr("type","password");
            $(".v-senha-2").html('<i class="fas fa-eye"></i>');
        }
    });
    $("#adicionar-revendedor").on("submit", function(e) {
      e.preventDefault();
      admin_submit_form(this, "revendedores.php");
    });
</script>



</div>
</div>
</body>
</html>