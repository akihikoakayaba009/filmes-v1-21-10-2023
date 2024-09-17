<?php 
require_once $_SERVER['DOCUMENT_ROOT'].'/controller/admin/admin_controller.php';
$page_title = 'Imagens Do Site';
require_once $_SERVER['DOCUMENT_ROOT'].'/admin/header.php'; 
?>

<div class="card shadow card-header-title mb-3"> 
    <h1><?php echo $page_title;?></h1>
    <small>Altere as imagens padrão do site.</small> 
</div>

<div class="card card-form shadow">
    <div class="card-body">

        <form id="form-site-images" class="row site_images_change" autocomplete="off" enctype="multipart/form-data">
            <div class="form-group col-12">
                <div class="text-center">
                    <label for="site_favicon" class="cursor-pointer">
                        <img src="<?php echo exibir_image_upload_or_url(BASE_IMAGES_SYSTEM_PATCH, BASE_IMAGES_SYSTEM_URL,SITE_FAVICON);?>" class="site_favicon_editar">
                        <small class="d-block">Alterar Favicon Do Site</small>
                        <small class="d-block">(32x32)</small>
                    </label>
                    <input type="file" style="display:none" name="site_favicon" id="site_favicon">
                </div>
            </div> 
            <div class="form-group col-12">
                <div class="text-center">
                    <label for="site_logo" class="cursor-pointer">
                        <img src="<?php echo exibir_image_upload_or_url(BASE_IMAGES_SYSTEM_PATCH, BASE_IMAGES_SYSTEM_URL,SITE_LOGO);?>" class="site_logo_editar">
                        <small class="d-block">Alterar Logo Do Site</small>
                        <small class="d-block">(100x40)</small>
                    </label>
                    <input type="file" style="display:none" name="site_logo" id="site_logo">
                </div>
            </div>
            <div class="form-group col-12">
                <div class="text-center">
                    <label for="site_avatar" class="cursor-pointer">
                        <img src="<?php echo exibir_image_upload_or_url(BASE_IMAGES_AVATARS_PATCH, BASE_IMAGES_AVATARS_URL,SITE_AVATAR);?>" class="site_avatar_editar">
                        <small class="d-block">Alterar Avatar Do Site</small>
                        <small class="d-block">(80x80)</small>
                    </label>
                    <input type="file" style="display:none" name="site_avatar" id="site_avatar">
                </div>
            </div>
            <div class="form-group col-12">
                <div class="text-center">
                    <label for="site_background" class="cursor-pointer">
                        <img src="<?php echo exibir_image_upload_or_url(BASE_IMAGES_SYSTEM_PATCH, BASE_IMAGES_SYSTEM_URL,SITE_BACKGROUND);?>" class="site_background_editar">
                        <small class="d-block">Alterar Background Do Site</small>
                        <small class="d-block">(1920x1080)</small>
                    </label>
                    <input type="file" style="display:none" name="site_background" id="site_background">
                </div>
            </div>

            <div class="form-group col-12">
                <div class="text-center">
                    <label for="site_categoria_image" class="cursor-pointer">
                        <img src="<?php echo exibir_image_upload_or_url(BASE_IMAGES_CATEGORIAS_PATCH, BASE_IMAGES_CATEGORIAS_URL,SITE_CATEGORIA_IMAGE);?>" class="site_categoria_editar">
                        <small class="d-block">Alterar Background Das Categorias</small>
                        <small class="d-block">(300x170)</small>
                    </label>
                    <input type="file" style="display:none" name="site_categoria_image" id="site_categoria_image">
                </div>
            </div>

            <div class="form-group col-12">
                <div class="text-center">
                    <label for="site_episodio_image" class="cursor-pointer">
                        <img src="<?php echo exibir_image_upload_or_url(BASE_IMAGES_EPISODIOS_PATCH, BASE_IMAGES_EPISODIOS_URL,SITE_EPISODIOS_IMAGE);?>" class="site_episodio_image">
                        <small class="d-block">Alterar Background Dos Episódios</small>
                        <small class="d-block">(300x170)</small>
                    </label>
                    <input type="file" style="display:none" name="site_episodio_image" id="site_episodio_image">
                </div>
            </div>

            <div class="form-group col-12"> 
                <div class="text-center"> 
                    <label for="site_midia_background" class="cursor-pointer">
                        <img src="<?php echo exibir_image_upload_or_url(BASE_IMAGES_MIDIA_PATCH, BASE_IMAGES_MIDIA_URL,SITE_MIDIA_BACKGROUND);?>" class="site_midia_editar">
                        <small class="d-block">Alterar Background Das Mídias</small>
                        <small class="d-block">(1000x450)</small>
                    </label>
                    <input type="file" style="display:none" name="site_midia_background" id="site_midia_background">
                </div>
            </div>
            <div class="form-group col-12"> 
                <input type="hidden" name="acao" value="editar-site-imagens">
            </div>
        </form>

    </div>
</div>

<?php require_once $_SERVER['DOCUMENT_ROOT'].'/admin/footer.php';?>
 
<script>
    $("#form-site-images").on("submit", function(e) {
      e.preventDefault();
      admin_submit_form(this, "site_config.php");
    });
    $("#site_favicon, #site_logo,  #site_avatar, #site_background, #site_categoria_image, #site_midia_background, #site_episodio_image").on("change", function(){
       $("#form-site-images").trigger("submit");
    });
</script>



</div>
</div>
</body>
</html>