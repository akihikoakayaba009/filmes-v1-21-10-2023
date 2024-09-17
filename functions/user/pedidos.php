<?php 
function cadastrar_pedido($nome, $email, $mensagem){
    global $pdo;
    $cad = $pdo->prepare("INSERT INTO pedidos SET 
                          nome = (:nome),
                          email = (:email),
                          mensagem = (:mensagem)");
    $cad->bindValue(":nome", $nome);
    $cad->bindValue(":email", $email);
    $cad->bindValue(":mensagem", $mensagem);
    if($cad->execute()){
        return true;
    }                      
}