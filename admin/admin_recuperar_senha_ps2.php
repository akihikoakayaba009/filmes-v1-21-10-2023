<?php 
require_once $_SERVER['DOCUMENT_ROOT'].'/autoload/admin_autoload.php';
if(isset($_SESSION['admin_hash']) OR !empty($_SESSION['admin_hash']) OR 
   !isset($_GET['admin_hash_recuperar_senha']) OR empty($_GET['admin_hash_recuperar_senha']) OR !verifica_hash_md5($_GET['admin_hash_recuperar_senha']) OR 
   empty(get_administrador_por_hash_recuperar_senha($_GET['admin_hash_recuperar_senha']))){
    die(header("Location:".BASE_ADMIN));
}
$res = get_administrador_por_hash_recuperar_senha($_GET['admin_hash_recuperar_senha']);

$page_title = 'Alterar Senha Administrador';    
require_once $_SERVER['DOCUMENT_ROOT'].'/admin/header.php';
?>
 
<div class="login mx-auto">
    <div class="card"> 
        <div class="card-header"> 
            <div class="text-center login-icon">
                <img src="<?php echo exibir_image_upload_or_url(BASE_IMAGES_AVATARS_PATCH, BASE_IMAGES_AVATARS_URL,$res['admin_avatar']);?>" class="mb-2">
                <h5 class="mb-0">ALTERAR SENHA</h5>
                <p class="mb-0"><?php echo $res['admin_nome'];?></p>
                <p class="mb-0">Informe e confirme a sua nova senha.</p>    
            </div>
        </div>
        <div class="card-body">
            <form id="form-recuperar-senha" autocomplete="off">
                <div class="form-group">
                <label>Nova Senha</label>
                    <div class="input-group">
                        <input type="password" name="nova_senha" class="form-control" id="input-two">
                        <span class="input-group-text v-senha-2 cursor-pointer"><i class="fas fa-eye"></i></span>
                    </div>
                </div>
                <div class="form-group">
                    <label>Confirmar Nova Senha</label>
                    <div class="input-group">
                        <input type="password" name="confirma_nova_senha" class="form-control" id="input-three">
                        <span class="input-group-text v-senha-3 cursor-pointer"><i class="fas fa-eye"></i></span>
                    </div>
                </div> 
                <div class="d-flex justify-content-center align-items-center flex-column">
                    <input type="hidden" name="acao" value="recuperar-senha-ps2">
                    <input type="hidden" name="email" value="<?php echo $res['admin_email'];?>">
                    <input type="hidden" name="admin_hash_recuperar_senha" value="<?php echo $_GET['admin_hash_recuperar_senha'];?>">
                    <button type="submit" class="btn btn-1 mb-2"><i class="fas fa-sign-in me-2"></i>Alterar Senha</button>
                </div> 
            </form>
        </div>
    </div>
</div>
 
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/admin/footer.php';?>
<script>
    $(document).ready(function(){
        $(".v-senha-2").on("click", function(){
            if($("input[name=nova_senha]").attr("type") == 'password'){
                $("input[name=nova_senha]").attr("type","text");
                $(".v-senha-2").html('<i class="fas fa-eye-slash"></i>');
            }else{
                $("input[name=nova_senha]").attr("type","password");
                $(".v-senha-2").html('<i class="fas fa-eye"></i>');
            }
        });
        $(".v-senha-3").on("click", function(){
            if($("input[name=confirma_nova_senha]").attr("type") == 'password'){
                $("input[name=confirma_nova_senha]").attr("type","text");
                $(".v-senha-3").html('<i class="fas fa-eye-slash"></i>');
            }else{
                $("input[name=confirma_nova_senha]").attr("type","password");
                $(".v-senha-3").html('<i class="fas fa-eye"></i>');
            }
        });
        $("#form-recuperar-senha").on("submit", function(e){
            e.preventDefault();
            admin_submit_form(this,"admin_recuperar_senha.php");
        });
    });
</script>