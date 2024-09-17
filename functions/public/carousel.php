<?php 
function contar_carousel($carousel_para){
   global $pdo;
   $v = $pdo->prepare("SELECT carousel_id,carousel_para FROM carousel WHERE carousel_para = (:carousel_para)");
   $v->bindValue(":carousel_para", $carousel_para);
   $v->execute();
   return $v->rowCount();
}

function listar_carousel($carousel_para){
   global $pdo;
   $res = array();
   $v = $pdo->prepare("SELECT * FROM carousel WHERE 
   	                   carousel_para = (:carousel_para)
   	                   ORDER BY carousel_posicao * 1 ASC");
   $v->bindValue(":carousel_para", $carousel_para);
   $v->execute();
   if($v->rowCount() > 0){
   	   $res = $v->fetchAll();
   }
   return $res;
}