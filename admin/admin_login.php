<?php 
require_once $_SERVER['DOCUMENT_ROOT'].'/autoload/admin_autoload.php';
if(isset($_SESSION['admin_hash']) && !empty($_SESSION['admin_hash'])){
    die(header("Location:".BASE_ADMIN));
}
$page_title = 'Login Administrador';    
require_once $_SERVER['DOCUMENT_ROOT'].'/admin/header.php';
?>


<div class="login mx-auto">
    <div class="card">
        <div class="card-header">
            <div class="text-center login-icon">
                <img src="<?php echo exibir_image_upload_or_url(BASE_IMAGES_AVATARS_PATCH, BASE_IMAGES_AVATARS_URL,SITE_AVATAR);?>" class="mb-2">
                <h5 class="mb-0">LOGIN</h5>
                <p class="mb-2">Administrador</p> 
            </div>
        </div>
        <div class="card-body">
            <form id="formLogin" autocomplete="off">
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control">
                </div>
                <div class="form-group mb-3">
                    <label>Senha</label>
                    <div class="input-group">
                        <input type="password" name="senha" class="form-control">
                        <span class="input-group-text cursor-pointer v-senha"><i class="fas fa-eye"></i></span>
                    </div>
                </div>
                <div class="d-flex justify-content-center align-items-center flex-column">
                    <input type="hidden" name="acao" value="admin-login">
                    <button type="submit" class="btn btn-one mb-3"><i class="fas fa-sign-in me-2"></i>Login</button>
                    <a class="link" href="<?php echo BASE_ADMIN;?>recuperar-senha-ps-1">Esqueci minha senha</a>
                </div>
            </form>
        </div>
    </div>
</div>

  


<?php require_once $_SERVER['DOCUMENT_ROOT'].'/admin/footer.php';?>
<script>
    $(document).ready(function(){
        $("#formLogin").on("submit", function(e){
            e.preventDefault();
            admin_submit_form(this,"admin_login.php");
        });
    });
    $(".input-group-text").on("click", function(){
        if($("input[name=senha]").attr("type") == 'password'){
            $("input[name=senha]").attr("type","text");
            $(".input-group-text").html('<i class="fas fa-eye-slash"></i>');
        }else{
            $("input[name=senha]").attr("type","password");
            $(".input-group-text").html('<i class="fas fa-eye"></i>');
        }
    });
</script>

</body>
</html>