<?php 
require_once $_SERVER['DOCUMENT_ROOT'].'/autoload/user_autoload.php';

if(isset($_COOKIE['user_hash']) && !empty($_COOKIE['user_hash'])){
    die(header("Location:".BASE_PUBLIC));
}

$page_title = "Login";
require_once $_SERVER['DOCUMENT_ROOT'].'/user/user_header.php';
?>


<div class="login">
    <div class="card">
        <div class="card-header">
            <div class="text-center login-icon">
                <a href="<?php echo BASE_PUBLIC;?>"><img src="<?php echo exibir_image_upload_or_url(BASE_IMAGES_SYSTEM_PATCH, BASE_IMAGES_SYSTEM_URL,SITE_LOGO);?>" class="site-logo"></a>
                <h5 class="mb-0">LOGIN</h5>
                <p class="mb-2">Acessar minha conta.</p>
            </div>
        </div> 
        <div class="card-body">
            <form id="form-login" autocomplete="off">
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="user_email" class="form-control">
                </div>
                <div class="form-group mb-3">
                    <label>Senha</label>
                    <div class="input-group">
                        <input type="password" name="user_senha" class="form-control">
                        <span class="input-group-text cursor-pointer v-senha-1"><i class="fas fa-eye"></i></span>
                    </div>
                </div>
                <div class="d-flex justify-content-center align-items-center flex-column">
                    <input type="hidden" name="acao" value="user-login">
                    <button type="submit" class="btn btn-sm"><i class="fas fa-sign-in me-2"></i>Login</button>
                    <a class="link" href="<?php echo BASE_USER;?>recuperar-senha-ps-1">Esqueci minha senha</a>
                    <a class="link" href="<?php echo BASE_USER;?>cadastro">Criar minha conta grátis</a>
                </div>
            </form>
        </div>
    </div>
</div> 


<?php require_once $_SERVER['DOCUMENT_ROOT'].'/user/user_footer.php';?>

<script>
    $(document).ready(function(){
        $(".v-senha-1").on("click", function(){
            if($("input[name=user_senha]").attr("type") == 'password'){
                $("input[name=user_senha]").attr("type","text");
                $(".v-senha-1").html('<i class="fas fa-eye-slash"></i>');
            }else{
                $("input[name=user_senha]").attr("type","password");
                $(".v-senha-1").html('<i class="fas fa-eye"></i>');
            }
        });
        $("#form-login").on("submit", function(e){
            e.preventDefault();
            user_submit_form(this, "user_login.php"); 
        });
    });
</script> 