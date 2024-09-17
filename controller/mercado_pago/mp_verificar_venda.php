<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/controller/user/user_controller.php';

    if(!isset($_GET['collection_id']) OR empty($_GET['collection_id'])){
        if(isset($_GET['ajax'])){
            die();
        }else{
            die(header("Location:".SITE_URL));  
        }
    }
    $collection_id = intval($_GET['collection_id']);

    /*
        VERIFICAR O STATUS DA VENDA NO MERCADO PAGO
    */
    
    $verificar_status_venda_no_mercado_pago = verificar_venda($collection_id);

    $mp['venda_user_email']    = $verificar_status_venda_no_mercado_pago['venda_user_email'];
    $mp['venda_user_id']       = $verificar_status_venda_no_mercado_pago['venda_user_id'];
    $mp['venda_status']        = $verificar_status_venda_no_mercado_pago['venda_status'];
    $mp['venda_item_id']       = $verificar_status_venda_no_mercado_pago['venda_item_id'];
    $mp['venda_collection_id'] = $verificar_status_venda_no_mercado_pago['venda_collection_id'];
    $mp['venda_titulo']        = $verificar_status_venda_no_mercado_pago['venda_titulo'];

    /*
        VERIFICA SE O EMAIL E O ID DO ALUNO É IGUAL AO QUE FOI CADASTRADO NO MERCADO PAGO
    */

    $v_venda = informacoes_venda_user_por_id($mp['venda_collection_id'], $user_id, $user_email); 
    if($mp['venda_status'] == 'approved' && !empty($v_venda) && $v_venda['venda_status'] != 'approved'){
        
        if(atualizar_status_venda($mp['venda_collection_id'], $mp['venda_item_id'], $mp['venda_user_id'], $mp['venda_user_email'], $mp['venda_status'])){
            
            $plano_premium = premium_free_listar_planos($mp['venda_item_id']); 

            $premium_data  = premium_free_gerar_data($user_premium_data, $plano_premium['premium_dias_acesso']);                        
            premium_free_ativar_premium($user_id, $user_email, $premium_data, $mp['venda_item_id']);

            premium_free_gerar_telas($user_id, $user_email, $plano_premium['premium_telas']);


            $venda_id = verificar_venda_cadastrada($mp['venda_user_id'], $mp['venda_user_email'], $collection_id)['venda_id'];

                               
            if(isset($_GET['ajax'])){
                $json = array("status" => "ok", "url" => BASE_USER.'pagamento/'.$collection_id);
                die(json_encode($json));
            }else{
                die(header("Location:".BASE_USER.'pagamento/'.$collection_id));
            }

        }else{
            die(header("Location:".BASE_USER.'pagamento/'.$collection_id));
        }


    }else{
        if(!isset($_GET['ajax'])){
            die(header("Location:".BASE_USER.'pagamento/'.$collection_id));
        }
    } 