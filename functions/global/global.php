<?php 
/*
  ============================== MENSAGENS DE RESPOSTA AJAX =================================
*/

  /* SUCCESS */  
  function die_success($msg=""){
    $data = array("status" => "success", "msg" => $msg);
    die(json_encode($data));
  }
  function die_success_reload($msg){
    $data = array("status" => "success_reload", "msg" => $msg);
    die(json_encode($data));
  }
  function die_success_redirect($msg, $url){
  $data = array("status" => "success_redirect", "msg" => $msg, "url" => $url);
  die(json_encode($data));
  }

  function die_success_redirect_after_confirm($msg, $url){
    $data = array("status" => "redirect_after_confirm", "msg" => $msg, "url" => $url);
    die(json_encode($data));
  } 
  
  
  /* ERROR */
  function die_error($msg){
     $data = array("status" => "error", "msg" => $msg);
     die(json_encode($data));
  }
  
  function die_error_reload($msg){
    $data = array("status" => "error_reload", "msg" => $msg);
    die(json_encode($data));
  }
  
  function die_error_redirect($msg, $url){
    $data = array("status" => "error_redirect", "msg" => $msg, "url" => $url);
    die(json_encode($data));
  }
         
  
  /* RECARREGAR A PÁGINA */
  function die_reload(){ 
    $data = array("status" => "reload");
    die(json_encode($data));
  }
  /* REDIRECIONAR PARA UMA URL */
  function die_url($url){
    $data = array("status" => "redirect_url", "url" => $url);
    die(json_encode($data));
  }
  
  /*
  ============================== MENSAGENS DE RESPOSTA AJAX =================================
  */
  
  /*
    ============================== REDIRECIONAMENTOS =================================
  */
  function admin_redirect($pagina)
  {
      die('<meta http-equiv="refresh" content="0; url=' . BASE_ADMIN . $pagina . '"/>');
  }
  function public_redirect($pagina)
  {
      die('<meta http-equiv="refresh" content="0; url=' . BASE_PUBLIC . $pagina . '"/>');
  }
  function user_redirect($pagina)
  {
      die('<meta http-equiv="refresh" content="0; url=' . BASE_USER . $pagina . '"/>');
  }
  
  /*
    ============================== GERAR / VERIFICAR HASH MD5 =================================
  */
  
  function md5_hash($hash){
      return md5(md5($hash));
  }
  
  function verifica_hash_md5($hash){
      if($hash != null && !empty($hash) && preg_match("/^[a-fA-F0-9]*$/", $hash) && strlen($hash) == 32){
          return true;
      }  
  }
  
  /*
    ============================== VERIFICAR SE EMAIL EXISTE =================================
  */
  
  function verificar_email_existe($email){
      global $pdo;
      $v = $pdo->prepare("SELECT * FROM administradores WHERE 
                          admin_email = (:email) OR 
                          (:email) IN (SELECT user_email FROM usuarios) OR 
                          (:email) IN (SELECT revendedor_email FROM revendedores) LIMIT 1");
      $v->bindValue(":email", $email);
      $v->execute();
      return $v->rowCount();                    
  }
  
  /*
    ============================== LIMPAR STRINGS =================================
  */
  
  function diretorio($string){
      $string = str_replace(array('[\', \']'), '', $string);
      $string = preg_replace('/\[.*\]/U', '', $string);
      $string = str_replace('&', 'e', $string);
      $string = preg_replace('/&(amp;)?#?[a-z0-9]+;/i', '-', $string);
      $string = htmlentities($string, ENT_COMPAT, 'utf-8');
      $string = preg_replace('/&([a-z])(acute|uml|circ|grave|ring|cedil|slash|tilde|caron|lig|quot|rsquo);/i', '\\1', $string );
      $string = preg_replace(array('/[^a-z0-9]/i', '/[-]+/') , '-', $string);
      return strtolower(trim($string, '-'));
  }  
  
  function diretorio_sem_espaco($string){
      $string = str_replace(array('[\', \']'), '', $string);
      $string = preg_replace('/\[.*\]/U', '', $string);
      $string = str_replace('&', 'e', $string);
      $string = preg_replace('/&(amp;)?#?[a-z0-9]+;/i', '-', $string);
      $string = htmlentities($string, ENT_COMPAT, 'utf-8');
      $string = preg_replace('/&([a-z])(acute|uml|circ|grave|ring|cedil|slash|tilde|caron|lig|quot|rsquo);/i', '\\1', $string );
      $string = preg_replace(array('/[^a-z0-9]/i', '/[-]+/') , '', $string);
      return strtolower(trim($string, '-'));
  }
  
  function diretorio_underline($string){
    $string = str_replace(array('[\', \']'), '', $string);
    $string = preg_replace('/\[.*\]/U', '', $string);
    $string = str_replace('&', 'e', $string);
    $string = preg_replace('/&(amp;)?#?[a-z0-9]+;/i', '-', $string);
    $string = htmlentities($string, ENT_COMPAT, 'utf-8');
    $string = preg_replace('/&([a-z])(acute|uml|circ|grave|ring|cedil|slash|tilde|caron|lig|quot|rsquo);/i', '\\1', $string );
    $string = preg_replace(array('/[^a-z0-9]/i', '/[-]+/') , '_', $string);
    return strtolower(trim($string, '-'));
  }
  function diretorio_mais($string){
    $string = str_replace(array('[\', \']'), '', $string);
    $string = preg_replace('/\[.*\]/U', '', $string);
    $string = str_replace('&', 'e', $string);
    $string = preg_replace('/&(amp;)?#?[a-z0-9]+;/i', '-', $string);
    $string = htmlentities($string, ENT_COMPAT, 'utf-8');
    $string = preg_replace('/&([a-z])(acute|uml|circ|grave|ring|cedil|slash|tilde|caron|lig|quot|rsquo);/i', '\\1', $string );
    $string = preg_replace(array('/[^a-z0-9]/i', '/[-]+/') , '_', $string);
    return strtolower(trim($string, '+'));
  }


  /*
    ============================== UPLOAD DE IMAGEM =================================
  */
  function upload_imagem($array_image){
      
      $imgTmp   = $array_image['tmp_name'];
      $imgName  = $array_image['name'];
      $imgSize  = $array_image['size'];
      $imgType  = $array_image['type'];
      $imgErro  = $array_image['error'];
      $formato  = array("image/jpeg", "image/png") ;
  
      if($formato[0] == "image/jpeg"){
         $extensao = "jpg";
      }
      if($formato[1] == "image/png"){
         $extensao = "png";
      }
   
      $tamanho_permitido  = 10000000;
  
      if($imgSize > $tamanho_permitido){
           die_error("A imagem não pode ultrapassar o limite de 10 megas.");
      }
      if(!in_array($imgType, $formato)){
           die_error("Envie a  imagem no formato png ou jpg.");
      }
      if($imgErro != 0){
           die_error("Houve um erro com o envio da imagem.");
      } 
  
      $imgMd5Name = md5(md5(time().rand(0,999).$imgName)).'.'.$extensao;
  
      $res = array("name" => $imgMd5Name, "tmp_name" => $imgTmp);
      return $res;
  
  }   
  
  
  function multiple_upload_image($imgTmp,$imgName,$imgSize,$imgType,$imgError){
      $formato  = array("image/jpeg", "image/png");
      $tamanho_permitido  = 10000000;
      
      if($imgSize < $tamanho_permitido && in_array($imgType, $formato) && $imgError == 0){
          if($imgType == "image/jpeg"){
              $extensao = "jpg";
          }
          if($imgType == "image/png"){
              $extensao = "png";
          }
          $imgMd5Name = md5(md5(time().rand(0,999).$imgName)).'.'.$extensao;
          $res = array("name" => $imgMd5Name, "tmp_name" => $imgTmp);
          return $res;
      }
      
  }

  function exibir_image_upload_or_url($patch,$patch_url,$image){
    $res = "";
    if(file_exists($patch.$image) && !is_dir($patch.$image)){
        $res = $patch_url.$image;
    }
    if(filter_var($image, FILTER_VALIDATE_URL)){
        $res = $image;
    }
    return $res;
  }

  function mover_imagem_upload($caminho, $tmp){
    if(move_uploaded_file($tmp, $caminho)){
        return true;
    }
    return false;
  }

  function excluir_imagem($imagem){

    if(file_exists($imagem)){
        @unlink($imagem);
        return true;
     }
     return false; 
}    

/*
  ============================== SERVIDOR SMTP E ENVIO DE EMAIL =================================
*/
  function get_servidor_smtp(){
    global $pdo;
    $v = $pdo->prepare("SELECT * FROM smtp LIMIT 1");
    $v->execute();
    return $v->fetch();
 }

 function enviar_email($email_destinatario, $email_destinatario_nome,$email_assunto,$email_mensagem){

    require_once $_SERVER['DOCUMENT_ROOT'].'/lib/vendor/autoload.php';

    if(empty(get_servidor_smtp())){
      return false;
    }
    $res = get_servidor_smtp();

    //Server settings
    $mail = new PHPMailer\PHPMailer\PHPMailer;
    $mail->CharSet    = "UTF-8";
    $mail->SMTPDebug  = 0;                     
    $mail->isSMTP();                                            
    $mail->Host       = $res['smtp_host'];                     
    $mail->SMTPAuth   = true;                                  
    $mail->Username   = $res['smtp_user'];                     
    $mail->Password   = $res['smtp_senha'];                    
    $mail->SMTPSecure = 'ssl';                                 
    $mail->Port       = $res['smtp_porta'];  

    //Recipients
    $mail->setFrom($res['smtp_email'], SITE_NOME); //REMETENTE
    $mail->addAddress($email_destinatario, $email_destinatario_nome);

    //Content
    $mail->isHTML(true);
    $mail->Subject = $email_assunto; //ASSUNTO TÍTULO APARECE
    $mail->Body    = $email_mensagem;  //ASSUNTO DO EMAIL
    
    if($mail->send()){
        return true;
    }
    return false;

 } 

 /* MIDIAS TIPO */
 function midia_tipo($midia_tipo){
    $array = array("anime","canal","filme","infantil","novela","serie");
    if(in_array($midia_tipo, $array)){
      return true;
    }
 }

 function midia_tipo_plural($midia_tipo){
    switch($midia_tipo){
        case "anime":
          return "animes";
          break;
        case "canal":
          return "canais";
          break;
        case "filme":
          return "filmes";
          break;
        case "infantil":
          return "infantis";
          break;  
        case "novela":
          return "novelas";
          break;
        case "serie":
          return "series";
          break;
        default:
          return "";
          break;                    
    }
 }

 function midia_tipo_plural_convert($midia_tipo){
  switch($midia_tipo){
      case "animes":
        return "anime";
        break;
      case "canais":
        return "canal";
        break;
      case "filmes":
        return "filme";
        break;
      case "infantis":
        return "infantil";
        break;  
      case "novelas":
        return "novela";
        break;
      case "series":
        return "serie";
        break;
      default:
        return "";
        break;                    
  }
}

 function midia_tipo_single_title($midia_tipo){
  switch($midia_tipo){
    case "anime":
      return "Anime";
      break;
    case "canal":
      return "Canal";
      break;
    case "filme":
      return "Filme";
      break;
    case "infantil":
      return "Infantil";
      break;
    case "novela":
      return "Novela";
      break;
    case "serie":
      return "Série";          
  }
}

 function midia_tipo_plural_title($midia_tipo){
    switch($midia_tipo){
      case "anime":
        return "Animes";
        break;
      case "canal":
        return "Canais";
        break;
      case "filme":
        return "Filmes";
        break;
      case "infantil":
        return "Infantis";
        break;
      case "novela":
        return "Novelas";
        break;
      case "serie":
        return "Séries";          
    }
 }

 function gerar_hash_sessao(){ 
    $a = md5(md5(time().rand(10000,99999)));
    $b = md5(md5(time().rand(10000,99999).$a));
    $c = $a . $b;
    $d = md5(md5(time().rand(10000,99999).$c));
    return $d;
 }