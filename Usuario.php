<?php
include_once "BancoDados.php";

class usuario
{
    public static function cadastrarUsuario($nick_name, $nome, $nivel , $senha, $logradouro, $numero, $cep, $cidade, $estado, $idArquivo)
    {

        try {
            // Criar uma conexão
            $conexao = BancoDados::getInstance()->getConnection();

            // Criar a SQL para executar
            $stmt = $conexao->prepare("INSERT INTO usuario(Nick_name, Nome, Nivel_Escolaridade, Senha, Logradouro, Numero, CEP, Cidade, Estado, idArquivo) VALUES (?,?,?,?,?,?,?,?,?,?)");

            // Executar a SQL
            $stmt->execute([$nick_name, $nome, $nivel, $senha, $logradouro, $numero, $cep, $cidade, $estado, $idArquivo]);

            // Checar resultado
            $linhas_alteradas = $stmt->rowCount();
        } catch (Exception $e) {
            echo $e->getMessage();
            exit;
        }

        if ($linhas_alteradas > 0) {
            return true;
        } else {
            return false;
        }
    }

    public static function deletarUsuario($nick_name)
    {

        try {
            deletarTelefone($nick_name);
            deletarEmails($nick_name);
            // Criar uma conexão
            $conexao = BancoDados::getInstance()->getConnection();

            // Criar a SQL para executar
            $stmt = $conexao->prepare("DELETE FROM usuario WHERE nick_name like '%$nick_name'");

            // Executar a SQL
            $stmt->execute([$nick_name]);

            // Checar resultado
            $linhas_alteradas = $stmt->rowCount();
        } catch (Exception $e) {
            echo $e->getMessage();
            exit;
        }

        if ($linhas_alteradas > 0) {
            return true;
        } else {
            return false;
        }
    }

    
    public static function editarUsuario($nick_name, $nome, $nivel , $senha, $data_nascimento, $logradouro, $numero, $cep, $cidade, $estado)
    {

        try {
            // Criar uma conexão
            $conexao = BancoDados::getInstance()->getConnection();

            // Criar a SQL para executar
            $stmt = $conexao->prepare("UPDATE usuario(Nome, Nivel_Escolaridade, Senha, Logradouro, Numero, CEP, Cidade, Estado) SET (?,?,?,?,?,?,?,?) WHERE nick_name=?");

            // Executar a SQL
            $stmt->execute([$nome, $nivel, $senha, $logradouro, $numero, $cep, $cidade, $estado, $nick_name]);

            // Checar resultado
            $linhas_alteradas = $stmt->rowCount();
        } catch (Exception $e) {
            echo $e->getMessage();
            exit;
        }

        if ($linhas_alteradas > 0) {
            return true;
        } else {
            return false;
        }
    }

    public static function retornaUsuario($nick_name, $senha){ //para o login
        try {
            $conexao = BancoDados::getInstance()->getConnection();

            $stmt = $conexao->prepare("SELECT u.* FROM usuario u WHERE u.nick_name=? and u.senha=?");

            $stmt->execute([$nick_name, $senha]);

            $resultado = $stmt->fetchAll();
        } catch (Exception $e) {
            echo $e->getMessage();
            exit;
        }

        return $resultado;
    }
    
    public static function retornaIdArquivoeNome($nick_name){ //para o login
        try {
            $conexao = BancoDados::getInstance()->getConnection();

            $stmt = $conexao->prepare("SELECT idArquivo, nome FROM usuario WHERE nick_name=?");

            $stmt->execute([$nick_name]);

            $resultado = $stmt->fetchAll();
        } catch (Exception $e) {
            echo $e->getMessage();
            exit;
        }

        return $resultado;
    }

    public static function hasNickName($nick_name){ //para o cadastrar
        try {
            $conexao = BancoDados::getInstance()->getConnection();

            $stmt = $conexao->prepare("SELECT nick_name FROM usuario WHERE nick_name=?");

            $stmt->execute([$nick_name]);

            $resultado = $stmt->fetchAll();
            if(count($resultado)>0){
                return true;
            }
            return false;
        } catch (Exception $e) {
            echo $e->getMessage();
            exit;
        }

        return null;
    }

    public static function retornarSenha($nick_name){ //para o cadastrar
        try {
            $conexao = BancoDados::getInstance()->getConnection();

            $stmt = $conexao->prepare("SELECT senha FROM usuario WHERE nick_name=?");

            $stmt->execute([$nick_name]);

            $resultado = $stmt->fetchAll();
           
            return $resultado;
        } catch (Exception $e) {
            echo $e->getMessage();
            exit;
        }

        return $resultado;
    }

    public static function redefinirSenha($nick_name, $antiga_senha, $nova_senha){
        try{
             
            $conexao = BancoDados::getInstance()->getConnection();

            $stmt = $conexao->prepare("UPDATE usuario SET Senha=? WHERE nick_name=? and senha=?");

            $stmt->execute([$nova_senha, $nick_name, $antiga_senha]);

            $linhas_alteradas = $stmt->rowCount();
        } catch (Exception $e){
            echo $e->getMessage();
            exit;
        }
        if ($linhas_alteradas > 0) {
            return true;
        }
        return false;
    
    }
    public static function redefinirEmail($nick_name, $antigoEmail, $novoEmail){
        try{
             
            $conexao = BancoDados::getInstance()->getConnection();

            $stmt = $conexao->prepare("UPDATE emails_usuario SET email=? WHERE nick_name=? and email=?");

            $stmt->execute([$novoEmail, $nick_name, $antigoEmail]);

            $linhas_alteradas = $stmt->rowCount();
        } catch (Exception $e){
            echo $e->getMessage();
            exit;
        }
        if ($linhas_alteradas > 0) {
            return true;
        }
        return false;
    
    }

