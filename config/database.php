<?php 
try{
   $pdo = new PDO(DB_CON, DB_USER , DB_PASS);

   function site_config(){
	   global $pdo;
	   $v = $pdo->prepare("SELECT * FROM site_config");
	   $v->execute();
	   if($v->rowCount() < 1){
            echo '<h2 style="text-align:center;">Ocorreu um erro (cod: 001). Contacte o administrador. Saindo...</h2>';
            exit();
	   }else{
		   $res = $v->fetch(); 
	   }
	   return $res;
   }

}catch(PDOException $error){
	echo '<h2 style="text-align:center;">Ocorreu um erro (cod: 002). Contacte o administrador. Saindo...</h2>';
	exit();
}