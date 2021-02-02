<?php

header('Content-Type: application/json', true);
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET");





include_once "Arquivo.php";

if(isset($_GET["id"]) && !empty($_GET["id"])) {
    $mensagem = Arquivo::recuperarArquivo($_GET["id"]);
    //header('Content-Type: '. $mensagem->tipo.",true");
    $string = "data:".$mensagem->tipo.";base64,";
    $retorno = array("image"=>$string.base64_encode($mensagem->arquivo));
   
}else{
    $retorno = array("status"=>"Parametro nao encontrado!");
}
echo json_encode($retorno);
?>