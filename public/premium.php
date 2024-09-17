<?php 
require_once $_SERVER['DOCUMENT_ROOT'].'/autoload/public_autoload.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/public/public_header.php';
?>

<div class="container">
    <div class="planos-premium">
        <h4>Planos Premium</h4>
        <?php if(count(listar_planos_premium()) > 0):?>
        <div class="row">
            <?php foreach(listar_planos_premium() as $item):?>
                <div class="col-12 col-md-6 col-lg-6 col-xl-4 col-xxl-4">
                    <div class="card">
                        <div class="card-header bg-gradient">
                            <h4><?php echo $item['premium_titulo'];?></h4>
                            <h3>R$ <?php echo $item['premium_preco'];?></h3>
                        </div>
                        <div class="card-body">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item"><?php echo $item['premium_dias_acesso'];?> Dias de Acesso Premium</li>
                                <li class="list-group-item"><?php echo $item['premium_telas'] == 1 ? 'Perfil Individual'  : 'Perfis individuais';?></li>
                                <li class="list-group-item"><?php echo $item['premium_telas'] == 1 ? $item['premium_telas'] . ' Tela '  : $item['premium_telas'] . ' Telas';?></li>
                                <?php foreach(explode("<::>", $item['premium_caracteristica']) as $c):?>
                                    <li class="list-group-item"><?php echo $c;?></li>
                                <?php endforeach;?>
                                <li class="list-group-item text-center">Formas de pagamento</li>
                                <li class="list-group-item text-center">Pix , Boleto , Cartão e Pagamento na lotérica.</li>
                                <li class="list-group-item text-center">
                                    <img src="<?php echo BASE_IMAGES_SYSTEM_URL.'bandeiras-pagamento.png';?>">
                                </li>
                            </ul>
                            <a class="btn btn-comprar bg-gradient" href="<?php echo BASE_PUBLIC.'checkout/premium/'.$item['premium_id'];?>">Comprar</a>
                        </div>
                    </div>
                </div>
            <?php endforeach;?>
        </div>
        <?php else:?>
            <p>Desculpe! sem planos ativos no momento.</p>
        <?php endif;?>    
    </div>
</div>
 
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/public/public_footer.php';?>