    public static function redefinirIdImagem($nick_name, $idArquivo){
        try{
             
            $conexao = BancoDados::getInstance()->getConnection();

            $stmt = $conexao->prepare("UPDATE usuario SET idArquivo=? WHERE nick_name=?");

            $stmt->execute([$idArquivo, $nick_name]);

            $linhas_alteradas = $stmt->rowCount();
        } catch (Exception $e){
            echo $e->getMessage();
            exit;
        }
        if ($linhas_alteradas > 0) {
            return true;
        }
        return false;
    
    }

    public static function retornarUsuarios()
    {
        $resultado = array();

        try {
            $conexao = BancoDados::getInstance()->getConnection();

            $stmt = $conexao->prepare("SELECT u.nick_name, u.nome FROM usuario u");

            $stmt->execute();

            $resultado = $stmt->fetchAll();
        } catch (Exception $e) {
            echo $e->getMessage();
            exit;
        }

        return $resultado;
    }
    public static function cadastrarTelefone($nickname, $telefone) {

        try {
            // Criar uma conexão
            $conexao = BancoDados::getInstance()->getConnection();

            // Criar a SQL para executar
            $stmt = $conexao->prepare("INSERT INTO telefones_usuario(Nick_name, numero) VALUES (?, ?)");
            
            // Executar a SQL
            $stmt->execute([$nickname, $telefone]);
            
            // Checar resultado
            $linhas_alteradas = $stmt->rowCount();

        } catch(Exception $e) {
            echo $e->getMessage();
            exit;
        }
        
        if($linhas_alteradas > 0) {
            return true;
        } else {
            return false;
        }
        


    }

    public static function retornarTelefone() {
        $resultado = array();

        try {
            $conexao = BancoDados::getInstance()->getConnection();

            $stmt = $conexao->prepare("SELECT Nick_name, numero FROM telefones_usuario ORDER BY Nick_name");

            $stmt->execute();

            $resultado = $stmt->fetchAll();
        } catch(Exception $e) {
            echo $e->getMessage();
            exit;
        }

        return $resultado;
    }
    public static function deletarTelefone($nick_name)
    {

        try {
            // Criar uma conexão
            $conexao = BancoDados::getInstance()->getConnection();

            // Criar a SQL para executar
            $stmt = $conexao->prepare("DELETE FROM telefones_usuario WHERE Nick_name=?");

            // Executar a SQL
            $stmt->execute([$nick_name]);

            // Checar resultado
            $linhas_alteradas = $stmt->rowCount();
        } catch (Exception $e) {
            echo $e->getMessage();
            exit;
        }

        if ($linhas_alteradas > 0) {
            return true;
        } else {
            return false;
        }
    }
    public static function cadastrarEmail($nickname, $email) {

        try {
            // Criar uma conexão
            $conexao = BancoDados::getInstance()->getConnection();

            // Criar a SQL para executar
            $stmt = $conexao->prepare("INSERT INTO emails_usuario(Nick_name, email) VALUES (?, ?)");
            
            // Executar a SQL
            $stmt->execute([$nickname, $email]);
            
            // Checar resultado
            $linhas_alteradas = $stmt->rowCount();

        } catch(Exception $e) {
            echo $e->getMessage();
            exit;
        }
        
        if($linhas_alteradas > 0) {
            return true;
        } else {
            return false;
        }
        


    }

    public static function retornarEmails() {
        $resultado = array();

        try {
            $conexao = BancoDados::getInstance()->getConnection();

            $stmt = $conexao->prepare("SELECT Nick_name, email FROM emails_usuario ORDER BY Nick_name");

            $stmt->execute();

            $resultado = $stmt->fetchAll();
        } catch(Exception $e) {
            echo $e->getMessage();
            exit;
        }

        return $resultado;
    }
    public static function deletarEmails($nick_name)
    {

        try {

            // Criar uma conexão
            $conexao = BancoDados::getInstance()->getConnection();

            // Criar a SQL para executar
            $stmt = $conexao->prepare("DELETE FROM emails_usuario WHERE Nick_name=?");

            // Executar a SQL
            $stmt->execute([$nick_name]);

            // Checar resultado
            $linhas_alteradas = $stmt->rowCount();
        } catch (Exception $e) {
            echo $e->getMessage();
            exit;
        }

        if ($linhas_alteradas > 0) {
            return true;
        } else {
            return false;
        }
    }

     public static function VerificaUsuario($nick_name, $senha){ //para o login
        try {
            $conexao = BancoDados::getInstance()->getConnection();

            $stmt = $conexao->prepare("SELECT u.* FROM usuario u WHERE u.nick_name=? and u.senha=?");

            $stmt->execute([$nick_name, $senha]);

            $resultado = $stmt->fetchAll();
        } catch (Exception $e) {
            echo $e->getMessage();
            exit;
        }
        if(count($resultado)>0){
            return true;
        }else{
            return false;
        }
        
    }
}

?>