<?php 
require_once $_SERVER['DOCUMENT_ROOT'].'/controller/admin/admin_controller.php';
$page_title = 'Smtp Envio De Email';
$res = get_servidor_smtp();
require_once $_SERVER['DOCUMENT_ROOT'].'/admin/header.php'; 
?>

<div class="card shadow card-header-title mb-3"> 
    <h1>Smtp Envio De Email</h1>
    <small>Verifique os dados do servidor com a sua hospedagem.</small> 
</div> 

<div class="card card-form shadow">
    <div class="card-body">

        <form id="form-smtp" class="row" autocomplete="off"> 
            <div class="form-group col-12">
                <label class="form-label-light">Usuário</label>
                <input type="text" class="form-control" name="smtp_user" value="<?php echo !empty($res['smtp_user']) ? $res['smtp_user'] : '';?>">
            </div>
            <div class="form-group col-12">
            <label class="form-label-light">Senha</label>
                <div class="input-group">
                    <input type="password" name="smtp_senha" class="form-control" id="input-one" value="<?php echo !empty($res['smtp_senha']) ? $res['smtp_senha'] : '';?>">
                    <span class="input-group-text v-senha-1 cursor-pointer"><i class="fas fa-eye"></i></span>
                </div>
            </div>
            <div class="form-group col-12">
                <label class="form-label-light">Porta</label>
                <input type="text" class="form-control" name="smtp_porta" value="<?php echo !empty($res['smtp_porta']) ? $res['smtp_porta'] : '';?>">
            </div>
            <div class="form-group col-12">
                <label class="form-label-light">Email</label>
                <input type="email" class="form-control" name="smtp_email" value="<?php echo !empty($res['smtp_email']) ? $res['smtp_email'] : '';?>">
            </div>
            <div class="form-group col-12">
                <label class="form-label-light">Host</label>
                <input type="text" class="form-control" name="smtp_host" value="<?php echo !empty($res['smtp_host']) ? $res['smtp_host'] : '';?>">
            </div>
            <div class="form-group col-12"> 
                <input type="hidden" name="acao" value="smtp-editar">
                <button type="submit" class="btn btn-four"><i class="fas fa-sign-in me-2"></i>Salvar</button>
            </div>
        </form>

    </div>
</div>

<?php require_once $_SERVER['DOCUMENT_ROOT'].'/admin/footer.php';?>
 
<script>
    $(".v-senha-1").on("click", function(){
        if($("input[name=smtp_senha]").attr("type") == 'password'){
            $("input[name=smtp_senha]").attr("type","text");
            $(".v-senha-1").html('<i class="fas fa-eye-slash"></i>');
        }else{
            $("input[name=smtp_senha]").attr("type","password");
            $(".v-senha-1").html('<i class="fas fa-eye"></i>');
        }
    });
    $("#form-smtp").on("submit", function(e) {
      e.preventDefault(); 
      admin_submit_form(this, "site_config.php");
    });
</script>



</div>
</div>
</body>
</html>