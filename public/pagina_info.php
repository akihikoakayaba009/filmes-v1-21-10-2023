<?php 
require_once $_SERVER['DOCUMENT_ROOT'].'/autoload/public_autoload.php';

if(!isset($_GET['pagina_diretorio']) OR empty($_GET['pagina_diretorio']) OR !diretorio($_GET['pagina_diretorio'])){
    die(header("Location:".BASE_PUBLIC.'paginas/listar'));
}

$res = get_pagina_por_diretorio($_GET['pagina_diretorio']);
$page_title = "Página " . $res['pagina_titulo'];

require_once $_SERVER['DOCUMENT_ROOT'].'/public/public_header.php';
?>

<style>
    .pagina-conteudo img{
        max-width: 100%;
    }
    .pagina-conteudo iframe{
        max-width: 100%;
    }
</style>

<div class="container">
    <div class="pagina-info">
        <div class="row">
            <!-- COL --> 
            <div class="col-12 col-lg-9">
                <h4 class="title"><?php echo $res['pagina_titulo'];?></h4>
                <div class="pt-4 pb-4 pagina-conteudo">
                    <?php echo $res['pagina_conteudo'];?>
                </div>
            </div>
            <!-- COL --> 
            <div class="col-12 col-lg-3">
                <h4 class="title">Links Úteis</h4>
                <ul class="list-group">
                <?php foreach(listar_pagina() as $item):?>
                    <a href="<?php echo BASE_PUBLIC.'paginas/listar/'.$item['pagina_diretorio'];?>" class="list-group-item">
                            <i class="fas fa-link me-2"></i>
                            <?php echo $item['pagina_titulo'];?>
                    </a>
                <?php endforeach;?>
                </ul>
            </div>
            <!-- END COL --> 
        </div>
        <!-- END ROW --> 
    </div>
</div>


<?php require_once $_SERVER['DOCUMENT_ROOT'].'/public/public_footer.php';?>