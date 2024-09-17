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

$page_title = 'Episódios '.midia_tipo_single_title($res['midia_tipo']);
require_once $_SERVER['DOCUMENT_ROOT'].'/admin/header.php'; 
?> 

 
<div class="card shadow card-header-title"> 
    <h1><?php echo $page_title;?></h1>
    <small>Total de episódios: <?php echo contar_episodios($_GET['midia_id']);?></small> 
</div> 


<div class="d-flex justify-content-between"> 
  <a class="btn btn-two btn-sm" href="<?php echo BASE_ADMIN.'midia/'.$_GET['midia_tipo'].'/'.$_GET['midia_id'].'/temporadas/listar';?>"><i class="fas fa-arrow-left me-2"></i>Temporadas</a>  
  <a class="btn btn-two btn-sm" href="<?php echo BASE_ADMIN.'midia/'.$_GET['midia_tipo'].'/'.$_GET['midia_id'].'/temporada/'.$temp['temporada_id'].'/episodio/adicionar';?>"><i class="fas fa-sign-in me-2"></i>Novo Episódio</a>  
</div>


<div class="d-flex justify-content-center align-items-center flex-column mb-3">
    <img src="<?php echo exibir_image_upload_or_url(BASE_IMAGES_MIDIA_PATCH, BASE_IMAGES_MIDIA_URL,$res['midia_image']);?>" class="image-midia-lista">
    <small class="d-block"><?php echo $res['midia_titulo'];?></small>
    <small class="d-block"><?php echo 'Temporada: ' . $temp['temporada_titulo'];?> </small>
</div>

<div class="card card-form shadow">
  <div class="card-body">
 
    <div class="table-responsive"> 
        <table class="w-100 table border" id="dataTable">
          <div class="table-responsive">
          <thead>
            <tr> 
              <th>Imagem</th>
              <th>Episódio</th>
              <th>Título</th>
              <th>Visualizações</th>
              <th>Temporada</th>
              <th>N° Players</th>
              <th>Listar Players</th>
              <th>Editar</th> 
              <th>Excluir</th>
            </tr> 
          </thead>  
          <tbody> 
              <?php foreach(listar_episodios($temp['temporada_id'], $res['midia_id']) as $item):?> 
                <tr>
                  <td>
                  <img src="<?php echo !empty($item['episodio_image']) ? exibir_image_upload_or_url(BASE_IMAGES_EPISODIOS_PATCH , BASE_IMAGES_EPISODIOS_URL, $item['episodio_image']) : exibir_image_upload_or_url(BASE_IMAGES_EPISODIOS_PATCH, BASE_IMAGES_EPISODIOS_URL, SITE_EPISODIOS_IMAGE);?>" class="image-episodio-list">
                  </td>
                  <td><?php echo 'Episódio ' . $item['episodio_numero'];?></td>
                  <td><?php echo !empty($item['episodio_titulo']) ? $item['episodio_titulo'] : 'Não informado';?></td>
                  <td><?php echo get_visualizacoes_episodio($item['episodio_midia_id'], $item['episodio_temporada_id'], $item['episodio_id']);?></td>
                  <td><?php echo $temp['temporada_titulo'];?></td> 
                  <td><?php echo contar_players_por_episodio($_GET['midia_id'], $item['episodio_id']);?></td>
                  <td><a class="btn btn-sm btn-five" title="Listar Players" href="<?php echo BASE_ADMIN.'midia/'.$_GET['midia_tipo'].'/'.$_GET['midia_id'].'/temporada/'.$temp['temporada_id'].'/episodio/'.$item['episodio_id'].'/players/listar';?>">
                        <i class="fa fa-play me-2"></i>Players
                    </a>
                  </td>
                  <td><a class="btn btn-sm btn-three" title="Editar" href="<?php echo BASE_ADMIN.'midia/'.$_GET['midia_tipo'].'/'.$_GET['midia_id'].'/temporada/'.$_GET['temporada_id'].'/episodio/'.$item['episodio_id'].'/editar';?>">
                        <i class="fa fa-pencil me-2"></i>Editar
                    </a>
                  </td>
                  <td><button data-id="<?php echo $item['episodio_id'];?>"
                              data-titulo="<?php echo $item['episodio_titulo'];?>"
                              class="btn btn-sm btn-four btn-excluir"  
                              data-bs-toggle="modal" 
                              data-bs-target="#modal-excluir" 
                              title="Excluir"><i class="fa fa-trash me-2"></i>Excluir
                      </button>
                  </td>
                </tr> 
              <?php endforeach;?> 
          </tbody>
        </table>
      </div> 

  </div>
</div>  


<!-- Modal Excluir -->
<div class="modal fade" id="modal-excluir" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5 modal-excluir-title">Excluir</h1>
        <button class="btn modal-close-btn" type="button" data-bs-dismiss="modal"><i class="fas fa-times"></i></button>
      </div>
      <form id="form-excluir">
            <div class="modal-body d-flex justify-content-center align-items-center flex-column">
                <p class="txt-excluir-title">Tem certeza que deseja excluir ?</p>
                <p class="txt-excluir-title text-excluir-1">O Episódio</p>
                <p class="txt-excluir-title text-excluir-2"></p>
                <p class="txt-excluir-title text-center text-excluir-1 text-warning text-alert">Os players serão excluídos se hover.</p>
            </div>
            <div class="modal-footer">
                <input type="hidden" name="episodio_id">
                <input type="hidden" name="acao" value="excluir">
                <input type="hidden" name="midia_id" value="<?php echo $_GET['midia_id'];?>">
                <input type="hidden" name="temporada_id" value="<?php echo $_GET['temporada_id'];?>">
                <input type="hidden" name="midia_tipo" value="<?php echo $_GET['midia_tipo'];?>">
                <button type="button" class="btn btn-sm btn-1" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-sm btn-3">Excluir</button>
            </div>
      </form>
    </div>
  </div>
</div> 


<?php require_once $_SERVER['DOCUMENT_ROOT'].'/admin/footer.php';?>
 
<script>
     $("#dataTable").on("click", ".btn-excluir", function(){
        $(".text-excluir-2").html($(this).attr("data-titulo"));
        $("input[name=episodio_id]").val($(this).attr("data-id"));
    }); 
    $("#form-excluir").on("submit", function(e) {
      e.preventDefault();
      admin_submit_form(this, "midia_episodios.php");
    });
</script>

</div>
</div> 
</body>
</html>