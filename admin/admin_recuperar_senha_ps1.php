<?php 
require_once $_SERVER['DOCUMENT_ROOT'].'/autoload/admin_autoload.php';
if(isset($_SESSION['admin_hash']) && !empty($_SESSION['admin_hash'])){
    die(header("Location:".BASE_ADMIN));
}
$page_title = 'Recuperar Senha Administrador';    
require_once $_SERVER['DOCUMENT_ROOT'].'/admin/header.php';
?>

<div class="login mx-auto">
    <div class="card"> 
        <div class="card-header">
            <div class="text-center login-icon">
                <img src="<?php echo exibir_image_upload_or_url(BASE_IMAGES_AVATARS_PATCH, BASE_IMAGES_AVATARS_URL,SITE_AVATAR);?>" class="mb-2">
                <h5 class="mb-0">RECUPERAR SENHA</h5>
                <p class="mb-2">Informe o seu email. Em instantes você receberá as instruções.</p>
            </div>
        </div>
        <div class="card-body">
            <form id="form-recuperar-senha" autocomplete="off">
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control">
                </div>
                <div class="d-flex justify-content-center align-items-center flex-column">
                    <input type="hidden" name="acao" value="recuperar-senha-ps1">
                    <button type="submit" class="btn btn-one mb-2"><i class="fas fa-sign-in me-2"></i>Enviar</button>
                    <a class="link" href="<?php echo BASE_ADMIN;?>login">Voltar para tela de login</a>
                </div>
            </form>
        </div>
    </div>
</div>


<?php require_once $_SERVER['DOCUMENT_ROOT'].'/admin/footer.php';?>
<script>
    $(document).ready(function(){
        $("#form-recuperar-senha").on("submit", function(e){
            e.preventDefault();
            admin_submit_form(this,"admin_recuperar_senha.php");
        });
    });
</script>