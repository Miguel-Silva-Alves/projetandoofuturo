<?php

header('Content-Type: application/json', true);
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: POST");

include_once "Projeto.php";
include_once "Avaliacao.php";
include_once "Avaliador.php";
include_once "Compra.php";



if(isset($_POST["nome"]) && isset($_POST["valor"]) && isset($_POST["resumo"]) && isset($_POST["data"]) && isset($_POST["visualiza"])){
   
    $id = conseguirId();
    $boolean = Projeto::cadastrarProjeto($id, $_POST["nome"], $_POST["valor"], $_POST["resumo"], $_POST["data"], $_POST["visualiza"], null, null, null);
    if($boolean){
        $mensagem = array("status" => "sucesso", "id" => $id);
    }else{
        $mensagem = array("status" => "erro no cadastro");
    }
}else if(isset($_POST["idArquivo"]) && isset($_POST["codigo"]) && isset($_POST["oque"])){
    //jeito que encontrei para inserir o id no projeto
    $booleana = Projeto::substituirIdArquivo($_POST["idArquivo"], $_POST["codigo"], $_POST["oque"]);
    if($booleana){
        $mensagem = array("status" => "modificado");
    }else{
        $mensagem = array("status" => "erro no update");
    }
    
}else if(isset($_POST["codigo"]) && isset($_POST["nick_name_pro"]) && isset($_POST["observacao"]) && isset($_POST["nota"]) && isset($_POST["dataHora"]) && isset($_POST["nick_pro_avaliador"])){
    //uma avaliação específica, que envolve desenvolvedor e avaliador pró
    $boolean = Avaliacao::editarAvaliacao($_POST["codigo"], $_POST["nick_name_pro"], $_POST["dataHora"], $_POST["nick_pro_avaliador"], $_POST["nota"], $_POST["observacao"]);
    $mensagem = array("status"=>$boolean);
}else if(isset($_POST["codigo"]) && isset($_POST["observacao"]) && isset($_POST["nota"]) && isset($_POST["nick_avaliador"])){
    //avaliacao simples
    $boolean = Avaliador::cadastraAvalia($_POST["nick_avaliador"],$_POST["codigo"],$_POST["observacao"],$_POST["nota"]);
    $mensagem = array("status"=>$boolean);
}else if(isset($_POST["nick_name_consumidor"]) && isset($_POST["codigoProjeto"]) && isset($_POST["parcelas"]) && isset($_POST["hora"]) && isset($_POST["data"]) && isset($_POST["formapagamento"])){
    //registro da compra
    $notafiscal = conseguirIdparaCompra();
    $boolean = Compra::cadastrarCompra($notafiscal, $_POST["nick_name_consumidor"],$_POST["codigoProjeto"],$_POST["parcelas"],$_POST["hora"], $_POST["data"],$_POST["formapagamento"]);
    $mensagem = array("status"=>$boolean);
}else{
    $mensagem = array("status" => "algum parâmetro não foi encontrado");
}

echo json_encode($mensagem);

function conseguirId(){
    $arrai = Projeto::recuperarId();
    return $arrai[0]["max(Codigo)"]+1;
}

function conseguirIdparaCompra(){
    $arrai = Compra::recuperarNotaFiscalMax();
    return $arrai[0]["max(NotaFiscal)"]+1;
}

?>