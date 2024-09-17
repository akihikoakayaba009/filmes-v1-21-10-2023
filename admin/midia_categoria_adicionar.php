<?php 
require_once $_SERVER['DOCUMENT_ROOT'].'/controller/admin/admin_controller.php';
$page_title = 'Adicionar Categoria';
require_once $_SERVER['DOCUMENT_ROOT'].'/admin/header.php'; 
?>

<div class="card shadow card-header-title"> 
    <h1>Adicionar Nova Categoria</h1>
    <small>A imagem e a descrição são opcionais.</small> 
</div>

<div class="d-flex justify-content-start align-items-start mb-3">
  <a class="btn btn-two btn-sm" href="<?php echo BASE_ADMIN.'midia/categoria/listar';?>"><i class="fas fa-arrow-left me-2"></i>Categorias</a>  
</div>

<div class="card card-form shadow">
    <div class="card-body">
        <form id="adicionar-categoria" class="row" autocomplete="off" enctype="multipart/form-data">
            <div class="text-center">
                <label for="image" class="cursor-pointer">
                    <img src="<?php echo exibir_image_upload_or_url(BASE_IMAGES_CATEGORIAS_PATCH,BASE_IMAGES_CATEGORIAS_URL,SITE_CATEGORIA_IMAGE);?>" class="image-categoria-change load-image-on-change">
                    <small class="text-two d-block">Imagem 300x170 (Opcional)</small>
                </label>
            </div> 
            <div class="form-group col-12">
                <label class="form-label-light">Título Da Categoria</label>
                <input type="text" class="form-control" name="categoria_titulo">
            </div>
            <div class="form-group col-12">
                <label class="form-label-light">Descrição Da categoria (opcional)</label>
                <textarea class="form-control" name="categoria_descricao" rows="4"></textarea>
            </div>
            <div class="form-group col-12">
                <label class="form-label-light">Categoria Para (ex: filmes,séries,animes,canais,novelas)</label>
                <select name="categoria_para" id="categoria_para" class="form-select">
                    <option value="" selected disabled>Selecione Uma Opção</option>
                    <option value="anime">Animes</option>
                    <option value="canal">Canais</option>
                    <option value="filme">Filmes</option>
                    <option value="infantil">Infantis</option>
                    <option value="novela">Novelas</option>
                    <option value="serie">Séries</option>
                </select>
            </div>
            <div class="form-group col-12">
                <input type="file" class="d-none input-image-change" name="categoria_image" id="image">
                <input type="hidden" name="acao" value="adicionar-categoria">
                <button type="submit" class="btn btn-four"><i class="fas fa-sign-in me-2"></i>Adicionar</button>
            </div>
        </form> 
    </div>
</div>

<?php require_once $_SERVER['DOCUMENT_ROOT'].'/admin/footer.php';?>
 
<script>
    $("#adicionar-categoria").on("submit", function(e) {
      e.preventDefault();
      admin_submit_form(this, "midia_categorias.php");
    });
</script>


</div>
</div>
</body>
</html>