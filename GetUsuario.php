<?php

    header("Content-Type: application/json", true);
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: POST");

    include_once "Usuario.php";
    include_once "Consumidor.php";
    include_once "DesenvolvedorComum.php";
    include_once "DesenvolvedorPro.php";
    include_once "AvaliadorPro.php";
    include_once "AvaliadorComum.php";
    

    if(isset($_POST["nick_name"]) && isset($_POST["senha"])){
        //validar o usuario
        $senharetornaada = usuario::retornarSenha($_POST["nick_name"]);
        if(count($senharetornaada)>0){
            if(password_verify($_POST["senha"], $senharetornaada[0]["senha"])){
                //verificar o tipo
                $cons = Consumidor::isConsumidor($_POST["nick_name"]);
                $dcomum = DesenvolvedorComum::isDesenvolvedorComum($_POST["nick_name"]);
                $dpro = DesenvolvedorPro::isDesenvolvedorPro($_POST["nick_name"]);
                $apro = AvaliadorPro::isAvaliadorPro($_POST["nick_name"]);
                $acomum = AvaliadorComum::isAvaliadorPro($_POST["nick_name"]);

                $resultado = array("status"=>true, "cc"=>$cons, "dc" => $dcomum, "dp" => $dpro, "ap" => $apro, "ac" => $acomum);//
            }else{
                $resultado = array("status"=>false);
            }
        }else{
            $resultado = array("status"=>false);
        }
    }else if(isset($_POST["nick_name"]) && isset($_POST["imagem"])){
        //retornar o id da imagem -> usado para inserir a imagem do usuario no menu
        $r = usuario::retornaIdArquivoeNome($_POST["nick_name"]);
        if(count($r)>0){
            $resultado = array("id"=>$r[0]["idArquivo"], "nome"=>$r[0]["nome"]);
        }else{
            $resultado = array("id"=>null);
        }
    }else if(isset($_POST["nick_name_verificar"])){
        //detectar a existencia de um nick_name
        $r = usuario::hasNickName($_POST["nick_name_verificar"]);
        $resultado = array("status"=>$r); //true = já existe, false nop
    }else{
        $resultado = array("status"=>"Parametros nao encontrados");
    }
    echo json_encode($resultado);
    
    
?>