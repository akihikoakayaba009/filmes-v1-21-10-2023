<?php 
require_once $_SERVER['DOCUMENT_ROOT'].'/controller/admin/admin_controller.php';

if(!isset($_GET['admin_id']) OR !intval($_GET['admin_id']) OR empty(get_admin($_GET['admin_id']))){
    die(header("Location:".BASE_ADMIN.'administradores/listar'));
}
$res = get_admin($_GET['admin_id']);
$page_title = 'Perfil Administrador ';
require_once $_SERVER['DOCUMENT_ROOT'].'/admin/header.php'; 
?>

<div class="card shadow card-header-title"> 
    <h1>Perfil Administrador</h1>
    <small><?php echo $res['admin_nome'];?></small> 
</div> 

<div class="d-flex justify-content-start align-items-start mb-3">
  <a class="btn btn-sm btn-two" href="<?php echo BASE_ADMIN.'administradores/listar';?>"><i class="fas fa-arrow-left me-2"></i>Administradores</a>  
</div>

<div class="card card-form shadow">
    <div class="card-body">
        <div class="row">
            <!-- COL -->
            <div class="col-12 col-md-3">
                <div class="perfil-info-left">
                    <img src="<?php echo exibir_image_upload_or_url(BASE_IMAGES_AVATARS_PATCH, BASE_IMAGES_AVATARS_URL, $res['admin_avatar']);?>" class="perfil-info-avatar">
                    <h4><?php echo $res['admin_nome'];?></h4>
                    <small>Administrador</small>
                </div>
            </div>
            <!-- COL -->
            <div class="col-12 col-md-9">
                <div class="perfil-info-right">
                    <ul class="list-group">
                        <li class="list-group-item d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">
                                <div class="d-flex align-items-center"><i class="fas fa-user-crown"></i>Nome Completo</div>
                                <div class="space-left"><?php echo $res['admin_nome'];?></div>
                            </div> 
                        </li> 
                        <li class="list-group-item d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">
                                <div class="d-flex align-items-center"><i class="fas fa-mobile"></i>Nº Celular</div>
                                <div class="space-left"><?php echo !empty($res['admin_celular']) ? $res['admin_celular'] : 'Não informado';?></div>
                            </div> 
                        </li> 
                        <li class="list-group-item d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">
                                <div class="d-flex align-items-center"><i class="fab fa-whatsapp"></i>N° Whatsapp</div>
                                <div class="space-left"><?php echo !empty($res['admin_whatsapp']) ? $res['admin_whatsapp'] : 'Não informado';?></div>
                            </div> 
                        </li> 
                        <li class="list-group-item d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">
                                <div class="d-flex align-items-center"><i class="fas fa-envelope"></i>Email</div>
                                <div class="space-left"><?php echo $res['admin_email'];?></div>
                            </div> 
                        </li> 
                        <li class="list-group-item d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">
                                <div class="d-flex align-items-center"><i class="fas fa-envelope"></i>Email Confirmado</div>
                                <div class="space-left"><?php echo $res['admin_email_confirmado'] == 'sim' ? 'Sim' : 'Não';?></div>
                            </div> 
                        </li> 
                        <li class="list-group-item d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">
                                <div class="d-flex align-items-center"><i class="fas fa-user-shield"></i>Administrador Responsável</div>
                                <div class="space-left"><?php echo !empty($res['admin_responsavel']) ? $res['admin_responsavel'] : 'Ninguém';?></div>
                            </div> 
                        </li> 
                        <li class="list-group-item d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">
                                <div class="d-flex align-items-center"><i class="fas fa-user-clock"></i>Último Login</div>
                                <div class="space-left"><?php echo !empty($res['admin_ultimo_login']) ? date("d/m/Y H:i:s", strtotime($res['admin_ultimo_login'])) : 'Sem Registro';?></div>
                            </div> 
                        </li> 
                        <li class="list-group-item d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">
                                <div class="d-flex align-items-center"><i class="fas fa-user-clock"></i>Online ás</div>
                                <div class="space-left"><?php echo !empty($res['admin_online']) ? date("d/m/Y H:i:s", strtotime($res['admin_online'])) : 'Sem Registro';?></div>
                            </div> 
                        </li> 
                        <li class="list-group-item d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">
                                <div class="d-flex align-items-center"><i class="fas fa-calendar-plus"></i>Data Cadastro</div>
                                <div class="space-left"><?php echo date("d/m/Y H:i:s", strtotime($res['admin_data']));?></div>
                            </div> 
                        </li> 
                    </ul>
                </div>
            </div>
            <!-- COL -->
        </div>
    </div>
</div>


<?php require_once $_SERVER['DOCUMENT_ROOT'].'/admin/footer.php';?>
 
 
 
 </div>
 </div>
 </body>
 </html> 