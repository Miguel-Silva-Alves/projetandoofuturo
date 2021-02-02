<?php

    header('Content-Type: application/json', true);
    header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Methods: GET");

    include_once "Projeto.php";
    include_once "DesenvolvedorComum.php";
    include_once "Avaliacao.php";
    include_once "Compra.php";

    if(isset($_GET["JustIds"])){
        //só os ids dos projetos
        $codigos = Projeto::retornarIdsProjetos();
        $mensagem = [];
        for($i=0;$i<count($codigos);$i++){
            $mensagem[] = array(
                "codigo" => $codigos[$i]["Codigo"]
            );
        }
    }else if(isset($_GET["allProjetos"])){
        $projetos = Projeto::retornarProjetos();
        $mensagem = [];
        for($i=0;$i<count($projetos);$i++){
            $mensagem[] = array(
                "codigo" =>$projetos[$i]["codigo"],
                "nome" => $projetos[$i]["nome"],
                "resumo" => $projetos[$i]["Resumo"],
                "PDF" => $projetos[$i]["PDF_Link"],
                "Valor" => $projetos[$i]["valor"],
                "Data" => $projetos[$i]["data"],
                "Visualizacao" => $projetos[$i]["Visualiza"],
                "ImagemP" => $projetos[$i]["imagem"],
                "NomeGrupo" => $projetos[$i]["NomeGrupo"]
            );
        }
    }else if(isset($_GET["only"])){
        $projeto = Projeto::retornaProjetoUnico($_GET["only"]);
        $vamos = Avaliacao::retornaDesenvolvedor($_GET["only"]);
        if(count($vamos)>0){
            $pro = true;
        }else{
            $pro = false;
        }
        for($i=0;$i<count($projeto);$i++){
            $mensagem[] = array(
                "codigo" =>$projeto[$i]["Codigo"],
                "nome" => $projeto[$i]["nome"],
                "resumo" => $projeto[$i]["Resumo"],
                "PDF" => $projeto[$i]["PDF_LINK"],
                "Valor" => $projeto[$i]["Valor"],
                "Data" => $projeto[$i]["Data_Publicacao"],
                "Visualizacao" => $projeto[$i]["Visualizacao_3D"],
                "ImagemP" => $projeto[$i]["imagem"],
                "NomeGrupo" => $projeto[$i]["id_grupo"],
                "Pro" => $pro
            );
        }
    }else if(isset($_GET["nick_name_compra"])){
        
        $compras = Compra::retornarInformacoesCompra($_GET["nick_name_compra"]);
        if(count($compras)>0){
            for($i=0;$i<count($compras);$i++){
                $mensagem[] = array(
                    "nome" => $compras[$i]["nome"],
                    "valor" => $compras[$i]["valor"],
                    "dataHora" => $compras[$i]["Data_Compra"],
                    "horaCompra"=>$compras[$i]["Hora_Compra"]
                );
            }
        }else{
            $mensagem = array("status"=>null);
        }
        
    }else if(isset($_GET["JustNomes"])){
        //retornar os nomes dos projetos, para o autocomplet do pesquisar
        $nomes = Projeto::retornaNomes();
        $mensagem = array("nomes"=>$nomes);
    }else if(isset($_GET["codigo"]) && isset($_GET["nick_name"])){
        //retornar o nome do projeto, e a ultima data que está la
        $listaComNome = Projeto::retornaNome($_GET["codigo"]);
        $listaComData = DesenvolvedorComum::retornarDataHoraDesenvolvesCP($_GET["codigo"], $_GET["nick_name"]);
        if(count($listaComNome)>0 ){
            $nomez = $listaComNome[0]["nome"];
        }else{
            $nomez = "";
        }
        if(count($listaComData)>0){
            $dataz = $listaComData[0]["dataHora"];
        }else{
            $dataz = "";
        }
        $mensagem = array("nome"=>$nomez, "data"=>$dataz);
    }else if(isset($_GET["codigo"]) && isset($_GET["nick_name_pro"])){
        //retornar o nome do projeto, e a ultima data que está la
        $listaComNome = Projeto::retornaNome($_GET["codigo"]);
        $listaComData = Avaliacao::retornaDataHoraDesenvolvimento($_GET["nick_name_pro"], $_GET["codigo"]);
        if(count($listaComNome)>0 ){
            $nomez = $listaComNome[0]["nome"];
        }else{
            $nomez = "";
        }
        if(count($listaComData)>0){
            $dataz = $listaComData[0]["dataHora"];
        }else{
            $dataz = "";
        }
        $mensagem = array("nome"=>$nomez, "data"=>$dataz);
    }else if(isset($_GET["codigoProjetoComRetornoDoDesenvolvedor"])){
        //vamos identificar se o desenvolvedor é pro ou comum
        $listaComum = DesenvolvedorComum::retornarDesenvolvedor($_GET["codigoProjetoComRetornoDoDesenvolvedor"]);
        $listaPro = Avaliacao::retornaDesenvolvedor($_GET["codigoProjetoComRetornoDoDesenvolvedor"]);
        $nick1 = null;
        $nick2 = null;
        if(count($listaComum)>0){
            $nick1 = $listaComum[0]["Nick_name"];
        }
        if(count($listaPro)>0){
            $nick2 = $listaPro[0]["Nick_pro_desenvolvedor"];
        }
        $mensagem = array("comum"=>$nick1, "pro"=>$nick2);
    }else{
        $mensagem = array("status" => "erro de parametro");
    }


    echo json_encode($mensagem);

?>