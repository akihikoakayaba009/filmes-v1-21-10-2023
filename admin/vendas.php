<?php 
require_once $_SERVER['DOCUMENT_ROOT'].'/controller/admin/admin_controller.php';
$page_title = 'Vendas';
require_once $_SERVER['DOCUMENT_ROOT'].'/admin/header.php';
?>


<div class="card shadow card-header-title"> 
    <h1>Vendas</h1>
    <small>Vendas de planos premium</small> 
</div>



<div class="card card-form shadow">
    <div class="card-body">

    <div class="table-responsive"> 
    <table class="w-100 table border" id="dataTable">
      <div class="table-responsive">
      <thead>
        <tr>
          <th>Premium Plano</th>
          <th>Preço</th>
          <th>Status</th>
          <th>Pagamento</th>
          <th>Email</th>
          <th>Identificador</th>
          <th>Criada</th>
          <th>Aprovada</th> 
        </tr>  
      </thead> 
      <tbody> 
          <?php foreach(listar_vendas() as $item):?>
            <tr> 
              <td><?php echo str_replace(SITE_NOME, '', $item['venda_titulo']);?></td>  
              <td>R$ <?php echo $item['venda_item_preco'];?></td>  
              <td><?php echo verificar_status_pagamento_mp($item['venda_status']);?>   </td>
              <td><?php echo  $item['venda_forma_pagamento'];?></td>
              <td><?php echo  $item['venda_user_email'];?></td>
              <td><?php echo  $item['venda_collection_id'];?></td>
              <td><?php echo date("d/m/Y H:i", strtotime($item['venda_data']));?></td>
              <td><?php echo !empty($item['venda_aprovada_data']) ? date("d/m/Y H:i", strtotime($item['venda_aprovada_data'])) : '';?></td>
            </tr>
          <?php endforeach;?>
      </tbody>
    </table>
  </div>

    </div>
</div>



<?php require_once $_SERVER['DOCUMENT_ROOT'].'/admin/footer.php';?>


</div>
</body>
</html>