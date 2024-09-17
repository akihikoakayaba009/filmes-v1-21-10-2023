<?php 
require_once $_SERVER['DOCUMENT_ROOT'].'/controller/admin/admin_controller.php';


if(isset($_POST['acao'])){


    //ADICIONAR
    if($_POST['acao'] == 'adicionar-categoria'){

        if(!isset($_POST['categoria_titulo']) OR 
            empty($_POST['categoria_titulo']) OR 
            !isset($_POST['categoria_descricao']) OR 
            !isset($_FILES['categoria_image']) OR 
            !isset($_POST['categoria_para'])){
                die_error("Preencha todos os campos.");
        }

            $categoria_titulo    = ucwords(trim($_POST['categoria_titulo']));
            $categoria_diretorio = diretorio($categoria_titulo);
            $categoria_para      = $_POST['categoria_para'];
            $categoria_image     = NULL;
            $categoria_descricao = NULL;

            if(!empty($_POST['categoria_descricao'])){
                $categoria_descricao = htmlspecialchars($_POST['categoria_descricao']);
            }

            if(!empty($_FILES['categoria_image']['tmp_name'])){
                $img = upload_imagem($_FILES['categoria_image']);
                $categoria_image = $img['name'];
                $tmp = $img['tmp_name'];
                $caminho = BASE_IMAGES_CATEGORIAS_PATCH.$categoria_image;
            }

            if(!midia_tipo($categoria_para)){
                die_error("A opção de mídia selecionada é inválida.");
            }

            if(verificar_categoria_existe($categoria_diretorio, $categoria_para) > 0){
                die_error("A categoria já existe.");
            }

            if(!adicionar_categoria($categoria_titulo, $categoria_descricao, $categoria_para,
                                     $categoria_image, $categoria_diretorio)){
                 die_error("Não foi possível adicionar.");                       
            }

            if(isset($caminho)){
                mover_imagem_upload($caminho, $tmp);
            }

            die_success_reload("A categoria foi adicionada.");
             
    }



    //EDITAR
    if($_POST['acao'] == 'editar-categoria'){


        if(!isset($_POST['categoria_titulo']) OR 
            empty($_POST['categoria_titulo']) OR 
            !isset($_FILES['categoria_image']) OR 
            !isset($_POST['categoria_para']) OR 
            !isset($_POST['categoria_descricao']) OR
            !isset($_POST['categoria_id']) OR !intval($_POST['categoria_id'])){
                die_error("Preencha todos os campos.");
        }

        $categoria_id        = $_POST['categoria_id'];
        $categoria_titulo    = ucwords(trim($_POST['categoria_titulo']));
        $categoria_diretorio = diretorio($categoria_titulo);
        $categoria_para      = $_POST['categoria_para'];
        $categoria_descricao = NULL;

        if(!empty($_POST['categoria_descricao'])){
            $categoria_descricao = htmlspecialchars($_POST['categoria_descricao']);
        }

        if(!midia_tipo($categoria_para)){
            die_error("A opção de mídia selecionada é inválida.");
        }
        
        $res = get_categoria_por_id($categoria_para, $categoria_id);
        $categoria_image = $res['categoria_image'];
        $categoria_image_atual = $res['categoria_image'];
        $caminho_excluir = BASE_IMAGES_CATEGORIAS_PATCH.$categoria_image_atual;
        
        if(verificar_categoria_existe($categoria_diretorio, $categoria_para) > 1){
            die_error("A categoria já existe.");    
        }

        if(!empty($_FILES['categoria_image']['tmp_name']) && !isset($_POST['remover_image'])){
            $img = upload_imagem($_FILES['categoria_image']);
            $categoria_image = $img['name'];
            $tmp  = $img['tmp_name'];
            $caminho = BASE_IMAGES_CATEGORIAS_PATCH.$categoria_image;
        }

        if(isset($_POST['remover_image'])){
            if(file_exists($caminho_excluir)){
                @unlink($caminho_excluir);
            }
            $categoria_image = NULL;
        }

        if(!editar_categoria($categoria_titulo, $categoria_descricao, $categoria_para,
                             $categoria_image, $categoria_diretorio,
                             $categoria_id)){
             die_error("Não foi possível editar.");                   
        }

        if($categoria_image != $categoria_image_atual && !isset($_POST['remover_image'])){
            mover_imagem_upload($caminho, $tmp);
            if(file_exists($caminho_excluir)){
                @unlink($caminho_excluir);
            }
        }

        die_success_reload("A categoria foi editada.");

    }

    //EXCLUIR
    if($_POST['acao'] == 'excluir-categoria'){
        if(!isset($_POST['categoria_id']) && !intval($_POST['categoria_id']) OR 
           !isset($_POST['categoria_para']) OR empty($_POST['categoria_para'])){
            die_error("A categoria não foi encontrada.");
        }

        if(!midia_tipo($_POST['categoria_para'])){
            die_error("Informações insulficientes para excluir.");
        }

        if(empty(get_categoria_por_id($_POST['categoria_para'], $_POST['categoria_id']))){
            die_error("A categoria não foi encontrada.");
        }

        $categoria_para = $_POST['categoria_para'];
        $categoria_id   = $_POST['categoria_id'];

        $res = get_categoria_por_id($categoria_para, $categoria_id);
        $midias = listar_midia_por_categoria($categoria_para, $categoria_id);

        $categoria_image = BASE_IMAGES_CATEGORIAS_PATCH.$res['categoria_image'];

        if($midias > 0){
            foreach($midias as $item){
                $midia_id = $item['midia_id'];
                $midia_image = BASE_IMAGES_MIDIA_PATCH.$item['midia_image'];
                if(!filter_var($midia_image, FILTER_VALIDATE_URL)){
                    excluir_imagem($midia_image);
                }

                if(count(midia_get_episodios($midia_id)) > 0){
                    foreach(midia_get_episodios($midia_id) as $ep){
                        $episodio_image = BASE_IMAGES_EPISODIOS_PATCH.$ep['episodio_image'];
                        if(!empty($ep['episodio_image'])){
                             excluir_imagem($episodio_image);   
                        }    
                    }
                }
                midia_excluir_temporadas($midia_id);
                midia_excluir_episodios($midia_id);
                midia_excluir_players($midia_id);
                excluir_midia($midia_id);

            }
        }
        
        if(!excluir_categoria($categoria_id)){
            die_error("Não foi possível excluir.");
        }

        if(!empty($res['categoria_image'])){
            excluir_imagem($categoria_image);
        }

        die_reload();

    }



}