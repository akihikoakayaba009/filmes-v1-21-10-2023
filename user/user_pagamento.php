<?php 
require_once $_SERVER['DOCUMENT_ROOT'].'/controller/user/user_controller.php';

if(!isset($_GET['venda_collection_id']) OR !intval($_GET['venda_collection_id']) OR empty(informacoes_venda_user_por_id($_GET['venda_collection_id'], $user_id, $user_email))){
    die(header("Location:".BASE_USER));
}

$res = informacoes_venda_user_por_id($_GET['venda_collection_id'], $user_id, $user_email);

$page_title = "Informações Pagamento";
require_once $_SERVER['DOCUMENT_ROOT'].'/user/user_header.php';
?>

<div class="container conta-page">

<div class="card shadow card-header-title">
    <h1>Informações Pagamento</h1>
    <small>Pagamentos com boleto podem levar até 48 horas para ser compensado.</small>
</div>

<div class="mt-3">
    <a href="<?php echo BASE_USER;?>" class="btn btn-sm btn-voltar"><i class="fas fa-arrow-left me-2"></i>Voltar</a>
</div>

<div class="card shadow card-form mt-4">
    <div class="card-body"> 

    <div class="perfil-info-right">
        <ul class="list-group">
            <li class="list-group-item d-flex justify-content-between align-items-start">
                <div class="ms-2 me-auto">
                    <div class="d-flex align-items-center"><i class="fas fa-tv"></i><?php echo $res['venda_titulo'];?></div>
                    <div class="space-left">R$ <?php echo $res['venda_item_preco'];?></div>   
                </div>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-start">
                <div class="ms-2 me-auto">
                    <div class="d-flex align-items-center"><i class="fas fa-info-circle"></i>Status</div>
                    <div class="space-left"><?php echo verificar_status_pagamento_mp($res['venda_status']);?></div>   
                </div>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-start">
                <div class="ms-2 me-auto">
                    <div class="d-flex align-items-center"><i class="far fa-money-check-alt"></i>Forma de pagamento</div>
                    <div class="space-left"><?php echo $res['venda_forma_pagamento'];?></div>   
                </div>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-start">
                <div class="ms-2 me-auto">
                    <div class="d-flex align-items-center"><i class="fas fa-calendar"></i>Data</div>
                    <div class="space-left"><?php echo date("d/m/Y H:i", strtotime($res['venda_data']));?></div>   
                </div>
            </li>

        </ul> 
    </div>
    
    </div>
</div>

</div>
           

<?php require_once $_SERVER['DOCUMENT_ROOT'].'/user/user_footer.php';?>
<script>
    $(".v-senha-1").on("click", function(){
        if($("input[name=senha_atual]").attr("type") == 'password'){
            $("input[name=senha_atual]").attr("type","text");
            $(".v-senha-1").html('<i class="fas fa-eye-slash"></i>');
        }else{
            $("input[name=senha_atual]").attr("type","password");
            $(".v-senha-1").html('<i class="fas fa-eye"></i>');
        }
    });
    $(".v-senha-2").on("click", function(){
        if($("input[name=senha_nova]").attr("type") == 'password'){
            $("input[name=senha_nova]").attr("type","text");
            $(".v-senha-2").html('<i class="fas fa-eye-slash"></i>');
        }else{
            $("input[name=senha_nova]").attr("type","password"); 
            $(".v-senha-2").html('<i class="fas fa-eye"></i>');
        }
    });
    $(".v-senha-3").on("click", function(){
        if($("input[name=senha_confirma]").attr("type") == 'password'){
            $("input[name=senha_confirma]").attr("type","text");
            $(".v-senha-3").html('<i class="fas fa-eye-slash"></i>');
        }else{
            $("input[name=senha_confirma]").attr("type","password");
            $(".v-senha-3").html('<i class="fas fa-eye"></i>');
        }
    });
    $("#form-senha").on("submit", function(e){
            e.preventDefault();
            user_submit_form(this, "user_perfil.php"); 
    });
    $("#form-perfil").on("submit", function(e){
            e.preventDefault();
            user_submit_form(this, "user_perfil_select.php"); 
    });
    $("#form-editar-perfil").on("submit", function(e){
            e.preventDefault();
            user_submit_form(this, "user_perfil.php"); 
    });

    $("#select-avatar-perfil").on("change", function(){
        $(".perfil-change").attr("src", '<?php echo BASE_IMAGES_AVATARS_PERFIL_SELECT_URL;?>'+$(this).val());
    });
</script>

</body>
</html>