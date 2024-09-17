<?php 
require_once $_SERVER['DOCUMENT_ROOT'].'/controller/admin/admin_controller.php';

if(!isset($_GET['midia_tipo']) OR empty($_GET['midia_tipo']) OR !midia_tipo($_GET['midia_tipo'])){
    die(header("Location:".BASE_ADMIN));
}
$page_title = "Listando " .midia_tipo_plural_title($_GET['midia_tipo']); 
require_once $_SERVER['DOCUMENT_ROOT'].'/admin/header.php'; 
?>

<div class="card shadow card-header-title"> 
    <h1><?php echo $page_title;?></h1>
    <small>Total de <?php echo midia_tipo_plural_title($_GET['midia_tipo']) . ' ' . contar_midia_por_tipo($_GET['midia_tipo']);?> </small> 
</div>

<div class="d-flex justify-content-end mb-3">
  <a class="btn btn-two btn-sm" href="<?php echo BASE_ADMIN.'midia/'.$_GET['midia_tipo'].'/adicionar';?>"><i class="fas fa-sign-in me-2"></i>Adicionar <?php echo midia_tipo_single_title($_GET['midia_tipo']);?></a>  
</div>



 

<div class="card card-form shadow">
    <div class="card-body">

        <div class="table-responsive"> 
            <table class="w-100 table border display responsive nowrap" id="dataTable">
                <div class="table-responsive">
                <thead>
                <tr>
                    <th>Imagem</th>  
                    <th>Título</th>
                    <th>Visualizacões</th>
                    <?php if($_GET['midia_tipo'] == 'serie' OR $_GET['midia_tipo'] == 'novela' OR $_GET['midia_tipo'] == 'anime'):?>
                        <th>N° Temporadas</th>
                        <th>N° Episódios</th>
                        <th>N° Players</th>
                        <th>Listar Temporadas</th>
                    <?php elseif($_GET['midia_tipo'] == 'filme' OR $_GET['midia_tipo'] == 'canal' OR $_GET['midia_tipo'] == 'infantil'):?>
                        <th>N° Players</th>
                        <th>Listar Players</th>                
                    <?php endif;?>    
                    <th>Editar</th>
                    <th>Excluir</th>
                </tr> 
                </thead>
                <tbody> 
                    <?php foreach(listar_midia($_GET['midia_tipo']) as $item):?> 
                    <tr> 
                        <td> 
                        <img src="<?php echo exibir_image_upload_or_url(BASE_IMAGES_MIDIA_PATCH, BASE_IMAGES_MIDIA_URL, $item['midia_image']);?>" class="image-midia-lista">
                        </td> 
                        <td><?php echo $item['midia_titulo'];?></td> 
                        <td><?php echo get_visualizacoes_midia($item['midia_id']);?></td>
                        
                        <?php if($_GET['midia_tipo'] == 'serie' OR $_GET['midia_tipo'] == 'novela' OR $_GET['midia_tipo'] == 'anime'): ?>
                            <td><?php echo contar_temporadas($item['midia_id']);?></td>
                            <td><?php echo contar_episodios($item['midia_id']);?></td>
                            <td><?php echo contar_players($item['midia_id']);?></td>
                            <td>
                                <a class="btn btn-sm btn-five" title="Listar Temporadas" href="<?php echo BASE_ADMIN.'midia/'.$item['midia_tipo'].'/'.$item['midia_id'].'/temporadas/listar';?>"><i class="fa fa-list me-2"></i>Temporadas</a>
                            </td>
                        <?php elseif($_GET['midia_tipo'] == 'filme' OR $_GET['midia_tipo'] == 'canal' OR $_GET['midia_tipo'] == 'infantil'):?>
                            <td><?php echo contar_players($item['midia_id']);?></td>
                            <td>
                                <a class="btn btn-sm btn-five" title="Listar Players" href="<?php echo BASE_ADMIN.'midia/'.$item['midia_tipo'].'/'.$item['midia_id'].'/temporada/0/episodio/0/players/listar';?>"><i class="fa fa-list me-2"></i>Players</a>
                            </td>    
                        <?php endif;?>    
                        <td>
                            <a class="btn btn-sm btn-three" title="Editar" href="<?php echo BASE_ADMIN.'midia/'.$item['midia_tipo'].'/'.$item['midia_id'].'/editar';?>"><i class="fa fa-pencil me-2"></i>Editar</a>
                        </td>
                        <td> 
                            <button data-id="<?php echo $item['midia_id'];?>"
                                    data-titulo="<?php echo $item['midia_titulo'];?>"
                                    data-image="<?php echo exibir_image_upload_or_url(BASE_IMAGES_MIDIA_PATCH, BASE_IMAGES_MIDIA_URL, $item['midia_image']);?>"  
                                    class="btn btn-sm btn-four btn-excluir" 
                                    data-tipo="<?php echo $item['midia_tipo'];?>" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#modal-excluir" 
                                    title="Excluir">
                                    <i class="fa fa-trash me-2"></i>Excluir 
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
    <form id="form-excluir-midia">
            <div class="modal-body d-flex justify-content-center align-items-center flex-column">
                <div class="text-center"><img src="" class="img-excluir midia-listar mb-1"></div>
                <p class="txt-excluir-title">Tem certeza que deseja excluir ?</p>
                <p class="txt-excluir-title text-excluir-1">A mídia</p>
                <p class="txt-excluir-title text-excluir-2"></p>
                <p class="txt-excluir-title text-center text-excluir-1 text-warning text-alert"></p>
            </div>
            <div class="modal-footer">
                <input type="hidden" name="midia_id">
                <input type="hidden" name="midia_tipo" value="<?php echo $_GET['midia_tipo'];?>">
                <input type="hidden" name="acao" value="excluir">
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
        $(".img-excluir").attr("src", $(this).attr("data-image"));
        $("input[name=midia_id]").val($(this).attr("data-id"));
        if($(this).attr("data-tipo") == 'serie' || $(this).attr("data-tipo") == 'anime' || $(this).attr("data-tipo") == 'novela'){
            $(".text-alert").html("Temporadas, episódios e players serão excluídos se hover.");
        }
        if($(this).attr("data-tipo") == 'filme' || $(this).attr("data-tipo") == 'infantil' || $(this).attr("data-tipo") == 'canal'){
            $(".text-alert").html("Os players serão excluídos se houver.");
        }
    });
    $("#form-excluir-midia").on("submit", function(e) {
      e.preventDefault();
      admin_submit_form(this, "midia.php"); 
    });
</script>

 

</div>
</div> 
</body>
</html> 