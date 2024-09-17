<?php 
require_once $_SERVER['DOCUMENT_ROOT'].'/controller/revendedor/revendedor_controller.php';

if(!isset($_GET['user_id']) OR !intval($_GET['user_id']) OR empty(get_user_por_id($_GET['user_id']))){
    die(header("Location:".BASE_REVENDEDOR));
}
$res = get_user_por_id($_GET['user_id']);

if(empty(premium_free_listar_planos($res['user_premium_plano_id']))){
    die(header("Location:".BASE_REVENDEDOR));
}

$pr = premium_free_listar_planos($res['user_premium_plano_id']);

$page_title = 'Renovar Premium Usuário';
require_once $_SERVER['DOCUMENT_ROOT'].'/revendedor/revendedor_header.php'; 
?>

<div class="card shadow card-header-title"> 
    <h1><?php echo $page_title;?></h1>
    <small>Usuário: <?php echo $res['user_nome'];?></small> 
</div> 

<div class="d-flex justify-content-between mb-3">
  <a class="btn btn-1 btn-two" href="<?php echo BASE_REVENDEDOR;?>"><i class="fas fa-arrow-left me-2"></i>Usuários</a>  
  <a class="btn btn-1 btn-two" data-bs-toggle="modal" data-bs-target="#modal-custos"><i class="fas fa-eye me-2"></i>Ver tabela de custos</a>  
</div>

<div class="card card-form shadow">
    <div class="card-body">
        <!-- NAV TABS -->
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <button type="button" class="btn btn-sm btn-nav me-1" data-bs-toggle="tab" data-bs-target="#tab-editar" aria-expanded="false" >Renovar Premium</button>
            </li>
        </ul>
        <!-- TABS -->
        <div class="tab-content mt-3" id="tab-content">
            <!-- TAB EDITAR -->
            <div class="tab-pane fade active show" id="tab-editar">
                <form id="adicionar-usuario" class="row" autocomplete="off" enctype="multipart/form-data">
                    <div class="text-center">
                        <img src="<?php echo BASE_IMAGES_AVATARS_URL.SITE_AVATAR;?>" class="image-avatar-change">
                        <small class="d-block">Plano Atual: <?php echo $pr['premium_titulo'];?></small>
                    </div>
                    <div class="form-group col-12 col-lg-6">
                        <label class="form-label-light">Email</label>
                        <input type="text" class="form-control" disabled value="<?php echo $res['user_email'];?>">
                    </div> 
                    <div class="form-group col-12 col-lg-6">
                        <label class="form-label-light">Premium Expiração</label>
                        <input type="text" class="form-control" disabled value="<?php echo date("d/m/Y H:i:s", strtotime($res['user_premium']));?>">
                    </div> 
                    <div class="form-group col-12"> 
                        <label>Plano Premium</label>
                        <select class="form-select" name="plano_premium">
                            <option value="" selected disabled>Selecione um plano</option>
                            <?php foreach(listar_plano_premium() as $item):?>
                                <option value="<?php echo $item['premium_id'];?>"><?php echo $item['premium_titulo'] . ' ' . $item['premium_dias_acesso'].' Dias';?></option>
                            <?php endforeach;?> 
                        </select>
                    </div>
                    <div class="form-group col-12">  
                        <input type="hidden" name="user_id" value="<?php echo $res['user_id'];?>">
                        <input type="hidden" name="user_email" value="<?php echo $res['user_email'];?>">
                        <input type="hidden" name="acao" value="renovar-premium">
                        <button type="submit" class="btn btn-four"><i class="fas fa-sign-in me-2"></i>Renovar</button>
                    </div>
                </form>
            </div>
            <!-- TAB EDITAR -->
        </div>

    </div>
</div>
<div class="py-2"></div>


<!-- Modal Excluir -->
<div class="modal fade" id="modal-custos" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">
    <div class="modal-header">
        <h1 class="modal-title fs-5 modal-excluir-title">Custo de Créditos</h1>
        <button class="btn modal-close-btn" type="button" data-bs-dismiss="modal"><i class="fas fa-times"></i></button>
    </div>
    <form id="form-excluir-plano">
            <div class="modal-body">
                <ul class="list-group">
                    <?php foreach(listar_plano_premium() as $c):?>
                        <li class="list-group-item d-flex justify-content-between align-items-start pe-1 ps-1">
                            <div class="me-auto">
                            <div class="fw-bold"><?php echo $c['premium_titulo'];?></div>
                            <?php echo $c['premium_dias_acesso'];?> Dias de acesso
                            </div>
                            <div><?php echo $c['premium_consumo_creditos_revendedor'] == 1 ? $c['premium_consumo_creditos_revendedor'] .' Crédito' : $c['premium_consumo_creditos_revendedor'].' Créditos';?></div>
                        </li>
                    <?php endforeach;?>
                </ul>
            </div>
            <div class="modal-footer">
                <input type="hidden" name="premium_id">
                <input type="hidden" name="acao" value="excluir">
                <button type="button" class="btn btn-sm btn-1" data-bs-dismiss="modal">Fechar</button>
            </div>
    </form>
    </div>
</div>
</div>  



<?php require_once $_SERVER['DOCUMENT_ROOT'].'/revendedor/revendedor_footer.php';?>
 
<script>
    $(".gerar-senha").on("click", function() {
      var pass = getPassword();
      var pswone = $("#input-one");
      var pstwo = $("#input-two");
      pswone.val(pass);
      pstwo.val(pass);
    }); 
    $(".v-senha-1").on("click", function(){
        if($("input[name=user_senha]").attr("type") == 'password'){
            $("input[name=user_senha]").attr("type","text");
            $(".v-senha-1").html('<i class="fas fa-eye-slash"></i>');
        }else{
            $("input[name=user_senha]").attr("type","password");
            $(".v-senha-1").html('<i class="fas fa-eye"></i>');
        }
    });
    $(".v-senha-2").on("click", function(){
        if($("input[name=user_confirmar_senha]").attr("type") == 'password'){
            $("input[name=user_confirmar_senha]").attr("type","text");
            $(".v-senha-2").html('<i class="fas fa-eye-slash"></i>');
        }else{
            $("input[name=user_confirmar_senha]").attr("type","password");
            $(".v-senha-2").html('<i class="fas fa-eye"></i>');
        }
    });
    $("#adicionar-usuario").on("submit", function(e) {
      e.preventDefault();
      revendedor_submit_form(this, "revendedor_usuarios.php");
    });
</script>



</div>
</div>
</body>
</html>