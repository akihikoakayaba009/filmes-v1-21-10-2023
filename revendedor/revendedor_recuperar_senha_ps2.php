<?php 
require_once $_SERVER['DOCUMENT_ROOT'].'/autoload/revendedor_autoload.php';

if(isset($_COOKIE['revendedor_hash']) && !empty($_COOKIE['revendedor_hash'])){
    die(header("Location:".BASE_PUBLIC));
}

if(!isset($_GET['revendedor_hash_recuperar_senha']) OR empty($_GET['revendedor_hash_recuperar_senha']) OR 
   !verifica_hash_md5($_GET['revendedor_hash_recuperar_senha']) OR empty(get_revendedor_por_hash_recuperar_senha($_GET['revendedor_hash_recuperar_senha']))){
    die(header("Location:".BASE_REVENDEDOR.'login'));
}

$res = get_revendedor_por_hash_recuperar_senha($_GET['revendedor_hash_recuperar_senha']);

$page_title = "Alterar Senha";
require_once $_SERVER['DOCUMENT_ROOT'].'/revendedor/revendedor_header.php';
?>


<div class="login">
    <div class="card">
        <div class="card-header">
            <div class="text-center align-items-center login-icon">
                <img src="<?php echo exibir_image_upload_or_url(BASE_IMAGES_AVATARS_PATCH, BASE_IMAGES_AVATARS_URL,$res['revendedor_avatar']);?>" class="mb-2">
                <h5 class="mb-1">REVENDEDOR ALTERAR SENHA</h5> 
                <p class="mb-0">Olá <?php echo $res['revendedor_nome'];?>.</p>
                <p class="mb-0">Informe e confirme a sua nova senha.</p>
            </div>
        </div>
        <div class="card-body">
            <form id="form-alterar-senha" autocomplete="off">
                <div class="form-group mb-3">
                    <label class="form-label-light">Nova Senha</label>
                    <div class="input-group">
                        <input type="password" name="revendedor_senha" class="form-control">
                        <span class="input-group-text cursor-pointer v-senha-1"><i class="fas fa-eye"></i></span>
                    </div>
                </div>
                <div class="form-group mb-3">
                    <label class="form-label-light">Confirmar Nova Senha</label>
                    <div class="input-group">
                        <input type="password" name="revendedor_senha_confirma" class="form-control">
                        <span class="input-group-text cursor-pointer v-senha-2"><i class="fas fa-eye"></i></span>
                    </div>
                </div>
                <div class="d-flex justify-content-center align-items-center flex-column">
                    <input type="hidden" name="revendedor_hash_recuperar_senha" value="<?php echo $_GET['revendedor_hash_recuperar_senha'];?>">
                    <input type="hidden" name="acao" value="recuperar-senha-ps2">
                    <button type="submit" class="btn btn-one mb-2 mt-3"><i class="fas fa-sign-in me-2"></i>Alterar</button>
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
        $(".v-senha-2").on("click", function(){
            if($("input[name=revendedor_senha_confirma]").attr("type") == 'password'){
                $("input[name=revendedor_senha_confirma]").attr("type","text");
                $(".v-senha-2").html('<i class="fas fa-eye-slash"></i>');
            }else{
                $("input[name=revendedor_senha_confirma]").attr("type","password");
                $(".v-senha-2").html('<i class="fas fa-eye"></i>');
            }
        });

        $("#form-alterar-senha").on("submit", function(e){
            e.preventDefault();
            revendedor_submit_form(this, "revendedor_recuperar_senha.php"); 
        });
    });
</script> 