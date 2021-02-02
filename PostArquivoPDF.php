<?php

header("Content-Type: application/json", true);
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");


include_once "Arquivo.php";
/*
if(isset($_FILES['pdf'])){
    
    $id = gerarId();
    
    Arquivo::inserirArquivo($id, $_FILES['pdf']);
    
}

function gerarId(){
    $arrai = Arquivo::recuperarIds();
    return $arrai[0]["max(id)"]+1;
}


// Função que retorno um JSON com a propriedade sucesso e mensagem
function retorno($mensagem, $sucesso = false, $id = null)
{
    // Criando vetor com a propriedades
    $retorno = array();
    $retorno['sucesso'] = $sucesso;
    $retorno['mensagem'] = $mensagem;
    $retorno['id'] = $id;

    // Convertendo para JSON e retornando
    return json_encode($retorno);
}
*/

?>