<?php 
require_once $_SERVER['DOCUMENT_ROOT'].'/controller/user/user_controller.php';
$page_title = "Minha Conta";
require_once $_SERVER['DOCUMENT_ROOT'].'/user/user_header.php';
?>

<div class="container conta-page">

<div class="card shadow card-header-title">
    <h1>Minha Conta</h1>
    <small>Gerenciar perfil. Alterar senha. Histórico de pagamentos.</small>
</div>

<div class="card shadow card-form mt-4">
    <div class="card-body"> 
            <!-- NAV TABS --> 
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <button type="button" class="btn btn-sm btn-nav" data-bs-toggle="tab" data-bs-target="#tab-conta" aria-expanded="false" >Minha Conta</button>
                </li>
                <li class="nav-item">
                    <button type="button" class="btn btn-sm btn-nav" data-bs-toggle="tab" data-bs-target="#tab-perfil" aria-expanded="false" >Meu Perfil</button>
                </li>
                <li class="nav-item">
                    <button type="button" class="btn btn-sm btn-nav" data-bs-toggle="tab" data-bs-target="#tab-pagamentos" aria-expanded="false" >Meus Pagamentos</button>
                </li>
                <li class="nav-item">
                    <button type="button" class="btn btn-sm btn-nav" data-bs-toggle="tab" data-bs-target="#tab-senha" aria-expanded="false" >Alterar Senha</button>
                </li>
            </ul>
            <!-- TABS -->
            <div class="tab-content mt-3" id="tab-content">
                <!-- TAB CONTA -->
                <div class="tab-pane fade active show" id="tab-conta">
                   <!-- ITEM --> 
                   <div class="row">
                        <div class="col-12 col-md-3">
                            <div class="perfil-info-left">
                                <img src="<?php echo exibir_image_upload_or_url(BASE_IMAGES_AVATARS_PATCH, BASE_IMAGES_AVATARS_URL, $user_avatar);?>" class="perfil-info-avatar">
                                <h4><?php echo $user_nome;?></h4>
                                <small>Usuário</small>
                            </div>
                        </div>
                        <div class="col-12 col-md-9">
                            <div class="perfil-info-right">
                                <ul class="list-group">
                                    <li class="list-group-item d-flex justify-content-between align-items-start">
                                        <div class="ms-2 me-auto">
                                            <div class="d-flex align-items-center"><i class="fas fa-user"></i>Nome</div>
                                            <div class="space-left"><?php echo $user_nome;?></div>
                                        </div>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-start">
                                        <div class="ms-2 me-auto">
                                            <div class="d-flex align-items-center"><i class="fas fa-gem"></i>Premium</div>
                                            <div class="space-left"><?php echo $user_premium ? 'Expira em: '.date("d/m/Y", strtotime($user_premium_data)) : 'Expirou em: '.date("d/m/Y", strtotime($user_premium_data)) ;?></div>
                                        </div>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-start">
                                        <div class="ms-2 me-auto">
                                            <div class="d-flex align-items-center"><i class="fas fa-tv"></i>Telas</div> 
                                            <div class="space-left"><?php echo premium_free_contar_perfis($perfil_user_id, $perfil_user_email) == 1 ? ' 1 Tela' : premium_free_contar_perfis($perfil_user_id, $perfil_user_email) . ' Telas' ;?></div>
                                        </div>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-start">
                                        <div class="ms-2 me-auto">
                                            <div class="d-flex align-items-center"><i class="fas fa-envelope"></i>Email</div>
                                            <div class="space-left"><?php echo $user_email;?></div>
                                        </div>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-start">
                                        <div class="ms-2 me-auto">
                                            <div class="d-flex align-items-center"><i class="fas fa-calendar"></i>Data Cadastro</div>
                                            <div class="space-left"><?php echo $user_cadastro;?></div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                   </div>
                   <!-- ITEM -->  
                </div>
                <!-- TAB PERFIL -->
                <div class="tab-pane fade" id="tab-perfil">
                   <!-- ITEM --> 
                   <div class="row">
                        <div class="col-12 col-md-3">
                            <div class="perfil-info-left">
                                <img src="<?php echo exibir_image_upload_or_url(BASE_IMAGES_AVATARS_PERFIL_SELECT_PATCH, BASE_IMAGES_AVATARS_PERFIL_SELECT_URL, $perfil_avatar);?>" class="perfil-info-avatar perfil-change">
                                <h4><?php echo $perfil_apelido;?></h4>
                                <small>Perfil</small>
                            </div>
                        </div>
                        <!-- FORM -->
                        <div class="col-12 col-md-9">
                            <form id="form-perfil" autocomplete="off">
                                <div class="form-group">
                                <label>Alterar Apelido</label>
                                    <div class="input-group">
                                        <input type="text" name="perfil_apelido" class="form-control" value="<?php echo $perfil_apelido;?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Alterar Avatar</label>
                                    <select class="form-select" name="perfil_avatar" id="select-avatar-perfil">
                                        <?php foreach(avatars_perfis_tela() as $item):?>
                                            <?php if($perfil_avatar == $item):?>
                                                <option value="<?php echo $perfil_avatar;?>" selected=""><?php echo premium_free_avatars_perfil_title($perfil_avatar);?></option>
                                            <?php else:?>
                                                <option value="<?php echo $item;?>"><?php echo premium_free_avatars_perfil_title($item);?></option>
                                            <?php endif;?>    
                                        <?php endforeach;?>
                                    </select> 
                                </div>
                                <div class="form-group">
                                    <input type="hidden" name="acao" value="editar-perfil-select">
                                    <button type="submit" class="btn btn-sm"><i class="fas fa-sign-in me-2"></i>Editar Perfil</button>
                                </div>
                            </form>
                        </div>
                        <!-- FORM -->
                   </div>
                   <!-- ITEM -->  
                </div>
                <!-- TAB PAGAMENTOS--> 
                <div class="tab-pane fade" id="tab-pagamentos">
                    <h4 class="mb-1">Meus pagamentos</h4>
                    <small class="d-block mb-4">Seus pedidos aprovados, pendentes ou reprovados. Apareceram aqui.</small>
                    <?php if(count(listar_vendas_por_user($user_id, $user_email)) > 0):?>
                        <div class="perfil-info-right">
                            <ul class="list-group">
                                <?php foreach(listar_vendas_por_user($user_id, $user_email) as $cp):?>
                                    <a href="<?php echo BASE_USER.'pagamento/'.$cp['venda_collection_id'];?>" class="list-group-item d-flex justify-content-between align-items-start">
                                        <div class="ms-2 me-auto">
                                            <div class="d-flex align-items-center"><i class="fas fa-tv"></i><?php echo $cp['venda_titulo'];?></div>
                                            <div class="space-left"><?php echo verificar_status_pagamento_mp($cp['venda_status']);?></div>   
                                        </div>
                                    </a>
                                <?php endforeach;?>
                            </ul> 
                        </div>
                    <?php else:?>
                        <small>Sem Pagamentos</small>    
                    <?php endif;?>
                </div>
                <!-- TAB SENHA--> 
                <div class="tab-pane fade" id="tab-senha">
                    <h4 class="mb-1">Alterar senha da conta</h4>
                    <small class="d-block mb-3">Todos os perfis serão desconectados.</small>
                    <!-- FORM -->
                    <form id="form-senha" autocomplete="off">
                        <div class="form-group">
                        <label>Senha Atual</label>
                            <div class="input-group">
                                <input type="password" name="senha_atual" class="form-control" id="input-one">
                                <span class="input-group-text v-senha-1 cursor-pointer"><i class="fas fa-eye"></i></span>
                            </div>
                        </div>
                        <div class="form-group">
                        <label>Nova Senha</label>
                            <div class="input-group">
                                <input type="password" name="senha_nova" class="form-control" id="input-two">
                                <span class="input-group-text v-senha-2 cursor-pointer"><i class="fas fa-eye"></i></span>
                            </div>
                        </div>
                        <div class="form-group">
                        <label>Confirmar Nova Senha</label>
                            <div class="input-group">
                                <input type="password" name="senha_confirma" class="form-control" id="input-three">
                                <span class="input-group-text v-senha-3 cursor-pointer"><i class="fas fa-eye"></i></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="hidden" name="acao" value="alterar-senha">
                            <button type="submit" class="btn btn-sm"><i class="fas fa-sign-in me-2"></i>Alterar Senha</button>
                        </div>
                    </form>
                    <!-- FORM -->
                
                </div>
            </div>
            <!-- TABS -->
    </div>
