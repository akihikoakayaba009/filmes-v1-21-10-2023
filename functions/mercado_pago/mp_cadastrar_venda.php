<?php 
/*
            CADASTRAR VENDA MERCADO PAGO
*/
function cadastra_venda($venda_titulo, $venda_item_id, $venda_item_preco, 
                        $venda_status, $venda_forma_pagamento, $venda_collection_id, 
                        $venda_user_id, $venda_user_email, $venda_user_nome, 
                        $venda_item, $venda_finalizada){

        global $pdo;
        
        $cad = $pdo->prepare("INSERT INTO vendas SET  
                              venda_titulo = (:venda_titulo),
                              venda_item_id = (:venda_item_id),
                              venda_item_preco = (:venda_item_preco),
                              venda_status = (:venda_status),
                              venda_forma_pagamento = (:venda_forma_pagamento),
                              venda_collection_id = (:venda_collection_id),
                              venda_user_id = (:venda_user_id),
                              venda_user_email = (:venda_user_email),
                              venda_user_nome = (:venda_user_nome),
                              venda_item = (:venda_item),
                              venda_finalizada = (:venda_finalizada)");

        $cad->bindValue(":venda_titulo", $venda_titulo);
        $cad->bindValue(":venda_item_id", $venda_item_id);
        $cad->bindValue(":venda_item_preco", $venda_item_preco);
        $cad->bindValue(":venda_status", $venda_status);
        $cad->bindValue(":venda_forma_pagamento", $venda_forma_pagamento);
        $cad->bindValue(":venda_collection_id", $venda_collection_id);
        $cad->bindValue(":venda_user_id", $venda_user_id);
        $cad->bindValue(":venda_user_email", $venda_user_email);
        $cad->bindValue(":venda_user_nome", $venda_user_nome);
        $cad->bindValue(":venda_item", $venda_item);
        $cad->bindValue(":venda_finalizada", $venda_finalizada);

        if($cad->execute()){
            return true;
        }

        return false;   

}
