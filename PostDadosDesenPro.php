<?php
    header('Content-Type: application/json', true);
    header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Methods: POST");

    //nick_name
     
    include_once "DesenvolvedorPro.php";
    //Alterar senha
    if(isset($_POST["nick_name"]) && !empty($_POST["nick_name"]) && isset($_POST["nomeBanco"]) && !empty($_POST["nomeBanco"]) && isset($_POST["agencia"]) && !empty($_POST["agencia"]) && isset($_POST["tipoConta"]) && !empty($_POST["tipoConta"]) && isset($_POST["numeroConta"]) && !empty($_POST["numeroConta"]) && isset($_POST["alterar"])) {
    
        $usuarioEscolhido = DesenvolvedorPro::editarDesenvolvedorPro($_POST["nick_name"], $_POST["nomeBanco"], $_POST["agencia"], $_POST["tipoConta"], $_POST["numeroConta"]);
        if($usuarioEscolhido>0){
            $retorno = array("status" => "Dados alterados com sucesso!");
        }else{
            $retorno = array("status" => "ERRO!");
        }
    }else if(isset($_POST["nick_name"]) && !empty($_POST["nick_name"]) && isset($_POST["nomeBanco"]) && !empty($_POST["nomeBanco"]) && isset($_POST["agencia"]) && !empty($_POST["agencia"]) && isset($_POST["tipoConta"]) && !empty($_POST["tipoConta"]) && isset($_POST["numeroConta"]) && !empty($_POST["numeroConta"])){
        //cadastrar desenvolvedor pro
        $boolean = DesenvolvedorPro::cadastrarDesenvolvedorPro($_POST["nick_name"], $_POST["nomeBanco"], $_POST["agencia"], $_POST["tipoConta"], $_POST["numeroConta"]);
        $retorno = array("status" => $boolean);
    }else{
        $retorno = array("status" => "Parametros nao encontrados");
    }
        
    // Seja qual for o resultado, imprime o JSON.
    echo json_encode($retorno);
?>