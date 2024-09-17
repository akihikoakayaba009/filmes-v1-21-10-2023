<?php 
require_once $_SERVER['DOCUMENT_ROOT'].'/controller/admin/admin_controller.php';
$page_title = 'Adicionar Código Monetização';
require_once $_SERVER['DOCUMENT_ROOT'].'/admin/header.php'; 
?> 

<div class="card shadow card-header-title mb-3"> 
    <h1>Adicionar Código Monetização</h1>
    <small>Você pode adicionar códigos html e javascript.</small> 
</div> 

<div class="d-flex justify-content-start mb-3"> 
  <a class="btn btn-sm btn-two" href="<?php echo BASE_ADMIN.'monetizacao/listar';?>"><i class="fas fa-arrow-left me-2"></i>Monetizações</a>  
</div>

<div class="card card-form shadow">
    <div class="card-body">

        <form id="form-monetizacao-adicionar" class="row" autocomplete="off"> 
            <div class="form-group col-12">
                <label class="form-label-light">Título</label>
                <input type="text" class="form-control" name="monetizacao_titulo">
            </div>
            <div class="form-group col-12">
                <label class="form-label-light">Código Html/Javascript</label>
                <textarea class="form-control" rows="8" name="monetizacao_codigo"></textarea>
            </div>
            <div class="form-group col-12">
                <label class="form-label-light">Posição</label>
                <select class="form-select" name="monetizacao_posicao">
                    <option value="" selected disabled>Selecione uma opção</option>
                    <option value="head">Adicionar Dentro da Tag &lt;head&gt;&lt;/head&gt;</option>
                </select>
            </div>
            <div class="form-group col-12"> 
                <input type="hidden" name="acao" value="adicionar">
                <button type="submit" class="btn btn-four"><i class="fas fa-sign-in me-2"></i>Adicionar</button>
            </div>
        </form>

    </div>
</div>

<?php require_once $_SERVER['DOCUMENT_ROOT'].'/admin/footer.php';?>
 
<script>
    $("#form-monetizacao-adicionar").on("submit", function(e) {
      e.preventDefault(); 
      admin_submit_form(this, "site_monetizacao.php");
    });
</script>



</div>
</div>
</body>
</html>