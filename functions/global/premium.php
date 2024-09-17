<?php 
function premium_free_listar_planos($premium_id){
    global $pdo;
    $v = $pdo->prepare("SELECT * FROM planos_premium WHERE premium_id = (:premium_id) LIMIT 1");
    $v->bindValue(":premium_id", $premium_id);
    $v->execute();
    return $v->fetch();
}

function premium_free_gerar_data($user_premium_data, $dias_acesso, $qtd_telas_atual=null, $qtd_telas_nova=null){

	if(!empty($qtd_telas_atual) && !empty($qtd_telas_nova) && $qtd_telas_nova > $qtd_telas_atual){
		$dias_acesso = round($dias_acesso / $qtd_telas_nova);	
	}

	if(date("Y-m-d H:i:s") < date("Y-m-d H:i:s", strtotime($user_premium_data))){
		$a = date("Y-m-d H:i:s", strtotime($user_premium_data. " + ".$dias_acesso." days"));
	}else{
		$a =  date("Y-m-d H:i:s", strtotime("+ ".$dias_acesso." days"));
	}
    return $a;
} 

function premium_free_ativar_premium($user_id, $user_email, $user_premium ,$user_premium_plano_id){
    global $pdo;
    $up = $pdo->prepare("UPDATE usuarios SET 
                         user_premium = (:user_premium),
                         user_premium_plano_id = (:user_premium_plano_id) WHERE 
                         user_id = (:user_id) AND 
                         user_email = (:user_email) LIMIT 1");
    $up->bindValue(":user_premium", $user_premium);
    $up->bindValue(":user_premium_plano_id", $user_premium_plano_id);
    $up->bindValue(":user_id", $user_id);
    $up->bindValue(":user_email", $user_email);
    if($up->execute()){
        return true;
    }                     
}

function premium_free_gerar_telas($perfil_user_id, $perfil_user_email, $premium_telas){

    $total_perfis_atual = premium_free_contar_perfis($perfil_user_id, $perfil_user_email);

    if($total_perfis_atual <= $premium_telas){

        for($i = 0; $i < $premium_telas - $total_perfis_atual; $i++){

            $perfil_hash          = gerar_hash_perfil();
            $avatar_perfil_select = avatars_perfis_tela()[rand(0,9)]; 
            $number               = ($total_perfis_atual + 1 ) + $i; 
            $perfil_apelido_gerar = "Perfil " . $number;
            premium_free_gerar_perfil($perfil_apelido_gerar, $avatar_perfil_select, $perfil_user_id, $perfil_user_email, $perfil_hash);
        }
    }else{
 
        $limite = $total_perfis_atual - $premium_telas;
        premium_free_excluir_perfil($perfil_user_id, $perfil_user_email, $limite);
    }

}


function premium_free_gerar_perfil($perfil_apelido, $perfil_avatar, $perfil_user_id, $perfil_user_email, $perfil_hash){
	global $pdo;
	$cad = $pdo->prepare("INSERT INTO usuarios_perfil SET 
						  perfil_apelido = (:perfil_apelido),
						  perfil_avatar = (:perfil_avatar),
						  perfil_user_id = (:perfil_user_id),
						  perfil_user_email = (:perfil_user_email),
						  perfil_hash = (:perfil_hash)");
	$cad->bindValue(":perfil_apelido", $perfil_apelido);
	$cad->bindValue(":perfil_avatar", $perfil_avatar);
	$cad->bindValue(":perfil_user_id", $perfil_user_id);
	$cad->bindValue(":perfil_user_email", $perfil_user_email);
	$cad->bindValue(":perfil_hash", $perfil_hash);
	if($cad->execute()){
		return true;
	}				  
}

function premium_free_excluir_perfil($perfil_user_id, $perfil_user_email, $limite){
	global $pdo;
	
	$total_perfis = premium_free_contar_perfis($perfil_user_id, $perfil_user_email);
    
	if($limite - $total_perfis == 0){
		$limite = $total_perfis - 1;
	}else if($limite == 0){
		$limite = $total_perfis;
	}
    
	$del = $pdo->prepare("DELETE FROM usuarios_perfil WHERE 
						  perfil_user_id = (:perfil_user_id) AND
						  perfil_user_email = (:perfil_user_email) ORDER BY perfil_id DESC LIMIT " . $limite);
    $del->bindValue(":perfil_user_id", $perfil_user_id);
	$del->bindValue(":perfil_user_email", $perfil_user_email);		
	$del->execute();				  
} 

function premium_free_contar_perfis($perfil_user_id, $perfil_user_email){
	global $pdo;
	$v = $pdo->prepare("SELECT * FROM usuarios_perfil WHERE 
						perfil_user_id = (:perfil_user_id) AND 
						perfil_user_email = (:perfil_user_email)");
	$v->bindValue(":perfil_user_id", $perfil_user_id);
	$v->bindValue(":perfil_user_email", $perfil_user_email);
	$v->execute();
	return $v->rowCount(); 
}

function premium_free_get_perfil_por_hash($perfil_hash){
    global $pdo;
    $v = $pdo->prepare("SELECT * FROM usuarios_perfil WHERE 
                        perfil_hash = (:perfil_hash) LIMIT 1");
    $v->bindValue(":perfil_hash", $perfil_hash);
    $v->execute();
    return $v->fetch();                    
}

function premium_free_atualizar_hash_perfil($perfil_hash, $perfil_id, $perfil_user_id, $perfil_user_email){
	global $pdo;
	$up = $pdo->prepare("UPDATE usuarios_perfil SET 
						 perfil_hash = (:perfil_hash) WHERE 
						 perfil_id = (:perfil_id) AND
						 perfil_user_id = (:perfil_user_id) AND 
						 perfil_user_email = (:perfil_user_email) LIMIT 1");
	$up->bindValue(":perfil_hash", $perfil_hash);
	$up->bindValue(":perfil_id", $perfil_id);
	$up->bindValue(":perfil_user_id", $perfil_user_id);
	$up->bindValue(":perfil_user_email", $perfil_user_email);		
	if($up->execute()){
		return true;
	}			  
}

function premium_free_avatars_perfil_title($perfil_avatar){
	$a = str_replace('.png', '', $perfil_avatar);
	$a = str_replace('-', ' ', $a);
	$a = ucwords($a);
	return $a;
}

function premium_free_listar_perfis($perfil_user_id, $perfil_user_email){
	global $pdo;
	$res = array();
	$v = $pdo->prepare("SELECT * FROM usuarios_perfil WHERE 
					    perfil_user_id = (:perfil_user_id) AND 
						perfil_user_email = (:perfil_user_email)");
	$v->bindValue(":perfil_user_id", $perfil_user_id);
	$v->bindValue(":perfil_user_email", $perfil_user_email);
	$v->execute();
	if($v->rowCount() > 0){
		$res = $v->fetchAll();
	}
	return $res;
}

function premium_free_editar_perfil($perfil_apelido, $perfil_avatar, $perfil_id, $perfil_user_id, $perfil_user_email){
	global $pdo;
	$up = $pdo->prepare("UPDATE usuarios_perfil SET 
					     perfil_apelido = (:perfil_apelido),
						 perfil_avatar = (:perfil_avatar) WHERE
						 perfil_id = (:perfil_id) AND 
						 perfil_user_id = (:perfil_user_id) AND 
						 perfil_user_email = (:perfil_user_email) LIMIT 1");
    $up->bindValue(":perfil_apelido", $perfil_apelido);
	$up->bindValue(":perfil_avatar", $perfil_avatar);
	$up->bindValue(":perfil_id", $perfil_id);
	$up->bindValue(":perfil_user_id", $perfil_user_id);
	$up->bindValue(":perfil_user_email", $perfil_user_email);	
	if($up->execute()){
		return true;
	}					 
}

function avatars_perfis_tela(){
    $array = array(
      'avatar-1.png',
      'avatar-2.png',
      'avatar-3.png',
      'avatar-4.png',
      'avatar-5.png',
      'avatar-6.png',
      'avatar-7.png',
      'avatar-8.png',
      'avatar-9.png',
      'avatar-10.png',
    ); 
    return $array;
 } 

 function gerar_hash_perfil(){
    $a = md5(md5(time().rand(10000,99999)));
    $b = md5(md5(time().rand(10000,99999).$a));
    $c = $a . $b;
    $d = md5(md5(time().rand(10000,99999).$c));
    return $d;
 }
 
 function premium_free_renovar_hash_perfil($perfil_hash, $perfil_id, $perfil_user_id, $perfil_user_email){
	global $pdo;
	$up = $pdo->prepare("UPDATE usuarios_perfil SET 
						 perfil_hash = (:perfil_hash) WHERE 
						 perfil_id = (:perfil_id) AND 
						 perfil_user_id = (:perfil_user_id) AND 
						 perfil_user_email = (:perfil_user_email) LIMIT 1");
    $up->bindValue(":perfil_hash", $perfil_hash);
	$up->bindValue(":perfil_id", $perfil_id);
	$up->bindValue(":perfil_user_id", $perfil_user_id);
	$up->bindValue(":perfil_user_email", $perfil_user_email);			
	$up->execute();			 

 }