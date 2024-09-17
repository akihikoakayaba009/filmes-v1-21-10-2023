<?php 
require_once $_SERVER['DOCUMENT_ROOT'].'/controller/admin/admin_controller.php';
$page_title = 'Informações Do Site';
require_once $_SERVER['DOCUMENT_ROOT'].'/admin/header.php'; 
?>

<div class="card shadow card-header-title mb-3"> 
    <h1><?php echo $page_title;?></h1>
    <small>Para ativar planos de venda, e adicionar revendedores. A revenda precisa estar ativada.</small> 
</div> 

<div class="card card-form shadow">
    <div class="card-body">

        <form id="site-informacoes" class="row" autocomplete="off">
            <div class="form-group col-12 col-lg-6">
                <label class="form-label-light">Nome Do Site</label>
                <input type="text" class="form-control" name="site_nome" value="<?php echo SITE_NOME;?>">
            </div>
            <div class="form-group col-12 col-lg-6">
                <label class="form-label-light">Quantidade de mídias na paginação (Número maior que zero)</label> 
                <input type="text" class="form-control" name="site_paginacao" value="<?php echo SITE_PAGINACAO;?>">
            </div>
            <div class="form-group col-12 col-lg-6">
                <label class="form-label-light">Email Do Site (opcional)</label>
                <input type="text" class="form-control" name="site_email" value="<?php echo SITE_EMAIL;?>">
            </div>
            <div class="form-group col-12 col-lg-6">
                <label class="form-label-light">Whatsapp Do Site (opcional)</label>
                <input type="text" class="form-control whatsapp" name="site_whatsapp" value="<?php echo SITE_WHATSAPP;?>">
            </div>
            <div class="form-group col-12 col-lg-6">
                <label class="form-label-light">Facebook Do Site (opcional)</label>
                <input type="text" class="form-control" name="site_facebook" value="<?php echo SITE_FACEBOOK;?>">
            </div>
            <div class="form-group col-12 col-lg-6">
                <label class="form-label-light">Instagram Do Site (opcional)</label>
                <input type="text" class="form-control" name="site_instagram" value="<?php echo SITE_INSTAGRAM;?>">
            </div>
            <div class="form-group col-12 col-lg-6">
                <label class="form-label-light">Twitter Do Site (opcional)</label>
                <input type="text" class="form-control" name="site_twitter" value="<?php echo SITE_TWITTER;?>">
            </div>
            <div class="form-group col-12 col-lg-6">
                <label class="form-label-light">Youtube Do Site (opcional)</label>
                <input type="text" class="form-control" name="site_youtube" value="<?php echo SITE_YOUTUBE;?>">
            </div>
            <div class="form-group col-12 col-lg-6">
                <label class="form-label-light">Descrição Do Site</label>
                <textarea class="form-control" rows="6" name="site_descricao"><?php echo SITE_DESCRICAO;?></textarea>
            </div>
            <div class="form-group col-12 col-lg-6">
                <label class="form-label-light">Keywords Do Site</label>
                <textarea class="form-control" rows="6" name="site_keywords"><?php echo SITE_KEYWORDS;?></textarea>
            </div>
            <div class="form-group col-12 col-lg-6">
                <label class="form-label-light">Token Mercado Pago Do Site</label>
                <input type="text" class="form-control" name="site_token_mp" value="<?php echo SITE_TOKEN_MP;?>">
            </div>
            <div class="form-group col-12 col-lg-6">
                <label class="form-label-light">Recarregar Cache (Altere o número para outro qualquer. Para recarregar o css e javascript)</label>
                <input type="text" class="form-control" name="site_cache" value="<?php echo SITE_CACHE;?>">
            </div>

            <div class="form-group col-12"> 
                <input type="hidden" name="acao" value="editar-informacoes-site">
                <button type="submit" class="btn btn-four"><i class="fas fa-sign-in me-2"></i>Salvar</button>
            </div>
        </form>

    </div>
</div>

<?php require_once $_SERVER['DOCUMENT_ROOT'].'/admin/footer.php';?>
 
<script>
    $("#site-informacoes").on("submit", function(e) {
      e.preventDefault();
      admin_submit_form(this, "site_config.php");
    });
</script>



</div>
</div>
</body>
</html>