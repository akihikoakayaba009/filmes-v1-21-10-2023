<?php 
require_once $_SERVER['DOCUMENT_ROOT'].'/controller/admin/admin_controller.php';

$page_title = "Planos Premium"; 
require_once $_SERVER['DOCUMENT_ROOT'].'/admin/header.php'; 
?>

<div class="card shadow card-header-title"> 
    <h1><?php echo $page_title;?></h1>
    <small>Total de planos: <?php echo contar_plano_premium();?></small> 
</div> 

<div class="d-flex justify-content-end mb-3"> 
  <a class="btn btn-sm btn-two" href="<?php echo BASE_ADMIN.'planos-premium/adicionar';?>"><i class="fas fa-sign-in me-2"></i>Adicionar Plano</a>  
</div>


<div class="card card-form shadow">
    <div class="card-body">

        <div class="table-responsive"> 
            <table class="w-100 table border display responsive nowrap" id="dataTable">
                <div class="table-responsive">
                <thead>
                <tr>
                    <th>Título</th>
                    <th>Preço</th>
                    <th>Telas</th>
                    <th>Dias de acesso</th>
                    <th>Editar</th>
                    <th>Excluir</th>
                </tr> 
                </thead>
                <tbody> 
                    <?php foreach(listar_plano_premium() as $item):?> 
                    <tr> 
                        <td><?php echo $item['premium_titulo'];?></td> 
                        <td>R$ <?php echo $item['premium_preco'];?></td> 
                        <td><?php echo $item['premium_telas'];?></td> 
                        <td><?php echo $item['premium_dias_acesso'];?></td> 
                        <td>
                            <a class="btn btn-sm btn-three btn-3" title="Editar" href="<?php echo BASE_ADMIN.'planos-premium/premium/'.$item['premium_id'].'/editar';?>"><i class="fa fa-pencil me-2"></i>Editar</a>
                        </td>
                        <td> 
                            <button data-id="<?php echo $item['premium_id'];?>"
                                    data-titulo="<?php echo $item['premium_titulo'];?>"
                                    class="btn btn-sm btn-four btn-excluir" 
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
    <form id="form-excluir-plano">
            <div class="modal-body d-flex justify-content-center align-items-center flex-column">
                <p class="txt-excluir-title">Tem certeza que deseja excluir ?</p>
                <p class="txt-excluir-title text-excluir-1">O plano</p>
                <p class="txt-excluir-title text-excluir-2"></p>
                <p class="txt-excluir-title text-center text-excluir-1 text-warning text-alert"></p>
            </div>
            <div class="modal-footer">
                <input type="hidden" name="premium_id">
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
        $("input[name=premium_id]").val($(this).attr("data-id"));
    }); 
    $("#form-excluir-plano").on("submit", function(e) {
      e.preventDefault();
      admin_submit_form(this, "planos_premium.php"); 
    });
</script>

 

</div>
</div> 
</body>
</html> 