<?php
    header("Content-Type: application/json", true);
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: POST");

    //nick_name
     
    include_once "AvaliadorPro.php";
    include_once "Avaliador.php";
    include_once "AvaliadorComum.php";

    if(isset($_POST["nick_name"]) && !empty($_POST["nick_name"]) && isset($_POST["NomeBanco"]) && !empty($_POST["NomeBanco"]) && isset($_POST["Agencia"]) && !empty($_POST["Agencia"]) && isset($_POST["TipoConta"]) && !empty($_POST["TipoConta"]) && isset($_POST["NumeroConta"]) && !empty($_POST["NumeroConta"]) && isset($_POST["alterar"])) {
        //redefinir dados bancarios de um avaliador pro
        $usuarioEscolhido = AvaliadorPro::redefinirBanco($_POST["nick_name"], $_POST["NomeBanco"], $_POST["Agencia"], $_POST["TipoConta"], $_POST["NumeroConta"]);
        if($usuarioEscolhido>0){
            $retorno = array("status" => "Dados alterados com sucesso!");
        }else{
            $retorno = array("status" => "ERRO!");
        }
    }else if(isset($_POST["nick_name"]) && !empty($_POST["nick_name"]) && isset($_POST["NomeBanco"]) && !empty($_POST["NomeBanco"]) && isset($_POST["Agencia"]) && !empty($_POST["Agencia"]) && isset($_POST["TipoConta"]) && !empty($_POST["TipoConta"]) && isset($_POST["NumeroConta"]) && !empty($_POST["NumeroConta"])){
        //cadastrar o dados bancários avaliador pro
        $boolean = AvaliadorPro::cadastrarAvaliadorPro($_POST["nick_name"], $_POST["NomeBanco"], $_POST["Agencia"], $_POST["TipoConta"], $_POST["NumeroConta"]);
        $retorno = array("status" => $boolean);
    }else if(isset($_POST["nick_name"]) && isset($_POST["Local"]) && isset($_POST["LinkCurriculo"])){
        //cadastrando um avaliador 
        $booleana = Avaliador::cadastrarAvaliador($_POST["nick_name"], $_POST["Local"], $_POST["LinkCurriculo"]);
        $retorno = array("status" => $booleana);
    }else if(isset($_POST["nick_name"]) && isset($_POST["sexo"])){
        //cadastrando avaliador comum

        $booleanaa = AvaliadorComum::cadastrarAvaliadorComum($_POST["nick_name"], $_POST["sexo"]);
        $retorno = array("status" => $booleanaa);
    }else{
        $retorno = array("status" => "Parametros nao encontrados");
    }
        
    // Seja qual for o resultado, imprime o JSON.
    echo json_encode($retorno);
?>