<?php 
require_once $_SERVER['DOCUMENT_ROOT'].'/controller/admin/admin_controller.php';
$page_title = 'Adicionar Plano Premium';
$res = get_servidor_smtp();
require_once $_SERVER['DOCUMENT_ROOT'].'/admin/header.php'; 
?>



<div class="card shadow card-header-title"> 
    <h1><?php echo $page_title;?></h1>
    <small>A revenda precisa estar ativada. Caso não esteja acesse configurações -> Informações do site.</small> 
</div> 

<div class="d-flex justify-content-start mb-3"> 
  <a class="btn btn-sm btn-two" href="<?php echo BASE_ADMIN.'planos-premium/listar';?>"><i class="fas fa-arrow-left me-2"></i>Planos Premium</a>  
</div>


<div class="card card-form shadow">
    <div class="card-body">

        <form id="premium-adicionar" class="row" autocomplete="off"> 
            <div class="form-group col-12">
                <label class="form-label-light">Título</label>
                <input type="text" class="form-control" name="premium_titulo">
            </div>
            <div class="form-group col-12">
                <label class="form-label-light">Preço</label>
                <input type="text" class="form-control preco" name="premium_preco">
            </div>
            <div class="form-group col-12">
                <label class="form-label-light">Quantidade dias de acesso</label>
                <input type="text" class="form-control numero-3" name="premium_dias_acesso">
            </div>
            <div class="form-group col-12">
                <label class="form-label-light">Quantidade de telas simultâneas</label>
                <input type="text" class="form-control numero-3" name="premium_telas">
            </div>
            <div class="form-group col-12">
                <label class="form-label-light">Quantidade de créditos a serem consumidos do revendedor</label>
                <input type="text" class="form-control numero-3" name="premium_consumo_creditos_revendedor">
            </div>
            <div class="form-group col-12 mb-2">
            <label class="form-label-light">Premium Característica</label>
                <div class="input-group">
                    <input type="text" name="premium_caracteristica[]" class="form-control">
                    <span class="input-group-text mais cursor-pointer"><i class="fas fa-plus-circle"></i></span>
                </div>
            </div>
            <div class="plano_mais"></div> 
            <div class="form-group col-12 mt-2"> 
                <input type="hidden" name="acao" value="adicionar">
                <button type="submit" class="btn btn-four"><i class="fas fa-sign-in me-2"></i>Adicionar</button>
            </div>
        </form>
    
    </div>
</div>    

<?php require_once $_SERVER['DOCUMENT_ROOT'].'/admin/footer.php';?>
 
<script>
    $(".mais").on("click", function(){
        $(".plano_mais").append(p_html());
    });
    function p_html(count){
        var html = '';
        html += '<div class="col-12 form-group">';
        html += '<label class="form-label-light">Adicionar Outra Característica</label>';
        html += '<div class="input-group">';
        html += '<input type="text" name="premium_caracteristica[]" class="form-control">';
        html += '<span class="input-group-text menos cursor-pointer"><i class="fas fa-trash"></i></span>';
        html += '</div>';
        html += '</div>';
        $(".plano_mais").append(html);
        remove();
        
    }
    function remove(){
        $(".menos").on("click", function(){
            $(this).parent().parent().html("");
        });
    }
    $("#premium-adicionar").on("submit", function(e) {
      e.preventDefault(); 
      admin_submit_form(this, "planos_premium.php");
    });
</script>



</div>
</div>
</body>
</html>