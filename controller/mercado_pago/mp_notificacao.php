<?php 
require_once $_SERVER['DOCUMENT_ROOT'].'/autoload/user_autoload.php';

if(isset($_GET['type']) && $_GET['type'] == 'payment' && isset($_GET['data_id']) && intval($_GET['data_id'])){
   
	if(empty(verificar_venda($_GET['data_id']))){
        exit;
    }
	 
	$venda = verificar_venda($_GET['data_id']);
	
	if(empty(get_user_mp($venda['venda_user_id'], $venda['venda_user_email']))){
		exit;
	} 
	
    $v_venda = verificar_venda_por_collection_id($venda['venda_collection_id']);

    $pagamento_status = $venda['venda_status'] == 'approved' && $venda['venda_status_detail'] == 'accredited' ? 'sim' : 'nao';
    $venda_finalizada = 'nao';
    

    if(empty(verificar_venda_por_collection_id($venda['venda_collection_id']))){
        cadastra_venda($venda['venda_titulo'], $venda['venda_item_id'], $venda['venda_item_preco'], 
                          $venda['venda_status'], verificar_forma_pagamento_mp($venda['venda_forma_pagamento']),
                          $venda['venda_collection_id'], $venda['venda_user_id'], $venda['venda_user_email'], 
                          $venda['venda_user_nome'], $venda['venda_item'], $venda_finalizada);

    }

    $v_venda = verificar_venda_por_collection_id($venda['venda_collection_id']);



    if($pagamento_status == 'sim' && !empty($v_venda) && $v_venda['venda_finalizada'] == 'nao'){

            $user          = get_user_mp($venda['venda_user_id'], $venda['venda_user_email']);
            $plano_premium = premium_free_listar_planos($venda['venda_item_id']); 
            $premium_data  = premium_free_gerar_data($user['user_premium'], $plano_premium['premium_dias_acesso']);                        
            premium_free_ativar_premium($user['user_id'], $user['user_email'], $premium_data, $venda['venda_item_id']);
            premium_free_gerar_telas($user['user_id'], $user['user_email'], $plano_premium['premium_telas']);   

            $venda_finalizada = 'sim';
            atualizar_status_venda($venda['venda_collection_id'], $venda['venda_item_id'], $venda['venda_user_id'], $venda['venda_user_email'], $venda['venda_status'], $venda_finalizada);

    }


}  
