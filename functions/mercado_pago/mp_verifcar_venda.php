<?php 
function verificar_venda($collection_id){
    require_once $_SERVER['DOCUMENT_ROOT'].'/lib/vendor/autoload.php'; 
     
    $res = array(); 
  
    MercadoPago\SDK::setAccessToken(SITE_TOKEN_MP);
    $payment = MercadoPago\Payment::find_by_id($collection_id);
    
    
    if(!empty($payment)){  
     
      $res['venda_titulo']          = $payment->additional_info->items[0]->title;  
      $res['venda_item_id']         = $payment->additional_info->items[0]->id; 
      $res['venda_item_preco']      = number_format($payment->additional_info->items[0]->unit_price,2,",","."); 
      $res['venda_status']          = $payment->status; 
      $res['venda_status_detail']   = $payment->status_detail; 
      $res['venda_forma_pagamento'] = $payment->payment_type_id;
      $res['venda_collection_id']   = $payment->id; 
      $res['venda_user_id']         = $payment->additional_info->payer->address->street_number; 
      $res['venda_user_email']      = $payment->additional_info->payer->address->street_name; 
      $res['venda_user_nome']       = $payment->additional_info->payer->first_name;
      $res['venda_item_quantidade'] = $payment->additional_info->items[0]->quantity;      
      $res['venda_item']            = $payment->additional_info->items[0]->category_id;  
         
    }
    return $res;             
   
} 

 
function verificar_venda_cadastrada($venda_user_id, $venda_user_email, $venda_collection_id){
     global $pdo;
     $v = $pdo->prepare("SELECT * FROM vendas WHERE 
                         venda_user_id = (:venda_user_id) AND 
                         venda_user_email = (:venda_user_email) AND 
                         venda_collection_id = (:venda_collection_id) LIMIT 1");
     $v->bindValue(":venda_user_id", $venda_user_id);
     $v->bindValue(":venda_user_email", $venda_user_email);                    
     $v->bindValue(":venda_collection_id", $venda_collection_id);
     $v->execute();
     return $v->fetch();
} 

function verificar_venda_por_collection_id($venda_collection_id){
     global $pdo;
     $v = $pdo->prepare("SELECT * FROM vendas WHERE 
                         venda_collection_id = (:venda_collection_id) LIMIT 1");              
     $v->bindValue(":venda_collection_id", $venda_collection_id);
     $v->execute();
     return $v->fetch();
}



function informacoes_venda_user_por_id($venda_collection_id, $venda_user_id, $venda_user_email){
     global $pdo;
     $v = $pdo->prepare("SELECT * FROM vendas WHERE venda_collection_id = (:venda_collection_id) AND  venda_user_id = (:venda_user_id) AND venda_user_email = (:venda_user_email) LIMIT 1");
     $v->bindValue(":venda_collection_id", $venda_collection_id);
     $v->bindValue(":venda_user_id", $venda_user_id);
     $v->bindValue(":venda_user_email", $venda_user_email);
     $v->execute();
     return $v->fetch();
}


function get_user_mp($user_id, $user_email){
     global $pdo;
     $v = $pdo->prepare("SELECT * FROM usuarios WHERE 
                         user_email = (:user_email) AND 
                         user_id = (:user_id) LIMIT 1");
     $v->bindValue(":user_email", $user_email); 
     $v->bindValue(":user_id", $user_id);      
     $v->execute();
     return $v->fetch();              
} 


function listar_vendas_por_user($venda_user_id, $venda_user_email){
     global $pdo;
     $res = array();
     $v = $pdo->prepare("SELECT * FROM vendas WHERE venda_user_id = (:venda_user_id) AND venda_user_email = (:venda_user_email)");
     $v->bindValue(":venda_user_id", $venda_user_id);
     $v->bindValue(":venda_user_email", $venda_user_email);
     $v->execute();
     if($v->rowCount() > 0){
          $res = $v->fetchAll();
     }
     return $res;
}

/*
    VERIFICA O STATUS DO PAGAMENTO
*/

function verificar_status_pagamento_mp($pagamento_status_um){
  
  if($pagamento_status_um == 'approved'){
     
        $res = "Aprovado";
  
  }else if($pagamento_status_um == 'pending'){
       
       $res = "Pendente"; 
  
  }else if($pagamento_status_um == 'in_process'){
     
       $res = "Processando";
  
  }else{
     
       $res = "Rejeitado";
  }

  return $res;

}