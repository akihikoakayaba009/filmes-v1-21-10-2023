<?php 
require_once $_SERVER['DOCUMENT_ROOT'].'/controller/admin/admin_controller.php';
if(!isset($_GET['midia_tipo']) OR !midia_tipo($_GET['midia_tipo']) OR !isset($_GET['midia_id']) OR !intval($_GET['midia_id']) OR empty(get_midia_por_id($_GET['midia_id'], $_GET['midia_tipo']))){
    die(header("Location:".BASE_ADMIN));
}
$res = get_midia_por_id($_GET['midia_id'], $_GET['midia_tipo']);
$page_title = 'Editar ' . midia_tipo_single_title($_GET['midia_tipo']);
require_once $_SERVER['DOCUMENT_ROOT'].'/admin/header.php'; 
?>

<div class="card shadow card-header-title"> 
    <h1><?php echo 'Editar ' .midia_tipo_single_title($_GET['midia_tipo']);?></h1>
    <small><?php echo $res['midia_titulo'];?></small> 
</div>

<div class="d-flex justify-content-between mb-4"> 
<a class="btn btn-two btn-sm" href="<?php echo BASE_ADMIN.'midia/'.$_GET['midia_tipo'].'/listar';?>"><i class="fas fa-arrow-left me-2"></i><?php echo midia_tipo_plural_title($_GET['midia_tipo']);?></a>  
<button class="btn btn-two btn-sm" type="button" data-bs-toggle="modal" data-bs-target="#modal-tmdb"><i class="fas fa-arrow-circle-down me-2"></i>Tmdb</button> 
</div>