</div>

</div>
           

<?php require_once $_SERVER['DOCUMENT_ROOT'].'/user/user_footer.php';?>
<script>
    $(".v-senha-1").on("click", function(){
        if($("input[name=senha_atual]").attr("type") == 'password'){
            $("input[name=senha_atual]").attr("type","text");
            $(".v-senha-1").html('<i class="fas fa-eye-slash"></i>');
        }else{
            $("input[name=senha_atual]").attr("type","password");
            $(".v-senha-1").html('<i class="fas fa-eye"></i>');
        }
    });
    $(".v-senha-2").on("click", function(){
        if($("input[name=senha_nova]").attr("type") == 'password'){
            $("input[name=senha_nova]").attr("type","text");
            $(".v-senha-2").html('<i class="fas fa-eye-slash"></i>');
        }else{
            $("input[name=senha_nova]").attr("type","password"); 
            $(".v-senha-2").html('<i class="fas fa-eye"></i>');
        }
    });
    $(".v-senha-3").on("click", function(){
        if($("input[name=senha_confirma]").attr("type") == 'password'){
            $("input[name=senha_confirma]").attr("type","text");
            $(".v-senha-3").html('<i class="fas fa-eye-slash"></i>');
        }else{
            $("input[name=senha_confirma]").attr("type","password");
            $(".v-senha-3").html('<i class="fas fa-eye"></i>');
        }
    });
    $("#form-senha").on("submit", function(e){
            e.preventDefault();
            user_submit_form(this, "user_perfil.php"); 
    });
    $("#form-perfil").on("submit", function(e){
            e.preventDefault();
            user_submit_form(this, "user_perfil_select.php"); 
    });
    $("#form-editar-perfil").on("submit", function(e){
            e.preventDefault();
            user_submit_form(this, "user_perfil.php"); 
    });

    $("#select-avatar-perfil").on("change", function(){
        $(".perfil-change").attr("src", '<?php echo BASE_IMAGES_AVATARS_PERFIL_SELECT_URL;?>'+$(this).val());
    });
</script>

</body>
</html>