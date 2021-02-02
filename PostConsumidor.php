<?php
    header("Content-Type: application/json", true);
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: POST");

    //nick_name
     
    //Alterar sexo
    include_once "Consumidor.php";
    if(isset($_POST["nick_name"]) && !empty($_POST["nick_name"]) && isset($_POST["sexo"]) && !empty($_POST["sexo"]) && isset($_POST["alterar"])) {
    
        $ConsumidorEscolhido = Consumidor::EditarConsumidor($_POST["nick_name"], $_POST["sexo"]);
        if($usuarioEscolhido>0){
            $retorno = array("status" => "Dados alterados com sucesso!");
        }else{
            $retorno = array("status" => "ERRO!");
        }
    }else if(isset($_POST["nick_name"]) && isset($_POST["sexo"])){
        $booleana = Consumidor::cadastrarConsumidor($_POST["nick_name"], $_POST["sexo"]);
        $retorno = array("status" => $booleana);
    }else{
        $retorno = array("status" => "parametros nao encontrados");
    }
        
    // Seja qual for o resultado, imprime o JSON.
    echo json_encode($retorno);
?>