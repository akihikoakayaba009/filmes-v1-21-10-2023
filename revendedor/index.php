<?php 
require_once $_SERVER['DOCUMENT_ROOT'].'/controller/revendedor/revendedor_controller.php';
$page_title = "Revendedor Home";
require_once $_SERVER['DOCUMENT_ROOT'].'/revendedor/revendedor_header.php';
?>


    <?php if(count(listar_usuarios($revendedor_id))):?>

        <div class="card card-form shadow">
            <div class="card-body"> 

                    <div class="table-responsive"> 
                    <table class="w-100 table border" id="dataTable">
                    <div class="table-responsive">
                    <thead>
                        <tr>
                        <th>Avatar</th>
                        <th>Nome</th>
                        <th>Premium</th> 
                        <th>Online/Offline</th>
                        <th>Perfil</th>
                        <th>Renovar Plano</th>
                        </tr>  
                    </thead> 
                    <tbody> 
                        <?php foreach(listar_usuarios($revendedor_id) as $item):?>
                            <tr>
                                <td><img src="<?php echo exibir_image_upload_or_url(BASE_IMAGES_AVATARS_PATCH,BASE_IMAGES_AVATARS_URL,$item['user_avatar']);?>" class="image-avatar-list"></td>
                                <td><?php echo $item['user_nome'];?></td> 
                                <td><?php echo $item['user_premium'] > date("Y-m-d H:i:s") ? 'Premium Ativo' : 'Premium Inativo';?></td> 
                                <td><?php echo date("Y-m-d H:i:s", strtotime("- 2 minutes")) < date("Y-m-d H:i:s", strtotime($item['user_online'])) ? '<span class="text-online">Online</span>' : '<span class="text-offline">Offline</span>';?></td>
                                <td><a class="btn btn-sm btn-five " title="Ver Perfil" href="<?php echo BASE_REVENDEDOR.'usuarios/perfil/'.$item['user_id'];?>"><i class="fa fa-user me-2"></i>Ver Perfil</a></td>
                                <td><a class="btn btn-sm btn-four " title="Renovar Plano" href="<?php echo BASE_REVENDEDOR.'usuarios/editar/'.$item['user_id'];?>"><i class="fa fa-gem me-2"></i>Premium</a></td>
                            </tr>
                        <?php endforeach;?>
                    </tbody> 
                    </table>
                </div>

            </div>
            </div>

    <?php endif;?>    

           

<?php require_once $_SERVER['DOCUMENT_ROOT'].'/revendedor/revendedor_footer.php';?>


</body>
</html> 