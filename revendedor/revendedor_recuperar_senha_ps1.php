<?php 
require_once $_SERVER['DOCUMENT_ROOT'].'/autoload/revendedor_autoload.php';

if(isset($_COOKIE['revendedor_hash']) && !empty($_COOKIE['revendedor_hash'])){
    die(header("Location:".BASE_PUBLIC));
}

$page_title = "Recuperar Senha";
require_once $_SERVER['DOCUMENT_ROOT'].'/revendedor/revendedor_header.php';
?>


<div class="login">
    <div class="card">
        <div class="card-header">
            <div class="text-center login-icon">
                <a href="<?php echo BASE_PUBLIC;?>"><img src="<?php echo exibir_image_upload_or_url(BASE_IMAGES_AVATARS_PATCH, BASE_IMAGES_AVATARS_URL,SITE_AVATAR);?>" class="mb-2"></a>
                <h5 class="mb-0">REVENDEDOR RECUPERAR SENHA</h5>
                <p class="mb-2">Informe o seu email. Em instantes você receberá as instruções.</p>
            </div>
        </div>
        <div class="card-body">
            <form id="form-recuperar-senha" autocomplete="off">
                <div class="form-group">
                    <label class="form-label-light">Email</label>
                    <input type="email" name="revendedor_email" class="form-control">
                </div>
                <div class="d-flex justify-content-center align-items-center flex-column">
                    <input type="hidden" name="acao" value="recuperar-senha-ps1">
                    <button type="submit" class="btn btn-one mb-2 mt-3"><i class="fas fa-sign-in me-2"></i>Enviar</button>
                    <a class="link" href="<?php echo BASE_REVENDEDOR;?>login">Acessar minha conta</a>
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
        $("#form-recuperar-senha").on("submit", function(e){
            e.preventDefault();
            revendedor_submit_form(this, "revendedor_recuperar_senha.php"); 
        });
    });
</script> 