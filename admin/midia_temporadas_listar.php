<?php 
require_once $_SERVER['DOCUMENT_ROOT'].'/controller/admin/admin_controller.php';

if(!isset($_GET['midia_id']) OR !intval($_GET['midia_id']) OR !isset($_GET['midia_tipo']) OR !midia_tipo($_GET['midia_tipo']) OR empty(get_midia_por_id($_GET['midia_id'], $_GET['midia_tipo']))){
  die(header("Location:".BASE_ADMIN));
}

if($_GET['midia_tipo']  != 'serie' && $_GET['midia_tipo'] != 'anime' && $_GET['midia_tipo'] != 'novela'){
  die(header("Location:".BASE_ADMIN));
} 
 
$res  = get_midia_por_id($_GET['midia_id'], $_GET['midia_tipo']);
  
$page_title = 'Temporadas '.midia_tipo_single_title($res['midia_tipo']);
require_once $_SERVER['DOCUMENT_ROOT'].'/admin/header.php'; 
?>


<div class="card shadow card-header-title"> 
    <h1><?php echo $page_title;?></h1>
    <small>Total de temporadas: <?php echo contar_temporadas($_GET['midia_id']);?></small> 
</div> 
 

<div class="d-flex justify-content-between"> 
  <a class="btn btn-two btn-sm" href="<?php echo BASE_ADMIN.'midia/'.$_GET['midia_tipo'].'/listar';?>"><i class="fas fa-arrow-left me-2"></i><?php echo midia_tipo_plural_title($_GET['midia_tipo']);?></a>  
  <a class="btn btn-two btn-sm" href="<?php echo BASE_ADMIN.'midia/'.$res['midia_tipo'].'/'.$res['midia_id'].'/temporada/adicionar';?>"><i class="fas fa-sign-in me-2"></i>Nova Temporada</a>  
</div>

<div class="d-flex justify-content-center align-items-center flex-column mb-3">
    <img src="<?php echo exibir_image_upload_or_url(BASE_IMAGES_MIDIA_PATCH, BASE_IMAGES_MIDIA_URL,$res['midia_image']);?>" class="image-midia-lista">
    <small class="d-block"><?php echo $res['midia_titulo'];?></small>
</div> 

<div class="card card-form shadow">
  <div class="card-body">

    <div class="table-responsive mt-3"> 
        <table class="w-100 table border" id="dataTable">
          <div class="table-responsive">
          <thead>
            <tr> 
              <th>Título</th>
              <th>Visualizacões</th>
              <th>N° Episódios</th>
              <th>Listar Episódios</th>
              <th>Editar</th>
              <th>Excluir</th>
            </tr> 
          </thead>  
          <tbody> 
              <?php foreach(listar_temporadas($res['midia_id']) as $item):?> 
                <tr>
                  <td><?php echo $item['temporada_titulo'];?></td>
                  <td><?php echo get_visualizacoes_temporada($item['temporada_midia_id'], $item['temporada_id']);?></td>
                  <td><?php echo contar_episodios_por_temporada($_GET['midia_id'],$item['temporada_id']);?></td>
                  <td><a class="btn btn-sm btn-five" title="Listar Episódios" href="<?php echo BASE_ADMIN.'midia/'.$_GET['midia_tipo'].'/'.$_GET['midia_id'].'/temporada/'.$item['temporada_id'].'/episodios/listar';?>">
                        <i class="fa fa-play me-2"></i>Episódios
                    </a>
                  </td>
                  <td><a class="btn btn-sm btn-three" title="Editar" href="<?php echo BASE_ADMIN.'midia/'.$_GET['midia_tipo'].'/'.$_GET['midia_id'].'/temporada/'.$item['temporada_id'].'/editar';?>">
                        <i class="fa fa-pencil me-2"></i>Editar
                    </a>
                  </td>
                  <td><button data-id="<?php echo $item['temporada_id'];?>"
                              data-titulo="<?php echo $item['temporada_titulo'];?>"
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
                <p class="txt-excluir-title text-excluir-1">A Temporada</p>
                <p class="txt-excluir-title text-excluir-2"></p> 
                <p class="txt-excluir-title text-center text-excluir-1 text-warning text-alert">Episódios e players serão excluídos se hover.</p>
            </div>
            <div class="modal-footer">
                <input type="hidden" name="temporada_id">
                <input type="hidden" name="acao" value="excluir">
                <input type="hidden" name="midia_id" value="<?php echo $_GET['midia_id'];?>">
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
        $("input[name=temporada_id]").val($(this).attr("data-id"));
    }); 
    $("#form-excluir").on("submit", function(e) {
      e.preventDefault();
      admin_submit_form(this, "midia_temporadas.php");
    });
</script>

</div>
</div> 
</body>
</html>