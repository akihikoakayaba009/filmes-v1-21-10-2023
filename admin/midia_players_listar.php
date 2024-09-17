<?php 
require_once $_SERVER['DOCUMENT_ROOT'].'/controller/admin/admin_controller.php';

if(!isset($_GET['midia_id']) OR !intval($_GET['midia_id']) OR !isset($_GET['midia_tipo']) OR  !midia_tipo($_GET['midia_tipo']) OR empty(get_midia_por_id($_GET['midia_id'], $_GET['midia_tipo']))){
  die(header("Location:".BASE_ADMIN));
}

if($_GET['midia_tipo'] == 'filme' OR $_GET['midia_tipo'] == 'canal' OR $_GET['midia_tipo'] == 'infantil'){
  if($_GET['temporada_id'] != 0 OR $_GET['episodio_id'] != 0){
    die(header("Location:".BASE_ADMIN.'midia/'.$_GET['midia_tipo'].'/listar'));
  }  
}

  $res  = get_midia_por_id($_GET['midia_id'], $_GET['midia_tipo']);
  

if($_GET['midia_tipo']  == 'serie' OR $_GET['midia_tipo'] == 'anime' OR $_GET['midia_tipo'] == 'novela'){
  if(!intval($_GET['temporada_id']) OR !intval($_GET['episodio_id'])){
    die(header("Location:".BASE_ADMIN.'midia/'.$_GET['midia_tipo'].'/listar'));
  }
  if(empty(get_temporada_por_id($_GET['temporada_id'], $_GET['midia_id'])) OR empty(get_episodio_por_id($_GET['temporada_id'], $_GET['midia_id'], $_GET['episodio_id']))){
    die(header("Location:".BASE_ADMIN.'midia/'.$_GET['midia_tipo'].'/listar'));
  }
  $temp = get_temporada_por_id($_GET['temporada_id'], $_GET['midia_id']);
  $ep   = get_episodio_por_id($_GET['temporada_id'], $_GET['midia_id'], $_GET['episodio_id']);
}

$page_title = 'Players '.midia_tipo_single_title($res['midia_tipo']);
require_once $_SERVER['DOCUMENT_ROOT'].'/admin/header.php'; 
?>

<div class="card shadow card-header-title"> 
    <h1><?php echo $page_title;?></h1>
    <small>Total de players: <?php echo contar_players($_GET['midia_id']);?></small> 
</div> 

<div class="d-flex justify-content-between">
    <?php if(isset($temp)):?>
      <a class="btn btn-two btn-sm" href="<?php echo BASE_ADMIN.'midia/'.$_GET['midia_tipo'].'/'.$_GET['midia_id'].'/temporada/'.$_GET['temporada_id'].'/episodios/listar';?>"><i class="fas fa-arrow-left me-2"></i>Episódios</a> 
    <?php else:?>
      <a class="btn btn-two btn-sm" href="<?php echo BASE_ADMIN.'midia/'.$_GET['midia_tipo'].'/listar';?>"><i class="fas fa-arrow-left me-2"></i><?php echo midia_tipo_plural_title($_GET['midia_tipo']);?></a> 
    <?php endif;?>  
    <a class="btn btn-two btn-sm" href="<?php echo BASE_ADMIN.'midia/'.$_GET['midia_tipo'].'/'.$_GET['midia_id'].'/temporada/'.$_GET['temporada_id'].'/episodio/'.$_GET['episodio_id'].'/player/adicionar';?>"><i class="fas fa-sign-in me-2"></i>Novo Player</a>  
</div>

<div class="d-flex justify-content-center align-items-center flex-column mb-3">
      <img src="<?php echo exibir_image_upload_or_url(BASE_IMAGES_MIDIA_PATCH, BASE_IMAGES_MIDIA_URL,$res['midia_image']);?>" class="image-midia-lista">
      <small class="d-block"><?php echo $res['midia_titulo'];?> </small>
    <?php if(isset($temp)):?>
      <small class="d-block"><?php echo 'Temporada: ' . $temp['temporada_titulo'];?> </small>
      <small class="d-block"><?php echo 'Episódio N° ' . $ep['episodio_numero'];?> </small>
    <?php endif;?>
</div>     

<div class="card card-form shadow">
  <div class="card-body">

      <div class="table-responsive"> 
          <table class="w-100 table border" id="dataTable">
            <div class="table-responsive">
            <thead>
              <tr> 
                <th>Título</th>
                <th>Visualizações</th>
                <th>Aúdio</th>
                <th>Duração</th>
                <th>Acesso</th>
                <th>Editar</th>
                <th>Excluir</th>
              </tr> 
            </thead>   
            <tbody> 
                <?php foreach(listar_players($_GET['midia_id'], $_GET['temporada_id'], $_GET['episodio_id']) as $item):?> 
                  <tr>
                    <td><?php echo !empty($item['player_titulo']) ? $item['player_titulo'] : 'Sem título';?></td>
                    <td><?php echo $item['player_visualizacoes'];?></td>
                    <td><?php echo ($item['player_audio'] == 'dublado' ? 'Dublado' : ($item['player_audio'] == 'legendado' ? 'Legendado' : ''));?></td>
                    <td><?php echo !empty($item['player_duracao']) ? $item['player_duracao'] : '';?></td>
                    <td><?php echo ($item['player_acesso'] == 'gratis' ? 'Grátis' : ($item['player_acesso'] == 'premium' ? 'Premium' : 'Error'));?></td>
                    <td><a class="btn btn-sm btn-three" title="Editar" href="<?php echo BASE_ADMIN.'midia/'.$_GET['midia_tipo'].'/'.$_GET['midia_id'].'/temporada/'.$_GET['temporada_id'].'/episodio/'.$_GET['episodio_id'].'/player/'.$item['player_id'].'/editar';?>">
                          <i class="fa fa-pencil me-2"></i>Editar
                      </a>
                    </td>
                    <td><button data-id="<?php echo $item['player_id'];?>"
                                data-titulo="<?php echo $item['player_titulo'];?>"
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
      <form id="form-excluir-player">
            <div class="modal-body d-flex justify-content-center align-items-center flex-column">
                <p class="txt-excluir-title">Tem certeza que deseja excluir ?</p>
                <p class="txt-excluir-title text-excluir-1">O Player</p>
                <p class="txt-excluir-title text-excluir-2"></p>
            </div>
            <div class="modal-footer">
                <input type="hidden" name="player_id">
                <input type="hidden" name="episodio_id" value="<?php echo $_GET['episodio_id'];?>">
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
        $("input[name=player_id]").val($(this).attr("data-id"));
    }); 
    $("#form-excluir-player").on("submit", function(e) {
      e.preventDefault();
      admin_submit_form(this, "midia_players.php");
    });
</script>

</div>
</div> 
</body>
</html>