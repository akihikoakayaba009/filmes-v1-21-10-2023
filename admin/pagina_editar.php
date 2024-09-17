<?php 
require_once $_SERVER['DOCUMENT_ROOT'].'/controller/admin/admin_controller.php';

if(!isset($_GET['pagina_id']) OR !intval($_GET['pagina_id']) OR empty(get_pagina_por_id($_GET['pagina_id']))){
    die(header("Location:".BASE_ADMIN.'pagina/listar'));
}
$pg = get_pagina_por_id($_GET['pagina_id']);

$page_title = 'Editar Página';
require_once $_SERVER['DOCUMENT_ROOT'].'/admin/header.php'; 
?>

<div class="card shadow card-header-title"> 
    <h1><?php echo $page_title;?></h1>
    <small><?php echo $pg['pagina_titulo'];?>.</small> 
</div> 

<div class="d-flex justify-content-start align-items-start mb-3">
  <a class="btn btn-1 btn-two" href="<?php echo BASE_ADMIN.'pagina/listar';?>"><i class="fas fa-arrow-left me-2"></i>Páginas</a>  
</div>


<div class="card card-form shadow">
    <div class="card-body">
        <form id="adicionar-pagina" class="row" autocomplete="off" enctype="multipart/form-data">
            <div class="form-group col-12">
                <label class="form-label-light">Titulo</label>
                <input type="text" class="form-control" name="pagina_titulo" value="<?php echo $pg['pagina_titulo'];?>">
            </div>
            <div class="form-group col-12">
                <label class="form-label-light">Conteúdo da página</label>
                <textarea name="pagina_conteudo" id="ckeditor" class="form__textarea"><?php echo $pg['pagina_conteudo'];?></textarea>
            </div>
            <div class="form-group col-12"> 
                <input type="hidden" name="acao" value="editar">
                <input type="hidden" name="pagina_id" value="<?php echo $pg['pagina_id'];?>">
                <button type="submit" class="btn btn-four"><i class="fas fa-sign-in me-2"></i>Editar</button>
            </div>
        </form> 
    </div>
</div>

<?php require_once $_SERVER['DOCUMENT_ROOT'].'/admin/footer.php';?>

<script src="<?php echo BASE_CKEDITOR;?>ckeditor.js"></script>
<script src="<?php echo BASE_CKEDITOR;?>plugins/codesnippet/lib/highlight/highlight.pack.js"></script>

<script type="text/javascript">
        
        $('.form__textarea').each(function () {
            CKEDITOR.replace($(this).prop('id'),{
                extraPlugins: 'codesnippet',
                codeSnippet_theme: 'monokai_sublime',
                height: 400,
                filebrowserUploadUrl: '<?php echo BASE_CKEDITOR_UPLOADS;?>',
                filebrowserUploadMethod: 'form',
            });
        });               

        $("#adicionar-pagina").on("submit", function(e) {
            e.preventDefault();
            admin_submit_form(this, "paginas.php");
        });
</script>



</div>
</div>
</body>
</html>