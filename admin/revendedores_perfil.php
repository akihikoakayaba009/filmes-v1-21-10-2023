<?php 
require_once $_SERVER['DOCUMENT_ROOT'].'/controller/admin/admin_controller.php';

if(!isset($_GET['revendedor_id']) OR !intval($_GET['revendedor_id']) OR empty(admin_get_revendedor_por_id($_GET['revendedor_id']))){
    die(header("Location:".BASE_ADMIN.'revendedores/listar'));
}
$res = admin_get_revendedor_por_id($_GET['revendedor_id']);
$page_title = 'Perfil Revendedor ';
require_once $_SERVER['DOCUMENT_ROOT'].'/admin/header.php'; 
?>

<div class="card shadow card-header-title"> 
    <h1>Perfil Revendedor</h1>
    <small><?php echo $res['revendedor_nome'];?></small> 
</div> 

<div class="d-flex justify-content-start align-items-start mb-3">
  <a class="btn btn-sm btn-two" href="<?php echo BASE_ADMIN.'revendedores/listar';?>"><i class="fas fa-arrow-left me-2"></i>Revendedores</a>  
</div>

<div class="card card-form shadow">
    <div class="card-body">
        <div class="row">
            <!-- COL -->
            <div class="col-12 col-md-3 mt-5">
                <div class="perfil-info-left">
                    <img src="<?php echo exibir_image_upload_or_url(BASE_IMAGES_AVATARS_PATCH, BASE_IMAGES_AVATARS_URL, $res['revendedor_avatar']);?>" class="perfil-info-avatar">
                    <h4><?php echo $res['revendedor_nome'];?></h4>
                    <small>Revendedor</small>
                    <small>Créditos: <?php echo $res['revendedor_creditos'];?></small>
                </div>
            </div>
            <!-- COL -->
            <div class="col-12 col-md-9">
                <div class="perfil-info-right">
                    <ul class="list-group mt-3 mt-lg-0">
                        <li class="list-group-item d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">
                                <div class="d-flex align-items-center"><i class="fas fa-user-crown"></i>Nome Completo</div>
                                <div class="space-left"><?php echo $res['revendedor_nome'];?></div>
                            </div> 
                        </li> 
                        <li class="list-group-item d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">
                                <div class="d-flex align-items-center"><i class="fab fa-whatsapp"></i>Nº Whatsapp</div>
                                <div class="space-left"><?php echo !empty($res['revendedor_whatsapp']) ? $res['revendedor_whatsapp'] : 'Não informado';?></div>
                            </div> 
                        </li> 
                        <li class="list-group-item d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">
                                <div class="d-flex align-items-center"><i class="fab fa-telegram-plane"></i>N° Telegram</div>
                                <div class="space-left"><?php echo !empty($res['revendedor_telegram']) ? $res['revendedor_telegram'] : 'Não informado';?></div>
                            </div> 
                        </li> 
                        <li class="list-group-item d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">
                                <div class="d-flex align-items-center"><i class="fab fa-instagram"></i>Url Instagram</div>
                                <div class="space-left"><?php echo !empty($res['revendedor_instagram']) ? $res['revendedor_instagram'] : 'Não informado';?></div>
                            </div> 
                        </li> 
                        <li class="list-group-item d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">
                                <div class="d-flex align-items-center"><i class="fas fa-envelope"></i>Email</div>
                                <div class="space-left"><?php echo $res['revendedor_email'];?></div>
                            </div> 
                        </li> 
                        <li class="list-group-item d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">
                                <div class="d-flex align-items-center"><i class="fas fa-user-clock"></i>Online ás</div>
                                <div class="space-left"><?php echo !empty($res['revendedor_online']) ? date("d/m/Y H:i:s", strtotime($res['revendedor_online'])) : 'Sem Registro';?></div>
                            </div> 
                        </li> 
                        <li class="list-group-item d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">
                                <div class="d-flex align-items-center"><i class="fas fa-calendar-plus"></i>Data Cadastro</div>
                                <div class="space-left"><?php echo date("d/m/Y H:i:s", strtotime($res['revendedor_cadastro']));?></div>
                            </div> 
                        </li> 
                    </ul>
                   
                </div>
            </div>
            <!-- COL -->
            <div class="d-flex justify-content-end align-items-end mt-3">
                    <a class="btn btn-sm btn-two" href="<?php echo BASE_ADMIN.'revendedores/editar/'.$_GET['revendedor_id'];?>"><i class="fas fa-coins me-2"></i>Editar Créditos</a>  
            </div>
        </div>
    </div>
</div>


<?php require_once $_SERVER['DOCUMENT_ROOT'].'/admin/footer.php';?>
 
 
 
 </div>
 </div>
 </body>
 </html> 