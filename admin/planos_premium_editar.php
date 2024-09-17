<?php 
require_once $_SERVER['DOCUMENT_ROOT'].'/controller/admin/admin_controller.php';

if(!isset($_GET['premium_id']) OR !intval($_GET['premium_id']) OR empty(get_plano_premium_por_id($_GET['premium_id']))){
    die(header("Location:".BASE_ADMIN.'planos-premium/listar'));
} 
$res = get_plano_premium_por_id($_GET['premium_id']);
$page_title = 'Editar Plano Premium';
require_once $_SERVER['DOCUMENT_ROOT'].'/admin/header.php'; 
?>

<div class="card shadow card-header-title"> 
    <h1><?php echo $page_title;?></h1>
    <small>Plano Premium: <?php echo $res['premium_titulo'];?>.</small> 
</div> 

<div class="d-flex justify-content-start align-items-start mb-3">
  <a class="btn btn-sm btn-two" href="<?php echo BASE_ADMIN.'planos-premium/listar';?>"><i class="fas fa-arrow-left me-2"></i>Planos Premium</a>  
</div> 


<div class="card card-form shadow">
    <div class="card-body">

        <form id="plano-premium-editar" class="row" autocomplete="off"> 
            <div class="form-group col-12">
                <label class="form-label-light">Título</label>
                <input type="text" class="form-control" name="premium_titulo" value="<?php echo $res['premium_titulo'];?>">
            </div>
            <div class="form-group col-12">
                <label class="form-label-light">Preço</label>
                <input type="text" class="form-control preco" name="premium_preco" value="<?php echo $res['premium_preco'];?>">
            </div>
            <div class="form-group col-12">
                <label class="form-label-light">Quantidade dias de acesso</label>
                <input type="text" class="form-control numero-3" name="premium_dias_acesso" value="<?php echo $res['premium_dias_acesso'];?>">
            </div>
            <div class="form-group col-12">
                <label class="form-label-light">Quantidade de telas simultâneas</label>
                <input type="text" class="form-control numero-3" name="premium_telas" value="<?php echo $res['premium_telas'];?>">
            </div>
            <div class="form-group col-12">
                <label class="form-label-light">Quantidade de créditos a serem consumidos do revendedor</label>
                <input type="text" class="form-control numero-3" name="premium_consumo_creditos_revendedor" value="<?php echo $res['premium_consumo_creditos_revendedor'];?>">
            </div>
            <?php $a = 0;?>
            <?php foreach(explode("<::>", $res['premium_caracteristica']) as $item):?>
            <?php if($a++ == 0):?>
                <div class="form-group col-12">
                <label class="form-label-light">Premium Característica</label>
                    <div class="input-group">
                        <input type="text" name="premium_caracteristica[]" class="form-control" value="<?php echo $item;?>">
                        <span class="input-group-text cursor-pointer mais"><i class="fas fa-plus-circle"></i></span>
                    </div>
                </div>
            <?php else:?>
                <div class="form-group col-12">
                <label class="form-label-light">Premium Característica</label>
                    <div class="input-group">
                        <input type="text" name="premium_caracteristica[]" class="form-control" value="<?php echo $item;?>">
                        <span class="input-group-text cursor-pointer menos"><i class="fas fa-trash"></i></span>
                    </div>
                </div>
            <?php endif;?>    
            <?php endforeach;?>
            <div class="plano_mais"></div>
            <div class="form-group col-12"> 
                <input type="hidden" name="premium_id" value="<?php echo $_GET['premium_id'];?>">
                <input type="hidden" name="acao" value="editar">
                <button type="submit" class="btn btn-four"><i class="fas fa-sign-in me-2"></i>Editar</button>
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
        html += '<div class="form-group col-12 remove">';
        html += '<label class="form-label-light">Adicionar Outra Característica</label>';
        html += '<div class="input-group">';   
        html += '<input type="text" name="premium_caracteristica[]" class="form-control">';
        html += '<span class="input-group-text cursor-pointer menos"><i class="fas fa-trash"></i></span>';
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
    remove();
    $("#plano-premium-editar").on("submit", function(e) {
      e.preventDefault(); 
      admin_submit_form(this, "planos_premium.php");
    });
</script>

 

</div>
</div>
</body>
</html>