<?php 
require_once $_SERVER['DOCUMENT_ROOT'].'/autoload/admin_autoload.php';

if(isset($_SESSION['admin_hash']) OR !empty($_SESSION['admin_hash'])){
    die(header("Location:".BASE_ADMIN));
}

if(!isset($_GET['admin_hash_confirmacao_email']) OR empty($_GET['admin_hash_confirmacao_email']) OR !verifica_hash_md5($_GET['admin_hash_confirmacao_email']) OR 
   empty(get_administrador_por_hash_confirmacao_email($_GET['admin_hash_confirmacao_email']))){
    die(header("Location:".BASE_ADMIN));
}
$res = get_administrador_por_hash_confirmacao_email($_GET['admin_hash_confirmacao_email']);

if(!confirmar_email_admin($_GET['admin_hash_confirmacao_email'], $res['admin_email'], $res['admin_id'])){
    die(header("Location:".BASE_ADMIN));
}

$page_title = 'Confirmação Email Administrador';    
require_once $_SERVER['DOCUMENT_ROOT'].'/admin/header.php';
?>



<div class="admin-login mx-auto">
    <div class="card"> 
        <div class="card-header"> 
            <div class="text-center admin-login-icon mb-3">
                <img src="<?php echo exibir_image_upload_or_url(BASE_IMAGES_AVATARS_PATCH, BASE_IMAGES_AVATARS_URL,$res['admin_avatar']);?>">
                <h5 class="mb-0"><?php echo $res['admin_nome'];?></h5>
            </div>
        </div>
        <div class="card-body">
            <div class="d-flex flex-column justify-content-center align-items-center">
                <p class="text-1 mb-0">Olá <?php echo $res['admin_nome'];?> !</p>
                <p class="text-1">Seu email foi confirmado com sucesso.</p>
                <a class="btn btn-1 w-50" href="<?php echo BASE_ADMIN;?>login"><i class="fas fa-sign-in me-2"></i>Acessar minha conta</a>
            </div>
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