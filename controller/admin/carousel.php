<?php 
require_once $_SERVER['DOCUMENT_ROOT'].'/controller/admin/admin_controller.php';

if(isset($_POST['acao'])){
    
    /*
         ADICIONAR ITEM CAROUSEL
    */
    if($_POST['acao'] == 'adicionar-item-carousel'){

         
          if(!isset($_POST['carousel_item_url']) OR !isset($_FILES['carousel_item_upload']) OR
             !isset($_POST['carousel_item_destino']) OR empty($_POST['carousel_item_destino']) OR 
             !isset($_POST['carousel_para']) OR empty($_POST['carousel_para'])){
                 die_error("Preencha todos os campos.");
          } 

          if(!empty($_FILES['carousel_item_upload']['tmp_name']) && !empty($_POST['carousel_item_url'])){
               die_error("Envie somente a url da imagem ou o arquivo da imagem.");
          }

          if(!empty($_FILES['carousel_item_upload']['tmp_name'])){
               $img = upload_imagem($_FILES['carousel_item_upload']);
               $carousel_item_url = $img['name'];
               $tmp = $img['tmp_name'];
               $caminho = BASE_IMAGES_CAROUSEL_PATCH.$carousel_item_url; 

          }

          if(!empty($_POST['carousel_item_url'])){
               if(!filter_var($_POST['carousel_item_url'], FILTER_VALIDATE_URL)){
                    die_error("A url do item do carousel é inválida.");
               }
               $carousel_item_url = $_POST['carousel_item_url'];
          }          

          if(!filter_var($_POST['carousel_item_destino'], FILTER_VALIDATE_URL)){
            die_error("A url do item do carousel é inválida.");
          }

          $carousel_posicao = contar_carousel_item_para($_POST['carousel_para']) + 1;

          if(!cadastrar_item_carousel($carousel_item_url, $_POST['carousel_item_destino'], 
                                      $_POST['carousel_para'], $carousel_posicao)){
                 die_error("Não foi possível adicionar.");
          }
          if(isset($caminho)){
               mover_imagem_upload($caminho, $tmp);
          }
          die_url(BASE_ADMIN.'carousel/'.$_POST['carousel_para']);               

        
    }

    /*
         EDITAR ITEM CAROUSEL
    */

    if($_POST['acao'] == 'editar-item-carousel'){

           if(!isset($_POST['carousel_id']) OR !intval($_POST['carousel_id'])){
                die_error("Carousel item não encontrado.");
           }


           if(!isset($_POST['carousel_item_url']) OR !isset($_FILES['carousel_item_upload']) OR
              !isset($_POST['carousel_item_url_destino']) OR empty($_POST['carousel_item_url_destino']) OR 
              !isset($_POST['carousel_para']) OR empty($_POST['carousel_para']) OR 
              !isset($_POST['carousel_posicao']) OR !intval($_POST['carousel_posicao'])){
                 die_error("Preencha todos os campos.");
           }

           if(!empty($_FILES['carousel_item_upload']['tmp_name']) && !empty($_POST['carousel_item_url'])){
               die_error("Envie somente a url da imagem ou o arquivo da imagem.");
           }

           $res = get_carousel_item_por_id($_POST['carousel_id']);
           $carousel_item_url = $res['carousel_item_url'];
           $carousel_item_url_atual = $res['carousel_item_url'];
           $carousel_posicao_atual = $res['carousel_posicao'];
           $caminho_excluir = BASE_IMAGES_CAROUSEL_PATCH.$res['carousel_item_url'];

           if(!empty($_FILES['carousel_item_upload']['tmp_name'])){
               $img = upload_imagem($_FILES['carousel_item_upload']);
               $carousel_item_url = $img['name'];
               $tmp = $img['tmp_name'];
               $caminho = BASE_IMAGES_CAROUSEL_PATCH.$carousel_item_url; 

          }

          if(!empty($_POST['carousel_item_url'])){
               if(!filter_var($_POST['carousel_item_url'], FILTER_VALIDATE_URL)){
                    die_error("A url do item do carousel é inválida.");
               }
               $carousel_item_url = $_POST['carousel_item_url'];
          }      


          if(!filter_var($_POST['carousel_item_url_destino'], FILTER_VALIDATE_URL)){
                die_error("A url do item do carousel é inválida.");
          }

           
          if($carousel_posicao_atual != $_POST['carousel_posicao']){
               if(verificar_posicao_carousel_existe($_POST['carousel_para'], $_POST['carousel_posicao']) > 0){
                    die_error("A posição já está em uso.");
               }
          }

          if(!editar_item_carousel($carousel_item_url, $_POST['carousel_item_url_destino'], 
                                   $_POST['carousel_para'], $_POST['carousel_posicao'], $_POST['carousel_id'])){
                die_error("Não foi possivel editar.");
          }

          if($carousel_item_url != $carousel_item_url_atual){ 

               if(isset($caminho)){
                    mover_imagem_upload($caminho, $tmp);
               }

               if(file_exists($caminho_excluir)){
                    excluir_imagem($caminho_excluir);
               }
          }

          die_url(BASE_ADMIN.'carousel/'.$_POST['carousel_para']);




    } 
    
    if($_POST['acao'] == 'excluir-item-carousel'){
          if(!isset($_POST['carousel_id']) OR !intval($_POST['carousel_id'])){
               die_error("O item do carousel não foi encontrado.");
          }

          if(empty(get_carousel_item_por_id($_POST['carousel_id']))){
               die_error("O item do carousel não foi encontrado.");
          }

          $carousel = get_carousel_item_por_id($_POST['carousel_id']);
          $caminho = BASE_IMAGES_CAROUSEL_PATCH.$carousel['carousel_item_url'];

          if(!excluir_item_carousel($_POST['carousel_id'])){
               die_error("Não foi possível excluir. Tente novamente.");
          }

          if(file_exists($caminho)){
               excluir_imagem($caminho);
          }

          die_reload();


    }


}