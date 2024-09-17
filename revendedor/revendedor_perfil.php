<?php 
require_once $_SERVER['DOCUMENT_ROOT'].'/controller/revendedor/revendedor_controller.php';
$page_title = "Meu Perfil";
require_once $_SERVER['DOCUMENT_ROOT'].'/revendedor/revendedor_header.php';
?>

<div class="card shadow card-header-title">
    <h1>Meu Perfil</h1>
    <small>Visualizar Perfil Editar E Alterar Senha.</small>
</div>


<div class="card shadow card-form mt-4">
    <div class="card-body">
            <!-- NAV TABS -->
            <ul class="nav nav-tabs tabs-three">
                <li class="nav-item">
                    <button type="button" class="btn btn-sm btn-nav me-1" data-bs-toggle="tab" data-bs-target="#tab-perfil" aria-expanded="false" >Meu Perfil</button>
                </li>
                <li class="nav-item">
                    <button type="button" class="btn btn-sm btn-nav me-1" data-bs-toggle="tab" data-bs-target="#tab-editar" aria-expanded="false" >Editar Perfil</button>
                </li>
                <li class="nav-item">
                    <button type="button" class="btn btn-sm btn-nav me-1" data-bs-toggle="tab" data-bs-target="#tab-senha" aria-expanded="false" >Alterar Senha</button>
                </li>
            </ul>
            <!-- TABS -->
            <div class="tab-content mt-3" id="tab-content">
                <!-- TAB PERFIL-->
                <div class="tab-pane fade active show" id="tab-perfil">
                   <!-- ITEM --> 
                   <div class="row">
                        <div class="col-12 col-md-3">
                            <div class="perfil-info-left">
                                <img src="<?php echo exibir_image_upload_or_url(BASE_IMAGES_AVATARS_PATCH, BASE_IMAGES_AVATARS_URL, $revendedor_avatar);?>" class="perfil-info-avatar">
                                <h4><?php echo $revendedor_nome;?></h4>
                                <small>Revendedor</small>
                            </div>
                        </div>
                        <div class="col-12 col-md-9">
                            <div class="perfil-info-right">
                                <ul class="list-group">
                                    <li class="list-group-item d-flex justify-content-between align-items-start">
                                        <div class="ms-2 me-auto">
                                            <div class="d-flex align-items-center"><i class="fab fa-whatsapp"></i>Whatsapp</div>
                                            <div class="space-left"><?php echo !empty($revendedor_whatsapp) ? $revendedor_whatsapp : 'Não informado';?></div>
                                        </div>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-start">
                                        <div class="ms-2 me-auto">
                                            <div class="d-flex align-items-center"><i class="fab fa-telegram-plane"></i>Telegram</div>
                                            <div class="space-left"><?php echo !empty($revendedor_telegram) ? $revendedor_telegram : 'Não informado';?></div>
                                        </div>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-start">
                                        <div class="ms-2 me-auto">
                                            <div class="d-flex align-items-center"><i class="fab fa-instagram"></i>Instagram</div>
                                            <div class="space-left"><?php echo !empty($revendedor_instagram) ? $revendedor_instagram : 'Não informado';?></div>
                                        </div>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-start">
                                        <div class="ms-2 me-auto">
                                            <div class="d-flex align-items-center"><i class="fas fa-envelope"></i>Email</div>
                                            <div class="space-left"><?php echo $revendedor_email;?></div>
                                        </div>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-start">
                                        <div class="ms-2 me-auto">
                                            <div class="d-flex align-items-center"><i class="fas fa-calendar"></i>Data Cadastro</div>
                                            <div class="space-left"><?php echo $revendedor_cadastro;?></div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                   </div>
                   <!-- ITEM --> 
                </div>
                <!-- TAB EDITAR-->
                <div class="tab-pane" id="tab-editar">
                    <h4>Editar Meu Perfil</h4>
                    <form id="form-editar-perfil" autocomplete="off">
                        <div class="perfil-image-change"> 
                        <label for="image">
                            <img src="<?php echo exibir_image_upload_or_url(BASE_IMAGES_AVATARS_PATCH, BASE_IMAGES_AVATARS_URL, $revendedor_avatar);?>" class="load-image-on-change">
                            <small class="small-text-one">Alterar Avatar</small>
                        </label>
                        
                        </div>
                        <div class="form-group">
                            <label>Nome</label>
                            <input type="form-control" class="form-control" name="revendedor_nome" value="<?php echo $revendedor_nome;?>">
                        </div>
                        <div class="form-group">
                            <label>Whatsapp</label>
                            <input type="form-control" class="form-control whatsapp" name="revendedor_whatsapp" value="<?php echo $revendedor_whatsapp;?>">
                        </div>
                        <div class="form-group">
                            <label>Telegram</label>
                            <input type="form-control" class="form-control whatsapp" name="revendedor_telegram" value="<?php echo $revendedor_telegram;?>">
                        </div>
                        <div class="form-group">
                            <label>Instagram</label>
                            <input type="form-control" class="form-control" name="revendedor_instagram" value="<?php echo $revendedor_instagram;?>">
                        </div>
                        <div class="form-group">
                            <input type="file" class="d-none input-image-change" name="avatar" id="image">
                            <input type="hidden" name="acao" value="editar-perfil">
                            <button type="submit" class="btn btn-one"><i class="fas fa-sign-in me-2"></i>Editar</button>
                        </div>
                    </form>
                </div>
                <!-- TAB SENHA-->
                <div class="tab-pane" id="tab-senha">
                    <h4>Alterar Minha Senha</h4>
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
                            <button type="submit" class="btn btn-one"><i class="fas fa-sign-in me-2"></i>Alterar Senha</button>
                        </div>
                    </form>
                    <!-- FORM -->
                
                </div>
            </div>
            <!-- TABS -->
    </div>
</div>
           

<?php require_once $_SERVER['DOCUMENT_ROOT'].'/revendedor/revendedor_footer.php';?>
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
            revendedor_submit_form(this, "revendedor_perfil.php"); 
    });
    $("#form-editar-perfil").on("submit", function(e){
            e.preventDefault();
            revendedor_submit_form(this, "revendedor_perfil.php"); 
    });
</script>

</body>
</html>