<?php 
require_once $_SERVER['DOCUMENT_ROOT'].'/autoload/public_autoload.php';
$page_title = "Links Úteis";

require_once $_SERVER['DOCUMENT_ROOT'].'/public/public_header.php';
?>

<div class="container">
    <div class="pagina-links">
    <h4 class="title">Contatos</h4>
    <small class="small-subtitle">Para dúvidas, sugestões ou reclamações. Nossos canais de atendimento abaixo.</small>
    <div class="row pt-4 pb-4">

        <?php if(!empty(SITE_WHATSAPP)):?>
        <div class="col-12 col-md-6 col-lg-6 col-xl-4 pb-2">
            <a href="<?php echo 'https://wa.me/'.formatar_whatsapp(SITE_WHATSAPP).'?text=Olá encontrei este número para contato no website: '.SITE_NOME.'. Preciso de atendimento.';?>" target="_blank">
                <div class="card shadow card-header-title card-links-uteis bg-gradient">
                    <i class="fab fa-whatsapp"></i>
                    <small class="d-block"><?php echo SITE_WHATSAPP;?></small>
                </div>
            </a>
        </div>
        <?php endif;?>
 
        <?php if(!empty(SITE_FACEBOOK)):?>
        <div class="col-12 col-md-6 col-lg-6 col-xl-4 pb-2">
            <a href="<?php echo SITE_FACEBOOK;?>" target="_blank">
                <div class="card shadow card-header-title card-links-uteis bg-gradient">
                    <i class="fab fa-facebook"></i>
                    <small class="d-block"><?php echo SITE_FACEBOOK;?></small>
                </div>
            </a>
        </div>
        <?php endif;?>

        <?php if(!empty(SITE_INSTAGRAM)):?>
        <div class="col-12 col-md-6 col-lg-6 col-xl-4 pb-2">
            <a href="<?php echo SITE_INSTAGRAM;?>" target="_blank">
                <div class="card shadow card-header-title card-links-uteis bg-gradient">
                    <i class="fab fa-instagram"></i>
                    <small class="d-block"><?php echo SITE_INSTAGRAM;?></small>
                </div>
            </a>
        </div>
        <?php endif;?>

        <?php if(!empty(SITE_YOUTUBE)):?>
        <div class="col-12 col-md-6 col-lg-6 col-xl-4 pb-2">
            <a href="<?php echo SITE_YOUTUBE;?>" target="_blank">
                <div class="card shadow card-header-title card-links-uteis bg-gradient">
                    <i class="fab fa-youtube"></i>
                    <small class="d-block"><?php echo SITE_YOUTUBE;?></small>
                </div>
            </a>
        </div>
        <?php endif;?>

        <?php if(!empty(SITE_EMAIL)):?>
        <div class="col-12 col-md-6 col-lg-6 col-xl-4 pb-2">
            <div class="card shadow card-header-title card-links-uteis bg-gradient">
                <i class="fas fa-envelope"></i>
                <small class="d-block"><?php echo SITE_EMAIL;?></small>
            </div>
        </div>
        <?php endif;?>
    </div>

    <h4 class="title">Links utéis</h4>
    <div class="row">
        <?php foreach(listar_pagina() as $item):?>
        <div class="col-12 col-md-6 col-lg-6 col-xl-4 pb-2">
            <a href="<?php echo BASE_PUBLIC.'paginas/listar/'.$item['pagina_diretorio'];?>">
                <div class="card shadow card-header-title card-links-uteis">
                        <i class="fas fa-link"></i>
                        <small class="d-block"><?php echo $item['pagina_titulo'];?></small>
                </div>
            </a>
        </div>
        <?php endforeach;?>
    </div>
</div>

</div>


<?php require_once $_SERVER['DOCUMENT_ROOT'].'/public/public_footer.php';?>