<div class="card card-form shadow"> 
    <div class="card-body">

    <!-- NAV TABS -->
    <ul class="nav nav-tabs tabs-three">
        <li class="nav-item">
            <button type="button" class="btn btn-sm" data-bs-toggle="tab" data-bs-target="#tab-informacoes" aria-expanded="false">Informações</button>
        </li>
        <li class="nav-item">
            <button type="button" class="btn btn-sm" data-bs-toggle="tab" data-bs-target="#tab-categorias" aria-expanded="false">Categorias</button>
        </li>
        <li class="nav-item">
            <button type="button" class="btn btn-sm" data-bs-toggle="tab" data-bs-target="#tab-images" aria-expanded="false">Imagens</button>
        </li>
    </ul>

    <!-- TABS -->
    <form id="adicionar-midia" autocomplete="off" enctype="multipart/form-data">
    <div class="tab-content mt-3" id="tab-content">
        
            <!-- TAB INFORMACOES-->
            <div class="tab-pane fade active show" id="tab-informacoes">
                <div class="row">
                        <!-- ITEM --> 
                        <div class="form-group col-12">
                            <label class="form-label-light">Título</label>
                            <input type="text" name="midia_titulo" class="form-control" value="<?php echo $res['midia_titulo'];?>">
                        </div>
                        <!-- ITEM --> 
                        <div class="form-group col-12 col-lg-6">
                            <label class="form-label-light">Avaliação (Porcentagem 1% a 99% Opcional)</label>
                            <input type="text" name="midia_avaliacao" class="form-control avaliacao" value="<?php echo $res['midia_avaliacao'];?>">
                        </div>
                        <!-- ITEM --> 
                        <div class="form-group col-12 col-lg-6">
                            <label class="form-label-light">Ano (Opcional)</label>
                            <input type="text" name="midia_ano" class="form-control ano" value="<?php echo $res['midia_ano'];?>">
                        </div>
                        <!-- ITEM --> 
                        <div class="form-group col-12 col-lg-6">
                            <label class="form-label-light">Url Imagem (Url png/jpg)</label>
                            <input type="text" name="midia_image_url" class="form-control" value="<?php echo filter_var($res['midia_image'],FILTER_VALIDATE_URL) ? $res['midia_image'] : '';?>">
                        </div>
                        <!-- ITEM --> 
                        <div class="form-group col-12 col-lg-6">
                            <label class="form-label-light">Url Background (Url png/jpg)</label>
                            <input type="text" name="midia_background_url" class="form-control" value="<?php echo filter_var($res['midia_background'],FILTER_VALIDATE_URL) ? $res['midia_background'] : '';?>">
                        </div>
                        <!-- ITEM --> 
                        <div class="form-group col-12 col-lg-12">
                            <label class="form-label-light">Trailer (Url Embed/Iframe Opcional)</label>
                            <input type="text" name="midia_trailer" class="form-control" value="<?php echo $res['midia_trailer'];?>">
                        </div>
                        <!-- ITEM -->  
                        <div class="form-group col-12">
                            <label class="form-label-light">Sinopse</label>
                            <textarea class="form-control d-block" name="midia_sinopse"><?php echo $res['midia_sinopse'];?></textarea>
                        </div>
                        <!-- ITEM --> 
                        <div class="form-group col-12">
                            <input type="hidden" name="acao" value="midia-editar">
                            <input type="hidden" name="midia_tipo" value="<?php echo $res['midia_tipo'];?>">
                            <input type="hidden" name="midia_tmdb" value="<?php echo $res['midia_tmdb'];?>">
                            <input type="hidden" name="midia_id" value="<?php echo $res['midia_id'];?>">
                            <button type="submit" class="btn btn-four"><i class="fas fa-sign-in me-2"></i>Editar</button>
                        </div>
                        <!-- ITEM --> 
                </div>
            </div>
            <!-- TAB CATEGORIAS-->
            <div class="tab-pane" id="tab-categorias">
                <!-- ITEM -->  
                <?php if(count(listar_categoria_por_tipo($_GET['midia_tipo'])) > 0):?>
                <ul class="list-group midia-categorias-list">
                    <?php foreach(listar_categoria_por_tipo($_GET['midia_tipo']) as $cat):?>
                    <?php $a = explode(",", $res['midia_categoria']);?>
                    <?php if(in_array($cat['categoria_id'], $a)):?>
                        <label class="list-group-item d-flex justify-content-start align-items-center cursor-pointer" for="<?php echo $cat['categoria_diretorio'];?>">
                            <input class="form-check-input mb-0 mt-0 me-3" type="checkbox" checked name="midia_categoria[]" value="<?php echo $cat['categoria_id'];?>" id="<?php echo $cat['categoria_diretorio'];?>">
                            <small><?php echo $cat['categoria_titulo'];?></small>
                        </label> 
                    <?php else:?>
                        <label class="list-group-item d-flex justify-content-start align-items-center cursor-pointer" for="<?php echo $cat['categoria_diretorio'];?>">
                            <input class="form-check-input mb-0 mt-0 me-3" type="checkbox" name="midia_categoria[]" value="<?php echo $cat['categoria_id'];?>" id="<?php echo $cat['categoria_diretorio'];?>">
                            <small><?php echo $cat['categoria_titulo'];?></small>
                        </label> 
                    <?php endif;?>    
                    <?php endforeach;?> 
                </ul>
                <?php else:?>
                    <small class="d-block">Crie uma categoria para <?php echo midia_tipo_plural_title($_GET['midia_tipo']);?> antes de tentar adicionar.</small>
                <?php endif;?>   
                <!-- ITEM --> 
            </div>
            <!-- TAB IMAGES-->
            <div class="tab-pane" id="tab-images">
                <!-- ITEM -->
                <div class="row">
                    <div class="col-12 col-md-4 col-lg-4 mb-3">
                        <div class="text-center mt-2 mt-md-5">
                        <label for="image" class="cursor-pointer text-center">
                            <img src="<?php echo !empty($res['midia_image']) ? exibir_image_upload_or_url(BASE_IMAGES_MIDIA_PATCH, BASE_IMAGES_MIDIA_URL,$res['midia_image']) : BASE_IMAGES_MIDIA_URL.'midia_background_330x220.png';?>" class="image-midia-change img-fluid load-image-on-change">
                            <small class="d-block">Upload Imagem</small>
                            <small class="d-block">220 Largura x 330 Altura</small>
                            <input type="file" class="d-none input-image-change" name="midia_image_upload" id="image">
                        </label>
                        </div> 
                    </div>
                    <div class="col-12 col-md-8 col-lg-8">
                        <label for="image-two" class="cursor-pointer text-center">
                            <img src="<?php echo !empty($res['midia_background']) ? exibir_image_upload_or_url(BASE_IMAGES_MIDIA_PATCH, BASE_IMAGES_MIDIA_URL,$res['midia_background']) : BASE_IMAGES_MIDIA_URL.'midia_background_1000x450.png';?>" class="img-fluid midia-background-mil load-image-on-change-two">
                            <small class="d-block">Upload Background</small> 
                            <small class="d-block">1000 Largura x 450 Altura</small>
                            <input type="file" class="d-none input-image-change-two" name="midia_background_upload" id="image-two">
                        </label>
                    </div>
                </div>
                <?php if(!empty($res['midia_background'])):?>
                <!-- ITEM -->
                <div class="form-group col-12 mt-3">
                    <hr class="mt-0">     
                        <label class="form-label-light">Selecione para remover o background</label>    
                        <div class="form-check">  
                            <input class="form-check-input me-2" name="remover_image" type="checkbox" id="remover_image">
                            <label class="form-check-label cursor-pointer" for="remover_image">
                                Remover o background desta mídia
                            </label>
                        </div>
                    <hr>     
                </div>  
                <!-- ITEM -->  
                <?php endif;?>

            </div>
        
    </div>
    <!-- TABS --> 
    </form>


    </div>
</div>

