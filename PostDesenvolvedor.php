<?php
header("Content-Type: application/json", true);
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET");

//nick_name
 
include_once "Desenvolvedor.php";
include_once "DesenvolvedorComum.php";
include_once "Avaliacao.php";

if(isset($_POST["nick_name"]) && isset($_POST["link_lattes"])){
   //cadastrar o desenvolvedor
   $desenvolvedor = desenvolvedor::cadastrarDesenvolvedor($_POST["nick_name"], $_POST["link_lattes"]);
   $resposta = array("status" => $desenvolvedor);
}else if(isset($_POST["nick_name"]) && isset($_POST["instituicao"])){
   //cadastrar o desenvolvedor comum
   $boolean = DesenvolvedorComum::cadastrarDesenvolvedorComum($_POST["nick_name"], $_POST["instituicao"]);
   $resposta = array("status" => $boolean);
}else if(isset($_POST["nick_name"]) && isset($_POST["codigo"]) && isset($_POST["datahora"])){
   //aqui cadastro o registro de um desenvolvedor comum desenvolvendo um projeto
   $boolean = DesenvolvedorComum::cadastrarDesenvolveCP($_POST["codigo"],$_POST["nick_name"],$_POST["datahora"]);
   $resposta = array("status" => $boolean);
}else if(isset($_POST["nick_name_pro"]) && isset($_POST["codigo"]) && isset($_POST["datahora"])){
   //aqui cadastro o registro de um desenvolvedor pro desenvolvendo um projeto
   $boolean = Avaliacao::cadastrarAvaliacao($_POST["codigo"], $_POST["nick_name_pro"], $_POST["datahora"], null, null, null, null);
   $resposta = array("status" => $boolean);
}else if(isset($_GET["nick_name"])){
   //aqui retornaremos os projetos desenvolvidos por um desenvolvedor comum
   $mensagem = DesenvolvedorComum::retornarCodigo($_GET["nick_name"]);
   $resposta = array("codigos"=>$mensagem);
}else if(isset($_GET["nick_name_pro"])){
   //aqui retornaremos os projetos desenvolvidos por um desenvolvedor pro
   $mensagem = Avaliacao::retornaCodigo($_GET["nick_name_pro"]);
   $resposta = array("codigos"=>$mensagem);
}else{
   $resposta = array("status" => "Parametros nao encontrados");
}
echo json_encode($resposta);

?>