<?php 
require_once $_SERVER['DOCUMENT_ROOT'].'/controller/admin/admin_controller.php';

if(!isset($_GET['revendedor_id']) OR !intval($_GET['revendedor_id']) OR empty(admin_get_revendedor_por_id($_GET['revendedor_id']))){
    die(header("Location:".BASE_ADMIN.'revendedores/listar'));
}
$res = admin_get_revendedor_por_id($_GET['revendedor_id']);
$page_title = 'Editar Revendedor ';
require_once $_SERVER['DOCUMENT_ROOT'].'/admin/header.php'; 
?>
<div class="card shadow card-header-title"> 
    <h1><?php echo $page_title;?></h1>
    <small>Adicionar / Remover créditos do revendedor.</small> 
</div> 

<div class="d-flex justify-content-between mb-3">
  <a class="btn btn-1 btn-two" href="<?php echo BASE_ADMIN.'revendedores/listar';?>"><i class="fas fa-arrow-left me-2"></i>Revendedores</a>  
  <a class="btn btn-1 btn-two" href="<?php echo BASE_ADMIN.'revendedores/perfil/'.$_GET['revendedor_id'];?>"><i class="fas fa-sign-in me-2"></i>Ver Perfil</a>  
</div>


<div class="card card-form shadow">
    <div class="card-body">
        <form id="editar-creditos" class="row" autocomplete="off" enctype="multipart/form-data">
            <div class="text-center">
                <label for="image" class="cursor-pointer">
                    <img src="<?php echo exibir_image_upload_or_url(BASE_IMAGES_AVATARS_PATCH, BASE_IMAGES_AVATARS_URL,$res['revendedor_avatar']) ;?>" class="image-avatar-change load-image-on-change">
                    <small class="d-block">Revendedor</small>
                    <small class="d-block"><?php echo $res['revendedor_nome'];?></small>
                </label>
            </div>
            <div class="form-group col-12">
                <label class="form-label-light">Quantidade de créditos Url (Zero ou maior que zero)</label>
                <input type="text" class="form-control" name="revendedor_creditos" value="<?php echo $res['revendedor_creditos'];?>">
            </div>
            <div class="form-group col-12">
                <input type="hidden" name="revendedor_id" value="<?php echo $_GET['revendedor_id'];?>">
                <input type="hidden" name="acao" value="editar-creditos">
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
    $("#editar-creditos").on("submit", function(e) {
      e.preventDefault();
      admin_submit_form(this, "revendedores.php");
    });
</script>



</div>
</div>
</body>
</html>