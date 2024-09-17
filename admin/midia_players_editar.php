<?php 
require_once $_SERVER['DOCUMENT_ROOT'].'/controller/admin/admin_controller.php';

  if(!isset($_GET['midia_id']) OR !intval($_GET['midia_id']) OR !isset($_GET['midia_tipo']) OR 
     !isset($_GET['episodio_id']) OR !isset($_GET['player_id']) OR !midia_tipo($_GET['midia_tipo']) OR empty(get_midia_por_id($_GET['midia_id'], $_GET['midia_tipo']))){
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

  if(!intval($_GET['player_id']) OR empty(get_player_por_id($_GET['midia_id'], $_GET['temporada_id'], $_GET['episodio_id'], $_GET['player_id']))){
    die(header("Location:".BASE_ADMIN.'midia/'.$_GET['midia_tipo'].'/'.$_GET['midia_id'].'/temporada/'.$_GET['temporada_id'].'/episodio/'.$_GET['episodio_id'].'/players/listar'));
  }

  $play = get_player_por_id($_GET['midia_id'], $_GET['temporada_id'], $_GET['episodio_id'], $_GET['player_id']);

$page_title = 'Adicionar Player '.midia_tipo_single_title($res['midia_tipo']);
require_once $_SERVER['DOCUMENT_ROOT'].'/admin/header.php'; 
?>


<div class="card shadow card-header-title"> 
    <h1><?php echo $page_title;?></h1>
    <small>Player premium somente usuários premium terão acesso.</small> 
</div>  

<div class="d-flex justify-content-start">
    <a class="btn btn-two btn-sm" href="<?php echo BASE_ADMIN.'midia/'.$_GET['midia_tipo'].'/'.$_GET['midia_id'].'/temporada/'.$_GET['temporada_id'].'/episodio/'.$_GET['episodio_id'].'/players/listar';?>"><i class="fas fa-arrow-left me-2"></i>Players</a> 
</div>

<div class="d-flex justify-content-center align-items-center flex-column mb-3">
        <img src="<?php echo exibir_image_upload_or_url(BASE_IMAGES_MIDIA_PATCH, BASE_IMAGES_MIDIA_URL,$res['midia_image']);?>" class="image-midia-lista">
        <small class="d-block"><?php echo $res['midia_titulo'];?></small>
    <?php if(isset($temp)):?>
        <small class="d-block"><?php echo 'Temporada: ' . $temp['temporada_titulo'];?></small>
        <small class="d-block"><?php echo 'Episódio N° ' . $ep['episodio_numero'];?> </small>
    <?php endif;?>
</div>


<div class="card card-form shadow">
  <div class="card-body">

<form class="row" id="form-players-editar" autocomplete="off">
    <div class="form-group col-12">
        <label class="form-label-light">Título (opcional)</label>
        <input type="text" class="form-control" name="player_titulo" value="<?php echo $play['player_titulo'];?>">
    </div>    
    <div class="form-group col-12">
        <label class="form-label-light">Duração (Ex: 01:45:00 hora/minutos/segundos)</label>
        <input type="text" class="form-control duracao" name="player_duracao" value="<?php echo $play['player_duracao'];?>">
    </div>
    <div class="form-group col-12">
        <label class="form-label-light">Url (Mp4/Iframe/M3u8)</label>
        <input type="text" class="form-control" name="player_url" value="<?php echo $play['player_url'];?>">
    </div>
    <div class="form-group col-12 col-md-6">
    <hr>        
        <div><label class="form-label-light mb-2">Tipo de Player (Selecione uma opção)</label></div>
        <div class="form-check form-check-inline">
            <input class="form-check-input mt-0 me-2" type="radio" name="player_tipo" value="iframe" id="iframe"
            <?php echo $play['player_tipo'] == 'iframe' ? 'checked' : '';?>>
            <label class="form-label-light cursor-pointer" for="iframe">
                Iframe/Embed
            </label>
        </div>    
        <div class="form-check form-check-inline">
            <input class="form-check-input mt-0 me-2" type="radio" name="player_tipo" value="mp4" id="mp4"
            <?php echo $play['player_tipo'] == 'mp4' ? 'checked' : '';?>>
            <label class="form-label-light cursor-pointer" for="mp4">
                Mp4
            </label>
        </div>   
        <div class="form-check form-check-inline">
            <input class="form-check-input mt-0 me-2" type="radio" name="player_tipo" value="m3u8" id="m3u8"
            <?php echo $play['player_tipo'] == 'm3u8' ? 'checked' : '';?>>
            <label class="form-label-light cursor-pointer" for="m3u8">
                M3u8
            </label>
        </div>       
    </div>
    <div class="form-group col-12 col-md-6">
    <hr>      
        <div><label class="form-label-light mb-2">Aúdio (Selecione uma opção)</label></div>
        <div class="form-check form-check-inline">
            <input class="form-check-input mt-0 me-2" type="radio" name="player_audio" value="dublado" id="dublado"
            <?php echo $play['player_audio'] == 'dublado' ? 'checked' : '';?>>
            <label class="form-label-light cursor-pointer" for="dublado">
                Dublado
            </label>
        </div>    
        <div class="form-check form-check-inline">
            <input class="form-check-input mt-0 me-2" type="radio" name="player_audio" value="legendado" id="legendado"
            <?php echo $play['player_audio'] == 'legendado' ? 'checked' : '';?>>
            <label class="form-label-light cursor-pointer" for="legendado">
                Legendado
            </label>
        </div>   
           
    </div>
    <div class="form-group col-12">
    <hr>      
        <div><label class="form-label-light mb-2">Acesso Ao Player (Grátis: Todos os usuários podem assistir.) (Premium: Somente usuários com um plano ativo podem assistir.)</label></div>
        <div class="form-check form-check-inline">
            <input class="form-check-input mt-0 me-2" type="radio" name="player_acesso" value="premium" id="premium"
            <?php echo $play['player_acesso'] == 'premium' ? 'checked' : '';?>>
            <label class="form-label-light cursor-pointer" for="premium">
                Acesso Premium
            </label>
        </div>    
        <div class="form-check form-check-inline">
            <input class="form-check-input mt-0 me-2" type="radio" name="player_acesso" value="gratis" id="gratis"
            <?php echo $play['player_acesso'] == 'gratis' ? 'checked' : '';?>>
            <label class="form-label-light cursor-pointer" for="gratis">
                Acesso Grátis
            </label>
        </div>   
    <hr>          
    </div> 
    <div class="col-12">
        <input type="file" class="d-none input-image-change" name="episodio_image" id="image">
        <input type="hidden" name="acao" value="editar">
        <input type="hidden" name="midia_id" value="<?php echo $_GET['midia_id'];?>">
        <input type="hidden" name="temporada_id" value="<?php echo $_GET['temporada_id'];?>">
        <input type="hidden" name="midia_tipo" value="<?php echo $_GET['midia_tipo'];?>">
        <input type="hidden" name="episodio_id" value="<?php echo $_GET['episodio_id'];?>">
        <input type="hidden" name="player_id" value="<?php echo $_GET['player_id'];?>"> 
        <button type="submit" class="btn btn-four"><i class="fas fa-sign-in me-2"></i>Editar</button>
    </div>  
</form>

    </div>
</div>
 

<?php require_once $_SERVER['DOCUMENT_ROOT'].'/admin/footer.php';?>
 
<script>
    $("#form-players-editar").on("submit", function(e) {
      e.preventDefault();
      admin_submit_form(this, "midia_players.php"); 
    });
</script>

 

</div>
</div> 
</body>
</html>