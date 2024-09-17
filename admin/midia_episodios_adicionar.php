<?php 
require_once $_SERVER['DOCUMENT_ROOT'].'/controller/admin/admin_controller.php';

if(!isset($_GET['midia_id']) OR !intval($_GET['midia_id']) OR !isset($_GET['midia_tipo']) OR !isset($_GET['temporada_id']) OR !intval($_GET['temporada_id']) OR
   !midia_tipo($_GET['midia_tipo']) OR empty(get_midia_por_id($_GET['midia_id'], $_GET['midia_tipo'])) OR 
    empty(get_temporada_por_id($_GET['temporada_id'], $_GET['midia_id']))){
    die(header("Location:".BASE_ADMIN));
} 

if($_GET['midia_tipo']  != 'serie' && $_GET['midia_tipo'] != 'anime' && $_GET['midia_tipo'] != 'novela'){
    die(header("Location:".BASE_ADMIN));
}
 
$res  = get_midia_por_id($_GET['midia_id'], $_GET['midia_tipo']);
$temp = get_temporada_por_id($_GET['temporada_id'], $_GET['midia_id']);

$page_title = 'Adicionar Episódio '.midia_tipo_single_title($res['midia_tipo']);
require_once $_SERVER['DOCUMENT_ROOT'].'/admin/header.php'; 
?>


<div class="card shadow card-header-title"> 
    <h1><?php echo $page_title;?></h1>
    <small>Total de episódios nesta temporada: <?php echo  contar_episodios_por_temporada($_GET['midia_id'], $_GET['temporada_id']) ;?></small> 
</div> 

<div class="d-flex justify-content-start"> 
    <a class="btn btn-two btn-sm" href="<?php echo BASE_ADMIN.'midia/'.$_GET['midia_tipo'].'/'.$_GET['midia_id'].'/temporada/'.$_GET['temporada_id'].'/episodios/listar';?>"><i class="fas fa-arrow-left me-2"></i>Episódios</a> 
</div>

<div class="d-flex justify-content-center align-items-center flex-column mb-3">
    <img src="<?php echo exibir_image_upload_or_url(BASE_IMAGES_MIDIA_PATCH, BASE_IMAGES_MIDIA_URL,$res['midia_image']);?>" class="image-midia-lista">
    <small class="d-block"><?php echo $res['midia_titulo'];?></small>
    <small class="d-block"><?php echo 'Temporada: ' . $temp['temporada_titulo'];?> </small>
</div>

<div class="card card-form shadow">
  <div class="card-body"> 

<form class="row" id="form-episodios" autocomplete="off" enctype="multipart/form-data">
    <div class="col-12 col-md-8 col-lg-9 order-2 order-md-1">
        <div class="row">
            <div class="form-group col-12 col-lg-6">
                <label class="form-label-light">Título (opcional)</label>
                <input type="text" class="form-control" name="episodio_titulo">
            </div> 
            <div class="form-group col-12 col-lg-6">
                        <label class="form-label-light">Número Episódio (Ex: 1)</label>
                        <input type="number" class="form-control" name="episodio_numero" min="1">
                </div> 
            <div class="form-group col-12">
                <label class="form-label-light">Descrição (Opcional)</label>
                <textarea class="form-control" rows="6" name="episodio_descricao"></textarea>
            </div>    
        </div> 
    </div>
    <div class="col-12 col-md-4 col-lg-3 mt-0 mt-lg-5 mt-md-5 order-1 order-md-2">
       <div class="text-center">
            <label for="image" class="cursor-pointer">
                <img src="<?php echo exibir_image_upload_or_url(BASE_IMAGES_EPISODIOS_PATCH,BASE_IMAGES_EPISODIOS_URL,SITE_EPISODIOS_IMAGE);?>" class="image-episodio-change load-image-on-change">
                <small class="d-block">Adicionar Imagem 300x170 (Opcional)</small> 
            </label> 
       </div>
    </div>
    <div class="col-12 order-3">
        <input type="file" class="d-none input-image-change" name="episodio_image" id="image">
        <input type="hidden" name="acao" value="adicionar">
        <input type="hidden" name="midia_id" value="<?php echo $_GET['midia_id'];?>">
        <input type="hidden" name="temporada_id" value="<?php echo $_GET['temporada_id'];?>">
        <input type="hidden" name="midia_tipo" value="<?php echo $_GET['midia_tipo'];?>">
        <button type="submit" class="btn btn-four"><i class="fas fa-sign-in me-2"></i>Adicionar</button>
    </div>  
</form>

</div>
</div>



<?php require_once $_SERVER['DOCUMENT_ROOT'].'/admin/footer.php';?>
 
<script>
    $("#form-episodios").on("submit", function(e) {
      e.preventDefault();
      admin_submit_form(this, "midia_episodios.php");
    });
</script>



</div>
</div> 
</body>
</html>