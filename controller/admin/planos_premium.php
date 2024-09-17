<?php 
require_once $_SERVER['DOCUMENT_ROOT'].'/controller/admin/admin_controller.php';

if(isset($_POST['acao'])){
  
    if($_POST['acao'] == 'adicionar'){  

    if(!isset($_POST['premium_titulo']) OR empty($_POST['premium_titulo']) OR 
       !isset($_POST['premium_preco']) OR empty($_POST['premium_preco']) OR  
       !isset($_POST['premium_dias_acesso']) OR 
       !isset($_POST['premium_telas']) OR  !intval($_POST['premium_telas']) OR
       !isset($_POST['premium_consumo_creditos_revendedor']) OR !intval($_POST['premium_consumo_creditos_revendedor']) OR 
       !isset($_POST['premium_caracteristica']) OR empty($_POST['premium_caracteristica'][0])){
        die_error("Preecha todos os campos.");
    }

    $premium_titulo                      = ucwords(trim($_POST['premium_titulo']));
    $premium_diretorio                   = diretorio($premium_titulo);
    $premium_preco                       = $_POST['premium_preco'];
    $premium_dias_acesso                 = $_POST['premium_dias_acesso'];
    $premium_caracteristica              = $_POST['premium_caracteristica'];
    $premium_telas                       = $_POST['premium_telas'];
    $premium_consumo_creditos_revendedor = $_POST['premium_consumo_creditos_revendedor'];

    if(!intval($premium_dias_acesso)){
        die_error("A quantidades de dias de acesso deve ser maior que 0.");
    }

    if(!valida_preco($premium_preco)){
        die_error("O preço é inválido.");
    }

    if(contar_plano_premium_por_diretorio($premium_diretorio) > 0){
        die_error("O plano premium já existe.");
    }
    
    $a = '';
    foreach($premium_caracteristica as $item){
        $a .= $item . '<::>';
    }
    $premium_caracteristica = substr($a, 0 , -4);

    if(!adicionar_plano_premium($premium_titulo, $premium_diretorio,
                              $premium_preco, $premium_dias_acesso,
                              $premium_caracteristica, $premium_telas,
                              $premium_consumo_creditos_revendedor)){
        die_error("Não foi possível adicionar.");
    }

    die_url(BASE_ADMIN.'planos-premium/listar');


    }

    //EDITAR
    if($_POST['acao'] == 'editar'){
    
        if(!isset($_POST['premium_titulo']) OR empty($_POST['premium_titulo']) OR 
           !isset($_POST['premium_preco']) OR empty($_POST['premium_preco']) OR  
           !isset($_POST['premium_dias_acesso']) OR 
           !isset($_POST['premium_telas']) OR  !intval($_POST['premium_telas']) OR
           !isset($_POST['premium_consumo_creditos_revendedor']) OR !intval($_POST['premium_consumo_creditos_revendedor']) OR 
           !isset($_POST['premium_caracteristica']) OR empty($_POST['premium_caracteristica'][0])){
            die_error("Preecha todos os campos.");
        }

        $premium_id                          = $_POST['premium_id'];
        $premium_titulo                      = ucwords(trim($_POST['premium_titulo']));
        $premium_diretorio                   = diretorio($premium_titulo);
        $premium_preco                       = $_POST['premium_preco'];
        $premium_dias_acesso                 = $_POST['premium_dias_acesso'];
        $premium_caracteristica              = $_POST['premium_caracteristica'];
        $premium_telas                       = $_POST['premium_telas'];
        $premium_consumo_creditos_revendedor = $_POST['premium_consumo_creditos_revendedor'];

        if(empty(get_plano_premium_por_id($premium_id))){
            die_error("O plano premium não existe.");
        }

        if(!intval($premium_dias_acesso)){
            die_error("A quantidades de dias de acesso deve ser maior que 0.");
        }

        if(!valida_preco($premium_preco)){
            die_error("O preço é inválido.");
        }

        if(contar_plano_premium_por_diretorio($premium_diretorio) > 1){
            die_error("O plano premium já existe.");
        }

        
        $a = '';
        foreach($premium_caracteristica as $item){
            $a .= $item . '<::>';
        }
        $premium_caracteristica = substr($a, 0 , -4);

        if(!editar_plano_premium($premium_titulo, $premium_diretorio,
                                 $premium_preco, $premium_dias_acesso,
                                 $premium_caracteristica, $premium_telas,
                                 $premium_consumo_creditos_revendedor, $premium_id)){
            die_error("Não foi possível editar.");                    
        }

        die_url(BASE_ADMIN.'planos-premium/listar');


    }

    //EXCLUIR
    if($_POST['acao'] == 'excluir'){
        if(!isset($_POST['premium_id']) OR !intval($_POST['premium_id'])){
            die_error("O plano premium não foi encontrado.");
        }

        if(empty(get_plano_premium_por_id($_POST['premium_id']))){
            die_error("O plano premium não existe.");
        }

        if(!excluir_plano_premium($_POST['premium_id'])){
            die_error("Não foi possível excluir.");
        }

        die_reload();
    }

}