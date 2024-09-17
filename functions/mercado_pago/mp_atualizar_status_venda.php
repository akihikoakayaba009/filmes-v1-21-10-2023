<?php 

/*
     LIBERA A VENDA CASO PAGAMENTO STATUS = APROVADO
*/

function atualizar_status_venda($venda_collection_id, $venda_item_id, $venda_user_id, $venda_user_email, $venda_status, $venda_finalizada){
    global $pdo;
    $v = $pdo->prepare("UPDATE vendas SET 
                        venda_status = (:venda_status),
                        venda_finalizada = (:venda_finalizada),
                        venda_aprovada_data = NOW() WHERE 
                        venda_item_id = (:venda_item_id) AND
                        venda_user_id = (:venda_user_id) AND 
                        venda_user_email = (:venda_user_email) AND 
                        venda_collection_id = (:venda_collection_id) LIMIT 1"); 
    $v->bindValue(":venda_status", $venda_status); 
    $v->bindValue(":venda_finalizada", $venda_finalizada); 
    $v->bindValue(":venda_item_id", $venda_item_id);                    
    $v->bindValue(":venda_user_id", $venda_user_id);                     
    $v->bindValue(":venda_user_email", $venda_user_email);
    $v->bindValue(":venda_collection_id", $venda_collection_id); 
    if($v->execute()){
        return true;
    }
}

function verificar_forma_pagamento_mp($pagamento){
    if($pagamento == 'credit_card'){
      $res = "Crédito";
    }elseif($pagamento == 'debit_card'){
        $res = "Débito";
    }elseif($pagamento == 'account_money'){
        $res = "Saldo Mp";
    }elseif($pagamento == 'digital_wallet'){
        $res = "Paypal";
    }elseif($pagamento == 'bank_transfer'){
        $res = "Pix";  
    }elseif($pagamento == 'digital_currency'){
        $res = "Giftcard";    
    }else if($pagamento == 'Venda Externa'){
        $res = "Administrador";     
    }else if($pagamento == 'Revendedor'){ 
        $res = "Revendedor";    
    }else{
        $res = "Boleto";
    }
    return $res;
} 