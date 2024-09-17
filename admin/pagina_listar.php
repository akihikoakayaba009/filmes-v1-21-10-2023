<?php 
require_once $_SERVER['DOCUMENT_ROOT'].'/controller/admin/admin_controller.php';
$page_title = 'Páginas';
require_once $_SERVER['DOCUMENT_ROOT'].'/admin/header.php'; 
?>

<div class="card shadow card-header-title"> 
    <h1>Páginas</h1>
    <small>Total de páginas: <?php echo count(listar_pagina());?></small> 
</div>  

<div class="d-flex justify-content-end align-items-end mb-3">
  <a class="btn btn-sm btn-two" href="<?php echo BASE_ADMIN.'pagina/adicionar';?>"><i class="fas fa-sign-in me-2"></i>Adicionar Página</a>  
</div>

<div class="card card-form shadow">
  <div class="card-body">

        <div class="table-responsive"> 
        <table class="w-100 table border" id="dataTable">
          <div class="table-responsive">
          <thead>
            <tr>
              <th>Título</th>
              <th>Editar</th>
              <th>Excluir</th>
            </tr>  
          </thead> 
          <tbody> 
              <?php foreach(listar_pagina() as $item):?>
                <tr>
                  <td><?php echo $item['pagina_titulo'];?></td> 
                  <td><a class="btn btn-sm btn-three " title="Editar" href="<?php echo BASE_ADMIN.'pagina/editar/'.$item['pagina_id'];?>"><i class="fa fa-pencil me-2"></i>Editar</a></td>
                  <td><button data-id="<?php echo $item['pagina_id'];?>"
                              data-titulo="<?php echo $item['pagina_titulo'];?>" 
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
                <p class="txt-excluir-title">Tem certeza que deseja excluir a página ?</p>
                <p class="txt-excluir-title text-excluir-1">A página</p>
            </div>
            <div class="modal-footer">
                <input type="hidden" name="acao" value="excluir">
                <input type="hidden" name="pagina_id">
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
      $("input[name=pagina_id]").val($(this).attr("data-id"));
      $(".text-excluir-1").html($(this).attr("data-titulo"));
    })
    $("#form-excluir").on("submit", function(e) {
      e.preventDefault(); 
      admin_submit_form(this, "paginas.php"); 
    });
</script>


</div>
</div>
</body>
</html>