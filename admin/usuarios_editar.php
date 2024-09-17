<?php 
require_once $_SERVER['DOCUMENT_ROOT'].'/controller/admin/admin_controller.php';

if(!isset($_GET['user_id']) OR !intval($_GET['user_id']) OR empty(get_user_por_id($_GET['user_id']))){
    die(header("Location:".BASE_ADMIN.'usuarios/listar'));
}
$res = get_user_por_id($_GET['user_id']);
$page_title = 'Editar Usuário';
require_once $_SERVER['DOCUMENT_ROOT'].'/admin/header.php'; 
?>

<div class="card shadow card-header-title"> 
    <h1><?php echo $page_title;?></h1>
    <small>Editar usuário: <?php echo $res['user_nome'];?></small> 
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
                <input type="text" class="form-control" name="user_nome" value="<?php echo $res['user_nome'];?>">
            </div>
            <div class="form-group col-12 col-lg-6">
                <label class="form-label-light">Email</label>
                <input type="email" class="form-control" name="user_email" disabled value="<?php echo $res['user_email'];?>">
            </div>
            <div class="form-group col-12">
                <label>Plano Premium</label>
                <select class="form-select" name="plano_premium">
                    <?php $a = 0;?>
                    <?php foreach(listar_todos_plano_premium() as $key => $item):?>
                        <?php if($res['user_premium_plano_id'] == $item['premium_id']):?>
                            <option value="" selected disabled>Plano Atual: <?php echo $item['premium_titulo'];?></option>
                        <?php else:?>
                            <option value="<?php echo $item['premium_id'];?>"><?php echo $item['premium_titulo'];?></option>
                        <?php endif;?>    
                    <?php endforeach;?>
                    <?php if(date("Y-m-d H:i:s") < date("Y-m-d H:i:s", strtotime($res['user_premium']))):?>
                        <option value="remover_premium">Remover Acesso Premium</option>
                    <?php endif;?>    
                </select> 
            </div>
            <div class="form-group col-12"> 
                <input type="hidden" name="user_id" value="<?php echo $res['user_id'];?>">
                <input type="hidden" name="acao" value="editar-usuario">
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
    $("#adicionar-usuario").on("submit", function(e) {
      e.preventDefault();
      admin_submit_form(this, "usuarios.php");
    });
</script>



</div>
</div>
</body>
</html>