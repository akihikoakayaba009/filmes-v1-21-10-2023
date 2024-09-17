<?php 
require_once $_SERVER['DOCUMENT_ROOT'].'/controller/admin/admin_controller.php';

if(!isset($_GET['user_id']) OR !intval($_GET['user_id'])){
    die(header("Location:".BASE_ADMIN.'usuarios/listar'));
}
require_once $_SERVER['DOCUMENT_ROOT'].'/admin/header.php';
$user  = get_user_por_id($_GET['user_id']);
$plano = premium_free_listar_planos($user['user_premium_plano_id']); 
?>

<div class="card shadow card-header-title mb-3"> 
    <h1>Perfil Usuário</h1>
    <small>Informações Renovar Premium Alterar Senha.</small> 
</div> 

<div class="d-flex justify-content-start mb-3"> 
  <a class="btn btn-sm btn-two" href="<?php echo BASE_ADMIN.'usuarios/listar';?>"><i class="fas fa-arrow-left me-2"></i>Usuários</a>  
</div>

<div class="card shadow card-form">
    <div class="card-body"> 
            <!-- NAV TABS --> 
            <ul class="nav nav-tabs tabs-three">
                <li class="nav-item">
                    <button type="button" class="btn btn-sm" data-bs-toggle="tab" data-bs-target="#tab-conta" aria-expanded="false" >Conta</button>
                </li>
                <li class="nav-item">
                    <button type="button" class="btn btn-sm" data-bs-toggle="tab" data-bs-target="#tab-premium" aria-expanded="false" >Premium</button>
                </li>
                <li class="nav-item">
                    <button type="button" class="btn btn-sm" data-bs-toggle="tab" data-bs-target="#tab-senha" aria-expanded="false" >Alterar Senha</button>
                </li>
            </ul>
            <!-- TABS -->
            <div class="tab-content mt-3" id="tab-content">
                <!-- TAB CONTA -->
                <div class="tab-pane fade active show" id="tab-conta">
                   <h4 class="mb-0">Perfil</h4>
                   <small class="d-block mb-3">Informações da conta.</small> 
                   <!-- ITEM --> 
                   <div class="row">
                        <div class="col-12 col-md-3">
                            <div class="perfil-info-left">
                                <img src="<?php echo exibir_image_upload_or_url(BASE_IMAGES_AVATARS_PATCH, BASE_IMAGES_AVATARS_URL, $user['user_avatar']);?>" class="perfil-info-avatar">
                                <h4><?php echo $user['user_nome'];?></h4>
                                <small>Usuário</small>
                            </div>
                        </div>
                        <div class="col-12 col-md-9">
                            <div class="perfil-info-right">
                                <ul class="list-group">
                                    <li class="list-group-item d-flex justify-content-between align-items-start">
                                        <div class="ms-2 me-auto">
                                            <div class="d-flex align-items-center"><i class="fas fa-user"></i>Nome</div>
                                            <div class="space-left"><?php echo $user['user_nome'];?></div>
                                        </div>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-start">
                                        <div class="ms-2 me-auto">
                                            <div class="d-flex align-items-center"><i class="fas fa-gem"></i>Premium</div>   
                                            <div class="space-left"><?php echo date("Y-m-d H:i:s",strtotime($user['user_premium'])) > date("Y-m-d H:i:s") ? 'Expira em: '.date("d/m/Y", strtotime($user['user_premium'])) : 'Expirou em: '.date("d/m/Y", strtotime($user['user_premium'])) ;?></div>
                                        </div>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-start">
                                        <div class="ms-2 me-auto">
                                            <div class="d-flex align-items-center"><i class="fas fa-tv"></i>Telas</div> 
                                            <div class="space-left"><?php echo premium_free_contar_perfis($user['user_id'], $user['user_email']) == 1 ? '1 Tela' : premium_free_contar_perfis($user['user_id'], $user['user_email']) . ' Telas' ;?></div>
                                        </div>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-start">
                                        <div class="ms-2 me-auto">
                                            <div class="d-flex align-items-center"><i class="fas fa-envelope"></i>Email</div>
                                            <div class="space-left"><?php echo $user['user_email'];?></div>
                                        </div>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-start">
                                        <div class="ms-2 me-auto">
                                            <div class="d-flex align-items-center"><i class="fas fa-calendar"></i>Data Cadastro</div>
                                            <div class="space-left"><?php echo date("d/m/Y", strtotime($user['user_cadastro']));?></div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                   </div>
                   <!-- ITEM -->  
                </div>
                <!-- TAB PREMIUM -->
                <div class="tab-pane fade" id="tab-premium"> 
                   <h4 class="mb-0">Premium</h4>
                   <small class="d-block mb-3">Renovar / Remover Premium.</small> 
                   <!-- ITEM --> 
                   <div class="row">
                        <div class="col-12 col-md-3">
                            <div class="perfil-info-left">
                                <img src="<?php echo exibir_image_upload_or_url(BASE_IMAGES_AVATARS_PATCH, BASE_IMAGES_AVATARS_URL, $user['user_avatar']);?>" class="perfil-info-avatar perfil-change">
                                <h4><?php echo $user['user_nome'];?></h4>
                                <small>Plano Atual: <?php echo !empty($plano['premium_titulo']) ? $plano['premium_titulo'] :  'Nenhum';?></small>
                            </div>
                        </div>
                        <!-- FORM -->
                        <div class="col-12 col-md-9">
                            <form id="renovar-premium" class="row" autocomplete="off">
                                <div class="form-group col-12">
                                    <label class="form-label-light">Premium Expiração</label>
                                    <input type="text" class="form-control" disabled value="<?php echo date("d/m/Y H:i:s", strtotime($user['user_premium']));?>">
                                </div> 
                                <div class="form-group col-12">
                                    <label>Plano Premium</label>
                                    <select class="form-select" name="plano_premium">
                                        <option value="" selected disabled>Selecione um plano</option>
                                        <?php foreach(listar_plano_premium() as $item):?>
                                            <option value="<?php echo $item['premium_id'];?>"><?php echo $item['premium_titulo'] . ' ' . $item['premium_dias_acesso'].' Dias';?></option>
                                        <?php endforeach;?> 
                                            <?php if(date("Y-m-d H:i:s") < date("Y-m-d H:i:s", strtotime($user['user_premium']))):?>
                                                <option value="0">Remover Premium</option>
                                            <?php endif;?>    
                                    </select>
                                </div>
                                <div class="form-group col-12">  
                                    <input type="hidden" name="user_id" value="<?php echo $user['user_id'];?>">
                                    <input type="hidden" name="user_email" value="<?php echo $user['user_email'];?>">
                                    <input type="hidden" name="acao" value="renovar-premium">
                                    <button type="submit" class="btn btn-four"><i class="fas fa-sign-in me-2"></i>Salvar</button>
                                </div>
                            </form>
                        </div>
                        <!-- FORM -->
                   </div>
                   <!-- ITEM -->  
                </div>
                <!-- TAB SENHA--> 
                <div class="tab-pane fade" id="tab-senha">
                    <h4 class="mb-0">Alterar senha da conta</h4>
                    <small class="d-block mb-3">Todos os perfis serão desconectados.</small>
                    
                    <div class="row">
                        <div class="col-12 col-md-3">
                            <div class="perfil-info-left">
                                <img src="<?php echo exibir_image_upload_or_url(BASE_IMAGES_AVATARS_PATCH, BASE_IMAGES_AVATARS_URL, $user['user_avatar']);?>" class="perfil-info-avatar perfil-change">
                                <h4><?php echo $user['user_nome'];?></h4>
                            </div>
                            </div>
                            <!-- FORM -->
                            <div class="col-12 col-lg-9">    
                            <form id="form-senha" autocomplete="off">
                                <div class="form-group">
                                <label>Nova Senha</label>
                                    <div class="input-group">
                                        <input type="password" name="senha_nova" class="form-control" id="input-two">
                                        <span class="input-group-text v-senha-1 cursor-pointer"><i class="fas fa-eye"></i></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                <label>Confirmar Nova Senha</label>
                                    <div class="input-group">
                                        <input type="password" name="senha_confirma" class="form-control" id="input-three">
                                        <span class="input-group-text v-senha-2 cursor-pointer"><i class="fas fa-eye"></i></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="hidden" name="acao" value="alterar-senha">
                                    <input type="hidden" name="user_id" value="<?php echo $user['user_id'];?>">
                                    <button type="submit" class="btn btn-one"><i class="fas fa-sign-in me-2"></i>Alterar Senha</button>
                                </div>
                            </form>
                            </div>
                            <!-- FORM -->
                    </div>
                
                </div>
            </div>
            <!-- TABS -->
    </div>
</div>

</div>

<?php require_once $_SERVER['DOCUMENT_ROOT'].'/admin/footer.php';?>

<script>
    $(".v-senha-1").on("click", function(){
        if($("input[name=senha_nova]").attr("type") == 'password'){
            $("input[name=senha_nova]").attr("type","text");
            $(".v-senha-1").html('<i class="fas fa-eye-slash"></i>');
        }else{
            $("input[name=senha_nova]").attr("type","password");
            $(".v-senha-1").html('<i class="fas fa-eye"></i>');
        }
    });
    $(".v-senha-2").on("click", function(){
        if($("input[name=senha_confirma]").attr("type") == 'password'){
            $("input[name=senha_confirma]").attr("type","text");
            $(".v-senha-2").html('<i class="fas fa-eye-slash"></i>');
        }else{
            $("input[name=senha_confirma]").attr("type","password");
            $(".v-senha-2").html('<i class="fas fa-eye"></i>');
        }
    });
    $("#form-senha").on("submit", function(e) {
      e.preventDefault();
      admin_submit_form(this, "usuarios.php");
    });
    $("#renovar-premium").on("submit", function(e) {
      e.preventDefault();
      admin_submit_form(this, "usuarios.php");
    });
</script>