<?php 
require_once $_SERVER['DOCUMENT_ROOT'].'/controller/admin/admin_controller.php';
$page_title = 'Administração';
require_once $_SERVER['DOCUMENT_ROOT'].'/admin/header.php';
?> 

<div class="row">
    <div class="col-12 mb-4"> 
        <div class="card shadow card-dashboard"> 
            <h1>Visitas</h1>
            <small>Resumo visitantes únicos</small>  
        <ul class="list-group">
            <li class="list-group-item">
                <div class="text">Hoje</div>
                <div class="badge"><span><i class="fad fa-bullseye-pointer"></i></span><?php echo get_visitas_hoje();?></div>
            </li>
            <li class="list-group-item">
                <div class="text">Este Mês</div>
                <div class="badge"><span><i class="fad fa-bullseye-pointer"></i></span><?php echo get_visitas_mes();?></div>
            </li>
            <li class="list-group-item">
                <div class="text">Ontem</div>
                <div class="badge"><span><i class="fad fa-bullseye-pointer"></i></span><?php echo get_visitas_ontem();?></div>
            </li>
            <li class="list-group-item">
                <div class="text">Mês Passado</div>
                <div class="badge"><span><i class="fad fa-bullseye-pointer"></i></span><?php echo get_visitas_mes_passado();?></div>
            </li>
        </ul>
        </div> 
    </div>

<div class="col-12 mb-4"> 
    <div class="card shadow card-dashboard"> 
        <h1>Usuários</h1>
        <small>Resumo usuários premium ativos / inativos</small>  
    <ul class="list-group">
        <li class="list-group-item">
            <div class="text">Total Usuários</div>
            <div class="badge"><span><i class="fas fa-users"></i></span><?php echo contar_usuarios();?></div>
        </li>
        <li class="list-group-item">
            <div class="text">Premium Ativo</div>
            <div class="badge"><span><i class="fas fa-user-check"></i></span><?php echo contar_usuarios_premium();?></div>
        </li>
        <li class="list-group-item">
            <div class="">Premium Inativo</div>
            <div class="badge"><span><i class="fas fa-user-times"></i></span><?php echo contar_usuarios_expirado();?></div>
        </li>
    </ul>
    </div> 
</div>

<div class="col-12 mb-4"> 
    <div class="card shadow card-dashboard"> 
        <h1>Mídias</h1>
        <small>Resumo mídias</small>  
    <ul class="list-group">
        <li class="list-group-item">
            <div class="text">Animes</div>
            <div class="badge"><span><i class="fas fa-film"></i></span><?php echo contar_midia_por_tipo("anime");?></div>
        </li>
        <li class="list-group-item">
            <div class="text">Canais</div>
            <div class="badge"><span><i class="fas fa-film"></i></span><?php echo contar_midia_por_tipo("canal");?></div>
        </li>
        <li class="list-group-item">
            <div class="text">Filmes</div>
            <div class="badge"><span><i class="fas fa-film"></i></span><?php echo contar_midia_por_tipo("filme");?></div>
        </li>
        <li class="list-group-item">
            <div class="text">Infantis</div>
            <div class="badge"><span><i class="fas fa-film"></i></span><?php echo contar_midia_por_tipo("infantil");?></div>
        </li>
        <li class="list-group-item">
            <div class="text">Novelas</div>
            <div class="badge"><span><i class="fas fa-film"></i></span><?php echo contar_midia_por_tipo("novela");?></div>
        </li>
        <li class="list-group-item">
            <div class="text">Séries</div>
            <div class="badge"><span><i class="fas fa-film"></i></span><?php echo contar_midia_por_tipo("serie");?></div>
        </li>
    </ul>
    </div> 
</div>

</div>

</div>
<!-- end row -->

<?php require_once $_SERVER['DOCUMENT_ROOT'].'/admin/footer.php';?>


</div>
</body>
</html>