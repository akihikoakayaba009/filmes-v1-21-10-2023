<?php 
require_once $_SERVER['DOCUMENT_ROOT'].'/autoload/revendedor_autoload.php';

if(isset($_COOKIE['revendedor_hash']) && !empty($_COOKIE['revendedor_hash'])){
    die(header("Location:".BASE_PUBLIC));
}

$page_title = "Login Revendedor";
require_once $_SERVER['DOCUMENT_ROOT'].'/revendedor/revendedor_header.php';
?>


<div class="login">
    <div class="card">
        <div class="card-header">
            <div class="text-center login-icon">
                <a href="<?php echo BASE_PUBLIC;?>"><img src="<?php echo exibir_image_upload_or_url(BASE_IMAGES_AVATARS_PATCH, BASE_IMAGES_AVATARS_URL,SITE_AVATAR);?>" class="mb-2"></a>
                <h5 class="mb-0">REVENDEDOR LOGIN</h5>
                <p class="mb-2">Acessar minha conta.</p>
            </div>
        </div>
        <div class="card-body">
            <form id="form-login" autocomplete="off">
                <div class="form-group">
                    <label class="form-label-light">Email</label>
                    <input type="email" name="revendedor_email" class="form-control">
                </div>
                <div class="form-group mb-3">
                    <label class="form-label-light">Senha</label>
                    <div class="input-group">
                        <input type="password" name="revendedor_senha" class="form-control">
                        <span class="input-group-text cursor-pointer v-senha-1"><i class="fas fa-eye"></i></span>
                    </div>
                </div>
                <div class="d-flex justify-content-center align-items-center flex-column">
                    <input type="hidden" name="acao" value="revendedor-login">
                    <button type="submit" class="btn bg-gradient mb-3 mt-3"><i class="fas fa-sign-in me-2"></i>Login</button>
                    <a class="link" href="<?php echo BASE_REVENDEDOR;?>recuperar-senha-ps-1">Esqueci minha senha</a>
                    <a class="link" href="<?php echo BASE_REVENDEDOR;?>cadastro">Criar minha conta grátis</a>
                </div>
            </form>
        </div>
    </div>
</div> 





<?php require_once $_SERVER['DOCUMENT_ROOT'].'/revendedor/revendedor_footer.php';?>

<script>
    $(document).ready(function(){
        $(".v-senha-1").on("click", function(){
            if($("input[name=revendedor_senha]").attr("type") == 'password'){
                $("input[name=revendedor_senha]").attr("type","text");
                $(".v-senha-1").html('<i class="fas fa-eye-slash"></i>');
            }else{
                $("input[name=revendedor_senha]").attr("type","password");
                $(".v-senha-1").html('<i class="fas fa-eye"></i>');
            }
        });
        $("#form-login").on("submit", function(e){
            e.preventDefault();
            revendedor_submit_form(this, "revendedor_login.php"); 
        });
    });
</script> 