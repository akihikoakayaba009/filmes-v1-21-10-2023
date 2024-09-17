<?php 
require_once $_SERVER['DOCUMENT_ROOT'].'/controller/admin/admin_controller.php';

if(!isset($_GET['midia_id']) OR !intval($_GET['midia_id']) OR !isset($_GET['midia_tipo']) OR !isset($_GET['temporada_id']) OR !intval($_GET['temporada_id']) OR
   !midia_tipo($_GET['midia_tipo']) OR empty(get_midia_por_id($_GET['midia_id'], $_GET['midia_tipo'])) OR empty(get_temporada_por_id($_GET['temporada_id'], $_GET['midia_id']))){
    die(header("Location:".BASE_ADMIN));
} 

if($_GET['midia_tipo']  != 'serie' && $_GET['midia_tipo'] != 'anime' && $_GET['midia_tipo'] != 'novela'){
    die(header("Location:".BASE_ADMIN));
}

$res  = get_midia_por_id($_GET['midia_id'], $_GET['midia_tipo']);
$temp = get_temporada_por_id($_GET['temporada_id'], $_GET['midia_id']);

$page_title = 'Editar Temporada '.midia_tipo_single_title($res['midia_tipo']);
require_once $_SERVER['DOCUMENT_ROOT'].'/admin/header.php'; 
?>

<div class="card shadow card-header-title"> 
    <h1><?php echo $page_title;?></h1>
    <small>Total de temporada: <?php echo  contar_temporadas($_GET['midia_id']) ;?></small> 
</div> 

<div class="d-flex justify-content-start align-items-start"> 
  <a class="btn btn-two btn-sm" href="<?php echo BASE_ADMIN.'midia/'.$res['midia_tipo'].'/'.$res['midia_id'].'/temporadas/listar';?>"><i class="fas fa-arrow-left me-2"></i>Temporadas</a>  
</div>

<div class="d-flex justify-content-center align-items-center flex-column mb-3">
    <img src="<?php echo exibir_image_upload_or_url(BASE_IMAGES_MIDIA_PATCH, BASE_IMAGES_MIDIA_URL,$res['midia_image']);?>" class="image-midia-lista">
    <small class="d-block"><?php echo $res['midia_titulo'];?></small>
</div>

<div class="card card-form shadow">
  <div class="card-body"> 

    <form class="row" id="form-temporadas" autocomplete="off">
        <div class="form-group col-12">
            <label class="form-label-light">Título da temporada (Ex: 1º Temporada)</label>
            <input type="text" class="form-control" name="temporada_titulo" value="<?php echo $temp['temporada_titulo'];?>">
        </div>
        <div class="form-group col-12">
            <input type="hidden" name="acao" value="editar">
            <input type="hidden" name="temporada_id" value="<?php echo $temp['temporada_id'];?>">
            <input type="hidden" name="midia_id" value="<?php echo $res['midia_id'];?>">
            <input type="hidden" name="midia_tipo" value="<?php echo $res['midia_tipo'];?>">
            <button type="submit" class="btn btn-four"><i class="fas fa-sign-in me-2"></i>Editar</button>
        </div>
    </form>

    </div>
</div>



<?php require_once $_SERVER['DOCUMENT_ROOT'].'/admin/footer.php';?>
 
<script>
    $("#form-temporadas").on("submit", function(e) {
      e.preventDefault();
      admin_submit_form(this, "midia_temporadas.php");
    });
</script>



</div>
</div> 
</body>
</html>