<?php 
#LINK PARA O MERCADO PAGO PROCESSAR O PAGAMENTO
function processar_pagamento_mp($preco, $item_id, $venda_item, $titulo, $user_nome_completo, $user_email, $user_id){ 

    $preco_mp  = number_format(str_replace(",",".",str_replace(".","",$preco)), 2, '.', '');
    //Mercado Pago Checkout Pro 
    require_once $_SERVER['DOCUMENT_ROOT'].'/lib/vendor/autoload.php';
    MercadoPago\SDK::setAccessToken(SITE_TOKEN_MP); 
    // Cria um objeto de preferência 
    $preference = new MercadoPago\Preference();
    // Cria um item na preferência
    $item = new MercadoPago\Item();
    $item->id = $item_id;  
    $item->title = $titulo;
    $item->description = SITE_NOME . " " . $titulo;
    $item->category_id = $venda_item;
    $item->quantity = 1; 
    $item->unit_price = $preco_mp;
    $item->picture_url = BASE_IMAGES_SYSTEM_URL.SITE_LOGO;
   
    $payer = new MercadoPago\Payer();
    $payer->name = $user_nome_completo;
    $payer->surname = $user_nome_completo;  
    $payer->email = $user_email; 
    
  
    $payer->address = array( 
      "street_name" => $user_email, 
      "street_number" => $user_id,
    ); 
   
    $preference->back_urls = array( 
        "success" => BASE_USER,
        "failure" => BASE_USER,
        "pending" => BASE_USER,
    );
    $preference->payment_methods = array(
      "excluded_payment_methods" => array(
        array("id" => "paypal"),
      )
    ); 
    $preference->notification_url = SITE_URL.'/controller/mercado_pago/mp_notificacao.php';
    $preference->auto_return = "approved"; 
    $preference->items = array($item);
    $preference->payer = $payer;
    $preference->save(); 
  
    return $preference->init_point;
}


