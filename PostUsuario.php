<?php
    header("Content-Type: application/json", true);
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: POST");
    include_once "Usuario.php";
     
    //Alterar senha
    if(isset($_POST["nick_name"]) && !empty($_POST["nick_name"]) && isset($_POST["nova_senha"]) && !empty($_POST["nova_senha"]) && isset($_POST["antiga_senha"]) && !empty($_POST["antiga_senha"])) {
        //alterar senha
        $usuarioEscolhido = usuario::redefinirSenha($_POST["nick_name"], password_hash($_POST["antiga_senha"], PASSWORD_BCRYPT), password_hash($_POST["nova_senha"], PASSWORD_BCRYPT));
        $retorno = array("status" => $usuarioEscolhido);
        
    }else if(isset($_POST["nick_name"]) && !empty($_POST["nick_name"]) && isset($_POST["novoEmail"]) && !empty($_POST["novoEmail"]) && isset($_POST["antigoEmail"]) && !empty($_POST["antigoEmail"])) {
        //alterar email
        $usuarioEmail = usuario::redefinirEmail($_POST["novoEmail"], $_POST["nick_name"], $_POST["antigoEmail"]);
        if($usuarioEmail>0){
            $retorno = array("status" => "Email Alterado com sucesso!");
        }else{
            $retorno = array("status" => "ERRO!");
        }
    }else if(isset($_POST["nick_name"]) && isset($_POST["nome"]) && isset($_POST["senha"]) && isset($_POST["cidade"]) && isset($_POST["estado"]) && isset($_POST["logradouro"]) && isset($_POST["CEP"]) && isset($_POST["numero"]) && isset($_POST["nivelescolaridade"]) && isset($_POST["idArquivo"]) ){
        //cadastrar usuario
        $boolean = usuario::cadastrarUsuario($_POST["nick_name"],$_POST["nome"],$_POST["nivelescolaridade"], password_hash($_POST["senha"], PASSWORD_BCRYPT),$_POST["logradouro"],$_POST["numero"],$_POST["CEP"],$_POST["cidade"],$_POST["estado"],$_POST["idArquivo"]);
        //$boolean=true;
        if($boolean){
            $retorno = array("status" => "Sucesso");
        }else{
            $retorno = array("status" => "Erro");
        }
    }else if(isset($_POST["nick_name"]) && isset($_POST["idArquivoRedefinir"])){
        //redefinir a imagem do usuario
        $boolean = usuario::redefinirIdImagem($_POST["nick_name"], $_POST["idArquivoRedefinir"]);
        $retorno = array("status" => $boolean);
    }else{
        $retorno = array("status" => "Parametros errados");
    }
        
    // Seja qual for o resultado, imprime o JSON.
    echo json_encode($retorno);
?>