<?php 
function contar_vendas_home($venda_data){
    global $pdo;
    $venda_data = date("Y-m-d");
    $v = $pdo->prepare("SELECT * FROM vendas WHERE venda_data LIKE (:venda_data)");
    $v->bindValue(":venda_data", "%".$venda_data."%");
    $v->execute();
    if($v->rowCount() > 0){
        $total = 0;
        foreach($v->fetchAll() as $item){
            $total += number_format(str_replace(",",".",str_replace(".","",$item['venda_item_preco'])), 2, '.', ''); 
        }
        return number_format($total,2,",",".");
    }
    return "0,00";
}


function listar_vendas(){
    global $pdo;
    $res = array();
    $v = $pdo->prepare("SELECT * FROM vendas ORDER BY venda_id DESC");
    $v->execute();
    if($v->rowCount() > 0){
        $res = $v->fetchAll();
    }
    return $res;
}
 