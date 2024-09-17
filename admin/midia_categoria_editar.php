<?php 
require_once $_SERVER['DOCUMENT_ROOT'].'/controller/admin/admin_controller.php';
if(!isset($_GET['categoria_para']) OR !midia_tipo($_GET['categoria_para']) OR 
   !isset($_GET['categoria_id']) OR !intval($_GET['categoria_id']) OR 
   empty(get_categoria_por_id($_GET['categoria_para'], $_GET['categoria_id']))){
    die(header("Location:".BASE_ADMIN.'midia/categoria/listar'));    
}

$res = get_categoria_por_id($_GET['categoria_para'], $_GET['categoria_id']);

$page_title = 'Editar Categoria Para '.midia_tipo_plural_title($res['categoria_para']);
require_once $_SERVER['DOCUMENT_ROOT'].'/admin/header.php'; 
?>

<div class="card shadow card-header-title"> 
    <h1>Editar Categoria</h1>
    <small>Categoria Para: <?php echo midia_tipo_plural_title($res['categoria_para']);?>. Título: <?php echo $res['categoria_titulo'];?></small> 
</div>

<div class="d-flex justify-content-start align-items-start mb-3">
  <a class="btn btn-two btn-sm" href="<?php echo BASE_ADMIN.'midia/categoria/listar';?>"><i class="fas fa-arrow-left me-2"></i>Categorias</a>  
</div>

<div class="card card-form shadow">
    <div class="card-body">

        <form id="adicionar-categoria" class="row" autocomplete="off" enctype="multipart/form-data">
            <div class="text-center">
                <label for="image" class="cursor-pointer">
                    <img src="<?php echo !empty($res['categoria_image']) ? exibir_image_upload_or_url(BASE_IMAGES_CATEGORIAS_PATCH,BASE_IMAGES_CATEGORIAS_URL,$res['categoria_image']) : exibir_image_upload_or_url(BASE_IMAGES_CATEGORIAS_PATCH,BASE_IMAGES_CATEGORIAS_URL,SITE_CATEGORIA_IMAGE);?>" 
                         class="image-categoria-change load-image-on-change">
                    <small class="text-two d-block">Imagem 300x170 (Opcional)</small> 
                </label>   
            </div> 
            <div class="form-group col-12">
                <label class="form-label-light">Título Da Categoria</label>
                <input type="text" class="form-control" name="categoria_titulo" value="<?php echo $res['categoria_titulo'];?>">
            </div>
            <div class="form-group col-12">
                <label class="form-label-light">Descrição Da categoria (opcional)</label>
                <textarea class="form-control" name="categoria_descricao" rows="4"><?php echo $res['categoria_descricao'];?></textarea>
            </div>
            <div class="form-group col-12">
                <label class="form-label-light">Categoria Para (ex: filmes,séries,animes,canais,novelas)</label>
                <select name="categoria_para" id="categoria_para" class="form-select">
                    <option value="anime" <?php echo $res['categoria_para'] == 'anime' ? 'selected' : '';?>>Animes</option>
                    <option value="canal" <?php echo $res['categoria_para'] == 'canal' ? 'selected' : '';?>>Canais</option>
                    <option value="filme" <?php echo $res['categoria_para'] == 'filme' ? 'selected' : '';?>>Filmes</option>
                    <option value="infantil" <?php echo $res['categoria_para'] == 'infantil' ? 'selected' : '';?>>Infantis</option>
                    <option value="novela" <?php echo $res['categoria_para'] == 'novela' ? 'selected' : '';?>>Novelas</option>
                    <option value="serie" <?php echo $res['categoria_para'] == 'serie' ? 'selected' : '';?>>Séries</option>
                </select>
            </div>
            <?php if(!empty($res['categoria_image'])):?>
            <div class="form-group col-12">
            <hr class="mt-0">     
                <label class="form-label-light mb-2">Selecione para remover a imagem</label>    
                <div class="form-check"> 
                    <input class="form-check-input mt-0" name="remover_image" type="checkbox" id="remover_image">
                    <label class="form-check-label ms-2 cursor-pointer" for="remover_image">
                        Remover a imagem desta categoria
                    </label>
                </div>
            <hr>     
            </div>
            <?php endif;?>
            <div class="form-group col-12">
                <input type="file" class="d-none input-image-change" name="categoria_image" id="image">
                <input type="hidden" name="categoria_id" value="<?php echo $res['categoria_id'];?>">
                <input type="hidden" name="acao" value="editar-categoria">
                <button type="submit" class="btn btn-four"><i class="fas fa-sign-in me-2"></i>Editar</button>
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