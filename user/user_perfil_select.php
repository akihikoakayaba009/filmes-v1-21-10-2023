<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/controller/user/user_controller.php';



if(isset($_GET['perfil_id']) && intval($_GET['perfil_id'])){
    $novo_hash_perfil = gerar_hash_perfil();
    if(premium_free_atualizar_hash_perfil($novo_hash_perfil, $_GET['perfil_id'], $user_id, $user_email)){
        setcookie("perfil_hash", $novo_hash_perfil, strtotime("+ 1 year"), "/");
        die(header("Location:".BASE_PUBLIC));
    }
}

$page_title = "Quem está assistindo ?";
require_once $_SERVER['DOCUMENT_ROOT'].'/user/user_header.php';
?>

<div class="container">
    <div class="perfil-select-logo"><a href="<?php echo BASE_PUBLIC;?>"><img src="<?php echo exibir_image_upload_or_url(BASE_IMAGES_SYSTEM_PATCH, BASE_IMAGES_SYSTEM_URL,SITE_LOGO);?>" class="site-logo"></a></div>
    <div class="perfil-select">
        <h1>Quem está assistindo ?</h1>
        <div class="row mt-5 d-flex justify-content-center">
        <?php foreach(premium_free_listar_perfis($user_id, $user_email) as $item):?> 

            <div class="col-6 col-md-4 col-lg-3 col-xl-2 col-xxl-2 text-center mb-3">
                <a class="link" href="<?php echo BASE_USER.'perfil-select/'.$item['perfil_id'];?>">
                    <img src="<?php echo exibir_image_upload_or_url(BASE_IMAGES_AVATARS_PERFIL_SELECT_PATCH, BASE_IMAGES_AVATARS_PERFIL_SELECT_URL, $item['perfil_avatar']);?>">
                    <small class="d-block"><?php echo $item['perfil_apelido'];?></small>
                </a>
            </div>

        <?php endforeach;?>    
        </div>
    </div>
</div>  


<?php require_once $_SERVER['DOCUMENT_ROOT'].'/user/user_footer.php';?>


</body>
</html> 