<?php 
require_once $_SERVER['DOCUMENT_ROOT'].'/controller/admin/admin_controller.php';

if(!isset($_GET['monetizacao_id']) OR !intval($_GET['monetizacao_id'])){
    die(header("Location:".BASE_ADMIN.'monetizacao'.'/listar')); 
}
$res = get_monetizacao_por_id($_GET['monetizacao_id']);
$page_title = 'Editar Código Monetização';
require_once $_SERVER['DOCUMENT_ROOT'].'/admin/header.php'; 
?>

<div class="card shadow card-header-title mb-3"> 
    <h1>Editar Código Monetização</h1>
    <small><?php echo $res['monetizacao_titulo'];?>.</small> 
</div> 

<div class="d-flex justify-content-start mb-3"> 
  <a class="btn btn-sm btn-two" href="<?php echo BASE_ADMIN.'monetizacao/listar';?>"><i class="fas fa-arrow-left me-2"></i>Monetizações</a>  
</div>

<div class="card card-form shadow">
    <div class="card-body">

        <form id="form-monetizacao-editar" class="row" autocomplete="off"> 
            <div class="form-group col-12">
                <label class="form-label-light">Título</label>
                <input type="text" class="form-control" name="monetizacao_titulo" value="<?php echo $res['monetizacao_titulo'];?>">
            </div>
            <div class="form-group col-12">
                <label class="form-label-light">Código Html/Javascript</label>
                <textarea class="form-control" rows="8" name="monetizacao_codigo"><?php echo $res['monetizacao_codigo'];?></textarea>
            </div>
            <div class="form-group col-12">
                <label class="form-label-light">Posição</label>
                <select class="form-select" name="monetizacao_posicao">
                    <option value="" disabled>Selecione uma opção</option>
                    <?php if($res['monetizacao_posicao'] == 'head'):?>
                        <option value="head" selected>Adicionar Dentro da Tag &lt;head&gt;&lt;/head&gt;</option>    
                    <?php endif;?>    
                </select>
            </div>
            <div class="form-group col-12"> 
                <input type="hidden" name="acao" value="editar">
                <input type="hidden" name="monetizacao_id" value="<?php echo $_GET['monetizacao_id'];?>">
                <button type="submit" class="btn btn-four"><i class="fas fa-sign-in me-2"></i>Editar</button>
            </div>
        </form>
        
    </div>
</div>

<?php require_once $_SERVER['DOCUMENT_ROOT'].'/admin/footer.php';?>
 
<script>
    $("#form-monetizacao-editar").on("submit", function(e) {
      e.preventDefault(); 
      admin_submit_form(this, "site_monetizacao.php");
    });
</script>



</div>
</div>
</body>
</html>