<!-- Modal Tmdb -->
<div class="modal fade" id="modal-tmdb" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5 modal-tmdb-title">Tmdb Importador</h1>
        <button class="btn modal-close-btn" type="button" data-bs-dismiss="modal"><i class="fas fa-times"></i></button>
      </div>
      <form id="form-tmdb" autocomplete="off">
            <div class="modal-body">
               <div class="text-center">
                    <p class="form-label-light mb-0">Para importar informações da mídia. Acesse <a href="https://www.themoviedb.org/" target="_BLANK">TMDB</a></p>
                    <p class="form-label-light mb-0">Escolha um filme série ou anime, click e copie o id na url.</p>
                    <p class="form-label-light mb-0">O id é somente números.</p>
               </div> 
               <label class="form-label-light">Id <?php echo midia_tipo_single_title($_GET['midia_tipo']);?></label>
               <input type="text" class="form-control midia_tmdb" name="item_id" value="<?php echo $res['midia_tmdb'];?>">
            </div>
            <div class="modal-footer"> 
                <input type="hidden" name="acao" value="<?php echo ($_GET['midia_tipo'] == 'infantil' ? 'filme' : ($_GET['midia_tipo'] == 'canal' ? 'filme' : ($_GET['midia_tipo'] == 'filme'))) ? 'filme' : 'serie' ;?>">
                <button type="button" class="btn btn-sm btn-1" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-sm btn-3">Importar</button>
            </div>
      </form>
    </div>
  </div>
</div> 
 
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/admin/footer.php';?>
<script>
    $("#image").on("change", function(){
        if($(this).val() == ''){
            $(".load-image-on-change").attr("src", '<?php echo exibir_image_upload_or_url(BASE_IMAGES_MIDIA_PATCH, BASE_IMAGES_MIDIA_URL,'midia_background.png');?>');
        }else{
            $("input[name=midia_image_url]").val("");
        }
    });
    $("#image-two").on("change", function(){
        if($(this).val() == ''){
            $(".load-image-on-change-two").attr("src", '<?php echo exibir_image_upload_or_url(BASE_IMAGES_MIDIA_PATCH, BASE_IMAGES_MIDIA_URL,SITE_MIDIA_BACKGROUND);?>');
        }else{
            $("input[name=midia_background_url]").val("");
        }
    });
    $("input[name=midia_image_url]").on("change", function(){
        if($(this).val() !== ""){
            $(".load-image-on-change").attr("src",$(this).val());
        }else{
            $(".load-image-on-change").attr("src", '<?php echo exibir_image_upload_or_url(BASE_IMAGES_MIDIA_PATCH, BASE_IMAGES_MIDIA_URL,'midia_background.png');?>');
        }
    });
    $("input[name=midia_background_url]").on("change", function(){
        if($(this).val() !== ""){
            $(".load-image-on-change-two").attr("src",$(this).val());
        }else{
            $(".load-image-on-change-two").attr("src", '<?php echo exibir_image_upload_or_url(BASE_IMAGES_MIDIA_PATCH, BASE_IMAGES_MIDIA_URL,SITE_MIDIA_BACKGROUND);?>');
        }
    });
    $("#form-tmdb").on("submit", function(e){
        e.preventDefault();
        $.ajax({
            url: SITE_URL+"/controller/admin/tmdb.php?ajax=ajax",
            method: "POST",
            data: $(this).serialize(),
            beforeSend: function(){
                var myModalEl = document.getElementById('modal-tmdb');
                var modal = bootstrap.Modal.getInstance(myModalEl);
                modal.hide();
                ajax_processando();
            },
            success: function(res){
                swal.close();
                try{
                   var item = JSON.parse(res);    
                   if(item.status != 'error'){
                        $("input[name=midia_titulo]").val(item.title);
                        $("textarea[name=midia_sinopse]").val(item.description);
                        $("input[name=midia_image_url]").val(item.image);
                        $(".load-image-on-change").attr("src", item.image);
                        $("input[name=midia_trailer]").val(item.trailer);
                        $("input[name=midia_ano]").val(item.year);
                        $("input[name=midia_avaliacao]").val(item.note);
                        $("input[name=midia_image_upload]").val("");
                        $("input[name=midia_tmdb]").val(item.tmdb_id);
                        $("input[name=midia_background_url]").val(item.background);
                        $(".load-image-on-change-two").attr("src", item.background);
                   }else{
                        ajax_error(item.msg);
                   }  
 
                }catch(e){
                   ajax_error("Ocorreu um erro. Tente novamente.");     
                }
            },
            error: function(){
                ajax_error("Página não encontrada.");
            }

        })
    });
    $("#adicionar-midia").on("submit", function(e) {
      e.preventDefault();
      admin_submit_form(this, "midia.php");
    });
</script>


</div>
</div>
</body>
</html>  