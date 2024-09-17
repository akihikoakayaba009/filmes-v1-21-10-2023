<?php 
require_once $_SERVER['DOCUMENT_ROOT'].'/controller/admin/admin_controller.php';
$page_title = 'Adicionar Usuário';
require_once $_SERVER['DOCUMENT_ROOT'].'/admin/header.php'; 
?>

<div class="card shadow card-header-title"> 
    <h1><?php echo $page_title;?></h1>
    <small>Adicionar novo usuário.</small> 
</div> 

<div class="d-flex justify-content-start align-items-start mb-3">
  <a class="btn btn-1 btn-two" href="<?php echo BASE_ADMIN.'usuarios/listar';?>"><i class="fas fa-arrow-left me-2"></i>Usuários</a>  
</div>


<div class="card card-form shadow">
    <div class="card-body">
        <form id="adicionar-usuario" class="row" autocomplete="off" enctype="multipart/form-data">
            <div class="text-center">
                <img src="<?php echo BASE_IMAGES_AVATARS_URL.SITE_AVATAR;?>" class="image-avatar-change">
            </div>
            <div class="form-group col-12 col-lg-6">
                <label class="form-label-light">Nome Completo</label>
                <input type="text" class="form-control" name="user_nome">
            </div>
            <div class="form-group col-12 col-lg-6">
                <label class="form-label-light">Email</label>
                <input type="email" class="form-control" name="user_email">
            </div>
            <div class="form-group col-12">
                <label>Plano Premium</label>
                <select class="form-select" name="plano_premium">
                    <option value="" selected disabled>Selecione um plano</option>
                    <?php foreach(listar_plano_premium() as $item):?>
                        <option value="<?php echo $item['premium_id'];?>"><?php echo $item['premium_titulo'];?></option>
                    <?php endforeach;?> 
                    <option value="0">Não adicionar a um plano premium</option>   
                </select>
            </div>
            <div class="form-group col-12 col-lg-6">
            <label class="form-label-light">Senha</label>
                <div class="input-group">
                    <input type="password" name="user_senha" class="form-control" id="input-one">
                    <span class="input-group-text v-senha-1 cursor-pointer"><i class="fas fa-eye"></i></span>
                </div>
            </div>
            <div class="form-group col-12 col-lg-6">
                <label class="form-label-light">Confirmar Senha</label>
                <div class="input-group">
                    <input type="password" name="user_confirmar_senha" class="form-control" id="input-two">
                    <span class="input-group-text v-senha-2 cursor-pointer"><i class="fas fa-eye"></i></span>
                </div>
                <div class="text-end"><small class="text-1 cursor-pointer gerar-senha">Gerar Senha</small></div>
            </div> 
            <div class="form-group col-12"> 
                <input type="hidden" name="acao" value="adicionar-usuario">
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
        if($("input[name=user_senha]").attr("type") == 'password'){
            $("input[name=user_senha]").attr("type","text");
            $(".v-senha-1").html('<i class="fas fa-eye-slash"></i>');
        }else{
            $("input[name=user_senha]").attr("type","password");
            $(".v-senha-1").html('<i class="fas fa-eye"></i>');
        }
    });
    $(".v-senha-2").on("click", function(){
        if($("input[name=user_confirmar_senha]").attr("type") == 'password'){
            $("input[name=user_confirmar_senha]").attr("type","text");
            $(".v-senha-2").html('<i class="fas fa-eye-slash"></i>');
        }else{
            $("input[name=user_confirmar_senha]").attr("type","password");
            $(".v-senha-2").html('<i class="fas fa-eye"></i>');
        }
    });
    $("#adicionar-usuario").on("submit", function(e) {
      e.preventDefault();
      admin_submit_form(this, "usuarios.php");
    });
</script>



</div>
</div>
</body>
</html>