<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/autoload/user_autoload.php';

if(isset($_COOKIE['user_hash']) && !empty($_COOKIE['user_hash'])){
    die(header("Location:".BASE_PUBLIC));
}

$page_title = "Cadastro";
require_once $_SERVER['DOCUMENT_ROOT'].'/user/user_header.php';
?>


<div class="login">
    <div class="card">
        <div class="card-header">
            <div class="text-center login-icon">
                <a href="<?php echo BASE_PUBLIC;?>"><img src="<?php echo exibir_image_upload_or_url(BASE_IMAGES_SYSTEM_PATCH, BASE_IMAGES_SYSTEM_URL,SITE_LOGO);?>" class="site-logo"></a>
                <h5 class="mb-0">CRIAR CONTA</h5>
                <p class="mb-2">Crie a sua conta gratuitamente.</p>
            </div>
        </div>
        <div class="card-body">
            <form id="form-cadastro" autocomplete="off">
                <div class="form-group">
                    <label>Nome</label>
                    <input type="text" name="user_nome" class="form-control">
                </div>
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
                <div class="form-group mb-3">
                    <label>Confirmar Senha</label>
                    <div class="input-group">
                        <input type="password" name="user_senha_confirma" class="form-control">
                        <span class="input-group-text cursor-pointer v-senha-2"><i class="fas fa-eye"></i></span>
                    </div>
                </div>
                <div class="d-flex justify-content-center align-items-center flex-column">
                    <input type="hidden" name="acao" value="user-cadastro">
                    <button type="submit" class="btn btn-sm"><i class="fas fa-sign-in me-2"></i>Criar Conta</button>
                    <a class="link" href="<?php echo BASE_USER;?>login">Acessar minha conta</a>
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
        $(".v-senha-2").on("click", function(){
            if($("input[name=user_senha_confirma]").attr("type") == 'password'){
                $("input[name=user_senha_confirma]").attr("type","text");
                $(".v-senha-2").html('<i class="fas fa-eye-slash"></i>');
            }else{
                $("input[name=user_senha_confirma]").attr("type","password");
                $(".v-senha-2").html('<i class="fas fa-eye"></i>');
            }
        });
        $("#form-cadastro").on("submit", function(e){
            e.preventDefault();
            user_submit_form(this, "user_cadastro.php"); 
        });
    });
</script> 