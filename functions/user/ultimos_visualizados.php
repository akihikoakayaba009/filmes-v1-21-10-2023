<?php 
function cad_ultimos_visualizados($idMidia,$idUser,$emailUser){
    global $pdo;
    $v = $pdo->prepare("SELECT * FROM ultimos_visualizados WHERE 
    	                idUser = (:idUser) AND 
    	                emailUser = (:emailUser)");
    $v->bindValue(":idUser", $idUser);
    $v->bindValue(":emailUser", $emailUser);
    $v->execute();
    if($v->rowCount() >= 16){
       $v = $pdo->prepare("DELETE FROM ultimos_visualizados WHERE 
       	                   idUser = (:idUser) AND 
                           emailUser = (:emailUser) ORDER BY ultimo_id ASC LIMIT 1");
       $v->bindValue(":idUser", $idUser);
       $v->bindValue(":emailUser", $emailUser);
       $v->execute();
    }
   
    $a = $pdo->prepare("DELETE FROM ultimos_visualizados WHERE 
    	                idMidia = (:idMidia) AND 
    	                idUser = (:idUser) AND 
    	                emailUser = (:emailUser)");
    $a->bindValue(":idMidia", $idMidia);
    $a->bindValue(":idUser", $idUser);
    $a->bindValue(":emailUser", $emailUser);
    $a->execute();

    $v = $pdo->prepare("INSERT INTO ultimos_visualizados SET 
    	                idMidia = (:idMidia),
    	                idUser = (:idUser), 
    	                emailUser = (:emailUser),
    	                data_hora = NOW()");
    $v->bindValue(":idMidia", $idMidia);
    $v->bindValue(":idUser", $idUser);
    $v->bindValue(":emailUser", $emailUser);
    $v->execute();

}


function get_ultimos_visualizados_index($idUser,$emailUser){
	global $pdo;
	$res = array();
	$v = $pdo->prepare("SELECT * FROM ultimos_visualizados INNER JOIN midia ON 
		                ultimos_visualizados.idMidia = midia.idMidia AND 
		                ultimos_visualizados.idUser = (:idUser) AND 
		                ultimos_visualizados.emailUser = (:emailUser)
		                GROUP BY midia.idMidia
		                ORDER BY ultimos_visualizados.ultimo_id DESC LIMIT 16");
	$v->bindValue(":idUser", $idUser);
    $v->bindValue(":emailUser", $emailUser);
	$v->execute();
	$res = $v->fetchAll();
	return $res;
}