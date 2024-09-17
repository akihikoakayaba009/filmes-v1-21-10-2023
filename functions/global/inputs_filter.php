<?php 
function valida_titulo($input){
    if(preg_match("/^[a-z-A-Z-0-9-&à-ÿ-Á-Ÿ ]*$/", $input)){
        return true;
    }
}
function valida_nome($input){
    if(preg_match("/^[A-Za-zà-ÿ-Á-Ÿ ]*$/", $input)){
    	return true;
    }
}

function valida_apelido($input){
    if(preg_match("/^[0-9-A-Za-zà-ÿ-Á-Ÿ ]*$/", $input)){
    	return true;
    }
}

function valida_cpf($input){
	if(preg_match("/^[0-9-.]*$/", $input)){
      if(strlen($input) == 14){
      	 $input = str_replace('.', '',$input);
      	 $input = str_replace('-', '', $input);
      	 if(intval($input) && strlen($input) == 11){
      	 	return true;
      	 }
      }
    }
}

function valida_cnpj($input){
    if(preg_match("/^[0-9-.\/]*$/", $input)){
      if(strlen($input) == 18){
      	 $input = str_replace('.', '',$input);
      	 $input = str_replace('-', '', $input);
      	 $input = str_replace('/', '', $input);
      	 if(intval($input) && strlen($input) == 14){
      	 	return true;
      	 }
      }
    }
}

function valida_telefone($input){
	if(preg_match("/^[0-9-()]*$/", $input)){
      if(strlen($input) == 13){
      	 $input = str_replace('.', '', $input);
      	 $input = str_replace('-', '', $input);
      	 $input = str_replace('(', '', $input);
      	 $input = str_replace(')', '', $input);
      	 if(intval($input) && strlen($input) == 10){
      	 	return true;
      	 }
      }
    }
}

function valida_celular($input){
	if(preg_match("/^[0-9-()]*$/", $input)){
      if(strlen($input) == 14){
      	 $input = str_replace('.', '', $input);
      	 $input = str_replace('-', '', $input);
      	 $input = str_replace('(', '', $input);
      	 $input = str_replace(')', '', $input);
      	 if(intval($input) && strlen($input) == 11){
      	 	return true;
      	 }
      }
    }
}

function valida_whatsapp($input){
	if(preg_match("/^[0-9-()-+ ]*$/", $input)){
      if(strlen($input) == 19){
		 $input = str_replace(' ', '', $input);
      	 $input = str_replace('-', '', $input);
      	 $input = str_replace('(', '', $input);
      	 $input = str_replace(')', '', $input);
		 $input = str_replace('+', '', $input);
      	 if(intval($input) && strlen($input) == 13){
      	 	return true;
      	 }
      }
    }
}

function formatar_whatsapp($whatsapp){
	$whatsapp = str_replace(' ', '', $whatsapp);
	$whatsapp = str_replace('-', '', $whatsapp);
	$whatsapp = str_replace('(', '', $whatsapp);
	$whatsapp = str_replace(')', '', $whatsapp);
    $whatsapp = str_replace('+', '', $whatsapp);
	return $whatsapp;
}

function valida_cep($input){
    if(preg_match("/^[0-9-.]*$/", $input)){
      if(strlen($input) == 9){
      	 $input = str_replace('-', '', $input);
      	 if(intval($input) && strlen($input) == 8){
      	 	return true;
      	 }
      }
    }
}

function valida_email($input){
	if(filter_var($input, FILTER_VALIDATE_EMAIL)){
		return true;
	}
}

function valida_senha($senha){
	if(strlen($senha) >= 6){
        return true;
	}
}

function valida_conta_bancaria($conta){
	if(preg_match("/^[0-9-.]*$/", $conta)){
        return true;
	}
}

function valida_preco($input){
    if(preg_match("/^[0-9.,]*$/", $input)){
       $input = str_replace(".", "", $input);
	   $input = str_replace(",","", $input);
	   if($input > 0){
		 return true;
	   }
    } 

}
